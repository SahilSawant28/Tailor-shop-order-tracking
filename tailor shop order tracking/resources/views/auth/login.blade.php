<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Tailor Shop Management</title>

    {{-- Bootstrap 5 CSS from CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .brand-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.25rem;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: white;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.12);
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .input-group-text {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-right: none;
            color: rgba(255,255,255,0.5);
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem;
            width: 100%;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .form-check-label {
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 10px;
            color: #ff6b7a;
            font-size: 0.85rem;
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.15);
            border: 1px solid rgba(25, 135, 84, 0.3);
            border-radius: 10px;
            color: #75e0a7;
            font-size: 0.85rem;
        }

        .demo-creds {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-top: 1.5rem;
        }

        .demo-creds p {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .demo-creds p:last-child {
            margin-bottom: 0;
        }

        .demo-creds strong {
            color: rgba(255,255,255,0.8);
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #ff6b7a;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        {{-- Brand --}}
        <div class="brand-icon">
            <i class="bi bi-scissors"></i>
        </div>
        <div class="brand-title">Tailor Shop</div>
        <div class="brand-subtitle">Order Tracking &amp; Management System</div>

        {{-- Success message (e.g., after logout) --}}
        @if(session('success'))
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Error messages --}}
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Login Form --}}
        {{-- action="{{ route('login.post') }}" → submits to POST /login --}}
        <form method="POST" action="{{ route('login.post') }}">
            {{-- CSRF Token: Laravel requires this on every POST form for security --}}
            @csrf

            {{-- Email Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@tailor.test"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>

        {{-- Demo Credentials (for development only) --}}
        <div class="demo-creds">
            <p><i class="bi bi-info-circle me-1"></i> <strong>Development Credentials</strong></p>
            <p>Admin: <strong>admin@tailor.test</strong> / <strong>password</strong></p>
            <p>Staff: <strong>staff@tailor.test</strong> / <strong>password</strong></p>
        </div>

    </div>
</div>

{{-- Bootstrap 5 JS (needed for interactive components) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
