<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom Favicon (Life Ring Emoji) -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛟</text></svg>">
    <title>Admin Login - Disaster Relief System</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛟</text></svg>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #dc3545 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
        }
        .brand-icon {
            font-size: 50px;
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <div class="brand-icon"><i class="fas fa-life-ring"></i></div>
    <h3 class="mb-1">Disaster Relief System</h3>
    <p class="text-muted mb-4">Admin Login Portal</p>

    <!-- Error Message -->
    @if ($errors->any())
        <div class="alert alert-danger text-start py-2">
            <small><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</small>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="input-group mb-3">
            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="username" placeholder="Username (admin)" value="{{ old('username') }}" required autofocus>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" id="password-field" name="password" placeholder="Password" required>
            <!-- Show/Hide Password Button -->
            <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </button>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-danger btn-lg">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to toggle password visibility -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        // Get the password input field and the icon
        const passwordInput = document.getElementById('password-field');
        const toggleIcon = document.getElementById('toggleIcon');

        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon
        if (type === 'password') {
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    });
</script>
</body>
</html>