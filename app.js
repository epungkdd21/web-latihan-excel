let csrfToken = '';

async function request(path, options = {}) {
    const { csrf = false, headers = {}, ...fetchOptions } = options;
    const response = await fetch(path, {
        ...fetchOptions,
        headers: {
            Accept: 'application/json',
            ...(fetchOptions.body ? { 'Content-Type': 'application/json' } : {}),
            ...(csrf ? { 'X-CSRF-Token': csrfToken } : {}),
            ...headers,
        },
    });
    const result = await response.json();

    if (!response.ok || !result.success) {
        const error = new Error(result.error || 'Permintaan gagal.');
        error.status = response.status;
        throw error;
    }

    return result.data;
}

export function loadQuizResults() {
    return request('./api.php');
}

export function loadStudentUsers() {
    return request('./api.php?action=users');
}

export function loadQuestionBank() {
    return request('./api.php?action=question-bank');
}

export function saveQuestionBank(questions) {
    return request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ action: 'save-question-bank', questions }),
    });
}

export async function checkAdminSession() {
    const session = await request('./api.php?action=session');
    csrfToken = session.csrfToken;
    return session;
}

export async function loginAdmin(email, password) {
    const session = await request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ action: 'login', email, password }),
    });
    csrfToken = session.csrfToken;
    return session;
}

export async function logoutAdmin() {
    const session = await request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ action: 'logout' }),
    });
    csrfToken = session.csrfToken;
    return session;
}

export function resetStudentPassword(userId, password) {
    return request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ action: 'reset-user-password', user_id: userId, password }),
    });
}

export function deleteStudentUser(userId) {
    return request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ action: 'delete-user', user_id: userId }),
    });
}

export function saveQuizResult(payload) {
    return request('./api.php', {
        method: 'POST',
        body: JSON.stringify(payload),
    });
}

export function importQuizResult(payload) {
    return request('./api.php', {
        method: 'POST',
        csrf: true,
        body: JSON.stringify({ ...payload, action: 'import' }),
    });
}