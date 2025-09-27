<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fyukarisa4471back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8"></script>
</head>
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
<body>
  <main class="main-container">


    <section class="login-card">
      <nav class="breadcrumb" aria-label="Breadcrumb navigation">
        <a href="/" class="breadcrumb-link breadcrumb-home">Home</a>
        <span class="breadcrumb-separator"></span>
        <span class="breadcrumb-link breadcrumb-current" aria-current="page">Login</span>
      </nav>

      <div class="login-content">
        <header class="login-header">
          <h1 class="login-title">Login</h1>
          <p class="login-subtitle">Masukkan Email dan Password!.</p>
        </header>
        <form method="POST" action="{{ route('login.store') }}" class="login-form">
            @csrf
              <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Email" required autocomplete="Email" />
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-container">
              <input type="password" id="password" name="password" class="form-input password-input" placeholder="Password" required autocomplete="current-password" />
              <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                <img src="../assets/images/img_closed_eye.svg" alt="Show password" id="passwordIcon" />
              </button>
            </div>
          </div>

          <button type="submit" class="login-button">Login</button>
        </form>

      </div>
    </section>

    <footer class="footer-content">
      <p class="signup-link">
        Belum Punya Akun? <a href="{{ route('register') }}" aria-label="Create new account">Register!</a>
      </p>
      <p class="copyright">© 2025 Pramudya. All rights reserved.</p>
    </footer>
  </main>

  <script>
    // Password visibility toggle
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (passwordToggle && passwordInput && passwordIcon) {
      passwordToggle.addEventListener('click', function() {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        passwordIcon.src = isPassword ? '/images/img_open_eye.svg' : '/images/img_closed_eye.svg';
        passwordIcon.alt = isPassword ? 'Hide password' : 'Show password';
        passwordToggle.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
      });
    }

    // Form submission handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username && password) {
          // Add loading state
          const submitButton = loginForm.querySelector('.login-button');
          const originalText = submitButton.textContent;
          submitButton.textContent = 'Logging in...';
          submitButton.disabled = true;

          // Simulate login process
          setTimeout(() => {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
            alert('Login functionality would be implemented here');
          }, 2000);
        }
      });
    }

    // Input focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
      });

      input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
      });
    });
  </script>
</body>
</html>
