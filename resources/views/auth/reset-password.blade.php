<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #dbeafe);
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 14px;
            background: linear-gradient(180deg, #0B2A4A, #0b5ed7);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: white;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;

        }

        .btn-primary {
            height: 45px;
            border-radius: 8px;
            font-weight: 500;
            color: white;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg p-4">

            <!-- Header -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/School logo.png') }}" alt="School logo.png" height="250px" width="250px">
                <div class="logo"> Sunrise Public School</div>
                <div class="title mt-2">Reset Password</div>
                <p class="text-white small" style="color:white;">
                    Enter your new password below
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:white;">Email Address</label>
                    <input type="email" name="email"
                        value="{{ old('email', $request->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required>

                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:white;">New Password</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter new password" required>
                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:white;">Confirm Password</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm password" required>
                    </div>

                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button -->
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Reset Password
                    </button>
                </div>

                
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none small" style="color:white;">
                        ← Back to Login
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>