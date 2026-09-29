<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Rumus Excel Interaktif</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Fira Code', 'monospace'],
                    },
                    colors: {
                        excel: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#16a34a',
                            600: '#15803d',
                            700: '#166534',
                            800: '#14532d',
                            900: '#052e16',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1e293b;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        .glass-panel {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex flex-col justify-between selection:bg-excel-500 selection:text-white">

    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-tr from-excel-700 to-emerald-500 p-2.5 rounded-xl shadow-lg shadow-emerald-950/50 flex items-center justify-center">
                    <i data-lucide="file-spreadsheet" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg text-white leading-tight flex items-center gap-2">
                        Excel Quiz
                     <!--   <span class="text-xs bg-excel-500/20 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded-full font-mono">20 Soal</span> -->
                    </h1>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="flex items-center gap-2 bg-slate-800/50 p-1.5 rounded-lg border border-slate-700/50">
                <button onclick="switchView('start')" id="tabStart" class="px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md bg-emerald-500/20 text-emerald-400 transition-colors flex items-center gap-2">
                    <i data-lucide="home" class="w-4 h-4"></i> <span class="hidden sm:inline">Kuis</span>
                </button>
                <button onclick="switchView('dashboard')" id="tabDashboard" class="px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md text-slate-400 hover:text-slate-200 transition-colors flex items-center gap-2">
                    <i data-lucide="bar-chart-2" class="w-4 h-4"></i> <span class="hidden sm:inline">Panel Admin</span>
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8 w-full flex-1 flex flex-col justify-center">
        
        <!-- STEP 1: Registration Form -->
        <div id="viewStart" class="glass-panel p-6 sm:p-10 rounded-2xl shadow-2xl max-w-xl mx-auto w-full border border-slate-800">
            <div class="text-center mb-8">
                <div class="inline-flex p-4 bg-emerald-500/10 rounded-2xl text-emerald-400 mb-4 border border-emerald-500/20">
                    <i data-lucide="graduation-cap" class="w-10 h-10"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Latihan Rumus Excel</h2>
                <p class="text-slate-400 text-sm mt-2">Isi identitas siswa sebelum memulai simulasi pengerjaan soal.</p>
            </div>

            <form id="formStudent" class="space-y-5">
                <div class="flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-900/80 p-1">
                    <button type="button" id="studentRegisterTab" class="flex-1 rounded-lg bg-emerald-500/15 text-emerald-300 px-3 py-2 text-sm font-semibold border border-emerald-500/30">
                        Daftar Baru
                    </button>
                    <button type="button" id="studentLoginTab" class="flex-1 rounded-lg text-slate-300 px-3 py-2 text-sm font-semibold border border-transparent">
                        Sudah Punya Akun
                    </button>
                </div>

                <div id="studentNameField">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5" for="inputName">
                        Nama Lengkap Siswa <span class="text-emerald-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input type="text" id="inputName" required placeholder="Contoh: Budi Pratama" 
                            class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                    </div>
                </div>

                <div id="studentSchoolFields" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5" for="inputLevel">
                            Tingkat Sekolah <span class="text-emerald-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <select id="inputLevel" required onchange="updateClassDropdown()"
                                class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                                <option value="SMP">SMP (Soal Dasar / Fundamental)</option>
                                <option value="SMA">SMA (Soal Lanjutan & Kombinasi)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5" for="inputClass">
                            Kelas <span class="text-emerald-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                            </div>
                            <select id="inputClass" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                                <!-- Populated dynamically by JS -->
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5" for="inputEmail">
                        Email <span class="text-emerald-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" id="inputEmail" required placeholder="contoh@gmail.com" 
                            class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5" for="inputPassword">
                        Password <span class="text-emerald-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" id="inputPassword" required minlength="4" placeholder="Masukkan password akun" 
                            class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                    </div>
                </div>

                <p id="studentAuthMessage" class="hidden text-sm text-rose-400"></p>

                <div class="bg-slate-900/80 rounded-xl p-4 border border-slate-800 text-xs text-slate-400 space-y-2">
                    <div class="flex items-center gap-2 font-medium text-slate-300">
                        <i data-lucide="info" class="w-4 h-4 text-emerald-400"></i> Ketentuan Soal Berdasarkan Tingkat:
                    </div>
                    <ul class="list-disc pl-5 space-y-1 text-slate-400">
                        <li><strong class="text-emerald-400">Tingkat SMP (Kls 7-9):</strong> 20 Soal Rumus Dasar & Lookup Sederhana (SUM, AVERAGE, MAX, MIN, COUNT, IF, VLOOKUP Dasar, SUMIF Dasar, Teks).</li>
                        <li><strong class="text-emerald-400">Tingkat SMA/SMK (Kls 10-12):</strong> 20 Soal Lanjutan & Kombinasi Rumus (VLOOKUP Dinamis, INDEX-MATCH, SUMIFS, XLOOKUP, IFERROR, IF Bertingkat/AND/OR).</li>
                    </ul>
                </div>

                <div id="studentSummaryBox" class="hidden mt-6 rounded-xl border border-emerald-500/25 bg-emerald-500/10 p-4 text-left">
                    <div class="flex items-center gap-2 text-emerald-300 text-sm font-semibold">
                        <i data-lucide="chart-column" class="w-4 h-4"></i>
                        <span>Rekap Nilai Anda</span>
                    </div>
                    <div id="studentSummaryContent" class="mt-3 text-sm text-slate-200"></div>
                </div>

                <button id="studentSubmitBtn" type="submit" class="w-full py-3.5 bg-gradient-to-r from-emerald-600 to-excel-600 hover:from-emerald-500 hover:to-excel-500 text-white font-bold rounded-xl shadow-lg shadow-emerald-900/40 transition flex items-center justify-center gap-2 text-base">
                    <span>Daftarkan Akun</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>
        </div>

        <!-- STEP 2: Quiz Interface -->
        <div id="viewQuiz" class="hidden space-y-6">
            
            <div class="glass-panel p-4 rounded-xl border border-slate-800 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span id="questionBadge" class="bg-emerald-500/20 text-emerald-400 font-mono text-sm px-3 py-1 rounded-lg border border-emerald-500/30 font-semibold">
                        Soal 1 dari 20
                    </span>
                    <span id="levelBadge" class="bg-cyan-500/20 text-cyan-400 font-mono text-xs px-2.5 py-1 rounded-lg border border-cyan-500/30 font-semibold">
                        SMP (Dasar)
                    </span>
                    <div class="h-4 w-px bg-slate-800 hidden sm:block"></div>
                    <span class="text-sm font-mono text-slate-400 flex items-center gap-1.5">
                        <i data-lucide="clock" class="w-4 h-4 text-emerald-400"></i> <span id="timerVal">00:00</span>
                    </span>
                    <div class="h-4 w-px bg-slate-800 hidden sm:block"></div>
                    <span id="activeStudentName" class="text-sm text-slate-300 font-medium truncate max-w-[150px]"></span>
                </div>
                <div class="w-full sm:w-64 bg-slate-900 rounded-full h-2.5 overflow-hidden border border-slate-800">
                    <div id="progressBar" class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full w-0 transition-all duration-300"></div>
                </div>
            </div>

            <div class="glass-panel p-6 sm:p-8 rounded-2xl border border-slate-800 shadow-xl space-y-6">
                <div>
                    <div class="text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                        <i data-lucide="help-circle" class="w-4 h-4"></i> Pertanyaan
                    </div>
                    <h3 id="questionText" class="text-lg sm:text-xl font-medium text-white leading-relaxed"></h3>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 overflow-hidden">
                    <div class="flex items-center justify-between mb-3 border-b border-slate-800 pb-2">
                        <div class="flex items-center gap-2 text-xs text-slate-400 font-mono">
                            <i data-lucide="sheet" class="w-4 h-4 text-emerald-400"></i>
                            <span id="sheetNameTitle">Sheet: Data_Latihan.xlsx</span>
                        </div>
                    </div>
                    <div class="overflow-x-auto custom-scrollbar">
                        <table id="excelTable" class="w-full text-xs font-mono text-slate-300 border-collapse border border-slate-800"></table>
                    </div>
                </div>

                <div id="optionsContainer" class="grid grid-cols-1 gap-3 pt-2">
                    <!-- Options Buttons generated by JS -->
                </div>
            </div>

            <div class="flex items-center justify-between gap-4">
                <button id="btnPrev" onclick="navigateQuestion(-1)" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-medium rounded-xl transition flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed text-sm">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    <span>Sebelumnya</span>
                </button>

                <div class="flex items-center gap-2">
                    <button id="btnNext" onclick="navigateQuestion(1)" class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-excel-600 hover:from-emerald-500 hover:to-excel-500 text-white font-semibold rounded-xl shadow-md transition flex items-center gap-2 text-sm">
                        <span>Lanjut Soal</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                    <button id="btnFinish" onclick="confirmFinishQuiz()" class="hidden px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl shadow-md transition items-center gap-2 text-sm">
                        <span>Selesaikan Kuis</span>
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 3: Summary & Export View -->
        <div id="viewSummary" class="hidden space-y-8">
            <div class="glass-panel p-8 rounded-2xl border border-slate-800 shadow-2xl text-center space-y-6 relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="inline-flex p-4 bg-emerald-500/10 rounded-full text-emerald-400 border border-emerald-500/20">
                    <i data-lucide="award" class="w-12 h-12"></i>
                </div>

                <div>
                    <h2 class="text-3xl font-extrabold text-white">Hasil Kuis Latihan Excel</h2>
                    <p class="text-slate-400 text-sm mt-1">Laporan pengerjaan siswa telah dibuat dan tersimpan di Dashboard.</p>
                </div>

                <div class="inline-flex flex-wrap items-center justify-center gap-4 bg-slate-900/90 px-6 py-3 rounded-xl border border-slate-800 text-sm">
                    <div>
                        <span class="text-slate-500 text-xs block">Siswa:</span>
                        <strong id="sumStudentName" class="text-white font-medium"></strong>
                    </div>
                    <div class="h-6 w-px bg-slate-800"></div>
                    <div>
                        <span class="text-slate-500 text-xs block">Kelas / NIM:</span>
                        <strong id="sumStudentClass" class="text-slate-300 font-medium">-</strong>
                    </div>
                    <div class="h-6 w-px bg-slate-800"></div>
                    <div>
                        <span class="text-slate-500 text-xs block">Waktu Selesai:</span>
                        <strong id="sumTimeTaken" class="text-emerald-400 font-mono">00:00</strong>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl mx-auto pt-2">
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block mb-1">Skor Akhir</span>
                        <span id="scoreFinal" class="text-3xl font-extrabold text-emerald-400 font-mono">0</span>
                        <span class="text-[10px] text-slate-500 block">/ 100 Poin</span>
                    </div>
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block mb-1">Benar</span>
                        <span id="scoreCorrect" class="text-2xl font-bold text-emerald-400 font-mono">0</span>
                        <span class="text-[10px] text-slate-500 block">Soal</span>
                    </div>
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block mb-1">Salah</span>
                        <span id="scoreIncorrect" class="text-2xl font-bold text-rose-400 font-mono">0</span>
                        <span class="text-[10px] text-slate-500 block">Soal</span>
                    </div>
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block mb-1">Akurasi</span>
                        <span id="scoreAccuracy" class="text-2xl font-bold text-teal-400 font-mono">0%</span>
                        <span class="text-[10px] text-slate-500 block">Persentase</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                    <button onclick="downloadJSONReport()" class="px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-excel-600 hover:from-emerald-500 hover:to-excel-500 text-white font-bold rounded-xl shadow-lg shadow-emerald-950/50 transition flex items-center gap-2">
                        <i data-lucide="download" class="w-5 h-5"></i>
                        <span>Unduh Hasil (Format JSON)</span>
                    </button>
                    <button onclick="switchView('dashboard')" class="px-6 py-3.5 bg-slate-800 hover:bg-slate-700 text-emerald-400 font-semibold rounded-xl border border-slate-700 transition flex items-center gap-2">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span>Ke Dashboard Nilai</span>
                    </button>
                </div>
            </div>

            <!-- Detailed Answer Review List (Feedback appears here) -->
            <div class="glass-panel p-6 rounded-2xl border border-slate-800 space-y-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <i data-lucide="list-checks" class="w-5 h-5 text-emerald-400"></i>
                    <span>Rincian Pembahasan Soal</span>
                </h3>

                <div id="reviewQuestionsList" class="space-y-4 pt-2">
                    <!-- Dynamic review questions rendered via JS -->
                </div>
            </div>
        </div>

        <!-- STEP 4: Dashboard Nilai View -->
        <div id="viewDashboard" class="hidden space-y-6">
            <section id="adminLogin" class="glass-panel max-w-md w-full mx-auto p-6 sm:p-8 rounded-2xl border border-slate-800 shadow-xl">
                <div class="mb-6">
                    <div class="inline-flex p-3 bg-emerald-500/10 rounded-xl text-emerald-400 border border-emerald-500/20 mb-4">
                        <i data-lucide="shield-check" class="w-7 h-7"></i>
                    </div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-emerald-400">Akses Terbatas</p>
                    <h2 class="mt-1 text-2xl font-bold text-white">Login Admin</h2>
                    <p class="mt-2 text-sm text-slate-400">Masuk untuk melihat dan mengelola hasil kuis siswa.</p>
                </div>
                <form id="adminLoginForm" class="space-y-4">
                    <div>
                        <label for="adminEmail" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">Email</label>
                        <input id="adminEmail" name="email" type="email" required autocomplete="username" value="saiful@jagatarsy.sch.id" class="w-full px-3.5 py-3 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label for="adminPassword" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">Password</label>
                        <input id="adminPassword" name="password" type="password" required autocomplete="current-password" class="w-full px-3.5 py-3 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                    <p id="adminLoginMessage" role="alert" class="hidden text-sm text-rose-400"></p>
                    <button id="adminLoginSubmit" type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 disabled:opacity-50 text-white font-semibold rounded-lg transition flex items-center justify-center gap-2">
                        <i data-lucide="log-in" class="w-4 h-4"></i> Masuk ke Panel Admin
                    </button>
                </form>
            </section>

            <div id="adminWorkspace" class="hidden space-y-6">
            <section class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 border-b border-slate-800 pb-5">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-emerald-400">Ruang Administrasi</p>
                    <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-white">Panel Admin</h2>
                    <p class="mt-1 text-sm text-slate-400">Pantau performa dan hasil pengerjaan siswa.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span id="adminSignedInAs" class="self-center px-3 text-xs text-slate-400"></span>
                    <button onclick="logoutAdmin()" class="px-3 py-2.5 bg-slate-800 hover:bg-slate-700 text-sm text-slate-200 font-medium rounded-lg border border-slate-700 transition flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                    </button>
                    <input type="file" id="jsonUpload" accept=".json" class="hidden" onchange="importJSON(event)">
                    <button onclick="document.getElementById('jsonUpload').click()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-sm text-slate-200 font-medium rounded-lg border border-slate-700 transition flex items-center gap-2">
                        <i data-lucide="upload" class="w-4 h-4"></i> Impor JSON
                    </button>
                    <button onclick="refreshDashboard()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-sm text-slate-200 font-medium rounded-lg border border-slate-700 transition flex items-center gap-2">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i> Segarkan
                    </button>
                    <button onclick="exportDashboardCSV()" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-sm text-white font-semibold rounded-lg transition flex items-center gap-2">
                        <i data-lucide="download" class="w-4 h-4"></i> Ekspor CSV
                    </button>
                </div>
            </section>

            <nav class="flex gap-2 border-b border-slate-800 pb-3" aria-label="Menu admin">
                <button id="adminResultsTab" type="button" onclick="switchAdminSection('results')" class="px-3 py-2 rounded-lg text-sm font-semibold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">Nilai</button>
                <button id="adminUsersTab" type="button" onclick="switchAdminSection('users')" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 border border-transparent hover:bg-slate-800">Manajemen User</button>
                <button id="adminQuestionsTab" type="button" onclick="switchAdminSection('questions')" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 border border-transparent hover:bg-slate-800">Manajemen Soal</button>
            </nav>

            <div id="adminResultsPanel" class="space-y-6">
            <section class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4" aria-label="Ringkasan nilai">
                <div class="glass-panel p-4 sm:p-5 rounded-xl border border-slate-800">
                    <div class="flex items-center justify-between text-slate-400 text-xs"><span>Total Percobaan</span><i data-lucide="clipboard-list" class="w-4 h-4 text-cyan-400"></i></div>
                    <p id="adminTotalAttempts" class="mt-3 text-2xl sm:text-3xl font-bold font-mono text-white">0</p>
                    <p class="mt-1 text-xs text-slate-500">Seluruh hasil tersimpan</p>
                </div>
                <div class="glass-panel p-4 sm:p-5 rounded-xl border border-slate-800">
                    <div class="flex items-center justify-between text-slate-400 text-xs"><span>Rata-rata Skor</span><i data-lucide="activity" class="w-4 h-4 text-emerald-400"></i></div>
                    <p id="adminAverageScore" class="mt-3 text-2xl sm:text-3xl font-bold font-mono text-emerald-400">0</p>
                    <p class="mt-1 text-xs text-slate-500">Dari 100 poin</p>
                </div>
                <div class="glass-panel p-4 sm:p-5 rounded-xl border border-slate-800">
                    <div class="flex items-center justify-between text-slate-400 text-xs"><span>Lulus KKM</span><i data-lucide="badge-check" class="w-4 h-4 text-teal-400"></i></div>
                    <p id="adminPassRate" class="mt-3 text-2xl sm:text-3xl font-bold font-mono text-teal-400">0%</p>
                    <p id="adminPassCount" class="mt-1 text-xs text-slate-500">0 dari 0 siswa</p>
                </div>
                <div class="glass-panel p-4 sm:p-5 rounded-xl border border-slate-800">
                    <div class="flex items-center justify-between text-slate-400 text-xs"><span>Siswa Unik</span><i data-lucide="users" class="w-4 h-4 text-amber-400"></i></div>
                    <p id="adminUniqueStudents" class="mt-3 text-2xl sm:text-3xl font-bold font-mono text-amber-400">0</p>
                    <p class="mt-1 text-xs text-slate-500">Berdasarkan nama siswa</p>
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="glass-panel p-5 rounded-xl border border-slate-800">
                    <div class="flex items-start justify-between gap-3 mb-5">
                        <div><h3 class="font-semibold text-white">Sebaran Nilai</h3><p class="text-xs text-slate-500 mt-1">Kelompok skor dari seluruh percobaan</p></div>
                        <i data-lucide="chart-no-axes-column-increasing" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <div id="scoreDistribution" class="space-y-4"></div>
                </div>
                <div class="glass-panel p-5 rounded-xl border border-slate-800">
                    <div class="flex items-start justify-between gap-3 mb-5">
                        <div><h3 class="font-semibold text-white">Partisipasi Tingkat</h3><p class="text-xs text-slate-500 mt-1">Perbandingan pengerjaan SMP dan SMA/SMK</p></div>
                        <i data-lucide="chart-pie" class="w-5 h-5 text-cyan-400"></i>
                    </div>
                    <div id="levelDistribution" class="space-y-5"></div>
                </div>
            </section>

            <section class="glass-panel rounded-xl border border-slate-800 overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-800">
                    <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-white">Hasil Pengerjaan</h3>
                            <p id="dashboardResultCount" class="text-xs text-slate-500 mt-1">0 hasil</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-2 w-full xl:max-w-5xl">
                            <label class="relative">
                                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500"></i>
                                <input id="dashboardSearch" type="search" placeholder="Cari nama atau kelas" class="w-full pl-9 pr-3 py-2.5 bg-slate-950 border border-slate-700 rounded-lg text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500">
                            </label>
                            <select id="dashboardLevelFilter" aria-label="Filter tingkat" class="w-full px-3 py-2.5 bg-slate-950 border border-slate-700 rounded-lg text-sm text-slate-200 focus:outline-none focus:border-emerald-500">
                                <option value="all">Semua tingkat</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                            </select>
                            <select id="dashboardClassFilter" aria-label="Filter kelas" class="w-full px-3 py-2.5 bg-slate-950 border border-slate-700 rounded-lg text-sm text-slate-200 focus:outline-none focus:border-emerald-500">
                                <option value="all">Semua kelas</option>
                                <option value="Kelas 7">Kelas 7</option>
                                <option value="Kelas 8">Kelas 8</option>
                                <option value="Kelas 9">Kelas 9</option>
                                <option value="Kelas 10">Kelas 10</option>
                                <option value="Kelas 11">Kelas 11</option>
                                <option value="Kelas 12">Kelas 12</option>
                            </select>
                            <select id="dashboardSort" aria-label="Urutkan hasil" class="w-full px-3 py-2.5 bg-slate-950 border border-slate-700 rounded-lg text-sm text-slate-200 focus:outline-none focus:border-emerald-500">
                                <option value="recent">Terbaru</option>
                                <option value="highest">Skor tertinggi</option>
                                <option value="lowest">Skor terendah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[850px] text-sm text-left text-slate-300">
                        <thead class="text-[11px] text-slate-400 uppercase tracking-wider bg-slate-900/80 border-b border-slate-800">
                            <tr>
                                <th class="px-5 py-3">Siswa</th>
                                <th class="px-5 py-3">Kelas</th>
                                <th class="px-5 py-3">Tingkat</th>
                                <th class="px-5 py-3 text-center">Skor</th>
                                <th class="px-5 py-3 text-center">Akurasi</th>
                                <th class="px-5 py-3">Tanggal</th>
                                <th class="px-5 py-3 text-right">Rincian</th>
                            </tr>
                        </thead>
                        <tbody id="dashboardTableBody" class="divide-y divide-slate-800"></tbody>
                    </table>
                </div>
                <div id="emptyDashboardMsg" class="p-10 text-center text-slate-500 hidden">
                    <i data-lucide="folder-search" class="w-9 h-9 mx-auto mb-3 opacity-50"></i>
                    <p id="emptyDashboardText">Belum ada hasil kuis tersimpan.</p>
                </div>
            </section>
            </div>

            <section id="adminUsersPanel" class="hidden glass-panel rounded-xl border border-slate-800 overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-800 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="font-semibold text-white">Manajemen User</h3>
                        <p id="adminUserCount" class="mt-1 text-xs text-slate-500">0 user terdaftar</p>
                    </div>
                    <button type="button" onclick="refreshAdminUsers()" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-sm text-slate-200 rounded-lg border border-slate-700 flex items-center gap-2">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i> Segarkan
                    </button>
                </div>
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[760px] text-sm text-left text-slate-300">
                        <thead class="text-[11px] text-slate-400 uppercase bg-slate-900/80 border-b border-slate-800">
                            <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Kelas / Tingkat</th><th class="px-5 py-3">Terdaftar</th><th class="px-5 py-3 text-right">Aksi</th></tr>
                        </thead>
                        <tbody id="adminUsersTableBody" class="divide-y divide-slate-800"></tbody>
                    </table>
                </div>
                <p id="adminUsersEmpty" class="hidden p-8 text-center text-sm text-slate-500">Belum ada user terdaftar.</p>
                <p id="adminUsersMessage" role="status" class="hidden px-5 pb-5 text-sm"></p>
            </section>

            <section id="adminQuestionsPanel" class="hidden space-y-4">
                <div class="glass-panel rounded-xl border border-slate-800 overflow-hidden">
                    <div class="p-5 sm:p-6 border-b border-slate-800 flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h3 class="font-semibold text-white">Manajemen Soal</h3>
                            <p id="adminQuestionCount" class="mt-1 text-xs text-slate-500">0 soal</p>
                        </div>
                        <button type="button" onclick="openQuestionEditor()" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-500 text-sm text-white rounded-lg flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah soal
                        </button>
                    </div>
                    <div id="questionEditor" class="hidden p-5 sm:p-6 border-b border-slate-800 bg-slate-950/40">
                        <h4 id="questionEditorTitle" class="font-semibold text-white mb-4">Soal baru</h4>
                        <form id="questionEditorForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input id="questionId" type="hidden">
                            <label class="text-xs text-slate-300">Topik
                                <input id="questionTopic" required maxlength="100" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="text-xs text-slate-300">Tingkat
                                    <select id="questionLevel" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                                        <option value="SMP">SMP</option><option value="SMA">SMA/SMK</option>
                                    </select>
                                </label>
                                <label class="text-xs text-slate-300">Kelas
                                    <select id="questionClass" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white"></select>
                                </label>
                            </div>
                            <label class="md:col-span-2 text-xs text-slate-300">Pertanyaan
                                <textarea id="questionText" required maxlength="5000" rows="3" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white"></textarea>
                            </label>
                            <label class="text-xs text-slate-300">Opsi A
                                <input id="questionOption0" required class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                            </label>
                            <label class="text-xs text-slate-300">Opsi B
                                <input id="questionOption1" required class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                            </label>
                            <label class="text-xs text-slate-300">Opsi C
                                <input id="questionOption2" required class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                            </label>
                            <label class="text-xs text-slate-300">Opsi D
                                <input id="questionOption3" required class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                            </label>
                            <label class="text-xs text-slate-300">Jawaban benar
                                <select id="questionCorrectAnswer" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white">
                                    <option value="0">A</option><option value="1">B</option><option value="2">C</option><option value="3">D</option>
                                </select>
                            </label>
                            <label class="md:col-span-2 text-xs text-slate-300">Penjelasan
                                <textarea id="questionExplanation" maxlength="5000" rows="2" class="mt-1 w-full px-3 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-sm text-white"></textarea>
                            </label>
                            <div class="md:col-span-2 flex flex-wrap gap-2">
                                <button type="submit" id="saveQuestionButton" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-sm text-white font-semibold rounded-lg">Simpan soal</button>
                                <button type="button" onclick="closeQuestionEditor()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-sm text-slate-200 rounded-lg border border-slate-700">Batal</button>
                            </div>
                        </form>
                    </div>
                    <div id="adminQuestionsList" class="divide-y divide-slate-800"></div>
                    <p id="adminQuestionsEmpty" class="hidden p-8 text-center text-sm text-slate-500">Belum ada soal.</p>
                    <p id="adminQuestionsMessage" role="status" class="hidden px-5 pb-5 text-sm"></p>
                </div>
            </section>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-900/50 py-4 text-center text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>&copy; 2026 Interactive Excel Learning Kit</span>
            <span class="font-mono text-emerald-500/80">Kelas TIK | Gus Ipul</span>
        </div>
    </footer>

    <script type="module">
        import {
            checkAdminSession,
            deleteStudentUser,
            importQuizResult,
            loadQuizResults,
            loadQuestionBank,
            loadStudentUsers,
            loginAdmin,
            logoutAdmin as endAdminSession,
            resetStudentPassword,
            saveQuestionBank,
            saveQuizResult,
        } from './app.js';

        const questionsSMP = [
            {
                topic: "SUM",
                question: "Diberikan data nilai tugas siswa pada sel A2 sampai A6 (80, 75, 90, 85, 70). Rumus untuk menghitung total keseluruhan nilai tersebut adalah:",
                sheetHeaders: ["No (A)", "Nilai Tugas (B)", "Total Nilai (C)"],
                sheetRows: [[1, "80", "[ ? ]"], [2, "75", ""], [3, "90", ""], [4, "85", ""], [5, "70", ""]],
                options: ["=SUM(A2:A6)", "=TOTAL(A2:A6)", "=SUM(A2+A6)", "=COUNT(A2:A6)"],
                correctAnswer: 0,
                explanation: "Fungsi SUM digunakan untuk menjumlahkan seluruh nilai angka dalam rentang sel (range) A2:A6."
            },
            {
                topic: "AVERAGE",
                question: "Untuk menghitung nilai rata-rata ujian matematika siswa pada rentang sel B2 hingga B10, rumus Excel yang tepat adalah:",
                sheetHeaders: ["Nama (A)", "Nilai Ujian (B)", "Rata-rata (C)"],
                sheetRows: [[2, "Budi", "85", "[ ? ]"], [3, "Siti", "90", ""]],
                options: ["=AVERAGE(B2:B10)", "=MEAN(B2:B10)", "=SUM(B2:B10)/2", "=AVERAGE(B2, B10)"],
                correctAnswer: 0,
                explanation: "Fungsi AVERAGE digunakan untuk menghitung nilai rata-rata aritmatika dari rentang sel yang ditentukan."
            },
            {
                topic: "MAX",
                question: "Dalam tabel nilai kelas, kita ingin mencari siapa yang memperoleh nilai tertinggi pada rentang C2:C20. Rumus yang digunakan adalah:",
                sheetHeaders: ["Nama (A)", "Nilai Akhir (C)", "Nilai Tertinggi"],
                sheetRows: [[2, "Andi", "95", "[ ? ]"], [3, "Cici", "88", ""]],
                options: ["=MAX(C2:C20)", "=HIGHEST(C2:C20)", "=TOP(C2:C20)", "=LARGE(C2:C20)"],
                correctAnswer: 0,
                explanation: "Fungsi MAX mengambil nilai angka paling besar/tertinggi dari rentang sel C2:C20."
            },
            {
                topic: "MIN",
                question: "Di sel D2:D15 terdapat daftar harga barang. Untuk mencari harga yang paling murah (terendah), rumus yang tepat adalah:",
                sheetHeaders: ["Barang (A)", "Harga (D)", "Harga Terendah"],
                sheetRows: [[2, "Buku", "5.000", "[ ? ]"], [3, "Pensil", "2.000", ""]],
                options: ["=MIN(D2:D15)", "=LOWEST(D2:D15)", "=SMALL(D2:D15)", "=MINIMUM(D2:D15)"],
                correctAnswer: 0,
                explanation: "Fungsi MIN berfungsi untuk menemukan nilai terkecil/terendah di dalam suatu rentang data."
            },
            {
                topic: "COUNT",
                question: "Kolom A berisi daftar angka hasil tes. Untuk menghitung berapa banyak sel yang BERISI ANGKA pada rentang A2:A20, kita menggunakan:",
                sheetHeaders: ["Data Tes (A)", "Jumlah Sel Berisi Angka"],
                sheetRows: [[2, "85", "[ ? ]"], [3, "Absen", ""]],
                options: ["=COUNT(A2:A20)", "=COUNTA(A2:A20)", "=SUM(A2:A20)", "=COUNTBLANK(A2:A20)"],
                correctAnswer: 0,
                explanation: "Fungsi COUNT khusus menghitung jumlah sel yang memuat data numerik (angka)."
            },
            {
                topic: "COUNTA",
                question: "Untuk menghitung berapa banyak sel yang TERISI (baik berupa angka maupun teks/nama siswa) di rentang B2:B15, rumusnya adalah:",
                sheetHeaders: ["Nama Siswa (B)", "Total Siswa Terdaftar"],
                sheetRows: [[2, "Ahmad", "[ ? ]"], [3, "Dewi", ""]],
                options: ["=COUNTA(B2:B15)", "=COUNT(B2:B15)", "=SUM(B2:B15)", "=COUNTALL(B2:B15)"],
                correctAnswer: 0,
                explanation: "COUNTA (Count All) menghitung semua sel yang tidak kosong, termasuk sel yang berisi teks."
            },
            {
                topic: "IF Dasar",
                question: "Nilai siswa ada di sel B2. Batas KKM adalah 70. Jika nilai B2 lebih besar atau sama dengan 70 maka 'Lulus', jika tidak maka 'Tidak Lulus'. Rumusnya adalah:",
                sheetHeaders: ["Nilai (B)", "Keterangan (C)"],
                sheetRows: [[2, "75", "[ ? ]"]],
                options: ["=IF(B2>=70, \"Lulus\", \"Tidak Lulus\")", "=IF(B2>70, \"Lulus\", \"Tidak Lulus\")", "=IF(B2=70, \"Lulus\", \"Gagal\")", "=IF(B2<70, \"Tidak Lulus\", \"Lulus\")"],
                correctAnswer: 0,
                explanation: "Kondisi B2>=70 mengecek apakah nilai mencapai KKM 70. Jika Benar menghasilkan 'Lulus', jika Salah 'Tidak Lulus'."
            },
            {
                topic: "VLOOKUP Dasar",
                question: "Di sel A2 diinputkan Kode Barang 'B01'. Kita ingin mengambil Nama Barang dari tabel acuan di rentang F2:G10 (kolom ke-2). Rumus VLOOKUP yang tepat adalah:",
                sheetHeaders: ["Kode (A)", "Nama Barang (B)", "Tabel Referensi (F2:G10)"],
                sheetRows: [[2, "B01", "[ ? ]", "F: Kode | G: Nama"]],
                options: ["=VLOOKUP(A2, F2:G10, 2, FALSE)", "=VLOOKUP(A2, F2:G10, 1, FALSE)", "=LOOKUP(A2, F2:G10, 2)", "=VLOOKUP(F2:G10, A2, 2, FALSE)"],
                correctAnswer: 0,
                explanation: "VLOOKUP mencari Kode di sel A2 pada tabel F2:G10 dan mengambil data Nama Barang dari kolom ke-2 dengan pencocokan eksak (FALSE)."
            },
            {
                topic: "SUMIF Dasar",
                question: "Kolom A (A2:A10) berisi nama barang dan Kolom B (B2:B10) berisi harga. Untuk menghitung total harga khusus untuk barang 'Buku', rumus SUMIF yang tepat adalah:",
                sheetHeaders: ["Barang (A)", "Harga (B)", "Total Harga 'Buku'"],
                sheetRows: [[2, "Buku", "5.000", "[ ? ]"], [3, "Pensil", "2.000", ""]],
                options: ["=SUMIF(A2:A10, \"Buku\", B2:B10)", "=SUMIF(B2:B10, \"Buku\", A2:A10)", "=SUM(A2:A10, \"Buku\")", "=COUNTIF(A2:A10, \"Buku\", B2:B10)"],
                correctAnswer: 0,
                explanation: "SUMIF(range_kriteria, kriteria, range_jumlah) digunakan untuk menjumlahkan nilai pada B2:B10 jika sel A2:A10 bernilai 'Buku'."
            },
            {
                topic: "LEFT",
                question: "Sel A2 berisi kode kelas '7A-2024'. Kita ingin mengambil 2 karakter pertama dari sebelah kiri yaitu '7A'. Rumus yang benar adalah:",
                sheetHeaders: ["Kode Kelas (A)", "Tingkat (B)"],
                sheetRows: [[2, "7A-2024", "[ ? ]"]],
                options: ["=LEFT(A2, 2)", "=RIGHT(A2, 2)", "=MID(A2, 1, 2)", "=FIRST(A2, 2)"],
                correctAnswer: 0,
                explanation: "Fungsi LEFT(A2, 2) mengambil 2 karakter dari urutan paling kiri teks."
            },
            {
                topic: "RIGHT",
                question: "Nomor Induk Siswa (NIS) di sel A2 adalah '20240015'. Rumus untuk mengambil 4 digit terakhir dari sebelah kanan ('0015') adalah:",
                sheetHeaders: ["NIS (A)", "No Urut (B)"],
                sheetRows: [[2, "20240015", "[ ? ]"]],
                options: ["=RIGHT(A2, 4)", "=LEFT(A2, 4)", "=MID(A2, 5, 4)", "=LAST(A2, 4)"],
                correctAnswer: 0,
                explanation: "Fungsi RIGHT(A2, 4) mengambil 4 karakter paling akhir dari sebelah kanan."
            },
            {
                topic: "MID",
                question: "Sel A2 berisi teks 'SMP-NEGERI-01'. Untuk mengambil kata 'NEGERI' (dimulai dari karakter ke-5 sebanyak 6 karakter), rumusnya adalah:",
                sheetHeaders: ["Kode Sekolah (A)", "Status (B)"],
                sheetRows: [[2, "SMP-NEGERI-01", "[ ? ]"]],
                options: ["=MID(A2, 5, 6)", "=LEFT(A2, 6)", "=RIGHT(A2, 6)", "=MID(A2, 4, 6)"],
                correctAnswer: 0,
                explanation: "MID(A2, start, length) mengambil teks dari posisi tengah sel A2 mulai karakter ke-5 sebanyak 6 huruf."
            },
            {
                topic: "UPPER",
                question: "Sel A2 berisi teks 'kelas tujuh a'. Rumus untuk mengubah semua huruf menjadi HURUF KAPITAL (BESAR) 'KELAS TUJUH A' adalah:",
                sheetHeaders: ["Teks Asli (A)", "Hasil Kapital (B)"],
                sheetRows: [[2, "kelas tujuh a", "[ ? ]"]],
                options: ["=UPPER(A2)", "=LOWER(A2)", "=PROPER(A2)", "=CAPITAL(A2)"],
                correctAnswer: 0,
                explanation: "Fungsi UPPER mengonversi seluruh karakter teks dalam sel menjadi huruf besar/kapital."
            },
            {
                topic: "LOWER",
                question: "Sel A2 berisi teks 'INFORMATIKA'. Rumus untuk mengubah seluruh huruf menjadi huruf kecil ('informatika') adalah:",
                sheetHeaders: ["Teks Asli (A)", "Huruf Kecil (B)"],
                sheetRows: [[2, "INFORMATIKA", "[ ? ]"]],
                options: ["=LOWER(A2)", "=UPPER(A2)", "=PROPER(A2)", "=SMALLTEXT(A2)"],
                correctAnswer: 0,
                explanation: "Fungsi LOWER merubah semua huruf kapital dalam sel menjadi huruf kecil."
            },
            {
                topic: "PROPER",
                question: "Di sel A2 terdapat nama 'budi santoso'. Agar menjadi 'Budi Santoso' (huruf besar di awal setiap kata), rumus yang tepat adalah:",
                sheetHeaders: ["Nama (A)", "Nama Rapi (B)"],
                sheetRows: [[2, "budi santoso", "[ ? ]"]],
                options: ["=PROPER(A2)", "=UPPER(A2)", "=TITLECASE(A2)", "=CAPITALIZE(A2)"],
                correctAnswer: 0,
                explanation: "PROPER mengubah karakter pertama setiap kata menjadi huruf besar dan sisanya huruf kecil."
            },
            {
                topic: "Penggabungan Teks (&)",
                question: "Sel A2 berisi 'Rani' dan B2 berisi 'Wijaya'. Rumus untuk menggabungkan keduanya menjadi 'Rani Wijaya' dengan spasi di tengahnya adalah:",
                sheetHeaders: ["Depan (A)", "Belakang (B)", "Lengkap (C)"],
                sheetRows: [[2, "Rani", "Wijaya", "[ ? ]"]],
                options: ["=A2 & \" \" & B2", "=A2 & B2", "=SUM(A2, B2)", "=JOIN(A2, B2)"],
                correctAnswer: 0,
                explanation: "Simbol ampersand (&) menggabungkan teks. Tanda petik ganda dengan spasi \" \" memberi jarak spasi di antara kata."
            },
            {
                topic: "LEN",
                question: "Untuk mengetahui jumlah huruf/karakter pada kata 'Pramuka' di sel A2, rumus yang kita gunakan adalah:",
                sheetHeaders: ["Kata (A)", "Panjang Karakter (B)"],
                sheetRows: [[2, "Pramuka", "[ ? ]"]],
                options: ["=LEN(A2)", "=LENGTH(A2)", "=COUNT(A2)", "=CHARCOUNT(A2)"],
                correctAnswer: 0,
                explanation: "Fungsi LEN (Length) menghitung total banyaknya karakter/huruf dalam suatu sel."
            },
            {
                topic: "COUNTBLANK",
                question: "Di rentang sel B2:B10 terdapat status pengumpulan tugas. Untuk menghitung berapa siswa yang BELUM mengumpulkan (sel kosong), rumusnya:",
                sheetHeaders: ["Status (B)", "Jumlah Belum Kumpul"],
                sheetRows: [[2, "Sudah", "[ ? ]"], [3, "", ""]],
                options: ["=COUNTBLANK(B2:B10)", "=COUNTA(B2:B10)", "=COUNTIF(B2:B10, \"Kosong\")", "=COUNT(B2:B10)"],
                correctAnswer: 0,
                explanation: "Fungsi COUNTBLANK khusus digunakan untuk menghitung sel-sel yang kosong tanpa isi data."
            },
            {
                topic: "TODAY",
                question: "Rumus Excel yang digunakan untuk menampilkan tanggal hari ini secara otomatis sesuai sistem komputer adalah:",
                sheetHeaders: ["Keterangan", "Tanggal Hari Ini"],
                sheetRows: [[1, "Sistem Date", "[ ? ]"]],
                options: ["=TODAY()", "=NOW()", "=DATE()", "=DAY()"],
                correctAnswer: 0,
                explanation: "Fungsi TODAY() mengambil dan menampilkan tanggal saat ini tanpa menyertakan jam."
            },
            {
                topic: "RANK",
                question: "Untuk menentukan peringkat/juara siswa berdasarkan Nilai Ujian di sel B2 dari seluruh nilai di rentang B2:B15, rumusnya adalah:",
                sheetHeaders: ["Nama (A)", "Nilai (B)", "Peringkat (C)"],
                sheetRows: [[2, "Siti", "92", "[ ? ]"]],
                options: ["=RANK(B2, B$2:B$15)", "=ORDER(B2, B2:B15)", "=POSITION(B2, B2:B15)", "=SORT(B2, B2:B15)"],
                correctAnswer: 0,
                explanation: "Fungsi RANK(number, ref) menentukan rangking posisi angka relatif terhadap rentang kumpulan data."
            }
        ];

        const questionsSMA = [
            {
                topic: "VLOOKUP",
                question: "Diberikan tabel data produk pada rentang A2:C10. Di sel E2 diinputkan Kode Barang 'P002'. Rumus apa yang tepat di sel F2 untuk mencari Harga Barang (Kolom C / Kolom ke-3) secara presisi?",
                sheetHeaders: ["Kode (A)", "Nama Barang (B)", "Harga (C)", "Cari Kode (E)", "Hasil Harga (F)"],
                sheetRows: [[2, "P001", "Laptop", "10.000.000", "P002", "[ ? ]"], [3, "P002", "Mouse", "150.000", "", ""]],
                options: ["=VLOOKUP(E2, A2:C10, 3, FALSE)", "=VLOOKUP(E2, A2:C10, 2, FALSE)", "=VLOOKUP(A2:C10, E2, 3, TRUE)", "=LOOKUP(E2, A2:A10, C2:C10)"],
                correctAnswer: 0,
                explanation: "VLOOKUP dengan argumen ke-4 FALSE (atau 0) digunakan untuk mencari pencocokan eksak pada indeks kolom ke-3."
            },
            {
                topic: "HLOOKUP",
                question: "Diberikan tabel horizontal di rentang B1:E3 di mana Baris 1 memuat Kode, Baris 2 memuat Barang, dan Baris 3 memuat Harga. Rumus di B5 mencari Harga (Baris ke-3) dari Kode 'K02' (A5):",
                sheetHeaders: ["Kategori", "Kolom B", "Kolom C", "Kolom D", "Kolom E"],
                sheetRows: [[1, "K01", "K02", "K03", "K04"], [2, "Pensil", "Buku", "Penggaris", "Spidol"], [3, "2.000", "5.000", "3.000", "4.000"], [5, "Cari: K02", "Hasil: [ ? ]", "", ""]],
                options: ["=HLOOKUP(A5, B1:E3, 3, FALSE)", "=HLOOKUP(A5, B1:E3, 2, FALSE)", "=VLOOKUP(A5, B1:E3, 3, FALSE)", "=LOOKUP(A5, B1:B3, 3)"],
                correctAnswer: 0,
                explanation: "HLOOKUP mencari nilai di baris pertama tabel secara horizontal dan mengembalikan nilai dari baris yang ditentukan (baris ke-3)."
            },
            {
                topic: "INDEX & MATCH",
                question: "Diketahui Nama Karyawan di kolom A (A2:A10) dan Gaji di kolom B (B2:B10). Di sel D2 diisi 'Siska'. Rumus kombinasi INDEX dan MATCH di E2 untuk mengambil Gaji Siska secara dinamis adalah:",
                sheetHeaders: ["Nama (A)", "Gaji (B)", "Cari (D2)", "Hasil Gaji (E2)"],
                sheetRows: [[2, "Rian", "5.000.000", "Siska", "[ ? ]"], [3, "Siska", "6.500.000", "", ""]],
                options: ["=INDEX(B2:B10, MATCH(D2, A2:A10, 0))", "=MATCH(INDEX(B2:B10), D2, A2:A10)", "=INDEX(A2:A10, MATCH(D2, B2:B10, 0))", "=LOOKUP(MATCH(D2, A2:A10), B2:B10)"],
                correctAnswer: 0,
                explanation: "MATCH mencari posisi indeks 'Siska' di range A2:A10, lalu INDEX mengambil nilai gaji pada urutan baris tersebut."
            },
            {
                topic: "XLOOKUP",
                question: "Kode Produk berada di kolom B (B2:B10) dan Nama Produk ada di kolom A (A2:A10). Rumus XLOOKUP di D2 untuk mencari Nama Produk berdasarkan Kode 'K-05' di C2 adalah:",
                sheetHeaders: ["Nama Produk (A)", "Kode (B)", "Cari Kode (C2)", "Hasil Produk (D2)"],
                sheetRows: [[2, "Kopi Arabika", "K-05", "K-05", "[ ? ]"]],
                options: ["=XLOOKUP(C2, B2:B10, A2:A10)", "=XLOOKUP(B2:B10, C2, A2:A10)", "=XLOOKUP(C2, A2:A10, B2:B10)", "=VLOOKUP(C2, B2:A10, 1, FALSE)"],
                correctAnswer: 0,
                explanation: "XLOOKUP(lookup_value, lookup_array, return_array) fleksibel mencari data ke arah kiri maupun kanan."
            },
            {
                topic: "SUMIF",
                question: "Tabel transaksi mencatat Cabang di B2:B20 dan Penjualan di C2:C20. Rumus yang tepat di sel E2 untuk menghitung total penjualan khusus cabang 'Jakarta' adalah:",
                sheetHeaders: ["No (A)", "Cabang (B)", "Penjualan (C)", "Cari (E1)", "Total Jakarta (E2)"],
                sheetRows: [[2, "Jakarta", "5.000.000", "Jakarta", "[ ? ]"], [3, "Surabaya", "3.500.000", "", ""]],
                options: ["=SUMIF(B2:B20, \"Jakarta\", C2:C20)", "=SUMIF(C2:C20, \"Jakarta\", B2:B20)", "=SUM(B2:B20, \"Jakarta\")", "=COUNTIF(B2:B20, \"Jakarta\", C2:C20)"],
                correctAnswer: 0,
                explanation: "Sintaks fungsi SUMIF adalah SUMIF(range_kriteria, kriteria, range_penjumlahan)."
            },
            {
                topic: "SUMIFS",
                question: "Tabel mencatat Cabang di A2:A20, Kategori di B2:B20, dan Total Penjualan di C2:C20. Rumus menghitung total penjualan cabang 'Bandung' ber-kategori 'Elektronik' adalah:",
                sheetHeaders: ["Cabang (A)", "Kategori (B)", "Penjualan (C)", "Hasil (E2)"],
                sheetRows: [[2, "Bandung", "Elektronik", "12.000.000", "[ ? ]"], [3, "Bandung", "Pakaian", "4.000.000", ""]],
                options: ["=SUMIFS(C2:C20, A2:A20, \"Bandung\", B2:B20, \"Elektronik\")", "=SUMIFS(A2:A20, \"Bandung\", B2:B20, \"Elektronik\", C2:C20)", "=SUMIF(C2:C20, \"Bandung\", \"Elektronik\")", "=SUMIFS(C2:C20, \"Bandung\", A2:A20, \"Elektronik\", B2:B20)"],
                correctAnswer: 0,
                explanation: "SUMIFS diawali dengan sum_range (C2:C20), diikuti pasangan range kriteria dan kriterianya."
            },
            {
                topic: "COUNTIF",
                question: "Di Kolom C (C2:C50) memuat status kehadiran karyawan. Untuk menghitung total karyawan berstatus 'Terlambat', rumus yang benar di sel E2 adalah:",
                sheetHeaders: ["ID (A)", "Nama (B)", "Status (C)", "Cari (E1)", "Total Terlambat (E2)"],
                sheetRows: [[2, "Doni", "Hadir", "Terlambat", "[ ? ]"], [3, "Eka", "Terlambat", "", ""]],
                options: ["=COUNTIF(C2:C50, \"Terlambat\")", "=COUNT(C2:C50, \"Terlambat\")", "=SUMIF(C2:C50, \"Terlambat\")", "=COUNTA(C2:C50, \"Terlambat\")"],
                correctAnswer: 0,
                explanation: "COUNTIF menghitung jumlah sel dalam rentang yang memenuhi satu syarat spesifik."
            },
            {
                topic: "COUNTIFS",
                question: "Tabel siswa mencatat Status Kelulusan di B2:B30 ('Lulus') dan Jenis Kelamin di C2:C30 ('L'). Rumus menghitung siswa Laki-laki yang Lulus adalah:",
                sheetHeaders: ["Status (B)", "Gender (C)", "Total Siswa Lulus Laki-laki"],
                sheetRows: [[2, "Lulus", "L", "[ ? ]"], [3, "Lulus", "P", ""]],
                options: ["=COUNTIFS(B2:B30, \"Lulus\", C2:C30, \"L\")", "=COUNTIF(B2:B30, \"Lulus\", C2:C30, \"L\")", "=COUNTIFS(\"Lulus\", B2:B30, \"L\", C2:C30)", "=SUMIFS(B2:B30, \"Lulus\", C2:C30, \"L\")"],
                correctAnswer: 0,
                explanation: "COUNTIFS menghitung jumlah sel yang memenuhi beberapa syarat/kriteria sekaligus secara bersamaan."
            },
            {
                topic: "AVERAGEIF",
                question: "Tabel mencatat Divisi Karyawan di A2:A30 dan Gaji di B2:B30. Rumus di sel D2 untuk menghitung rata-rata gaji khusus divisi 'IT' adalah:",
                sheetHeaders: ["Divisi (A)", "Gaji (B)", "Kriteria (D1)", "Rata-rata IT (D2)"],
                sheetRows: [[2, "IT", "8.000.000", "IT", "[ ? ]"], [3, "HRD", "6.000.000", "", ""]],
                options: ["=AVERAGEIF(A2:A30, \"IT\", B2:B30)", "=AVERAGEIF(B2:B30, \"IT\", A2:A30)", "=AVERAGE(A2:A30, \"IT\")", "=SUMIF(A2:A30, \"IT\", B2:B30) / COUNT(B2:B30)"],
                correctAnswer: 0,
                explanation: "Sintaks AVERAGEIF(range, criteria, [average_range]) menghitung nilai rata-rata berdasarkan syarat tertentu."
            },
            {
                topic: "IFERROR + VLOOKUP",
                question: "Rumus `=VLOOKUP(E2, A2:B10, 2, FALSE)` menghasilkan error `#N/A` jika kode tidak ada. Pembungkusan IFERROR yang tepat agar muncul tulisan 'Tidak Ditemukan':",
                sheetHeaders: ["Kode (A)", "Nama (B)", "Cari (E2)", "Status Hasil (F2)"],
                sheetRows: [[2, "X99", "Unknown", "X99", "[ ? ]"]],
                options: ["=IFERROR(VLOOKUP(E2, A2:B10, 2, FALSE), \"Tidak Ditemukan\")", "=IF(VLOOKUP(E2, A2:B10, 2, FALSE), \"Tidak Ditemukan\")", "=ISERROR(VLOOKUP(E2, A2:B10, 2, FALSE), \"Tidak Ditemukan\")", "=IFNA(E2, \"Tidak Ditemukan\")"],
                correctAnswer: 0,
                explanation: "Fungsi IFERROR(nilai_rumus, nilai_jika_error) mengganti pesan galat dengan alternatif teks yang lebih rapi."
            },
            {
                topic: "Nested IF",
                question: "Di sel A2 terdapat Nilai Angka (85). Ketentuan predikat: >=90 (A), >=80 (B), >=70 (C), selainnya (D). Rumus IF bertingkat yang benar di sel B2 adalah:",
                sheetHeaders: ["Nilai (A)", "Predikat (B)"],
                sheetRows: [[2, "85", "[ ? ]"]],
                options: ["=IF(A2>=90, \"A\", IF(A2>=80, \"B\", IF(A2>=70, \"C\", \"D\")))", "=IF(A2>=90, \"A\", A2>=80, \"B\", A2>=70, \"C\", \"D\")", "=IF(A2>=90; \"A\"; \"B\"; \"C\"; \"D\")", "=IF(A2>=70, \"C\", IF(A2>=80, \"B\", IF(A2>=90, \"A\", \"D\")))"],
                correctAnswer: 0,
                explanation: "Dalam IF bertingkat, evaluasi kondisi logika disusun secara hierarkis berurutan dari nilai tertinggi ke terendah."
            },
            {
                topic: "IF dengan AND",
                question: "Untuk mendapat bonus bulanan, Karyawan harus memiliki Masa Kerja (A2) > 3 tahun DAN Penjualan (B2) > 50 unit. Rumus status di C2 adalah:",
                sheetHeaders: ["Masa Kerja (A)", "Penjualan (B)", "Status Bonus (C)"],
                sheetRows: [[2, "4", "60", "[ ? ]"]],
                options: ["=IF(AND(A2>3, B2>50), \"Bonus\", \"Tidak Bonus\")", "=IF(OR(A2>3, B2>50), \"Bonus\", \"Tidak Bonus\")", "=IF(A2>3 AND B2>50, \"Bonus\", \"Tidak Bonus\")", "=AND(IF(A2>3), IF(B2>50), \"Bonus\")"],
                correctAnswer: 0,
                explanation: "Fungsi AND mengembalikan TRUE hanya bila seluruh syarat di dalamnya terpenuhi sekaligus."
            },
            {
                topic: "IF dengan OR",
                question: "Beasiswa diberikan jika Nilai Akademik (A2) >= 90 ATAU Prestasi Non-Akademik (B2) = 'Juara'. Rumus di C2 adalah:",
                sheetHeaders: ["Nilai (A)", "Prestasi (B)", "Beasiswa (C)"],
                sheetRows: [[2, "82", "Juara", "[ ? ]"]],
                options: ["=IF(OR(A2>=90, B2=\"Juara\"), \"Dapat\", \"Tidak\")", "=IF(AND(A2>=90, B2=\"Juara\"), \"Dapat\", \"Tidak\")", "=IF(A2>=90 OR B2=\"Juara\", \"Dapat\", \"Tidak\")", "=OR(IF(A2>=90), IF(B2=\"Juara\"))"],
                correctAnswer: 0,
                explanation: "Fungsi OR mengembalikan TRUE jika salah satu saja dari beberapa kondisi logika terpenuhi."
            },
            {
                topic: "Gabungan LEFT + SEARCH",
                question: "Sel A2 berisi nama lengkap 'Budi Gunawan'. Untuk mengambil nama depan saja ('Budi') sebelum posisi spasi secara dinamis, rumus yang digunakan adalah:",
                sheetHeaders: ["Nama Lengkap (A)", "Nama Depan (B)"],
                sheetRows: [[2, "Budi Gunawan", "[ ? ]"]],
                options: ["=LEFT(A2, SEARCH(\" \", A2)-1)", "=LEFT(A2, 4)", "=MID(A2, 1, SEARCH(\" \", A2))", "=FIRSTWORD(A2)"],
                correctAnswer: 0,
                explanation: "SEARCH(\" \", A2) menemukan posisi karakter spasi, lalu dikurangi 1 agar LEFT mengambil karakter nama depan saja."
            },
            {
                topic: "TEXT Format",
                question: "Sel A2 berisi tanggal '17/08/2024'. Kita ingin merubah bentuk tampilan tanggal menjadi nama hari penuh (contoh: 'Saturday' / 'Sabtu') dengan rumus:",
                sheetHeaders: ["Tanggal (A)", "Nama Hari (B)"],
                sheetRows: [[2, "17/08/2024", "[ ? ]"]],
                options: ["=TEXT(A2, \"dddd\")", "=DAYNAME(A2)", "=FORMAT(A2, \"day\")", "=DATEFORMAT(A2, \"dddd\")"],
                correctAnswer: 0,
                explanation: "Fungsi TEXT(A2, \"dddd\") merubah serial angka tanggal menjadi string format nama hari penuh."
            },
            {
                topic: "TEXTJOIN",
                question: "Untuk menggabungkan daftar nama di A2:A5 menjadi satu sel dipisahkan koma ', ' dan mengabaikan sel kosong, rumus Excel modernnya adalah:",
                sheetHeaders: ["Daftar Nama (A2:A5)", "Hasil Gabungan"],
                sheetRows: [[2, "Andi, Budi, Cici, Doni", "[ ? ]"]],
                options: ["=TEXTJOIN(\", \", TRUE, A2:A5)", "=CONCATENATE(A2:A5, \", \")", "=JOIN(\", \", A2:A5)", "=MERGE(A2:A5, \", \")"],
                correctAnswer: 0,
                explanation: "TEXTJOIN(delimiter, ignore_empty, range) merupakan fungsi modern untuk menggabungkan range teks dengan pemisah."
            },
            {
                topic: "ROUND",
                question: "Di sel A2 terdapat angka desimal hasil perhitungan '87.654'. Untuk membulatkan angka tersebut menjadi 2 angka di belakang koma ('87.65'), rumusnya adalah:",
                sheetHeaders: ["Angka Desimal (A)", "Hasil Pembulatan (B)"],
                sheetRows: [[2, "87.654", "[ ? ]"]],
                options: ["=ROUND(A2, 2)", "=ROUNDUP(A2, 2)", "=INT(A2, 2)", "=TRUNC(A2, 2)"],
                correctAnswer: 0,
                explanation: "Fungsi ROUND(number, num_digits) membulatkan nilai numerik ke jumlah desimal yang ditentukan."
            },
            {
                topic: "VLOOKUP Dinamis + MATCH",
                question: "Agar nomor indeks kolom pada VLOOKUP tidak ditulis manual (hardcode 3), kita dapat mengganti angka 3 dengan fungsi MATCH untuk mencari nama header di baris 1. Rumus di F2:",
                sheetHeaders: ["Kode (A)", "Nama (B)", "Harga (C)", "Cari Kolom (F1)", "Hasil (F2)"],
                sheetRows: [[2, "P01", "Laptop", "10.000.000", "Harga", "[ ? ]"]],
                options: ["=VLOOKUP(E2, A1:C10, MATCH(F1, A1:C1, 0), FALSE)", "=VLOOKUP(E2, A1:C10, INDEX(F1, A1:C1), FALSE)", "=MATCH(VLOOKUP(E2, A1:C10, 3), F1)", "=LOOKUP(E2, A1:C10, MATCH(F1))"],
                correctAnswer: 0,
                explanation: "MATCH(F1, A1:C1, 0) menghasilkan angka posisi kolom header secara otomatis dan dinamis bagi VLOOKUP."
            },
            {
                topic: "DATEDIF",
                question: "Di sel A2 tertera Tanggal Lahir '15/05/2005' dan B2 Tanggal Hari Ini. Untuk menghitung Usia/Umur lengkap dalam satuan TAHUN ('Y'), rumus yang tepat di C2:",
                sheetHeaders: ["Tgl Lahir (A)", "Tgl Sekarang (B)", "Usia (Tahun) (C)"],
                sheetRows: [[2, "15/05/2005", "15/05/2024", "[ ? ]"]],
                options: ["=DATEDIF(A2, B2, \"Y\")", "=YEARFRAC(A2, B2)", "=AGE(A2, B2)", "=DATEDIFF(A2, B2, \"YEAR\")"],
                correctAnswer: 0,
                explanation: "DATEDIF(start_date, end_date, \"Y\") menghitung selisih penuh dua tanggal dalam interval tahun."
            },
            {
                topic: "IF + SUMIF",
                question: "Jika total penjualan cabang 'Surabaya' di B2:B20 melebihi 50.000.000 maka tampilkan 'Target Tercapai', jika tidak 'Belum Tercapai'. Rumus di E2:",
                sheetHeaders: ["Cabang (B)", "Penjualan (C)", "Status Target (E2)"],
                sheetRows: [[2, "Surabaya", "15.000.000", "[ ? ]"]],
                options: ["=IF(SUMIF(B2:B20, \"Surabaya\", C2:C20) > 50000000, \"Target Tercapai\", \"Belum Tercapai\")", "=SUMIF(IF(B2:B20, \"Surabaya\") > 50000000, \"Target Tercapai\", \"Belum Tercapai\")", "=IF(COUNTIF(B2:B20, \"Surabaya\") > 50000000, \"Target Tercapai\", \"Belum\")", "=SUMIFS(B2:B20, \"Surabaya\", \"Target Tercapai\")"],
                correctAnswer: 0,
                explanation: "SUMIF menghitung total penjualan Surabaya terlebih dahulu, lalu dievaluasi oleh fungsi IF untuk menentukan status target."
            }
        ];

        let questionBank = [];
        let studentProfile = { name: "", classId: "", level: "SMP", date: new Date().toISOString().split('T')[0] };
        let currentQuestionIndex = 0;
        let activeQuestions = [];
        let userAnswers = [];
        let timerSeconds = 0;
        let timerInterval = null;
        let currentQuizPayload = null;
        let dashboardHistory = []; 
        let expandedResultIndex = null;
        let adminAuthenticated = false;
        let studentAuthMode = 'register';

        function setStudentAuthMode(mode) {
            studentAuthMode = mode;
            const registerTab = document.getElementById('studentRegisterTab');
            const loginTab = document.getElementById('studentLoginTab');
            const submitBtn = document.getElementById('studentSubmitBtn');
            const authMessage = document.getElementById('studentAuthMessage');
            const nameField = document.getElementById('studentNameField');
            const schoolFields = document.getElementById('studentSchoolFields');
            const nameInput = document.getElementById('inputName');
            const levelField = document.getElementById('inputLevel');
            const classField = document.getElementById('inputClass');
            const emailField = document.getElementById('inputEmail');
            const passwordField = document.getElementById('inputPassword');

            if (registerTab && loginTab) {
                const isRegister = mode === 'register';
                registerTab.className = `flex-1 rounded-lg px-3 py-2 text-sm font-semibold border ${isRegister ? 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30' : 'text-slate-300 border-transparent'}`;
                loginTab.className = `flex-1 rounded-lg px-3 py-2 text-sm font-semibold border ${!isRegister ? 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30' : 'text-slate-300 border-transparent'}`;
            }

            const requireAccountFields = mode === 'register';
            if (nameField) nameField.classList.toggle('hidden', !requireAccountFields);
            if (schoolFields) schoolFields.classList.toggle('hidden', !requireAccountFields);
            if (nameInput) nameInput.required = requireAccountFields;
            if (levelField) levelField.required = requireAccountFields;
            if (classField) classField.required = requireAccountFields;
            if (emailField) emailField.required = true;
            if (passwordField) passwordField.required = true;

            if (submitBtn) {
                submitBtn.querySelector('span').innerText = mode === 'register' ? 'Daftarkan Akun' : 'Masuk ke Akun';
            }

            if (authMessage) {
                authMessage.classList.add('hidden');
                authMessage.innerText = '';
            }
        }

        function setStudentAuthMessage(message) {
            const element = document.getElementById('studentAuthMessage');
            if (!element) return;
            element.innerText = message;
            element.classList.toggle('hidden', !message);
        }

        async function handleStudentAuth(event) {
            event.preventDefault();
            const name = document.getElementById('inputName').value.trim();
            const level = document.getElementById('inputLevel').value;
            const className = document.getElementById('inputClass').value;
            const email = document.getElementById('inputEmail').value.trim();
            const password = document.getElementById('inputPassword').value;

            if (!email || !password) {
                setStudentAuthMessage('Email dan password wajib diisi.');
                return;
            }

            if (studentAuthMode === 'register') {
                if (!name || !className || !level) {
                    setStudentAuthMessage('Nama, kelas, dan tingkat wajib diisi saat daftar baru.');
                    return;
                }
            }

            const action = studentAuthMode === 'register' ? 'register-user' : 'login-user';
            const payload = studentAuthMode === 'register'
                ? { action, student_name: name, class_name: className, level, email, password }
                : { action, email, password };

            setStudentAuthMessage('');
            const submitBtn = document.getElementById('studentSubmitBtn');
            if (submitBtn) submitBtn.disabled = true;

            try {
                const response = await fetch('./api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.error || 'Proses akun gagal.');
                }

                studentProfile.name = result.data.name || name;
                studentProfile.level = result.data.level || level;
                studentProfile.classId = result.data.class_name || className;
                document.getElementById('inputPassword').value = '';
                setStudentAuthMessage(studentAuthMode === 'register' ? 'Akun berhasil dibuat. Silakan mulai kuis.' : 'Login berhasil. Silakan mulai kuis.');
                setStudentAuthMode(studentAuthMode);
                loadStudentSummary(studentProfile.name, studentProfile.classId, studentProfile.level);
                startQuiz(event);
            } catch (error) {
                setStudentAuthMessage(error.message || 'Terjadi kesalahan saat memproses akun.');
            } finally {
                const currentSubmitBtn = document.getElementById('studentSubmitBtn');
                if (currentSubmitBtn) currentSubmitBtn.disabled = false;
            }
        }

        window.addEventListener('DOMContentLoaded', async () => {
            const dateInput = document.getElementById('inputDate');
            if (dateInput) dateInput.value = studentProfile.date;
            updateClassDropdown();
            setStudentAuthMode('register');
            document.getElementById('studentRegisterTab').addEventListener('click', () => setStudentAuthMode('register'));
            document.getElementById('studentLoginTab').addEventListener('click', () => setStudentAuthMode('login'));
            document.getElementById('formStudent').addEventListener('submit', handleStudentAuth);
            document.getElementById('inputName').addEventListener('input', () => {
                const name = document.getElementById('inputName').value.trim();
                const level = document.getElementById('inputLevel').value;
                const className = document.getElementById('inputClass').value;
                loadStudentSummary(name, className, level);
            });
            document.getElementById('inputLevel').addEventListener('change', () => {
                const name = document.getElementById('inputName').value.trim();
                const level = document.getElementById('inputLevel').value;
                const className = document.getElementById('inputClass').value;
                loadStudentSummary(name, className, level);
            });
            document.getElementById('inputClass').addEventListener('change', () => {
                const name = document.getElementById('inputName').value.trim();
                const level = document.getElementById('inputLevel').value;
                const className = document.getElementById('inputClass').value;
                loadStudentSummary(name, className, level);
            });
            lucide.createIcons();
            try {
                const session = await checkAdminSession();
                adminAuthenticated = session.authenticated;
                if (adminAuthenticated) {
                    dashboardHistory = await loadQuizResults();
                }
            } catch (error) {
                adminAuthenticated = false;
                dashboardHistory = [];
                setAdminLoginMessage(error.status === 401
                    ? error.message
                    : 'Tidak dapat menghubungi layanan admin. Coba muat ulang halaman.');
            }
            try {
                const savedQuestions = await loadQuestionBank();
                questionBank = savedQuestions.length ? savedQuestions : buildDefaultQuestionBank();
                if (adminAuthenticated && savedQuestions.length === 0) {
                    await saveQuestionBank(questionBank);
                }
            } catch (error) {
                questionBank = buildDefaultQuestionBank();
            }
            updateAdminPanelState();
            document.getElementById('adminLoginForm').addEventListener('submit', submitAdminLogin);
            document.getElementById('dashboardSearch').addEventListener('input', renderDashboard);
            document.getElementById('dashboardLevelFilter').addEventListener('change', renderDashboard);
            document.getElementById('dashboardClassFilter').addEventListener('change', renderDashboard);
            document.getElementById('dashboardSort').addEventListener('change', renderDashboard);
            document.getElementById('dashboardTableBody').addEventListener('click', (event) => {
                const button = event.target.closest('[data-result-index]');
                if (!button) return;
                const resultIndex = Number(button.dataset.resultIndex);
                expandedResultIndex = expandedResultIndex === resultIndex ? null : resultIndex;
                renderDashboard();
            });
            document.getElementById('adminUsersTableBody').addEventListener('click', (event) => {
                const button = event.target.closest('[data-user-action]');
                if (!button) return;
                const userId = Number(button.dataset.userId);
                if (button.dataset.userAction === 'reset') resetUserPassword(userId);
                if (button.dataset.userAction === 'delete') deleteUser(userId);
            });
            document.getElementById('adminQuestionsList').addEventListener('click', (event) => {
                const button = event.target.closest('[data-question-action]');
                if (!button) return;
                const questionId = button.dataset.questionId;
                if (button.dataset.questionAction === 'edit') openQuestionEditor(questionId);
                if (button.dataset.questionAction === 'delete') deleteQuestion(questionId);
            });
            document.getElementById('questionEditorForm').addEventListener('submit', saveQuestionFromForm);
            document.getElementById('questionLevel').addEventListener('change', () => updateQuestionClassOptions());
            updateQuestionClassOptions();
            renderQuestionBank();
            if (adminAuthenticated) renderDashboard();
        });

        function setAdminLoginMessage(message) {
            const element = document.getElementById('adminLoginMessage');
            element.innerText = message;
            element.classList.toggle('hidden', !message);
        }

        function updateAdminPanelState() {
            document.getElementById('adminLogin').classList.toggle('hidden', adminAuthenticated);
            document.getElementById('adminWorkspace').classList.toggle('hidden', !adminAuthenticated);
            if (adminAuthenticated) {
                document.getElementById('adminSignedInAs').innerText = document.getElementById('adminEmail').value;
                setAdminLoginMessage('');
            }
        }

        async function submitAdminLogin(event) {
            event.preventDefault();
            const form = event.currentTarget;
            const submitButton = document.getElementById('adminLoginSubmit');
            submitButton.disabled = true;
            setAdminLoginMessage('');

            try {
                const session = await loginAdmin(
                    document.getElementById('adminEmail').value.trim(),
                    document.getElementById('adminPassword').value
                );
                dashboardHistory = await loadQuizResults();
                adminAuthenticated = session.authenticated;
                document.getElementById('adminPassword').value = '';
                updateAdminPanelState();
                renderDashboard();
            } catch (error) {
                setAdminLoginMessage(error.message);
            } finally {
                submitButton.disabled = false;
            }
        }

        async function logoutAdmin() {
            try {
                await endAdminSession();
            } catch (error) {
                alert(`Logout gagal: ${error.message}`);
                return;
            }

            adminAuthenticated = false;
            dashboardHistory = [];
            expandedResultIndex = null;
            updateAdminPanelState();
            switchView('dashboard');
        }

        function switchAdminSection(section) {
            const showUsers = section === 'users';
            const showQuestions = section === 'questions';
            document.getElementById('adminResultsPanel').classList.toggle('hidden', showUsers || showQuestions);
            document.getElementById('adminUsersPanel').classList.toggle('hidden', !showUsers);
            document.getElementById('adminQuestionsPanel').classList.toggle('hidden', !showQuestions);
            document.getElementById('adminResultsTab').className = `px-3 py-2 rounded-lg text-sm font-semibold ${!showUsers && !showQuestions ? 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30' : 'text-slate-300 border border-transparent hover:bg-slate-800'}`;
            document.getElementById('adminUsersTab').className = `px-3 py-2 rounded-lg text-sm font-semibold ${showUsers ? 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30' : 'text-slate-300 border border-transparent hover:bg-slate-800'}`;
            document.getElementById('adminQuestionsTab').className = `px-3 py-2 rounded-lg text-sm font-semibold ${showQuestions ? 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30' : 'text-slate-300 border border-transparent hover:bg-slate-800'}`;
            if (showUsers) refreshAdminUsers();
            if (showQuestions) renderQuestionBank();
        }

        function setAdminUsersMessage(message, isError = false) {
            const element = document.getElementById('adminUsersMessage');
            element.innerText = message;
            element.className = `px-5 pb-5 text-sm ${isError ? 'text-rose-400' : 'text-emerald-400'} ${message ? '' : 'hidden'}`;
        }

        async function refreshAdminUsers() {
            setAdminUsersMessage('');
            try {
                const users = await loadStudentUsers();
                const tableBody = document.getElementById('adminUsersTableBody');
                tableBody.innerHTML = users.map((user) => `
                    <tr>
                        <td class="px-5 py-4 font-medium text-white">${escapeHtml(user.name)}</td>
                        <td class="px-5 py-4 text-slate-400">${escapeHtml(user.email)}</td>
                        <td class="px-5 py-4 text-slate-400">${escapeHtml(user.class_name)} / ${escapeHtml(user.level)}</td>
                        <td class="px-5 py-4 text-xs text-slate-500">${escapeHtml(user.created_at)}</td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            <button type="button" data-user-action="reset" data-user-id="${Number(user.id)}" class="px-2.5 py-1.5 text-xs text-amber-300 hover:bg-amber-500/10 rounded border border-amber-500/20">Reset password</button>
                            <button type="button" data-user-action="delete" data-user-id="${Number(user.id)}" class="ml-1 px-2.5 py-1.5 text-xs text-rose-300 hover:bg-rose-500/10 rounded border border-rose-500/20">Hapus</button>
                        </td>
                    </tr>`).join('');
                document.getElementById('adminUserCount').innerText = `${users.length} user terdaftar`;
                document.getElementById('adminUsersEmpty').classList.toggle('hidden', users.length > 0);
            } catch (error) {
                if (error.status === 401) {
                    adminAuthenticated = false;
                    updateAdminPanelState();
                }
                setAdminUsersMessage(`Daftar user gagal dimuat: ${error.message}`, true);
            }
        }

        async function resetUserPassword(userId) {
            const password = window.prompt('Masukkan password baru (minimal 4 karakter):');
            if (password === null) return;
            try {
                await resetStudentPassword(userId, password);
                setAdminUsersMessage('Password user berhasil direset.');
            } catch (error) {
                setAdminUsersMessage(`Reset password gagal: ${error.message}`, true);
            }
        }

        async function deleteUser(userId) {
            if (!window.confirm('Hapus akun user ini? Tindakan ini tidak dapat dibatalkan.')) return;
            try {
                await deleteStudentUser(userId);
                setAdminUsersMessage('Akun user berhasil dihapus.');
                await refreshAdminUsers();
            } catch (error) {
                setAdminUsersMessage(`Penghapusan user gagal: ${error.message}`, true);
            }
        }

        function updateQuestionClassOptions(selectedClass = 'all') {
            const level = document.getElementById('questionLevel').value;
            const classes = level === 'SMP'
                ? ['all', 'Kelas 7', 'Kelas 8', 'Kelas 9']
                : ['all', 'Kelas 10', 'Kelas 11', 'Kelas 12'];
            const classSelect = document.getElementById('questionClass');
            classSelect.innerHTML = classes.map((className) => (
                `<option value="${className}">${className === 'all' ? 'Semua kelas' : className}</option>`
            )).join('');
            classSelect.value = classes.includes(selectedClass) ? selectedClass : 'all';
        }

        function renderQuestionBank() {
            const list = document.getElementById('adminQuestionsList');
            if (!list) return;
            document.getElementById('adminQuestionCount').innerText = `${questionBank.length} soal`;
            document.getElementById('adminQuestionsEmpty').classList.toggle('hidden', questionBank.length > 0);
            list.innerHTML = questionBank.map((question) => `
                <article class="px-5 py-4 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="font-semibold text-emerald-300">${escapeHtml(question.topic)}</span>
                            <span class="text-slate-500">${escapeHtml(question.level === 'SMA' ? 'SMA/SMK' : question.level)}</span>
                            <span class="text-slate-500">${escapeHtml(question.className === 'all' ? 'Semua kelas' : question.className)}</span>
                        </div>
                        <p class="mt-1 text-sm text-slate-200">${escapeHtml(question.question)}</p>
                    </div>
                    <div class="flex shrink-0 gap-2">
                        <button type="button" data-question-action="edit" data-question-id="${escapeHtml(question.id)}" class="px-3 py-2 text-xs text-cyan-300 hover:bg-cyan-500/10 rounded border border-cyan-500/20">Edit</button>
                        <button type="button" data-question-action="delete" data-question-id="${escapeHtml(question.id)}" class="px-3 py-2 text-xs text-rose-300 hover:bg-rose-500/10 rounded border border-rose-500/20">Hapus</button>
                    </div>
                </article>`).join('');
        }

        function openQuestionEditor(questionId = '') {
            const question = questionBank.find((item) => item.id === questionId);
            const form = document.getElementById('questionEditorForm');
            form.reset();
            document.getElementById('questionId').value = question?.id || '';
            document.getElementById('questionEditorTitle').innerText = question ? 'Edit soal' : 'Soal baru';
            document.getElementById('questionTopic').value = question?.topic || '';
            document.getElementById('questionLevel').value = question?.level || 'SMP';
            updateQuestionClassOptions(question?.className || 'all');
            document.getElementById('questionText').value = question?.question || '';
            for (let index = 0; index < 4; index++) {
                document.getElementById(`questionOption${index}`).value = question?.options?.[index] || '';
            }
            document.getElementById('questionCorrectAnswer').value = String(question?.correctAnswer ?? 0);
            document.getElementById('questionExplanation').value = question?.explanation || '';
            document.getElementById('questionEditor').classList.remove('hidden');
            document.getElementById('questionTopic').focus();
        }

        function closeQuestionEditor() {
            document.getElementById('questionEditor').classList.add('hidden');
        }

        function setAdminQuestionsMessage(message, isError = false) {
            const element = document.getElementById('adminQuestionsMessage');
            element.innerText = message;
            element.className = `px-5 pb-5 text-sm ${isError ? 'text-rose-400' : 'text-emerald-400'} ${message ? '' : 'hidden'}`;
        }

        async function commitQuestionBank(nextQuestions, successMessage) {
            const button = document.getElementById('saveQuestionButton');
            if (button) button.disabled = true;
            try {
                await saveQuestionBank(nextQuestions);
                questionBank = nextQuestions;
                renderQuestionBank();
                setAdminQuestionsMessage(successMessage);
                return true;
            } catch (error) {
                setAdminQuestionsMessage(`Penyimpanan soal gagal: ${error.message}`, true);
                return false;
            } finally {
                if (button) button.disabled = false;
            }
        }

        async function saveQuestionFromForm(event) {
            event.preventDefault();
            const questionId = document.getElementById('questionId').value;
            const previous = questionBank.find((item) => item.id === questionId);
            const nextQuestion = {
                ...previous,
                id: questionId || (window.crypto?.randomUUID?.() || `question-${Date.now()}`),
                topic: document.getElementById('questionTopic').value.trim(),
                level: document.getElementById('questionLevel').value,
                className: document.getElementById('questionClass').value,
                question: document.getElementById('questionText').value.trim(),
                options: [0, 1, 2, 3].map((index) => document.getElementById(`questionOption${index}`).value.trim()),
                correctAnswer: Number(document.getElementById('questionCorrectAnswer').value),
                explanation: document.getElementById('questionExplanation').value.trim(),
                sheetHeaders: previous?.sheetHeaders || ['Data', 'Hasil'],
                sheetRows: previous?.sheetRows || [['Contoh', '[ ? ]']],
            };
            if (nextQuestion.options.some((option) => !option)) {
                setAdminQuestionsMessage('Isi semua empat opsi jawaban.', true);
                return;
            }

            const nextQuestions = previous
                ? questionBank.map((item) => item.id === questionId ? nextQuestion : item)
                : [...questionBank, nextQuestion];
            if (await commitQuestionBank(nextQuestions, 'Soal berhasil disimpan.')) {
                closeQuestionEditor();
            }
        }

        async function deleteQuestion(questionId) {
            const question = questionBank.find((item) => item.id === questionId);
            if (!question || !window.confirm(`Hapus soal "${question.topic}"?`)) return;
            const nextQuestions = questionBank.filter((item) => item.id !== questionId);
            await commitQuestionBank(nextQuestions, 'Soal berhasil dihapus.');
        }

        function updateClassDropdown() {
            const levelSelect = document.getElementById('inputLevel');
            const classSelect = document.getElementById('inputClass');
            if (!levelSelect || !classSelect) return;

            const selectedLevel = levelSelect.value;
            classSelect.innerHTML = '';

            if (selectedLevel === 'SMP') {
                const smpClasses = ['Kelas 7', 'Kelas 8', 'Kelas 9'];
                smpClasses.forEach(cls => {
                    const opt = document.createElement('option');
                    opt.value = cls;
                    opt.innerText = `${cls} (SMP)`;
                    classSelect.appendChild(opt);
                });
            } else {
                const smaClasses = ['Kelas 10', 'Kelas 11', 'Kelas 12'];
                smaClasses.forEach(cls => {
                    const opt = document.createElement('option');
                    opt.value = cls;
                    opt.innerText = `${cls} (SMA/SMK)`;
                    classSelect.appendChild(opt);
                });
            }
        }

        function switchView(viewName) {
            const views = ['viewStart', 'viewQuiz', 'viewSummary', 'viewDashboard'];
            views.forEach(v => document.getElementById(v).classList.add('hidden'));

            document.getElementById('tabStart').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md text-slate-400 hover:text-slate-200 transition-colors flex items-center gap-2 border-transparent";
            document.getElementById('tabDashboard').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md text-slate-400 hover:text-slate-200 transition-colors flex items-center gap-2 border-transparent";

            if (viewName === 'start') {
                document.getElementById('viewStart').classList.remove('hidden');
                document.getElementById('tabStart').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md bg-emerald-500/20 text-emerald-400 transition-colors flex items-center gap-2";
            } else if (viewName === 'quiz') {
                document.getElementById('viewQuiz').classList.remove('hidden');
                document.getElementById('tabStart').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md bg-emerald-500/20 text-emerald-400 transition-colors flex items-center gap-2";
            } else if (viewName === 'summary') {
                document.getElementById('viewSummary').classList.remove('hidden');
                document.getElementById('tabStart').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md bg-emerald-500/20 text-emerald-400 transition-colors flex items-center gap-2";
            } else if (viewName === 'dashboard') {
                document.getElementById('viewDashboard').classList.remove('hidden');
                document.getElementById('tabDashboard').className = "px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-md bg-emerald-500/20 text-emerald-400 transition-colors flex items-center gap-2";
                updateAdminPanelState();
                if (adminAuthenticated) renderDashboard();
            }
            lucide.createIcons();
        }

        function buildDefaultQuestionBank() {
            return [
                ...questionsSMP.map((question, index) => ({ ...question, id: `smp-${index + 1}`, level: 'SMP', className: 'all' })),
                ...questionsSMA.map((question, index) => ({ ...question, id: `sma-${index + 1}`, level: 'SMA', className: 'all' })),
            ];
        }

        function prepareQuizQuestions(level, className) {
            const sourceDataset = questionBank.filter((question) => (
                question.level === level && (question.className === 'all' || question.className === className)
            ));
            activeQuestions = sourceDataset.map(q => {
                const mappedOptions = q.options.map((optText, idx) => ({ text: optText, isCorrect: idx === q.correctAnswer }));
                for (let i = mappedOptions.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [mappedOptions[i], mappedOptions[j]] = [mappedOptions[j], mappedOptions[i]];
                }
                return {
                    ...q,
                    options: mappedOptions.map(item => item.text),
                    correctAnswer: mappedOptions.findIndex(item => item.isCorrect)
                };
            });
            userAnswers = new Array(activeQuestions.length).fill(null);
            return activeQuestions.length > 0;
        }

        async function loadStudentSummary(name, className, level) {
            const summaryBox = document.getElementById('studentSummaryBox');
            const summaryContent = document.getElementById('studentSummaryContent');
            const classLabel = `${className} (${level})`;

            if (!name || !classLabel) {
                summaryBox.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(`./api.php?action=student-summary&name=${encodeURIComponent(name)}&class=${encodeURIComponent(classLabel)}`);
                const result = await response.json();

                if (!response.ok || !result.success || !result.data || !result.data.latest) {
                    summaryBox.classList.add('hidden');
                    return;
                }

                const latest = result.data.latest;
                const score = Number(latest.ringkasanNilai?.skorAkhir || 0);
                const date = latest.metadata?.tanggalPengerjaan || 'Belum ada';
                const attempts = result.data.count || 1;

                summaryContent.innerHTML = `
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="rounded-lg bg-slate-950/60 border border-emerald-500/20 p-3">
                            <div class="text-[10px] uppercase tracking-wider text-slate-400">Skor Terakhir</div>
                            <div class="mt-1 text-2xl font-bold font-mono text-emerald-400">${score}</div>
                        </div>
                        <div class="rounded-lg bg-slate-950/60 border border-emerald-500/20 p-3">
                            <div class="text-[10px] uppercase tracking-wider text-slate-400">Akurasi</div>
                            <div class="mt-1 text-xl font-bold font-mono text-cyan-400">${latest.ringkasanNilai?.persentaseAkurasi || `${score}%`}</div>
                        </div>
                        <div class="rounded-lg bg-slate-950/60 border border-emerald-500/20 p-3">
                            <div class="text-[10px] uppercase tracking-wider text-slate-400">Tryout</div>
                            <div class="mt-1 text-base font-semibold text-slate-200">${attempts} kali</div>
                            <div class="mt-1 text-[11px] text-slate-400">${date}</div>
                        </div>
                    </div>
                `;
                summaryBox.classList.remove('hidden');
                lucide.createIcons();
            } catch (error) {
                summaryBox.classList.add('hidden');
            }
        }

        function startQuiz(event) {
            event.preventDefault();
            const nameInput = studentProfile.name || document.getElementById('inputName').value.trim();
            const levelInput = studentProfile.name ? studentProfile.level : document.getElementById('inputLevel').value;
            const classInput = studentProfile.name ? studentProfile.classId : document.getElementById('inputClass').value;
            if (!nameInput || !classInput) return;

            studentProfile.name = nameInput;
            studentProfile.level = levelInput;
            studentProfile.classId = classInput;
            loadStudentSummary(studentProfile.name, studentProfile.classId, studentProfile.level);
            
            document.getElementById('activeStudentName').innerText = studentProfile.name;
            const levelBadge = document.getElementById('levelBadge');
            if (levelBadge) {
                levelBadge.innerText = levelInput === "SMP" ? "SMP (Dasar)" : "SMA/SMK (Lanjutan)";
            }

            if (!prepareQuizQuestions(studentProfile.level, studentProfile.classId)) {
                setStudentAuthMessage('Belum ada soal untuk tingkat dan kelas ini. Hubungi admin.');
                switchView('start');
                return;
            }
            switchView('quiz');

            timerSeconds = 0;
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                timerSeconds++;
                const mins = String(Math.floor(timerSeconds / 60)).padStart(2, '0');
                const secs = String(timerSeconds % 60).padStart(2, '0');
                document.getElementById('timerVal').innerText = `${mins}:${secs}`;
            }, 1000);

            currentQuestionIndex = 0;
            renderQuestion();
        }

        function renderQuestion() {
            const q = activeQuestions[currentQuestionIndex];
            
            document.getElementById('questionBadge').innerText = `Soal ${currentQuestionIndex + 1} dari ${activeQuestions.length}`;
            document.getElementById('progressBar').style.width = `${((currentQuestionIndex + 1) / activeQuestions.length) * 100}%`;
            document.getElementById('questionText').innerText = q.question;
            document.getElementById('sheetNameTitle').innerText = `Sheet: Case_${q.topic.replace(/\s+/g, '_')}.xlsx`;

            renderExcelSheet(q.sheetHeaders, q.sheetRows);

            const optionsContainer = document.getElementById('optionsContainer');
            optionsContainer.innerHTML = "";
            const selectedAns = userAnswers[currentQuestionIndex];

            q.options.forEach((optText, optIdx) => {
                const btn = document.createElement('button');
                btn.type = "button";
                btn.onclick = () => selectAnswer(optIdx);

                let isSelected = selectedAns === optIdx;
                let btnClasses = "w-full text-left p-4 rounded-xl font-mono text-sm border transition flex items-center justify-between group ";

                if (isSelected) {
                    btnClasses += "bg-emerald-950/60 border-emerald-500 text-emerald-300 ring-1 ring-emerald-500/50 shadow-md";
                } else {
                    btnClasses += "bg-slate-900/60 hover:bg-slate-800/80 border-slate-800 text-slate-200 hover:border-slate-700";
                }

                btn.className = btnClasses;
                btn.innerHTML = `
                    <div class="flex items-center gap-3 pr-2">
                        <span class="w-7 h-7 rounded-lg font-sans font-bold text-xs flex items-center justify-center border ${isSelected ? 'bg-emerald-500 text-slate-950 border-emerald-400' : 'bg-slate-800 text-slate-400 border-slate-700'}">
                            ${String.fromCharCode(65 + optIdx)}
                        </span>
                        <span class="break-all">${escapeHtml(optText)}</span>
                    </div>
                    ${isSelected ? '<i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 shrink-0"></i>' : ''}
                `;
                optionsContainer.appendChild(btn);
            });

            // Navigation State
            document.getElementById('btnPrev').disabled = currentQuestionIndex === 0;
            if (currentQuestionIndex === activeQuestions.length - 1) {
                document.getElementById('btnNext').classList.add('hidden');
                document.getElementById('btnFinish').classList.remove('hidden');
                document.getElementById('btnFinish').classList.add('flex');
            } else {
                document.getElementById('btnNext').classList.remove('hidden');
                document.getElementById('btnFinish').classList.add('hidden');
                document.getElementById('btnFinish').classList.remove('flex');
            }
            lucide.createIcons();
        }

        function renderExcelSheet(headers, rows) {
            const table = document.getElementById('excelTable');
            table.innerHTML = "";

            const thead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            headerRow.className = "bg-slate-800/80 text-slate-400";

            const thCorner = document.createElement('th');
            thCorner.className = "border border-slate-700/60 p-2 text-center w-10 bg-slate-800/90";
            thCorner.innerText = "#";
            headerRow.appendChild(thCorner);

            headers.forEach(h => {
                const th = document.createElement('th');
                th.className = "border border-slate-700/60 px-3 py-2 text-center font-semibold text-slate-300 min-w-[100px]";
                th.innerText = h;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            const tbody = document.createElement('tbody');
            rows.forEach((row) => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-800/30 transition";

                const tdNum = document.createElement('td');
                tdNum.className = "border border-slate-800 p-2 text-center bg-slate-900/90 text-slate-500 font-semibold";
                tdNum.innerText = row[0]; 
                tr.appendChild(tdNum);

                for (let c = 1; c < row.length; c++) {
                    const td = document.createElement('td');
                    const cellVal = String(row[c]);
                    let isTargetCell = cellVal.includes('[ ? ]');

                    td.className = `border border-slate-800 px-3 py-2 whitespace-nowrap ${isTargetCell ? 'bg-emerald-950/50 text-emerald-300 font-bold border-emerald-500/40 animate-pulse' : 'text-slate-300'}`;
                    td.innerText = cellVal;
                    tr.appendChild(td);
                }
                tbody.appendChild(tr);
            });
            table.appendChild(tbody);
        }

        function selectAnswer(optionIndex) {
            userAnswers[currentQuestionIndex] = optionIndex;
            renderQuestion();
        }

        function navigateQuestion(direction) {
            const newIdx = currentQuestionIndex + direction;
            if (newIdx >= 0 && newIdx < activeQuestions.length) {
                currentQuestionIndex = newIdx;
                renderQuestion();
            }
        }

        function confirmFinishQuiz() {
            const unanswered = userAnswers.filter(a => a === null).length;
            if (unanswered > 0) {
                const proceed = confirm(`Terdapat ${unanswered} soal yang belum dijawab. Yakin ingin menyelesaikan kuis?`);
                if (!proceed) return;
            }
            finishQuiz();
        }

        async function finishQuiz() {
            clearInterval(timerInterval);

            let correctCount = 0;
            const detailedResults = activeQuestions.map((q, idx) => {
                const userAns = userAnswers[idx];
                const isCorrect = userAns === q.correctAnswer;
                if (isCorrect) correctCount++;
                return {
                    no: idx + 1,
                    topik: q.topic,
                    pertanyaan: q.question,
                    jawabanSiswa: userAns !== null ? q.options[userAns] : "[Tidak Dijawab]",
                    kunciJawaban: q.options[q.correctAnswer],
                    status: isCorrect ? "BENAR" : userAns === null ? "DILEWATI" : "SALAH",
                    penjelasan: q.explanation
                };
            });

            const totalQ = activeQuestions.length;
            const finalScore = Math.round((correctCount / totalQ) * 100);
            const incorrectCount = totalQ - correctCount;
            const mins = String(Math.floor(timerSeconds / 60)).padStart(2, '0');
            const secs = String(timerSeconds % 60).padStart(2, '0');

            // Generate Payload for Dashboard & JSON Download
            currentQuizPayload = {
                metadata: {
                    aplikasi: "Excel Master Quiz System",
                    tingkatSekolah: studentProfile.level === "SMP" ? "SMP (Dasar)" : "SMA/SMK (Lanjutan)",
                    tanggalPengerjaan: studentProfile.date,
                    waktuPengerjaanFormatted: `${mins}:${secs}`
                },
                identitasSiswa: {
                    namaLengkap: studentProfile.name,
                    kelasAtauNIM: `${studentProfile.classId} (${studentProfile.level})`
                },
                ringkasanNilai: {
                    skorAkhir: finalScore,
                    persentaseAkurasi: `${finalScore}%`
                },
                rincianJawaban: detailedResults
            };

            try {
                await saveQuizResult(currentQuizPayload);
                dashboardHistory.unshift(currentQuizPayload);
            } catch (error) {
                alert(`Hasil kuis tidak berhasil disimpan: ${error.message}`);
            }

            // Populate Summary UI
            document.getElementById('sumStudentName').innerText = studentProfile.name;
            document.getElementById('sumStudentClass').innerText = studentProfile.classId;
            document.getElementById('sumTimeTaken').innerText = `${mins}:${secs}`;
            document.getElementById('scoreFinal').innerText = finalScore;
            document.getElementById('scoreCorrect').innerText = correctCount;
            document.getElementById('scoreIncorrect').innerText = incorrectCount;
            document.getElementById('scoreAccuracy').innerText = `${finalScore}%`;

            renderReviewList(detailedResults);
            switchView('summary');
        }

        function renderReviewList(results) {
            const container = document.getElementById('reviewQuestionsList');
            container.innerHTML = "";

            results.forEach((res, idx) => {
                const q = activeQuestions[idx];
                const item = document.createElement('div');
                const isCorrect = res.status === "BENAR";
                const isSkipped = res.status === "DILEWATI";

                item.className = `p-4 rounded-xl border text-xs sm:text-sm space-y-2.5 ${isCorrect ? 'bg-emerald-950/20 border-emerald-500/30' : isSkipped ? 'bg-amber-950/20 border-amber-500/30' : 'bg-rose-950/20 border-rose-500/30'}`;

                let badgeHtml = isCorrect 
                    ? `<span class="px-2 py-0.5 rounded text-emerald-400 bg-emerald-500/20 border border-emerald-500/30 font-semibold text-xs flex items-center gap-1"><i data-lucide="check" class="w-3.5 h-3.5"></i> Benar</span>`
                    : isSkipped 
                    ? `<span class="px-2 py-0.5 rounded text-amber-400 bg-amber-500/20 border border-amber-500/30 font-semibold text-xs flex items-center gap-1"><i data-lucide="minus" class="w-3.5 h-3.5"></i> Dilewati</span>`
                    : `<span class="px-2 py-0.5 rounded text-rose-400 bg-rose-500/20 border border-rose-500/30 font-semibold text-xs flex items-center gap-1"><i data-lucide="x" class="w-3.5 h-3.5"></i> Salah</span>`;

                item.innerHTML = `
                    <div class="flex items-start justify-between gap-3">
                        <div class="font-bold text-white flex items-center gap-2">
                            <span>#${idx + 1}</span>
                            <span class="text-xs font-mono bg-slate-800 text-slate-300 px-2 py-0.5 rounded border border-slate-700">${res.topik}</span>
                        </div>
                        ${badgeHtml}
                    </div>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">${escapeHtml(res.pertanyaan)}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 font-mono text-xs">
                        <div class="p-2 rounded bg-slate-900/80 border border-slate-800">
                            <span class="text-slate-500 block text-[10px] uppercase">Jawaban Siswa:</span>
                            <span class="${isCorrect ? 'text-emerald-400' : 'text-rose-400'} font-semibold break-all">
                                ${escapeHtml(res.jawabanSiswa)}
                            </span>
                        </div>
                        <div class="p-2 rounded bg-slate-900/80 border border-slate-800">
                            <span class="text-slate-500 block text-[10px] uppercase">Kunci Jawaban Tepat:</span>
                            <span class="text-emerald-400 font-semibold break-all">${escapeHtml(res.kunciJawaban)}</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400 pt-1 border-t border-slate-800/60 font-sans leading-normal">
                        <strong class="text-slate-300">Penjelasan:</strong> ${res.penjelasan}
                    </p>
                `;
                container.appendChild(item);
            });
        }

        function downloadJSONReport() {
            if (!currentQuizPayload) return;

            const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(currentQuizPayload, null, 2));
            const downloadAnchor = document.createElement('a');
            
            // Format Filename: nama_kelas.json
            const safeName = (currentQuizPayload.identitasSiswa.namaLengkap || "Siswa").replace(/\s+/g, '_').replace(/[^a-zA-Z0-9_]/g, '');
            const safeClass = (currentQuizPayload.identitasSiswa.kelasAtauNIM || "Umum").replace(/\s+/g, '_').replace(/[^a-zA-Z0-9_]/g, '');
            
            downloadAnchor.setAttribute("href", dataStr);
            downloadAnchor.setAttribute("download", `${safeName}_${safeClass}.json`);
            document.body.appendChild(downloadAnchor);
            downloadAnchor.click();
            downloadAnchor.remove();
        }

        function getDashboardLevel(result) {
            const identity = result.identitasSiswa || {};
            const metadata = result.metadata || {};
            const level = `${metadata.tingkatSekolah || ''} ${identity.kelasAtauNIM || ''}`.toUpperCase();

            if (level.includes('SMP')) return 'SMP';
            if (level.includes('SMA') || level.includes('SMK')) return 'SMA/SMK';
            return 'Tidak diketahui';
        }

        function getDashboardClass(result) {
            const className = String(result.identitasSiswa?.kelasAtauNIM || '');
            const match = className.match(/\bkelas\s*(7|8|9|10|11|12)\b/i);
            return match ? `Kelas ${match[1]}` : '';
        }

        function getFilteredDashboardResults() {
            const searchTerm = document.getElementById('dashboardSearch').value.trim().toLocaleLowerCase('id');
            const selectedLevel = document.getElementById('dashboardLevelFilter').value;
            const selectedClass = document.getElementById('dashboardClassFilter').value;
            const sortOrder = document.getElementById('dashboardSort').value;

            const results = dashboardHistory.map((data, index) => ({ data, index }))
                .filter(({ data }) => {
                    const identity = data.identitasSiswa || {};
                    const searchable = `${identity.namaLengkap || ''} ${identity.kelasAtauNIM || ''}`.toLocaleLowerCase('id');
                    return (!searchTerm || searchable.includes(searchTerm))
                        && (selectedLevel === 'all' || getDashboardLevel(data) === selectedLevel)
                        && (selectedClass === 'all' || getDashboardClass(data) === selectedClass);
                });

            results.sort((left, right) => {
                const scoreDifference = Number(right.data.ringkasanNilai?.skorAkhir || 0)
                    - Number(left.data.ringkasanNilai?.skorAkhir || 0);
                if (sortOrder === 'highest') return scoreDifference || left.index - right.index;
                if (sortOrder === 'lowest') return -scoreDifference || left.index - right.index;
                return left.index - right.index;
            });

            return results;
        }

        function renderScoreDistribution() {
            const groups = [
                { label: '90–100', minimum: 90, maximum: 100, color: 'bg-emerald-400' },
                { label: '75–89', minimum: 75, maximum: 89, color: 'bg-cyan-400' },
                { label: '60–74', minimum: 60, maximum: 74, color: 'bg-amber-400' },
                { label: '0–59', minimum: 0, maximum: 59, color: 'bg-rose-400' },
            ];
            const scores = dashboardHistory.map((result) => Number(result.ringkasanNilai?.skorAkhir || 0));
            const container = document.getElementById('scoreDistribution');

            if (scores.length === 0) {
                container.innerHTML = '<p class="text-sm text-slate-500 py-4">Belum ada data untuk ditampilkan.</p>';
                return;
            }

            container.innerHTML = groups.map((group) => {
                const count = scores.filter((score) => score >= group.minimum && score <= group.maximum).length;
                const width = (count / scores.length) * 100;
                return `
                    <div>
                        <div class="flex justify-between text-xs mb-2"><span class="text-slate-300">${group.label} poin</span><span class="font-mono text-slate-400">${count} <span class="text-slate-600">/ ${scores.length}</span></span></div>
                        <div class="h-2 bg-slate-800 rounded-full overflow-hidden"><div class="${group.color} h-full rounded-full transition-all duration-500" style="width:${width}%"></div></div>
                    </div>
                `;
            }).join('');
        }

        function renderLevelDistribution() {
            const groups = [
                { label: 'SMP', color: 'bg-emerald-400' },
                { label: 'SMA/SMK', color: 'bg-cyan-400' },
            ];
            const counts = groups.map((group) => dashboardHistory.filter(
                (result) => getDashboardLevel(result) === group.label
            ).length);
            const totalKnownLevels = counts.reduce((sum, count) => sum + count, 0);

            document.getElementById('levelDistribution').innerHTML = groups.map((group, index) => {
                const count = counts[index];
                const width = totalKnownLevels === 0 ? 0 : (count / totalKnownLevels) * 100;
                return `
                    <div>
                        <div class="flex items-center justify-between mb-2"><span class="flex items-center gap-2 text-sm text-slate-300"><span class="w-2.5 h-2.5 rounded-full ${group.color}"></span>${group.label}</span><span class="font-mono text-sm text-white">${count}</span></div>
                        <div class="h-2 bg-slate-800 rounded-full overflow-hidden"><div class="${group.color} h-full rounded-full transition-all duration-500" style="width:${width}%"></div></div>
                    </div>
                `;
            }).join('');
        }

        function renderResultDetails(result) {
            const answers = Array.isArray(result.rincianJawaban) ? result.rincianJawaban : [];
            if (answers.length === 0) {
                return '<p class="p-4 text-sm text-slate-500">Rincian jawaban tidak tersedia.</p>';
            }

            const rows = answers.map((answer, index) => {
                const isCorrect = answer.status === 'BENAR';
                const isSkipped = answer.status === 'DILEWATI';
                const statusClass = isCorrect ? 'text-emerald-400' : isSkipped ? 'text-amber-400' : 'text-rose-400';
                const statusLabel = isCorrect ? 'Benar' : isSkipped ? 'Dilewati' : 'Salah';
                return `
                    <tr class="border-t border-slate-800/80 align-top">
                        <td class="px-3 py-3 text-slate-500">${escapeHtml(answer.no ?? index + 1)}</td>
                        <td class="px-3 py-3"><span class="text-slate-200">${escapeHtml(answer.topik || '-')}</span><p class="mt-1 max-w-lg whitespace-normal text-xs leading-relaxed text-slate-500">${escapeHtml(answer.pertanyaan || '')}</p></td>
                        <td class="px-3 py-3 max-w-xs whitespace-normal font-mono text-xs text-slate-400">${escapeHtml(answer.jawabanSiswa || '-')}</td>
                        <td class="px-3 py-3 max-w-xs whitespace-normal font-mono text-xs text-slate-300">${escapeHtml(answer.kunciJawaban || '-')}</td>
                        <td class="px-3 py-3 text-right font-medium ${statusClass}">${statusLabel}</td>
                    </tr>
                `;
            }).join('');

            return `
                <div class="overflow-x-auto bg-slate-950/70">
                    <table class="w-full min-w-[760px] text-left text-xs">
                        <thead class="text-[10px] uppercase tracking-wider text-slate-500"><tr><th class="px-3 py-2">No</th><th class="px-3 py-2">Soal</th><th class="px-3 py-2">Jawaban siswa</th><th class="px-3 py-2">Kunci</th><th class="px-3 py-2 text-right">Status</th></tr></thead>
                        <tbody>${rows}</tbody>
                    </table>
                </div>
            `;
        }

        function renderDashboard() {
            const resultCount = dashboardHistory.length;
            const scores = dashboardHistory.map((result) => Number(result.ringkasanNilai?.skorAkhir || 0));
            const average = scores.length ? scores.reduce((sum, score) => sum + score, 0) / scores.length : 0;
            const passingCount = scores.filter((score) => score >= 75).length;
            const uniqueStudents = new Set(dashboardHistory.map((result) => (
                result.identitasSiswa?.namaLengkap || ''
            ).trim().toLocaleLowerCase('id')).filter(Boolean));
            const filteredResults = getFilteredDashboardResults();

            document.getElementById('adminTotalAttempts').innerText = resultCount;
            document.getElementById('adminAverageScore').innerText = average.toFixed(1).replace(/\.0$/, '');
            document.getElementById('adminPassRate').innerText = `${resultCount ? Math.round((passingCount / resultCount) * 100) : 0}%`;
            document.getElementById('adminPassCount').innerText = `${passingCount} dari ${resultCount} percobaan`;
            document.getElementById('adminUniqueStudents').innerText = uniqueStudents.size;
            document.getElementById('dashboardResultCount').innerText = `Menampilkan ${filteredResults.length} dari ${resultCount} hasil`;

            renderScoreDistribution();
            renderLevelDistribution();

            const tbody = document.getElementById('dashboardTableBody');
            const emptyMessage = document.getElementById('emptyDashboardMsg');
            const emptyText = document.getElementById('emptyDashboardText');
            emptyMessage.classList.toggle('hidden', filteredResults.length > 0);
            emptyText.innerText = resultCount === 0
                ? 'Belum ada hasil kuis tersimpan.'
                : 'Tidak ada hasil yang cocok dengan pencarian atau filter.';

            tbody.innerHTML = filteredResults.map(({ data, index }) => {
                const identity = data.identitasSiswa || {};
                const summary = data.ringkasanNilai || {};
                const metadata = data.metadata || {};
                const score = Number(summary.skorAkhir || 0);
                const isExpanded = expandedResultIndex === index;
                const level = getDashboardLevel(data);
                const levelClass = level === 'SMP' ? 'text-emerald-300 bg-emerald-500/10' : 'text-cyan-300 bg-cyan-500/10';
                const scoreClass = score >= 75 ? 'text-emerald-400' : 'text-rose-400';
                const details = isExpanded
                    ? `<tr><td colspan="7" class="p-0 border-t border-slate-800">${renderResultDetails(data)}</td></tr>`
                    : '';

                return `
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-5 py-4"><span class="font-semibold text-white">${escapeHtml(identity.namaLengkap || '-')}</span></td>
                        <td class="px-5 py-4 text-slate-400">${escapeHtml(identity.kelasAtauNIM || '-')}</td>
                        <td class="px-5 py-4"><span class="px-2 py-1 rounded text-xs ${levelClass}">${escapeHtml(level)}</span></td>
                        <td class="px-5 py-4 text-center font-mono font-bold ${scoreClass}">${escapeHtml(score)}</td>
                        <td class="px-5 py-4 text-center font-mono text-slate-400">${escapeHtml(summary.persentaseAkurasi || `${score}%`)}</td>
                        <td class="px-5 py-4 text-xs text-slate-400">${escapeHtml(metadata.tanggalPengerjaan || '-')}</td>
                        <td class="px-5 py-4 text-right"><button type="button" data-result-index="${index}" aria-expanded="${isExpanded}" class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-400 hover:text-emerald-300"><i data-lucide="${isExpanded ? 'chevron-up' : 'list'}" class="w-4 h-4"></i>${isExpanded ? 'Tutup' : 'Lihat'}</button></td>
                    </tr>
                    ${details}
                `;
            }).join('');

            lucide.createIcons();
        }

        async function refreshDashboard() {
            try {
                dashboardHistory = await loadQuizResults();
                expandedResultIndex = null;
                renderDashboard();
            } catch (error) {
                if (error.status === 401) {
                    adminAuthenticated = false;
                    dashboardHistory = [];
                    updateAdminPanelState();
                }
                alert(`Data dashboard gagal dimuat: ${error.message}`);
            }
        }

        function csvCell(value) {
            let text = String(value ?? '');
            if (/^\s*[=+\-@]/.test(text)) text = `'${text}`;
            return `"${text.replace(/"/g, '""')}"`;
        }

        function exportDashboardCSV() {
            const results = getFilteredDashboardResults();
            if (results.length === 0) {
                alert('Tidak ada hasil untuk diekspor.');
                return;
            }

            const rows = [
                ['Nama Siswa', 'Kelas', 'Tingkat', 'Skor', 'Akurasi', 'Tanggal', 'Waktu'],
                ...results.map(({ data }) => [
                    data.identitasSiswa?.namaLengkap || '',
                    data.identitasSiswa?.kelasAtauNIM || '',
                    getDashboardLevel(data),
                    data.ringkasanNilai?.skorAkhir ?? 0,
                    data.ringkasanNilai?.persentaseAkurasi || '',
                    data.metadata?.tanggalPengerjaan || '',
                    data.metadata?.waktuPengerjaanFormatted || '',
                ]),
            ];
            const csv = `\uFEFF${rows.map((row) => row.map(csvCell).join(',')).join('\r\n')}`;
            const downloadUrl = URL.createObjectURL(new Blob([csv], { type: 'text/csv;charset=utf-8' }));
            const downloadLink = document.createElement('a');
            downloadLink.href = downloadUrl;
            downloadLink.download = `hasil-kuis-${new Date().toISOString().slice(0, 10)}.csv`;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            downloadLink.remove();
            URL.revokeObjectURL(downloadUrl);
        }

        async function importJSON(event) {
            const file = event.target.files[0];
            if (!file) return;

            try {
                const data = JSON.parse(await file.text());
                if (!data?.identitasSiswa || !data?.ringkasanNilai || !data?.metadata) {
                    throw new Error('Format JSON tidak valid atau bukan hasil kuis ini.');
                }
                await importQuizResult(data);
                dashboardHistory.unshift(data);
                renderDashboard();
                alert('File JSON berhasil disimpan ke Dashboard Nilai.');
            } catch (error) {
                if (error.status === 401) {
                    adminAuthenticated = false;
                    dashboardHistory = [];
                    updateAdminPanelState();
                }
                alert(`Gagal mengimpor hasil kuis: ${error.message}`);
            } finally {
                event.target.value = '';
            }
        }

        function escapeHtml(str) {
            return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        Object.assign(window, {
            confirmFinishQuiz,
            downloadJSONReport,
            exportDashboardCSV,
            importJSON,
            logoutAdmin,
            navigateQuestion,
            closeQuestionEditor,
            deleteQuestion,
            openQuestionEditor,
            refreshDashboard,
            refreshAdminUsers,
            saveQuestionFromForm,
            startQuiz,
            switchAdminSection,
            switchView,
            updateClassDropdown,
        });
    </script>
</body>
</html>