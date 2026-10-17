<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Register | Sunrise Public School</title>

    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">

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
            --error: #b42318;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 16px;
            background: linear-gradient(135deg, #e6effb 0%, #f6f8fb 55%, #fdf3e0 100%);
            color: var(--ink);
            font-family: 'Source Sans 3', 'Segoe UI', sans-serif;
            line-height: 1.6;
        }

        h1, h2, h3 { font-family: 'Bricolage Grotesque', 'Segoe UI', sans-serif; margin: 0; line-height: 1.1; }

        a:focus-visible, button:focus-visible {
            outline: 3px solid var(--sun);
            outline-offset: 2px;
        }

        .card {
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            width: min(780px, 100%);
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(11, 42, 74, .16);
        }

        /* ---------- Left: brand side ---------- */
        .side {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, var(--navy) 0%, var(--blue) 100%);
            color: #fff;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .side .sun {
            position: absolute; left: -70px; bottom: -120px;
            width: 240px; height: 240px; border-radius: 50%;
            background: radial-gradient(circle, var(--sun) 0 52%, rgba(242,169,59,.35) 53% 70%, rgba(242,169,59,.12) 71% 100%);
        }
        .side > *:not(.sun) { position: relative; z-index: 1; }
        .side img { height: 140px; width: 140px; object-fit: contain; filter: drop-shadow(0 6px 14px rgba(0,0,0,.35)); }
        .side h1 { margin-top: 14px; font-size: 1.3rem; font-weight: 800; }
        .side p { margin: 8px 0 0; max-width: 26ch; font-size: .95rem; color: #eaf2ff; }
        .side small { display: block; margin-top: 16px; font-size: .85rem; color: #cfe0f7; }

        /* ---------- Right: form ---------- */
        .form-side { padding: 28px 32px; }
        .form-side h2 { font-size: 1.6rem; font-weight: 800; color: var(--navy); }
        .form-side h2::after { content: ''; display: block; width: 44px; height: 4px; margin-top: 8px; border-radius: 2px; background: var(--sun); }
        .form-side .sub { margin: 4px 0 16px; font-size: .95rem; color: var(--muted); }

        .field { margin-bottom: 12px; position: relative; }
        .field label { display: block; font-weight: 600; font-size: .9rem; margin-bottom: 4px; }
        .field input {
            width: 100%;
            padding: 9px 12px;
            font: inherit;
            font-size: .95rem;
            color: var(--ink);
            background: var(--paper);
            border: 1px solid #aebccd;
            border-radius: 8px;
        }
        .field input:focus { outline: none; background: #fff; border-color: var(--blue); box-shadow: 0 0 0 3px rgba(11,94,215,.15); }
        .field .err { display: block; margin-top: 4px; font-size: .88rem; color: var(--error); }

        .eye {
            position: absolute; right: 4px; top: 27px;
            width: 38px; height: 38px;
            display: grid; place-items: center;
            background: none; border: 0; cursor: pointer; color: var(--muted);
            font-size: 1.1rem; border-radius: 6px;
        }
        .eye:hover { color: var(--blue); }
        .field.has-eye input { padding-right: 44px; }

        .btn-submit {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            font: inherit; font-weight: 600; font-size: 1rem;
            color: #fff; background: linear-gradient(180deg, var(--navy), var(--blue));
            border: 0; border-radius: 8px; cursor: pointer;
            transition: filter .15s;
        }
        .btn-submit:hover { filter: brightness(1.12); }

        .login-link { margin: 14px 0 0; text-align: center; color: var(--muted); font-size: .95rem; }
        .login-link a { color: var(--blue); font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }

        /* ---------- Mobile ---------- */
        @media (max-width: 820px) {
            .card { grid-template-columns: 1fr; }
            .side { padding: 20px 20px; }
            .side img { height: 84px; width: 84px; }
            .side h1 { font-size: 1.2rem; margin-top: 10px; }
            .side small { display: none; }
            .form-side { padding: 24px 20px; }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="side">
        <div class="sun" aria-hidden="true"></div>
        <img src="{{ asset('images/School logo.png') }}" alt="Sunrise Public School logo">
        <h1>Sunrise Public School</h1>
        <p>Teacher account banayein aur school records manage karna shuru karein.</p>
        <small>© 2026 Sunrise Public School</small>
    </div>

    <div class="form-side">
        <h2>Create Account</h2>
        <p class="sub">Teacher ke roop me register karein.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="Rohit Kapoor">
                @if($errors->has('name'))
                    <span class="err">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="field">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="name@example.com">
                @if($errors->has('email'))
                    <span class="err">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="field has-eye">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Kam se kam 8 characters">
                <button type="button" class="eye" onclick="toggleField('password', 'eyeIcon')" aria-label="Password dikhayein ya chhupayein">
                    <i id="eyeIcon" class="bi bi-eye"></i>
                </button>
                @if($errors->has('password'))
                    <span class="err">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="field has-eye">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Password dobara likhein">
                <button type="button" class="eye" onclick="toggleField('password_confirmation', 'eyeIcon2')" aria-label="Password dikhayein ya chhupayein">
                    <i id="eyeIcon2" class="bi bi-eye"></i>
                </button>
            </div>

            <button type="submit" class="btn-submit">Register now</button>

            <p class="login-link">
                Pehle se account hai? <a href="{{ route('teacherlogin') }}">Login karein</a>
            </p>
        </form>
    </div>
</div>

<script>
    // Ek hi function dono password fields ke liye
    function toggleField(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>
</body>
</html>