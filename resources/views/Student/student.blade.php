<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sunrise Public School</title>

    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root {
    --navy: #0b2a4a;
    --navy-dark: #071b33;
    --blue: #0b5ed7;
    --bg: #f3f6fc;
    --text: #1e293b;
    --muted: #64748b;
    --line: #e8edf5;
    --sidebar-w: 264px;
    --header-h: 82px;
}

* { box-sizing: border-box; }

body {
    margin: 0;
    background: var(--bg);
    color: var(--text);
    font-family: Inter, Arial, sans-serif;
}

a { text-decoration: none; }

.topbar {
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    right: 0;
    height: var(--header-h);
    padding: 0 26px;
    background: #fff;
    border-bottom: 1px solid var(--line);
    box-shadow: 0 3px 16px rgba(15,23,42,.05);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.topbar::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg,#0b5ed7,#4facfe,#f9b233);
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.logo {
    width: 52px;
    height: 52px;
    object-fit: contain;
}

.school-name {
    font-size: 21px;
    font-weight: 800;
    color: var(--navy);
}

.school-tag {
    font-size: 11px;
    color: var(--muted);
    letter-spacing: .6px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.date-chip {
    background: var(--bg);
    border-radius: 10px;
    padding: 10px 13px;
    font-size: 12px;
    color: var(--muted);
}

.icon-btn, .menu-toggle {
    height: 42px;
    width: 42px;
    border: 0;
    border-radius: 12px;
    background: #edf3ff;
    color: var(--blue);
    font-size: 20px;
}

.menu-toggle { display: none; }

.user-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    border: 0;
    padding: 5px;
    border-radius: 12px;
}

.avatar {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: white;
    font-size: 17px;
    font-weight: 800;
    background: linear-gradient(135deg,#0b5ed7,#4facfe);
}

.welcome-small { font-size: 11px; color: var(--muted); }
.user-name { font-size: 13px; font-weight: 700; color: var(--navy); }

.dropdown-menu {
    border: 1px solid var(--line);
    border-radius: 13px;
    padding: 8px;
    box-shadow: 0 12px 30px rgba(15,23,42,.12);
}

.dropdown-item {
    padding: 9px 12px;
    border-radius: 8px;
    font-size: 13px;
}

/* Sidebar */

.sidebar {
    position: fixed;
    top: var(--header-h);
    bottom: 0;
    left: 0;
    width: var(--sidebar-w);
    padding: 14px;
    overflow-y: auto;
    background: linear-gradient(180deg,var(--navy-dark),var(--navy) 55%,#0a4aa8);
    color: white;
    z-index: 900;
    display: flex;
    flex-direction: column;
    transition: transform .3s ease;
}

.menu-label {
    padding: 17px 12px 7px;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1.3px;
    font-weight: 700;
    color: rgba(255,255,255,.48);
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 13px;
    margin-bottom: 3px;
    color: #d6e4f5;
    font-size: 13px;
    font-weight: 500;
    border-radius: 10px;
    transition: .2s;
}

.sidebar a:hover, .sidebar a.active {
    color: #fff;
    background: rgba(255,255,255,.15);
}

.sidebar a.active {
    box-shadow: inset 3px 0 #7cc0ff;
}

.menu-icon {
    width: 21px;
    text-align: center;
    font-size: 17px;
}

.chev { margin-left: auto; font-size: 11px; }

.submenu {
    margin: 0 0 5px 18px;
    padding-left: 8px;
    border-left: 1px dashed rgba(255,255,255,.25);
}

.sidebar .submenu a {
    font-size: 12px;
    padding: 9px 11px;
}

.sidebar-footer {
    margin-top: auto;
    padding: 18px 5px 5px;
    border-top: 1px solid rgba(255,255,255,.12);
    text-align: center;
    font-size: 11px;
    color: rgba(255,255,255,.5);
}

/* Main content */

.content {
    margin-left: var(--sidebar-w);
    padding-top: var(--header-h);
    min-height: 100vh;
}

.page {
    padding: 27px;
    max-width: 1800px;
    margin: auto;
}

.page-title {
    font-size: 25px;
    font-weight: 800;
    letter-spacing: -.7px;
}

.page-subtitle {
    font-size: 13px;
    color: var(--muted);
    margin-top: 5px;
}

.quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.qa {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 12px;
    border: 1px solid var(--line);
    border-radius: 10px;
    background: #fff;
    color: var(--navy);
    font-size: 12px;
    font-weight: 700;
    transition: .2s;
}

.qa i { color: var(--blue); }

.qa:hover {
    background: var(--blue);
    color: white;
    transform: translateY(-2px);
}

.qa:hover i { color: white; }

/* Statistics */

.stat-card {
    position: relative;
    overflow: hidden;
    min-height: 157px;
    height: 100%;
    padding: 21px;
    border-radius: 17px;
    color: white;
    box-shadow: 0 8px 22px rgba(15,23,42,.08);
    transition: .25s;
}

.stat-card:hover { transform: translateY(-4px); }

.stat-card::after {
    content: "";
    position: absolute;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    right: -30px;
    top: -32px;
    background: rgba(255,255,255,.15);
}

.stat-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .8px;
    text-transform: uppercase;
    opacity: .93;
}

.stat-number {
    margin-top: 12px;
    font-size: clamp(25px,2.4vw,34px);
    font-weight: 800;
    overflow-wrap: anywhere;
}

.stat-note {
    font-size: 11px;
    margin-top: 5px;
    opacity: .9;
}

.stat-icon {
    position: absolute;
    right: 18px;
    bottom: 14px;
    font-size: 38px;
    opacity: .28;
}

.bg1 { background: linear-gradient(135deg,#3979e8,#56b4fc); }
.bg2 { background: linear-gradient(135deg,#0fae80,#35d4ad); }
.bg3 { background: linear-gradient(135deg,#ee8b42,#f6bb4e); }
.bg4 { background: linear-gradient(135deg,#8757db,#c084fc); }

/* Panels */

.panel {
    height: 100%;
    min-width: 0;
    background: #fff;
    border: 1px solid #edf0f6;
    border-radius: 17px;
    box-shadow: 0 6px 22px rgba(15,23,42,.045);
}

.panel-header {
    padding: 19px 20px 13px;
    border-bottom: 1px solid #f0f2f7;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
}

.panel-title {
    font-size: 14px;
    font-weight: 800;
    margin: 0;
}

.panel-subtitle {
    color: var(--muted);
    font-size: 11px;
    margin-top: 5px;
}

.panel-body { padding: 19px 20px; }

.chart-area {
    position: relative;
    height: 270px;
    width: 100%;
}

.chart-area.small { height: 235px; }

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 0;
    border-bottom: 1px solid #f0f2f7;
}

.activity-item:last-child { border-bottom: 0; }

.activity-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #edf3ff;
    color: var(--blue);
}

.activity-title { font-size: 12px; font-weight: 700; }
.activity-description { font-size: 11px; color: var(--muted); margin-top: 4px; }

.table-clean { width: 100%; border-collapse: collapse; font-size: 12px; }
.table-clean th {
    text-align: left;
    padding: 11px 9px;
    background: #f6f8fc;
    color: #64748b;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .4px;
}
.table-clean td { padding: 12px 9px; border-bottom: 1px solid #f0f2f7; }
.table-clean tbody tr:last-child td { border-bottom: 0; }

.student-name-cell { font-weight: 700; }
.mini-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e4edff;
    color: #155eef;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    margin-right: 8px;
}

.grade-pill {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 20px;
    background: #dcfce7;
    color: #15803d;
    font-weight: 800;
    font-size: 10px;
}

.empty-message {
    text-align: center;
    color: var(--muted);
    font-size: 12px;
    padding: 28px 12px !important;
}

.footer-note {
    color: var(--muted);
    font-size: 11px;
    text-align: center;
    padding: 22px 0 4px;
}

/* Responsive */

@media(max-width: 1100px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .content { margin-left: 0; }
    .menu-toggle { display: inline-flex; align-items: center; justify-content: center; }
    .brand { gap: 9px; }
    .school-name { font-size: 18px; }
}

@media(max-width: 650px) {
    :root { --header-h: 70px; }
    .topbar { padding: 0 12px; }
    .logo { width: 39px; height: 39px; }
    .school-name { font-size: 14px; }
    .school-tag, .date-chip, .welcome-small, .user-name { display: none; }
    .header-right { gap: 6px; }
    .page { padding: 17px 12px; }
    .page-title { font-size: 21px; }
    .page-header-actions { align-items: flex-start !important; }
    .quick-actions { margin-top: 5px; }
    .qa { padding: 8px 10px; }
    .panel-header, .panel-body { padding-left: 14px; padding-right: 14px; }
    .chart-area { height: 230px; }
}

@media print {
    .topbar, .sidebar, .quick-actions { display: none !important; }
    .content { margin: 0; padding: 0; }
    .page { padding: 0; }
    .panel, .stat-card { break-inside: avoid; }
}
</style>
</head>

<body>

@php
    $userName = Auth::user()->name ?? 'Administrator';

    $totalStudent = $totalStudent ?? 0;
    $activeStudent = $activeStudent ?? 0;
    $newAdmission = $newAdmission ?? 0;
    $totalFees = $totalFees ?? 0;
    $totalTeacher = $totalTeacher ?? 0;

    $monthlyAdmissions = $monthlyAdmissions ?? [];
    $monthlyIncome = $monthlyIncome ?? [];
    $monthlyLabels = $monthlyLabels ?? [];

    $topStudents = $topStudents ?? [];
    $gradeDistribution = $gradeDistribution ?? [];
    $subjectPerformance = $subjectPerformance ?? [];
    $recentActivities = $recentActivities ?? [];
@endphp

{{-- HEADER --}}
<header class="topbar">
    <div class="brand">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <img src="{{ asset('images/School logo.png') }}" class="logo" alt="School Logo">

        <div>
            <div class="school-name">Sunrise Public School</div>
            <div class="school-tag">LEARN • GROW • SUCCEED</div>
        </div>
    </div>

    <div class="header-right">
        <div class="date-chip">
            <i class="bi bi-calendar3 me-1"></i>
            <span id="todayDate"></span>
        </div>

        <button class="icon-btn" type="button" title="Notifications">
            <i class="bi bi-bell"></i>
        </button>

        <div class="dropdown">
            <button class="user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="avatar">
                    {{ strtoupper(substr($userName, 0, 1)) }}
                </span>
                <span>
                    <span class="welcome-small d-block">Welcome back</span>
                    <span class="user-name">{{ $userName }}</span>
                </span>
                <i class="bi bi-chevron-down small text-muted"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li class="px-3 py-2 small text-muted">
                    Signed in as<br>
                    <strong class="text-dark">{{ $userName }}</strong>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">

    <div class="menu-label">Main Menu</div>

    <a href="{{ route('Student.student') }}" class="active">
        <i class="bi bi-grid-1x2-fill menu-icon"></i>
        Dashboard
    </a>

    <div class="menu-label">Management</div>

    <a href="#" data-bs-toggle="collapse" data-bs-target="#studentMenu" aria-expanded="false">
        <i class="bi bi-people menu-icon"></i>
        Students
        <i class="bi bi-chevron-right chev"></i>
    </a>

    <div class="collapse submenu" id="studentMenu" data-bs-parent="#sidebar">
        <a href="{{ route('student.viewstudent') }}">
            <i class="bi bi-list-ul"></i> View Students
        </a>
        <a href="{{ route('Student.create') }}">
            <i class="bi bi-person-plus"></i> Add Student
        </a>
    </div>

    <a href="#" data-bs-toggle="collapse" data-bs-target="#teacherMenu" aria-expanded="false">
        <i class="bi bi-person-workspace menu-icon"></i>
        Teachers
        <i class="bi bi-chevron-right chev"></i>
    </a>

    <div class="collapse submenu" id="teacherMenu" data-bs-parent="#sidebar">
        <a href="{{ route('Student.viewteacher') }}">
            <i class="bi bi-list-ul"></i> View Teachers
        </a>
        <a href="{{ route('Student.teacher') }}">
            <i class="bi bi-person-plus"></i> Add Teacher
        </a>
    </div>

    <a href="{{ route('admin.accounts') }}">
        <i class="bi bi-key menu-icon"></i>
        Teacher & Student Logins
    </a>

    <a href="/events">
        <i class="bi bi-calendar-event menu-icon"></i>
        Events Calendar
    </a>

    <a href="{{ route('admin.marks') }}">
        <i class="bi bi-file-earmark-bar-graph menu-icon"></i>
        All Results
    </a>

    <div class="menu-label">Finance</div>

    <a href="{{ route('Student.fees') }}">
        <i class="bi bi-cash-stack menu-icon"></i>
        Fees Management
    </a>

    <div class="sidebar-footer">
        © <span id="year"></span> Sunrise Public School
    </div>
</aside>

{{-- MAIN CONTENT: NO STUDENT TABLE HERE --}}
<main class="content">
<div class="page">

    {{-- PAGE TITLE --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4 page-header-actions">
        <div>
            <h1 class="page-title mb-0">Dashboard Overview</h1>
            <p class="page-subtitle mb-0">
                School performance, finances and academic analytics.
            </p>
        </div>

        <div class="quick-actions">
            <a class="qa" href="{{ route('Student.create') }}">
                <i class="bi bi-person-plus"></i> Add Student
            </a>
            <a class="qa" href="{{ route('Student.teacher') }}">
                <i class="bi bi-person-workspace"></i> Add Teacher
            </a>
            <a class="qa" href="{{ route('Student.fees') }}">
                <i class="bi bi-cash-stack"></i> Fees
            </a>
            <a class="qa" href="{{ route('admin.marks') }}">
                <i class="bi bi-bar-chart"></i> Results
            </a>
            <button class="qa" onclick="window.print()" type="button">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="stat-card bg1">
                <div class="stat-label">Total Students</div>
                <div class="stat-number">{{ number_format($totalStudent) }}</div>
                <div class="stat-note">All registered students</div>
                <i class="bi bi-people-fill stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card bg2">
                <div class="stat-label">Fees Collected</div>
                <div class="stat-number">
                    ₹{{ number_format((float) $totalFees, 0) }}
                </div>
                <div class="stat-note">Collected fees overview</div>
                <i class="bi bi-wallet2 stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card bg3">
                <div class="stat-label">Total Teachers</div>
                <div class="stat-number">{{ number_format($totalTeacher) }}</div>
                <div class="stat-note">Registered teaching staff</div>
                <i class="bi bi-person-workspace stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card bg4">
                <div class="stat-label">New Admissions</div>
                <div class="stat-number">{{ number_format($newAdmission) }}</div>
                <div class="stat-note">Admissions in the selected period</div>
                <i class="bi bi-person-plus-fill stat-icon"></i>
            </div>
        </div>

    </div>

    {{-- SECONDARY STATS --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body d-flex align-items-center gap-3">
                    <div class="activity-icon">
                        <i class="bi bi-person-check fs-5"></i>
                    </div>
                    <div>
                        <div class="panel-subtitle mt-0">Active Students</div>
                        <div class="fs-4 fw-bold">{{ number_format($activeStudent) }}</div>
                        <div class="panel-subtitle">Currently active</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body d-flex align-items-center gap-3">
                    <div class="activity-icon" style="background:#dcfce7;color:#15803d">
                        <i class="bi bi-graph-up-arrow fs-5"></i>
                    </div>
                    <div>
                        <div class="panel-subtitle mt-0">Student Activity</div>
                        <div class="fs-6 fw-bold">Admissions & Growth</div>
                        <div class="panel-subtitle">Review the monthly chart below</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body d-flex align-items-center gap-3">
                    <div class="activity-icon" style="background:#fef3c7;color:#b45309">
                        <i class="bi bi-mortarboard fs-5"></i>
                    </div>
                    <div>
                        <div class="panel-subtitle mt-0">Academic Performance</div>
                        <div class="fs-6 fw-bold">Marks & Grades</div>
                        <div class="panel-subtitle">Exam results overview</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CHARTS: MONTHLY ADMISSIONS AND INCOME --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-8">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Monthly Business Activity</h2>
                        <div class="panel-subtitle">
                            Admissions and fee income over the months
                        </div>
                    </div>
                    <span class="badge text-bg-light">Analytics</span>
                </div>
                <div class="panel-body">
                    <div class="chart-area">
                        <canvas id="businessChart"></canvas>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-xl-4">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Fee Collection Status</h2>
                        <div class="panel-subtitle">Paid and pending fee amounts</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="chart-area small">
                        <canvas id="feeChart"></canvas>
                    </div>
                </div>
            </section>
        </div>

    </div>

    {{-- ACADEMIC CHARTS --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-7">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Subject-wise Performance</h2>
                        <div class="panel-subtitle">
                            Average marks for each subject
                        </div>
                    </div>
                    <span class="badge text-bg-light">Exams</span>
                </div>
                <div class="panel-body">
                    <div class="chart-area">
                        <canvas id="subjectChart"></canvas>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-xl-5">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Grade Distribution</h2>
                        <div class="panel-subtitle">Students by grade</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="chart-area">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>
            </section>
        </div>

    </div>

    {{-- TOP STUDENTS AND RECENT ACTIVITY --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-7">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Top Performing Students</h2>
                        <div class="panel-subtitle">
                            Highest overall marks based on recorded exam results
                        </div>
                    </div>
                    <a href="{{ route('admin.marks') }}" class="small fw-bold">
                        All Results <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table-clean">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topStudents as $top)
                                <tr>
                                    <td>
                                        <span class="mini-avatar">
                                            {{ strtoupper(substr($top->fullname ?? $top->name ?? 'S', 0, 1)) }}
                                        </span>
                                        <span class="student-name-cell">
                                            {{ $top->fullname ?? $top->name ?? 'Student' }}
                                        </span>
                                    </td>
                                    <td>{{ $top->class ?? '—' }}</td>
                                    <td class="fw-bold">
                                        {{ $top->percentage ?? $top->marks ?? '—' }}
                                        @if(isset($top->percentage))% @endif
                                    </td>
                                    <td>
                                        <span class="grade-pill">
                                            {{ $top->grade ?? '—' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-message">
                                        <i class="bi bi-bar-chart fs-4 d-block mb-2"></i>
                                        No exam results available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div class="col-xl-5">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Recent School Activity</h2>
                        <div class="panel-subtitle">
                            Latest admissions, fees and staff updates
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @forelse($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="bi {{ $activity['icon'] ?? 'bi-activity' }}"></i>
                            </div>
                            <div>
                                <div class="activity-title">
                                    {{ $activity['title'] ?? 'School activity' }}
                                </div>
                                <div class="activity-description">
                                    {{ $activity['description'] ?? '' }}
                                </div>
                                @if(!empty($activity['date']))
                                    <div class="activity-description">
                                        {{ $activity['date'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-message">
                            <i class="bi bi-clock-history fs-4 d-block mb-2"></i>
                            No recent activity data available.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

    </div>

    <div class="footer-note">
        © <span id="footerYear"></span> Sunrise Public School · Admin Analytics
    </div>

</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-IN', {
        weekday: 'short',
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });

document.getElementById('year').textContent = new Date().getFullYear();
document.getElementById('footerYear').textContent = new Date().getFullYear();

const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menuToggle');

menuToggle.addEventListener('click', function () {
    sidebar.classList.toggle('open');
});

document.querySelector('.content').addEventListener('click', function () {
    if (window.innerWidth <= 1100) {
        sidebar.classList.remove('open');
    }
});

/*
 * Chart data is supplied by the Laravel controller.
 * Empty arrays produce empty charts rather than fake business results.
 */
const labels = @json($monthlyLabels);
const admissions = @json($monthlyAdmissions);
const income = @json($monthlyIncome);

const feeCollected = Number(@json((float) $totalFees));
const feePending = Number(@json((float) ($pendingFees ?? 0)));

const subjectLabels = @json(collect($subjectPerformance)->pluck('subject')->values());
const subjectMarks = @json(collect($subjectPerformance)->pluck('average')->values());

const gradeLabels = @json(collect($gradeDistribution)->pluck('grade')->values());
const gradeCounts = @json(collect($gradeDistribution)->pluck('count')->values());

Chart.defaults.font.family = 'Inter, Arial, sans-serif';
Chart.defaults.color = '#64748b';

new Chart(document.getElementById('businessChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'New Admissions',
                data: admissions,
                borderColor: '#0b5ed7',
                backgroundColor: 'rgba(11,94,215,.10)',
                fill: true,
                tension: .35,
                borderWidth: 3,
                pointRadius: 3,
                yAxisID: 'y'
            },
            {
                label: 'Fee Income (₹)',
                data: income,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,.08)',
                fill: false,
                tension: .35,
                borderWidth: 3,
                pointRadius: 3,
                yAxisID: 'y1'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { position: 'bottom', labels: { usePointStyle: true, padding: 18 } }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Admissions' }
            },
            y1: {
                beginAtZero: true,
                position: 'right',
                grid: { drawOnChartArea: false },
                title: { display: true, text: 'Income (₹)' }
            }
        }
    }
});

new Chart(document.getElementById('feeChart'), {
    type: 'doughnut',
    data: {
        labels: ['Collected', 'Pending'],
        datasets: [{
            data: [feeCollected, feePending],
            backgroundColor: ['#10b981', '#f59e0b'],
            borderWidth: 0,
            hoverOffset: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: {
            legend: { position: 'bottom', labels: { usePointStyle: true, padding: 18 } }
        }
    }
});

new Chart(document.getElementById('subjectChart'), {
    type: 'bar',
    data: {
        labels: subjectLabels,
        datasets: [{
            label: 'Average Marks (%)',
            data: subjectMarks,
            backgroundColor: '#4f83ee',
            borderRadius: 7,
            maxBarThickness: 45
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        scales: {
            x: { beginAtZero: true, max: 100 }
        },
        plugins: {
            legend: { display: false }
        }
    }
});

new Chart(document.getElementById('gradeChart'), {
    type: 'doughnut',
    data: {
        labels: gradeLabels,
        datasets: [{
            data: gradeCounts,
            backgroundColor: [
                '#10b981', '#3b82f6', '#f59e0b',
                '#8b5cf6', '#f97316', '#ef4444'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
            legend: { position: 'bottom', labels: { usePointStyle: true, padding: 12 } }
        }
    }
});
</script>

</body>
</html>
```