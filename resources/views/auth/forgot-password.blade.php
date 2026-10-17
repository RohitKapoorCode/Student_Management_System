<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
        }

        .card {
            border: none;
            border-radius: 14px;
            background: linear-gradient(180deg, #0B2A4A, #0b5ed7);
            
        }

        .logo {
            font-size: 30px;
            font-weight: 700;
            color: white;
            
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color:white;
        }

        .desc {
            font-size: 14px;
            
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            
        }

        .input-group-text {
            background: #fff;
            border-radius: 8px 0 0 8px;
            
        }

        .btn-primary {
            height: 45px;
            border-radius: 8px;
            font-weight: 500;
            
        }

        .footer-link {
            font-size: 15px;
            color:white;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg p-4">

            <!-- Header -->
            <div class="text-center mb-4" style="color:white;">
                <img src="{{ asset('images/School logo.png') }}" alt="School logo.png" height="250px" width="250px">
                <div class="logo" > Sunrise Public School</div>
                <div class="title mt-2">Forgot Password</div>
             <div> 
                <p class="text-white desc" style="color:white;" >
                    Enter your registered email to receive a password reset link.
                </p>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Field with Icon -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:white;">Email Address</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email" required>
                    </div>

                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Button -->
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Send Reset Link
                    </button>
                </div>

                <!-- Footer -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="footer-link text-decoration-none">
                        ← Back to Login
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>