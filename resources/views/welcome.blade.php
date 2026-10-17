<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunrise Public School</title>

    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">

    {{-- ====== ROUTES: apne project ke route names yahan set karo ====== --}}
    @php
        $studentUrl = Route::has('login')        ? route('login')        : '#';
        $teacherUrl = Route::has('teacherlogin') ? route('teacherlogin') : '#';
        $adminUrl   = Route::has('adminlogin')   ? route('adminlogin')   : '#';
    @endphp

    <style>
        :root {
            --navy: #0B2A4A;
            --navy-soft: #16406b;
            --blue: #0b5ed7;
            --sun: #F2A93B;
            --paper: #F6F8FB;
            --ink: #10233A;
            --muted: #55677c;
            --line: #d6dee8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Source Sans 3', 'Segoe UI', sans-serif;
            color: var(--ink);
            background: linear-gradient(135deg, #e6effb 0%, #f6f8fb 50%, #fdf3e0 100%);
            line-height: 1.6;
        }

        h1, h2, h3 { font-family: 'Bricolage Grotesque', 'Segoe UI', sans-serif; margin: 0; line-height: 1.1; }

        a:focus-visible, button:focus-visible {
            outline: 3px solid var(--sun);
            outline-offset: 2px;
        }

        .wrap { width: min(1120px, 92%); margin: 0 auto; }

        /* ---------- Top bar ---------- */
        .topbar { background: #fff; border-bottom: 3px solid var(--blue); }
        .topbar .wrap { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 12px 0; }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: var(--navy); }
        .brand { gap: 16px; }
        .brand img { height: 96px; width: 96px; object-fit: contain; }
        .brand .name { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.75rem; line-height: 1.1; display: block; }
        .brand .tag { display: block; margin-top: 4px; font-size: .95rem; font-weight: 600; color: var(--muted); }
        .topbar nav { display: flex; gap: 24px; }
        .topbar nav a { color: var(--ink); text-decoration: none; font-weight: 600; }
        .topbar nav a:hover { color: var(--blue); text-decoration: underline; }

        .btn-dash {
            background: linear-gradient(180deg, var(--navy), var(--blue)); color: #fff; text-decoration: none;
            padding: 10px 20px; border-radius: 6px; font-weight: 600;
        }

        /* ---------- Hero ---------- */
        .topbar { position: sticky; top: 0; z-index: 10; }
        .hero {
            position: relative; overflow: hidden; color: #fff;
            background:
                linear-gradient(135deg, rgba(11,42,74,.96) 0%, rgba(11,60,140,.88) 50%, rgba(11,94,215,.82) 100%),
                url('https://images.unsplash.com/photo-1523050853063-915894614232?auto=format&fit=crop&w=1350&q=70') center/cover,
                var(--navy);
        }
        .hero .wrap {
            position: relative; z-index: 1;
            display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 56px;
            align-items: center; padding: 88px 0 96px;
        }
        .hero h1 { font-size: clamp(2.4rem, 5.5vw, 4.2rem); font-weight: 800; letter-spacing: -0.02em; }
        .hero p.lead { margin: 20px 0 0; max-width: 46ch; font-size: 1.15rem; color: #eaf2ff; }

        /* The one memorable element: a rising sun */
        .sun {
            position: absolute; left: -140px; bottom: -260px;
            width: 520px; height: 520px; border-radius: 50%;
            background: radial-gradient(circle, var(--sun) 0 52%, rgba(242,169,59,.35) 53% 70%, rgba(242,169,59,.12) 71% 100%);
        }
        @media (prefers-reduced-motion: no-preference) {
            .sun { animation: rise 1.4s ease-out both; }
            @keyframes rise { from { transform: translateY(160px); opacity: 0; } to { transform: none; opacity: 1; } }
        }

        /* ---------- Login panel ---------- */
        .portal { background: #fff; color: var(--ink); border-radius: 10px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.25); }
        .portal h2 { font-size: 1.2rem; padding: 20px 24px; border-bottom: 1px solid var(--line); }
        .portal-row {
            display: flex; align-items: center; gap: 16px;
            padding: 18px 24px; text-decoration: none; color: inherit;
            border-bottom: 1px solid var(--line); transition: background .15s;
        }
        .portal-row:last-child { border-bottom: 0; }
        .portal-row:hover { background: #e6effb; }
        .portal-row .ic {
            flex: none; width: 46px; height: 46px; border-radius: 10px;
            display: grid; place-items: center; font-size: 1.35rem;
            background: linear-gradient(180deg, var(--navy), var(--blue)); color: #fff;
        }
        .portal-row.teacher .ic { background: var(--blue); }
        .portal-row.admin .ic { background: var(--sun); color: var(--navy); }
        .portal-row b { display: block; font-size: 1.05rem; }
        .portal-row small { color: var(--muted); font-size: .92rem; }
        .portal-row .go { margin-left: auto; color: var(--muted); }
        
                .portal-form {
            margin: 0;
            width: 100%;
        }

        .portal button.portal-row {
            width: 100%;
            font-family: inherit;
            font-size: inherit;
            text-align: left;
            color: inherit;
            background: #fff;
            border: 0;
            border-bottom: 1px solid var(--line);
            cursor: pointer;
        }

        .portal button.portal-row:hover {
            background: #e6effb;
        }


        /* ---------- Roles ---------- */
        .roles .wrap { padding: 72px 0 8px; }
        .roles h2 { font-size: 2rem; color: var(--navy); max-width: 22ch; }
        .roles h2::after { content: ''; display: block; width: 44px; height: 4px; margin-top: 10px; border-radius: 2px; background: var(--sun); }
        .roles .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 32px; }
        .role { background: #fff; border: 1px solid var(--line); border-radius: 10px; padding: 28px; }
        .role .ic { width: 48px; height: 48px; border-radius: 10px; display: grid; place-items: center; font-size: 1.4rem; background: linear-gradient(180deg, var(--navy), var(--blue)); color: #fff; margin-bottom: 16px; }
        .role.t .ic { background: var(--blue); }
        .role.a .ic { background: var(--sun); color: var(--navy); }
        .role h3 { font-size: 1.25rem; color: var(--navy); }
        .role ul { list-style: none; padding: 0; margin: 14px 0 0; }
        .role li { display: flex; gap: 10px; padding: 6px 0; color: var(--muted); }
        .role li i { color: var(--sun); }
        /* ---------- Info ---------- */
        .info .wrap { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; padding: 64px 0; }
        .info h3 { font-size: 1.1rem; color: var(--navy); margin-bottom: 8px; }
        .info p { margin: 0; color: var(--muted); }
        .info .item { border-left: 4px solid var(--sun); padding-left: 18px; }

        footer { background: linear-gradient(180deg, var(--navy) 0%, #0a3d8f 100%); color: #dbe8fa; margin-top: 24px; }
        footer .cols { display: grid; grid-template-columns: 1.4fr 1fr 1.2fr; gap: 40px; padding: 48px 0 32px; }
        footer h4 { font-family: 'Bricolage Grotesque', sans-serif; color: #fff; font-size: 1.1rem; margin: 0 0 12px; }
        footer p { margin: 0 0 6px; }
        footer a { color: #dbe8fa; text-decoration: none; display: block; padding: 3px 0; }
        footer a:hover { color: var(--sun); }
        footer .logo-row { display: flex; align-items: center; gap: 14px; margin-bottom: 12px; }
        footer .logo-row img { height: 72px; width: 72px; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(0,0,0,.35)); }
        footer .copy { border-top: 1px solid rgba(255,255,255,.15); text-align: center; padding: 18px 0; font-size: .95rem; }

        /* ---------- Mobile ---------- */
        @media (max-width: 860px) {
            .topbar nav { display: none; }
            .brand img { height: 68px; width: 68px; }
            .brand .name { font-size: 1.2rem; }
            .brand .tag { font-size: .85rem; }
            .hero .wrap { grid-template-columns: 1fr; gap: 32px; }
            .hero .wrap { padding: 56px 0 88px; }
            .roles .grid, footer .cols { grid-template-columns: 1fr; }
            .info .wrap { grid-template-columns: 1fr; gap: 28px; }
            .sun { width: 340px; height: 340px; left: -120px; bottom: -190px; }
        }
    </style>
</head>
<body>

    <header class="topbar">
        <div class="wrap">
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('images/School logo.png') }}" alt="Sunrise Public School logo">
                <span>
                    <span class="name">Sunrise Public School</span>
                </span>
            </a>
            <nav aria-label="Main">
                <a href="#contact">Contact</a>
            </nav>
            {{-- @auth
                <a href="{{ route('Student.student') }}" class="btn-dash">Go to Dashboard</a>
            @endauth --}}
        </div>
    </header>

    <section class="hero">
        <div class="sun" aria-hidden="true"></div>
        <div class="wrap">
            <div>
                <h1>Excellence in Education</h1>
                <p class="lead">Students, fees, and records—all in one place. Choose your login and get started..</p>
            </div>

            
            <div class="portal">
                <h2>Log in</h2>

                {{-- Student Login --}}
                @auth
                    <form method="POST" action="{{ route('logout.student') }}" class="portal-form">
                        @csrf
                        <button type="submit" class="portal-row student">
                            <span class="ic"><i class="bi bi-mortarboard-fill"></i></span>
                            <span><b>Student Login</b><small></small></span>
                            <i class="bi bi-chevron-right go"></i>
                        </button>
                    </form>
                @else
                    <a class="portal-row student" href="{{ $studentUrl }}">
                        <span class="ic"><i class="bi bi-mortarboard-fill"></i></span>
                        <span><b>Student Login</b><small></small></span>
                        <i class="bi bi-chevron-right go"></i>
                    </a>
                @endauth

                {{-- Teacher Login --}}
                @auth
                    <form method="POST" action="{{ route('logout.teacher') }}" class="portal-form">
                        @csrf
                        <button type="submit" class="portal-row teacher">
                            <span class="ic"><i class="bi bi-person-workspace"></i></span>
                            <span><b>Teacher Login</b><small></small></span>
                            <i class="bi bi-chevron-right go"></i>
                        </button>
                    </form>
                @else
                    <a class="portal-row teacher" href="{{ $teacherUrl }}">
                        <span class="ic"><i class="bi bi-person-workspace"></i></span>
                        <span><b>Teacher Login</b><small></small></span>
                        <i class="bi bi-chevron-right go"></i>
                    </a>
                @endauth

                {{-- Admin Login --}}
                @auth
                    <form method="POST" action="{{ route('logout.admin') }}" class="portal-form">
                        @csrf
                        <button type="submit" class="portal-row admin">
                            <span class="ic"><i class="bi bi-shield-lock-fill"></i></span>
                            <span><b>Admin Login</b><small></small></span>
                            <i class="bi bi-chevron-right go"></i>
                        </button>
                    </form>
                @else
                    <a class="portal-row admin" href="{{ $adminUrl }}">
                        <span class="ic"><i class="bi bi-shield-lock-fill"></i></span>
                        <span><b>Admin Login</b><small></small></span>
                        <i class="bi bi-chevron-right go"></i>
                    </a>
                @endauth
            </div>

        </div>
    </section>

    <section class="roles">
        <div class="wrap">
            <h2>A portal for everyone</h2>
            <div class="grid">
                <div class="role">
                    <div class="ic"><i class="bi bi-mortarboard-fill"></i></div>
                    <h3>Students</h3>
                    <ul>
                        <li><i class="bi bi-check-circle-fill"></i> View your profile</li>
                        <li><i class="bi bi-check-circle-fill"></i> Check fee status</li>
                    </ul>
                </div>
                <div class="role t">
                    <div class="ic"><i class="bi bi-person-workspace"></i></div>
                    <h3>Teachers</h3>
                    <ul>
                        {{-- <li><i class="bi bi-check-circle-fill"></i> Apni class ke students dekhein</li> --}}
                        <li><i class="bi bi-check-circle-fill"></i> Enter marks</li>
                        <li><i class="bi bi-check-circle-fill"></i> Update the results</li>
                    </ul>
                </div>
                <div class="role a">
                    <div class="ic"><i class="bi bi-shield-lock-fill"></i></div>
                    <h3>Admin</h3>
                    <ul>
                        <li><i class="bi bi-check-circle-fill"></i> Students and teachers should manage it.</li>
                        <li><i class="bi bi-check-circle-fill"></i> Manage fee records</li>
                        <li><i class="bi bi-check-circle-fill"></i> Track pending payments</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="info" id="contact">
        <div class="wrap">
            <div class="item">
                <h3>Address</h3>
                <p>109, A/1, Edu Manzil, L J Road, Opp. Paradise Mall, Delhi</p>
            </div>
            <div class="item">
                <h3>Contact and email</h3>
                <p>+91 8506893615<br>sunrisepublicschool01@gmail.com</p>
            </div>
            <div class="item">
                <h3>Fee portal</h3>
                <p>Easily manage fee records and pending payments.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="wrap cols">
            <div>
                <div class="logo-row">
                    <img src="{{ asset('images/School logo.png') }}" alt="Sunrise Public School logo">
                    <h4 style="margin:0">Sunrise Public School</h4>
                </div>
                <p>Excellence in Education</p>
            </div>
            <div>
                <h4>Quick links</h4>
                <a href="{{ $studentUrl }}">Student Login</a>
                <a href="{{ $teacherUrl }}">Teacher Login</a>
                <a href="{{ $adminUrl }}">Admin Login</a>
            </div>
            <div>
                <h4>Contact</h4>
                <p>109, A/1, Edu Manzil, L J Road, Opp. Paradise Mall, Delhi</p>
                <p>+91 8506893615</p>
                <p>sunrisepublicschool01@gmail.com</p>
            </div>
        </div>
        <div class="copy">© 2026 Sunrise Public School | Developed for Excellence</div>
    </footer>

</body>
</html>