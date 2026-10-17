<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Portal') | Sunrise Public School</title>
<link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@php
    $u = Auth::user();
    $role = $u->role;

    if ($role === 'admin') {
        $menu = [
            [route('Student.student'), 'bi-people', 'Students'],
            [route('Student.create'), 'bi-person-plus', 'Add Student'],
            [route('Student.fees'), 'bi-cash-stack', 'Fees'],
            [route('admin.accounts'), 'bi-key', 'Teacher & Student Logins'],
            [route('admin.marks'), 'bi-file-earmark-bar-graph', 'All Results'],
        ];
    } elseif ($role === 'teacher') {
        $menu = [[route('teacher.dashboard'), 'bi-journal-check', 'Students & Marks']];
    } else {
        $menu = [
            ['#top', 'bi-speedometer2', 'My Dashboard'],
            ['#profile', 'bi-person-vcard', 'My Profile'],
            ['#family', 'bi-people', 'Family Details'],
            ['#results', 'bi-file-earmark-bar-graph', 'Exam & Results'],
            ['#fees', 'bi-cash-stack', 'My Fees'],
            ['#edit', 'bi-pencil-square', 'Edit My Details'],
        ];
    }

    $roleLabel = ['student' => 'Student Portal', 'teacher' => 'Teacher Portal', 'admin' => 'Admin Panel'][$role] ?? 'Portal';
@endphp

<style>
:root { --navy:#0B2A4A; --navy-dark:#071b33; --blue:#0b5ed7; --soft:#e6effb; --sun:#F2A93B;
        --ink:#10233A; --muted:#55677c; --line:#dde5f0; --sw:256px; --hh:84px; }
* { box-sizing:border-box; }
html { scroll-behavior:smooth; scroll-padding-top:100px; }
body { font-family:'Source Sans 3','Segoe UI',sans-serif; color:var(--ink);
       background:linear-gradient(135deg,#e6effb 0%,#f3f6fc 50%,#fdf3e0 100%) fixed; }
h1,h2,h3,h4,h5,h6,.school-name { font-family:'Bricolage Grotesque','Segoe UI',sans-serif; }

/* header */
.topbar { position:fixed; top:0; left:0; right:0; height:var(--hh); padding:0 26px; z-index:200; background:#fff;
          box-shadow:0 2px 14px rgba(15,23,42,.06); display:flex; align-items:center; justify-content:space-between; }
.topbar::after { content:""; position:absolute; left:0; right:0; bottom:0; height:3px;
                 background:linear-gradient(90deg,#0B2A4A,#0b5ed7 55%,#F2A93B); }
.topbar .logo { height:62px; width:62px; object-fit:contain; }
.school-name { font-size:25px; font-weight:800; color:var(--navy); line-height:1.1; }
.role-tag { font-size:12px; font-weight:700; letter-spacing:.8px; text-transform:uppercase; color:var(--blue); }
.menu-toggle { display:none; border:0; background:var(--soft); color:var(--blue); width:40px; height:40px; border-radius:10px; font-size:22px; }
.avatar { width:42px; height:42px; border-radius:50%; color:#fff; font-weight:700; display:flex; align-items:center;
          justify-content:center; background:linear-gradient(135deg,var(--navy),var(--blue)); }
.user-btn { display:flex; align-items:center; gap:10px; background:none; border:0; border-radius:12px; padding:4px 8px; }
.user-btn:hover { background:#f3f6fc; }
.dropdown-menu { border:1px solid var(--line); border-radius:12px; box-shadow:0 12px 30px rgba(15,23,42,.12); }

/* sidebar */
.sidebar { position:fixed; top:var(--hh); left:0; width:var(--sw); height:calc(100vh - var(--hh)); z-index:100;
           padding:16px 14px; overflow-y:auto; transition:transform .3s;
           background:linear-gradient(180deg,#071b33 0%,#0B2A4A 40%,#0b5ed7 100%); }
.sidebar a { display:flex; align-items:center; gap:12px; padding:11px 14px; margin-bottom:4px; color:#dbe8fa;
             text-decoration:none; border-radius:10px; font-weight:600; transition:.2s; }
.sidebar a:hover, .sidebar a.active { background:rgba(255,255,255,.16); color:#fff; }
.sidebar a.active { box-shadow:inset 3px 0 0 var(--sun); }
.sidebar .foot { position:absolute; bottom:16px; left:0; right:0; text-align:center; font-size:12px; color:rgba(255,255,255,.55); }

/* content */
.content { margin-left:var(--sw); padding-top:var(--hh); min-height:100vh; }
.page { padding:26px; }
.head h4 { font-weight:800; color:var(--navy); margin:0; }
.head h4::after { content:''; display:block; width:44px; height:4px; margin-top:8px; border-radius:2px; background:var(--sun); }
.head p { margin:10px 0 22px; color:var(--muted); }

/* cards */
.hero { position:relative; overflow:hidden; border-radius:20px; padding:26px 30px; color:#fff;
        background:linear-gradient(120deg,#0B2A4A 0%,#0b5ed7 65%,#4facfe 100%); box-shadow:0 14px 34px rgba(11,94,215,.25); }
.hero::before { content:""; position:absolute; right:-60px; top:-80px; width:260px; height:260px; border-radius:50%; background:rgba(255,255,255,.10); }
.hero-avatar { width:80px; height:80px; border-radius:50%; flex-shrink:0; font-size:34px; font-weight:800;
               background:rgba(255,255,255,.18); border:3px solid rgba(255,255,255,.55); display:flex; align-items:center; justify-content:center; }
.hero h3 { font-weight:800; margin:0 0 4px; }
.chip { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,.18); border-radius:20px; padding:5px 13px; font-size:13px; font-weight:600; margin:8px 8px 0 0; }
.chip-paid { background:#22c55e; } .chip-unpaid { background:#ef4444; }

.stat { position:relative; overflow:hidden; height:100%; border-radius:18px; padding:20px 22px; color:#fff; box-shadow:0 10px 24px rgba(11,42,74,.14); }
.stat::before { content:""; position:absolute; right:-28px; top:-28px; width:110px; height:110px; border-radius:50%; background:rgba(255,255,255,.16); }
.stat small { text-transform:uppercase; letter-spacing:.8px; font-weight:700; font-size:12px; opacity:.9; }
.stat h2 { font-weight:800; margin:6px 0 0; font-size:30px; }
.stat i { position:absolute; right:18px; bottom:12px; font-size:44px; opacity:.25; }
.s1 { background:linear-gradient(135deg,#0B2A4A,#0b5ed7); } .s2 { background:linear-gradient(135deg,#0b5ed7,#4facfe); }
.s3 { background:linear-gradient(135deg,#F2A93B,#f7c97a); color:var(--navy); } .s4 { background:linear-gradient(135deg,#0a3d8f,#16406b); }

.box { background:#fff; border-radius:18px; box-shadow:0 10px 30px rgba(15,23,42,.07); overflow:hidden; height:100%; }
.box > h5 { font-weight:800; color:var(--navy); margin:0; padding:17px 24px; border-bottom:1px solid var(--line); font-size:17px; }
.box > h5 i { color:var(--blue); margin-right:8px; }
.box .body { padding:8px 24px 20px; }
.box .body.pad { padding-top:20px; }

.info-row { display:flex; align-items:flex-start; gap:14px; padding:13px 0; border-bottom:1px dashed var(--line); }
.info-row:last-child { border-bottom:0; }
.info-ico { width:38px; height:38px; border-radius:11px; flex-shrink:0; background:var(--soft); color:var(--blue); display:flex; align-items:center; justify-content:center; font-size:17px; }
.info-label { font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.6px; font-weight:600; }
.info-value { font-weight:600; word-break:break-word; }

.fee-line { display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px dashed var(--line); font-weight:500; }
.fee-line span:last-child { font-weight:700; }
.fee-total { display:flex; justify-content:space-between; margin-top:14px; padding:15px 18px; border-radius:14px; background:var(--soft); font-weight:800; font-size:18px; color:var(--navy); }
.banner { margin-top:14px; padding:12px 16px; border-radius:14px; font-weight:600; font-size:14px; display:flex; align-items:center; gap:10px; }
.banner-paid { background:#dcfce7; color:#15803d; } .banner-unpaid { background:#fee2e2; color:#b91c1c; }

/* tables + forms */
.table { margin:0; font-size:14.5px; }
.table thead th { background:var(--soft); color:var(--navy); font-size:12px; text-transform:uppercase; letter-spacing:.6px; padding:12px 14px; border-bottom:2px solid #cfe0f7; white-space:nowrap; }
.table td { padding:12px 14px; vertical-align:middle; }
.table tbody tr:hover td { background:#f6f9ff; }
.pill { background:var(--soft); color:var(--blue); padding:3px 12px; border-radius:20px; font-weight:600; font-size:12.5px; }
.badge-ok { background:#dcfce7; color:#15803d; padding:4px 12px; border-radius:20px; font-weight:600; font-size:12.5px; }
.badge-bad { background:#fee2e2; color:#b91c1c; padding:4px 12px; border-radius:20px; font-weight:600; font-size:12.5px; }
.form-label { font-weight:600; font-size:.92rem; }
.form-control, .form-select { border-radius:8px; border:1px solid #aebccd; padding:9px 12px; }
.form-control:focus, .form-select:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(11,94,215,.15); }
.btn-main { background:linear-gradient(180deg,var(--navy),var(--blue)); color:#fff; border:0; border-radius:8px; padding:9px 22px; font-weight:600; text-decoration:none; display:inline-block; }
.btn-main:hover { color:#fff; filter:brightness(1.12); }
.btn-soft { background:#f3f6fc; border:1px solid #dbe3ef; color:var(--navy); border-radius:8px; padding:8px 16px; font-weight:600; }
.btn-soft:hover { background:var(--soft); color:var(--blue); }
.empty { text-align:center; padding:34px 20px; color:var(--muted); }
.empty i { font-size:36px; color:#b9c7de; display:block; margin-bottom:8px; }

@media (max-width:992px) {
    .menu-toggle { display:inline-flex; align-items:center; justify-content:center; }
    .sidebar { transform:translateX(-100%); box-shadow:8px 0 30px rgba(0,0,0,.25); }
    .sidebar.open { transform:none; }
    .content { margin-left:0; }
    .school-name { font-size:18px; }
    .topbar { padding:0 14px; }
    .topbar .logo { height:46px; width:46px; }
    .page { padding:16px; }
    .user-name { display:none; }
}
@media print { .topbar, .sidebar, .no-print { display:none !important; } .content { margin:0; } body { background:#fff; } }
</style>
</head>
<body>

<div class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="menu-toggle" id="menuToggle" aria-label="Menu"><i class="bi bi-list"></i></button>
        <img src="{{ asset('images/School logo.png') }}" class="logo" alt="Sunrise Public School logo">
        <div>
            <div class="school-name">Sunrise Public School</div>
            <div class="role-tag">{{ $roleLabel }}</div>
        </div>
    </div>

    <div class="dropdown">
        <button class="user-btn" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="avatar">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
            <div class="text-start user-name">
                <div class="small text-muted" style="line-height:1">Welcome back</div>
                <strong style="color:var(--navy)">{{ $u->name }}</strong>
            </div>
            <i class="bi bi-chevron-down small text-muted"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end p-2">
            <li class="px-3 py-2 small text-muted">Signed in as<br><strong class="text-dark">{{ $u->email }}</strong></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<div class="sidebar" id="sidebar">
    @foreach($menu as $m)
        <a href="{{ $m[0] }}" class="{{ url()->current() === $m[0] ? 'active' : '' }}">
            <i class="bi {{ $m[1] }}"></i> {{ $m[2] }}
        </a>
    @endforeach
    <div class="foot">© {{ date('Y') }} Sunrise Public School</div>
</div>

<main class="content" id="top">
    <div class="page">
        @if(session('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<script>
    const sidebar = document.getElementById('sidebar');
    document.getElementById('menuToggle').addEventListener('click', () => sidebar.classList.toggle('open'));
    document.querySelector('.content').addEventListener('click', () => sidebar.classList.remove('open'));
</script>
</body>
</html>
