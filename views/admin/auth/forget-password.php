<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password - Demo Admin Panel</title>
  <meta name="description" content="Reset your Demo Admin Panel password using email and OTP verification.">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
    body { background:#fefefe; display:flex; justify-content:center; align-items:center; min-height:100vh; padding:20px; }
    .container { background:#fff; border-radius:20px; padding:40px 30px; max-width:420px; width:100%; text-align:center; box-shadow:0 0 30px rgba(0,0,0,0.05); border:1px solid #eaeaea; }
    h1 { font-size:24px; font-weight:600; margin-bottom:10px; }
    .tagline { font-size:14px; color:#555; margin-bottom:25px; }
    form { display:flex; flex-direction:column; align-items:center; }
    input[type="email"], input[type="text"], input[type="password"] { width:100%; padding:14px 20px; margin-bottom:18px; border:1px solid #ccc; border-radius:50px; font-size:15px; transition:0.3s; }
    input:focus { border-color:#000; outline:none; box-shadow:0 0 0 3px rgba(0,0,0,0.1); }
    button { width:100%; padding:14px; border:none; border-radius:50px; background:#000; color:#fff; font-size:16px; font-weight:600; cursor:pointer; transition:0.3s; margin-top:5px; }
    button:hover { transform:scale(1.03); box-shadow:0 8px 25px rgba(0,0,0,0.2); }
    .back-link { margin-top:20px; font-size:14px; }
    .back-link a { color:#0073e6; text-decoration:none; font-weight:500; }
    .back-link a:hover { text-decoration:underline; }
    .hidden { display:none; }
    @media (max-width:480px) { .container { padding:30px 20px; } }
  </style>
</head>
<body>
  <div class="container">
    <!-- Place this in your HTML body where messages should appear -->
<?php if(isset($_SESSION['success'])): ?>
<div class="alert success">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<div class="alert error">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
</div>
<?php endif; ?>

<style>
.alert {
    max-width: 420px;
    margin: 20px auto;
    padding: 15px 20px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    opacity: 0;
    transform: translateY(-10px);
    animation: slideDown 0.5s forwards;
}

.alert.success {
    background: #e6f4ea;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
}

.alert.error {
    background: #fdecea;
    color: #c62828;
    border: 1px solid #f5c6cb;
}

@keyframes slideDown {
    to { opacity: 1; transform: translateY(0); }
}
</style>

    <h1>Forgot Password?</h1>
    <div class="tagline">Reset your password using email and OTP verification.</div>

    <?php
       if(!isset($_SESSION['email_otp']) AND !isset($_SESSION['verify_complete'])):
    ?>
    <!-- Step 1: Email input -->
    <form id="emailForm" method="POST" action="/send-otp">
      <input type="email" name="email" placeholder="Enter your Email" required>
      <button type="submit">Send OTP</button>
    </form>
    <?php endif ?>

    <?php if(isset($_SESSION['email_otp'])): ?>

    <!-- Step 2: OTP input -->
    <form id="otpForm" method="POST" action="/verify-otp" >
      <input type="text" name="otp" placeholder="Enter OTP" required>
      <button type="submit">Verify OTP</button>
    </form>

    <?php endif ?>

    <?php if(isset($_SESSION['verify_complete']) ): ?>

    <!-- Step 3: New Password -->
    <form id="newPasswordForm" method="POST" action="/reset-password">
      <input type="hidden" name="verify_complete_email" value="<?=$_SESSION['verify_complete']?>" id="">
      <input type="password" name="new_password" placeholder="New Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Reset Password</button>
    </form>

    <?php endif ?>

    <div class="back-link">
      <a href="/login">← Back to Login</a>
    </div>
  </div>

</body>
</html>
