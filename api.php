<?php

declare(strict_types=1);

const ADMIN_EMAIL = 'saiful@jagatarsy.sch.id';
const ADMIN_PASSWORD_HASH = '$2y$12$Ls61Pee7bSdP8Et6YefeAekLraedFMa.I/MX4m5IUqf0bcK5Nkqou';

ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'httponly' => true,
    'samesite' => 'Strict',
]);
session_start();

/*
 * SQLite schema:
 * CREATE TABLE quiz_results (
 *     id INTEGER PRIMARY KEY AUTOINCREMENT,
 *     student_name TEXT NOT NULL,
 *     class_name TEXT NOT NULL,
 *     score INTEGER NOT NULL CHECK (score BETWEEN 0 AND 100),
 *     taken_at TEXT NOT NULL,
 *     payload TEXT NOT NULL,
 *     created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
 * );
 */

final class QuizRepository
{
    private PDO $database;

    public function __construct(string $databasePath)
    {
        $directory = dirname($databasePath);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException('Direktori penyimpanan tidak dapat dibuat.');
        }

        $this->database = new PDO('sqlite:' . $databasePath, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $this->database->exec('PRAGMA busy_timeout = 5000');
        $this->database->exec(
            'CREATE TABLE IF NOT EXISTS quiz_results (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                student_name TEXT NOT NULL,
                class_name TEXT NOT NULL,
                score INTEGER NOT NULL CHECK (score BETWEEN 0 AND 100),
                taken_at TEXT NOT NULL,
                payload TEXT NOT NULL,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );
        $this->database->exec(
            'CREATE TABLE IF NOT EXISTS student_users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                student_name TEXT NOT NULL,
                class_name TEXT NOT NULL,
                level TEXT NOT NULL,
                email TEXT NOT NULL,
                password_hash TEXT NOT NULL,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE(email)
            )'
        );
        $this->database->exec(
            'CREATE TABLE IF NOT EXISTS question_bank (
                id TEXT PRIMARY KEY,
                level TEXT NOT NULL,
                class_name TEXT NOT NULL,
                position INTEGER NOT NULL,
                question_data TEXT NOT NULL,
                updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );

        $columns = $this->database->query("PRAGMA table_info(student_users)")->fetchAll();
        $columnNames = array_map(static fn (array $column): string => $column['name'], $columns);
        if (!in_array('email', $columnNames, true)) {
            $this->database->exec('ALTER TABLE student_users ADD COLUMN email TEXT NOT NULL DEFAULT ""');
            $this->database->exec('CREATE UNIQUE INDEX IF NOT EXISTS idx_student_users_email ON student_users(email)');
        }
    }

    public function all(): array
    {
        $statement = $this->database->query(
            'SELECT payload FROM quiz_results ORDER BY id DESC'
        );

        return array_map(
            static fn (array $row): array => json_decode($row['payload'], true, 512, JSON_THROW_ON_ERROR),
            $statement->fetchAll()
        );
    }

    public function studentResults(string $studentName, string $className): array
    {
        $statement = $this->database->prepare(
            'SELECT payload FROM quiz_results
             WHERE student_name = :student_name AND class_name = :class_name
             ORDER BY id DESC LIMIT 5'
        );
        $statement->execute([
            'student_name' => trim($studentName),
            'class_name' => trim($className),
        ]);

        return array_map(
            static fn (array $row): array => json_decode($row['payload'], true, 512, JSON_THROW_ON_ERROR),
            $statement->fetchAll()
        );
    }

    public function save(array $payload): void
    {
        $name = $payload['identitasSiswa']['namaLengkap'] ?? null;
        $className = $payload['identitasSiswa']['kelasAtauNIM'] ?? null;
        $score = $payload['ringkasanNilai']['skorAkhir'] ?? null;
        $takenAt = $payload['metadata']['tanggalPengerjaan'] ?? null;

        if (!is_string($name) || trim($name) === '' || strlen($name) > 200
            || !is_string($className) || trim($className) === '' || strlen($className) > 100
            || !is_int($score) || $score < 0 || $score > 100
            || !is_string($takenAt) || trim($takenAt) === '') {
            throw new InvalidArgumentException('Data hasil kuis tidak valid.');
        }

        $statement = $this->database->prepare(
            'INSERT INTO quiz_results (student_name, class_name, score, taken_at, payload)
             VALUES (:student_name, :class_name, :score, :taken_at, :payload)'
        );
        $statement->execute([
            'student_name' => trim($name),
            'class_name' => trim($className),
            'score' => $score,
            'taken_at' => $takenAt,
            'payload' => json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE),
        ]);
    }

    public function registerStudent(string $studentName, string $className, string $level, string $email, string $password): array
    {
        $name = trim($studentName);
        $class = trim($className);
        $schoolLevel = trim($level);
        $studentEmail = strtolower(trim($email));

        if ($name === '' || $class === '' || $schoolLevel === '' || $studentEmail === '') {
            throw new InvalidArgumentException('Nama, kelas, tingkat, dan email wajib diisi.');
        }
        if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Format email tidak valid.');
        }
        if (strlen($password) < 4 || strlen($password) > 64) {
            throw new InvalidArgumentException('Password harus terdiri dari 4 sampai 64 karakter.');
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        if ($hashed === false) {
            throw new RuntimeException('Password tidak dapat diproses.');
        }

        $statement = $this->database->prepare(
            'INSERT INTO student_users (student_name, class_name, level, email, password_hash, updated_at)
             VALUES (:student_name, :class_name, :level, :email, :password_hash, datetime("now"))
             ON CONFLICT(email)
             DO UPDATE SET student_name = excluded.student_name, class_name = excluded.class_name, level = excluded.level, password_hash = excluded.password_hash, updated_at = datetime("now")'
        );
        $statement->execute([
            'student_name' => $name,
            'class_name' => $class,
            'level' => $schoolLevel,
            'email' => $studentEmail,
            'password_hash' => $hashed,
        ]);

        return ['name' => $name, 'class_name' => $class, 'level' => $schoolLevel, 'email' => $studentEmail];
    }

    public function loginStudent(string $email, string $password): array
    {
        $studentEmail = strtolower(trim($email));

        if ($studentEmail === '') {
            throw new InvalidArgumentException('Email wajib diisi.');
        }
        if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Format email tidak valid.');
        }
        if (strlen($password) < 4) {
            throw new InvalidArgumentException('Password tidak valid.');
        }

        $statement = $this->database->prepare(
            'SELECT * FROM student_users WHERE email = :email LIMIT 1'
        );
        $statement->execute([
            'email' => $studentEmail,
        ]);

        $user = $statement->fetch();
        if (!$user || !password_verify($password, $user['password_hash'])) {
            throw new InvalidArgumentException('Email atau password tidak cocok.');
        }

        return [
            'id' => (int) $user['id'],
            'name' => $user['student_name'],
            'class_name' => $user['class_name'],
            'level' => $user['level'],
            'email' => $user['email'],
        ];
    }

    public function studentUsers(): array
    {
        return $this->database->query(
            'SELECT id, student_name AS name, email, class_name, level, created_at
             FROM student_users ORDER BY id DESC'
        )->fetchAll();
    }

    public function resetStudentPassword(int $userId, string $password): void
    {
        if ($userId < 1 || strlen($password) < 4 || strlen($password) > 64) {
            throw new InvalidArgumentException('User dan password baru tidak valid. Password harus 4 sampai 64 karakter.');
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        if ($hashed === false) {
            throw new RuntimeException('Password tidak dapat diproses.');
        }

        $statement = $this->database->prepare(
            'UPDATE student_users SET password_hash = :password_hash, updated_at = datetime("now") WHERE id = :id'
        );
        $statement->execute(['password_hash' => $hashed, 'id' => $userId]);
        if ($statement->rowCount() === 0) {
            $exists = $this->database->prepare('SELECT 1 FROM student_users WHERE id = :id');
            $exists->execute(['id' => $userId]);
            if (!$exists->fetchColumn()) {
                throw new InvalidArgumentException('User tidak ditemukan.');
            }
        }
    }

    public function deleteStudent(int $userId): void
    {
        if ($userId < 1) {
            throw new InvalidArgumentException('User tidak valid.');
        }

        $statement = $this->database->prepare('DELETE FROM student_users WHERE id = :id');
        $statement->execute(['id' => $userId]);
        if ($statement->rowCount() === 0) {
            throw new InvalidArgumentException('User tidak ditemukan.');
        }
    }

    public function questionBank(): array
    {
        $rows = $this->database->query(
            'SELECT question_data FROM question_bank ORDER BY position, id'
        )->fetchAll();

        return array_map(
            static fn (array $row): array => json_decode($row['question_data'], true, 512, JSON_THROW_ON_ERROR),
            $rows
        );
    }

    public function replaceQuestionBank(array $questions): void
    {
        if (count($questions) > 500) {
            throw new InvalidArgumentException('Maksimal 500 soal dapat disimpan.');
        }

        $allowedClasses = ['all', 'Kelas 7', 'Kelas 8', 'Kelas 9', 'Kelas 10', 'Kelas 11', 'Kelas 12'];
        $seenIds = [];
        foreach ($questions as $question) {
            if (!is_array($question)) {
                throw new InvalidArgumentException('Format soal tidak valid.');
            }

            $id = $question['id'] ?? null;
            $level = $question['level'] ?? null;
            $className = $question['className'] ?? null;
            $topic = $question['topic'] ?? null;
            $text = $question['question'] ?? null;
            $options = $question['options'] ?? null;
            $correctAnswer = $question['correctAnswer'] ?? null;
            $headers = $question['sheetHeaders'] ?? [];
            $rows = $question['sheetRows'] ?? [];
            $explanation = $question['explanation'] ?? '';

            if (!is_string($id) || $id === '' || strlen($id) > 80 || isset($seenIds[$id])
                || !in_array($level, ['SMP', 'SMA'], true)
                || !is_string($className) || !in_array($className, $allowedClasses, true)
                || !is_string($topic) || trim($topic) === '' || strlen($topic) > 100
                || !is_string($text) || trim($text) === '' || strlen($text) > 5000
                || !is_array($options) || count($options) < 2 || count($options) > 8
                || !is_int($correctAnswer) || !array_key_exists($correctAnswer, $options)
                || !is_array($headers) || !is_array($rows)
                || !is_string($explanation) || strlen($explanation) > 5000) {
                throw new InvalidArgumentException('Data soal tidak valid. Periksa topik, tingkat, kelas, opsi, dan jawaban benar.');
            }

            $validClasses = $level === 'SMP'
                ? ['all', 'Kelas 7', 'Kelas 8', 'Kelas 9']
                : ['all', 'Kelas 10', 'Kelas 11', 'Kelas 12'];
            if (!in_array($className, $validClasses, true)) {
                throw new InvalidArgumentException('Kelas tidak sesuai dengan tingkat soal.');
            }
            foreach ($options as $option) {
                if (!is_string($option) || trim($option) === '' || strlen($option) > 1000) {
                    throw new InvalidArgumentException('Setiap opsi jawaban harus berisi teks.');
                }
            }

            $seenIds[$id] = true;
        }

        $this->database->beginTransaction();
        try {
            $this->database->exec('DELETE FROM question_bank');
            $statement = $this->database->prepare(
                'INSERT INTO question_bank (id, level, class_name, position, question_data, updated_at)
                 VALUES (:id, :level, :class_name, :position, :question_data, datetime("now"))'
            );
            foreach (array_values($questions) as $position => $question) {
                $statement->execute([
                    'id' => $question['id'],
                    'level' => $question['level'],
                    'class_name' => $question['className'],
                    'position' => $position,
                    'question_data' => json_encode($question, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE),
                ]);
            }
            $this->database->commit();
        } catch (Throwable $exception) {
            $this->database->rollBack();
            throw $exception;
        }
    }
}

function respond(int $status, array $body): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    exit;
}

function csrfToken(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function requireAdmin(): void
{
    if (($_SESSION['is_admin'] ?? false) !== true) {
        respond(401, ['success' => false, 'data' => null, 'error' => 'Silakan login untuk membuka panel admin.']);
    }
}

function requireCsrfToken(): void
{
    $sessionToken = $_SESSION['csrf_token'] ?? '';
    $requestToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

    if ($sessionToken === '' || !hash_equals($sessionToken, $requestToken)) {
        respond(403, ['success' => false, 'data' => null, 'error' => 'Permintaan tidak valid. Muat ulang halaman dan coba lagi.']);
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $requestAction = (string) ($_GET['action'] ?? '');

        if ($requestAction === 'session') {
            respond(200, [
                'success' => true,
                'data' => [
                    'authenticated' => ($_SESSION['is_admin'] ?? false) === true,
                    'email' => $_SESSION['admin_email'] ?? null,
                    'csrfToken' => csrfToken(),
                ],
                'error' => null,
            ]);
        }

        if ($requestAction === 'student-summary') {
            $studentName = trim((string) ($_GET['name'] ?? ''));
            $className = trim((string) ($_GET['class'] ?? ''));

            if ($studentName === '' || $className === '') {
                respond(400, ['success' => false, 'data' => null, 'error' => 'Nama siswa dan kelas wajib diisi.']);
            }

            $repository = new QuizRepository(
                getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
            );
            $results = $repository->studentResults($studentName, $className);
            $latest = $results[0] ?? null;

            respond(200, ['success' => true, 'data' => [
                'count' => count($results),
                'latest' => $latest,
                'results' => $results,
            ], 'error' => null]);
        }

        if ($requestAction === 'question-bank') {
            $repository = new QuizRepository(
                getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
            );
            respond(200, ['success' => true, 'data' => $repository->questionBank(), 'error' => null]);
        }

        requireAdmin();
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        if ($requestAction === 'users') {
            respond(200, ['success' => true, 'data' => $repository->studentUsers(), 'error' => null]);
        }
        respond(200, ['success' => true, 'data' => $repository->all(), 'error' => null]);
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: GET, POST');
        respond(405, ['success' => false, 'data' => null, 'error' => 'Metode tidak didukung.']);
    }

    $payload = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($payload)) {
        throw new InvalidArgumentException('Format data harus berupa objek JSON.');
    }

    $action = $payload['action'] ?? null;
    if ($action === 'login') {
        requireCsrfToken();

        $email = $payload['email'] ?? '';
        $password = $payload['password'] ?? '';
        $lockUntil = (int) ($_SESSION['admin_login_lock_until'] ?? 0);
        if ($lockUntil > time()) {
            respond(429, ['success' => false, 'data' => null, 'error' => 'Terlalu banyak percobaan. Coba lagi sebentar.']);
        }

        $expectedEmail = getenv('ADMIN_EMAIL') ?: ADMIN_EMAIL;
        $passwordHash = getenv('ADMIN_PASSWORD_HASH') ?: ADMIN_PASSWORD_HASH;
        $emailMatches = is_string($email) && hash_equals($expectedEmail, $email);
        $passwordMatches = is_string($password) && password_verify($password, $passwordHash);

        if (!$emailMatches || !$passwordMatches) {
            $_SESSION['admin_login_failures'] = (int) ($_SESSION['admin_login_failures'] ?? 0) + 1;
            if ($_SESSION['admin_login_failures'] >= 5) {
                $_SESSION['admin_login_failures'] = 0;
                $_SESSION['admin_login_lock_until'] = time() + 60;
            }
            respond(401, ['success' => false, 'data' => null, 'error' => 'Email atau password tidak sesuai.']);
        }

        session_regenerate_id(true);
        $_SESSION['is_admin'] = true;
        $_SESSION['admin_email'] = $expectedEmail;
        $_SESSION['admin_login_failures'] = 0;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        respond(200, [
            'success' => true,
            'data' => [
                'authenticated' => true,
                'email' => $expectedEmail,
                'csrfToken' => csrfToken(),
            ],
            'error' => null,
        ]);
    }

    if ($action === 'reset-user-password') {
        requireAdmin();
        requireCsrfToken();
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        $repository->resetStudentPassword(
            (int) ($payload['user_id'] ?? 0),
            (string) ($payload['password'] ?? '')
        );
        respond(200, ['success' => true, 'data' => null, 'error' => null]);
    }

    if ($action === 'delete-user') {
        requireAdmin();
        requireCsrfToken();
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        $repository->deleteStudent((int) ($payload['user_id'] ?? 0));
        respond(200, ['success' => true, 'data' => null, 'error' => null]);
    }

    if ($action === 'save-question-bank') {
        requireAdmin();
        requireCsrfToken();
        $questions = $payload['questions'] ?? null;
        if (!is_array($questions)) {
            throw new InvalidArgumentException('Daftar soal tidak valid.');
        }
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        $repository->replaceQuestionBank($questions);
        respond(200, ['success' => true, 'data' => ['count' => count($questions)], 'error' => null]);
    }

    if ($action === 'register-user') {
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        $student = $repository->registerStudent(
            (string) ($payload['student_name'] ?? ''),
            (string) ($payload['class_name'] ?? ''),
            (string) ($payload['level'] ?? ''),
            (string) ($payload['email'] ?? ''),
            (string) ($payload['password'] ?? '')
        );
        $_SESSION['student_id'] = $student['name'] . ':' . $student['class_name'] . ':' . $student['level'];
        $_SESSION['student_name'] = $student['name'];
        $_SESSION['student_class'] = $student['class_name'];
        $_SESSION['student_level'] = $student['level'];
        respond(200, ['success' => true, 'data' => $student, 'error' => null]);
    }

    if ($action === 'login-user') {
        $repository = new QuizRepository(
            getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
        );
        $student = $repository->loginStudent(
            (string) ($payload['email'] ?? ''),
            (string) ($payload['password'] ?? '')
        );
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        $_SESSION['student_class'] = $student['class_name'];
        $_SESSION['student_level'] = $student['level'];
        respond(200, ['success' => true, 'data' => $student, 'error' => null]);
    }

    if ($action === 'logout') {
        requireAdmin();
        requireCsrfToken();
        unset($_SESSION['is_admin'], $_SESSION['admin_email']);
        session_regenerate_id(true);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        respond(200, [
            'success' => true,
            'data' => ['authenticated' => false, 'csrfToken' => csrfToken()],
            'error' => null,
        ]);
    }

    if ($action === 'import') {
        requireAdmin();
        requireCsrfToken();
        unset($payload['action']);
    } elseif ($action !== null) {
        throw new InvalidArgumentException('Aksi tidak dikenal.');
    }

    $repository = new QuizRepository(
        getenv('EXCEL_QUIZ_DB') ?: dirname(__DIR__) . '/web-latihan-excel-data/quiz.sqlite'
    );
    $repository->save($payload);
    respond(201, ['success' => true, 'data' => $payload, 'error' => null]);
} catch (InvalidArgumentException $exception) {
    respond(400, ['success' => false, 'data' => null, 'error' => $exception->getMessage()]);
} catch (JsonException $exception) {
    respond(400, ['success' => false, 'data' => null, 'error' => 'Format JSON tidak valid.']);
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    respond(500, ['success' => false, 'data' => null, 'error' => 'Penyimpanan data gagal.']);
}