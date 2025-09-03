<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Demo Admin Panel - Login</title>
  <meta name="description" content="Demo Admin Panel Login page. Securely access the demo dashboard and manage content.">
  <meta name="keywords" content="demo admin panel, login, secure dashboard, <?= $urls ?>">
  <meta name="author" content="Demo Admin Panel">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #ffffff;
      color: #000000;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      background-color: #fff;
      border-radius: 20px;
      padding: 50px 30px;
      max-width: 420px;
      width: 100%;
      text-align: center;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
      transition: 0.3s ease;
      border: 1px solid #eaeaea;
    }

    h1 {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .tagline {
      font-size: 14px;
      color: #555;
      margin-bottom: 30px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 14px 20px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      background: #fff;
      color: #000;
      border-radius: 50px;
      font-size: 15px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #000;
      outline: none;
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .remember {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      margin-bottom: 25px;
      font-size: 14px;
      color: #333;
    }

    .remember input[type="checkbox"] {
      margin-right: 10px;
      transform: scale(1.1);
      accent-color: #000;
    }

    .remember a {
      color: #0073e6;
      text-decoration: none;
      font-size: 14px;
    }

    .remember a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 50px;
      background: #000;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .about {
      margin-top: 35px;
      font-size: 13px;
      color: #666;
      line-height: 1.6;
    }

    @media (max-width: 480px) {
      .container {
        padding: 40px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Login to Demo Admin Panel</h1>
    <div class="tagline">Access your demo dashboard at <strong><?= $urls ?></strong></div>
    <form method="POST" action="/login">
      <input type="text" name="username_or_email" placeholder="Email or Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <div class="remember">
        <div>
          <input type="checkbox" name="remember" id="remember" />
          <label for="remember">Remember Me</label>
        </div>
        <a href="/forgot-password">Forgot Password?</a>
      </div>
      <button type="submit">Login</button>
    </form>
    <div class="about">
      <div class="contact" style="margin-top:25px; padding:15px; border-radius:12px; background:#f9f9f9; border:1px solid #eee; font-size:14px; line-height:1.6;">
        Welcome to the <strong>Demo Admin Panel</strong>!  
        Manage your content, users, and settings securely from one place.  
        This is a demonstration panel designed for testing and learning purposes only.
      </div>
    </div>
  </div>

  <!-- In your <head> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Before closing </body> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <?php flash_message(); ?>
</body>
</html>
