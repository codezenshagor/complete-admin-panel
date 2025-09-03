<?php

if(isset($_SESSION['ip_block'])){
     require_once 'views/admin/auth/blocked.php';
     exit;
}

$login = new LoginModel($db);
if($request[0]=='' || $request[0]=='login'){
    if ($login->checkLogin()) {
        $_SESSION['success'] = "You are already logged in.";
        header("Location:/dashboard");
        exit;
    }

    if (isset($_POST['username_or_email']) && isset($_POST['password'])) {
        $usernameOrEmail = $_POST['username_or_email'];
        $password = $_POST['password'];
        $remember = isset($_POST['remember']);

        if ($login->login($usernameOrEmail, $password, $remember)) {
            header("Location: /dashboard");
            exit;
        } else {
            $_SESSION['error'] = "Invalid credentials.";
            header("Location: /login");
            exit;
        }
    }
    require_once 'views/admin/auth/login.php';
    exit;
}

if($request[0]=='forgot-password'){
   require_once 'views/admin/auth/forget-password.php';
   exit;
}
if($request[0]=='send-otp'){
    if(isset($_POST['email'])){
        $auth = new LoginModel($db);
        $email = $_POST['email'];
        $auth->sendEmailOtp($email);
        header("Location:/forgot-password");
    }
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'];



if($request[0] == 'verify-otp' && isset($_POST['otp'])){
    // Check if IP is blocked
    if(isset($_SESSION['ip_block'][$ip]) && time() < $_SESSION['ip_block'][$ip]){
        $_SESSION['error'] = "Too many failed attempts. Your IP is blocked. Try after ".ceil(($_SESSION['ip_block'][$ip]-time())/60)." minutes.";
        header("Location:/blocked"); exit;
    }

    $inputOtp = $_POST['otp'];
    if(!isset($_SESSION['email_otp'])){
        $_SESSION['error'] = "No OTP request found. Please try again.";
        header("Location:/forgot-password"); exit;
    }

    $otpData = &$_SESSION['email_otp'];

    if(time() > $otpData['expires']){
        unset($_SESSION['email_otp']);
        $_SESSION['error'] = "OTP expired. Please request a new one.";
        header("Location:/forgot-password"); exit;
    }

    if($otpData['attempts'] <= 0){
        $_SESSION['ip_block'][$ip] = time() + 600; // Block 10 min
        unset($_SESSION['email_otp']);
        $_SESSION['error'] = "Maximum OTP attempts exceeded. Your IP is blocked for 10 minutes.";
        header("Location:/blocked"); exit;
    }

    if(password_verify($inputOtp, $otpData['otp'])){
        $_SESSION['verify_complete'] = $otpData['email'];
        unset($_SESSION['email_otp']);
        $_SESSION['success'] = "OTP verified successfully. You can reset your password now.";
        header("Location:/forgot-password"); exit;
    } else {
        $otpData['attempts'] -= 1;
        $_SESSION['error'] = "Invalid OTP. Attempts left: {$otpData['attempts']}";
        header("Location:/forgot-password"); exit;
    }
}





if($request[0] == 'reset-password' && isset($_POST['verify_complete_email'], $_POST['new_password'], $_POST['confirm_password'])){

    $email = $_POST['verify_complete_email'];

    // Check if verify_complete session exists
    if(!isset($_SESSION['verify_complete']) || $_SESSION['verify_complete'] !== $email){
        $_SESSION['error'] = "Unauthorized action. Please verify OTP first.";
        header("Location:/forgot-password"); exit;
    }

    // Check if OTP session existed before (optional, stronger security)
    if(isset($_SESSION['email_otp'])){
        $otpData = $_SESSION['email_otp'];
        if(time() > $otpData['expires']){
            unset($_SESSION['email_otp'], $_SESSION['verify_complete']);
            $_SESSION['error'] = "OTP expired. Request a new one.";
            header("Location:/forgot-password"); exit;
        }
    }

    // Passwords
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password match
    if($new_password !== $confirm_password){
        $_SESSION['error'] = "Passwords do not match.";
        header("Location:/forgot-password"); exit;
    }

    // Optional: Check password strength
    if(strlen($new_password) < 6){
        $_SESSION['error'] = "Password must be at least 6 characters.";
        header("Location:/forgot-password"); exit;
    }

    // Hash password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update DB
    $update = $db->update("UPDATE users SET password=? WHERE email=?", [$hashed_password, $email]);

    if($update){
        unset($_SESSION['verify_complete'], $_SESSION['email_otp']);
        $_SESSION['success'] = "Password updated successfully. You can now login.";
        header("Location:/login"); exit;
    }else{
        $_SESSION['error'] = "Failed to update password. Try again later.";
        header("Location:/forgot-password"); exit;
    }
}







if($request[0]=='logout'){
    session_unset();
    session_destroy();
    setcookie('remember_me', '', time() - 3600, "/"); // Expire the cookie
     $_SESSION['success'] = "You have been logged out successfully.";
    header("Location: /login");
    exit;
}

if (!$login->checkLogin()) {
    $_SESSION['error'] = "Please login to access the admin panel.";
    header("Location:/login");
    exit;
}
?>