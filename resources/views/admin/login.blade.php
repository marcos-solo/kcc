<!DOCTYPE html>
<html lang="en" x-data>
<head>
  <meta charset="UTF-8">
  <title>KCCWG Admin Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #f5f5f5;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      position: relative;
    }
    .btn-kccwg {
      background-color: #2f855a;
      color: white;
      border: none;
      transition: all 0.3s;
    }
    .btn-kccwg:hover {
      background-color: #276749;
    }
    .spinner-overlay {
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      display: none;
      z-index: 10;
      flex-direction: column;
    }
    .spinner-overlay.show {
      display: flex;
    }
  </style>
</head>
<body>

<div class="login-box">
  <!-- Spinner overlay -->
  <div id="spinner" class="spinner-overlay">
    <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
      <span class="visually-hidden">Loading...</span>
    </div>
    <p class="mt-3">Logging in, please wait...</p>
  </div>

  <img src="{{ asset('images/kcclogo.jpeg') }}" alt="KCCWG Logo" style="height:80px; margin-bottom:15px;">
  <h3>KCCWG Admin Portal</h3>

  <form id="loginForm" method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <div class="mt-3">
      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
    </div>
    <div class="mt-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-kccwg mt-4 w-100">Login</button>
  </form>

  @if($errors->any())
    <div class="alert alert-danger mt-3">
      {{ $errors->first() }}
    </div>
  @endif

  @if(session('status'))
    <div class="alert alert-success mt-3">
      {{ session('status') }}
    </div>
  @endif
</div>

<script>
  const form = document.getElementById('loginForm');
  const spinner = document.getElementById('spinner');

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // prevent default submission

    // Show spinner
    spinner.classList.add('show');

    // Delay 3 seconds, then submit
    setTimeout(() => {
      form.submit();
    }, 3000);
  });
</script>

</body>
</html>
