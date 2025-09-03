<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'application/mail/vendor/autoload.php';
class LoginModel {
    private $db;
    private $cookieName = 'remember_me';

    public function __construct(Database $db) {
        $this->db = $db;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


   public function sendEmailOtp($email){
    $select = $this->db->select("SELECT users.id FROM users WHERE email=?",[$email]);
    if($select){
    $otp = rand(100000, 999999);
    $_SESSION['email_otp'] = [
        'otp' => password_hash($otp, PASSWORD_DEFAULT),
        'email' => $email,
        'expires' => time() + 300,
        'attempts' => 5
    ];

    $subject = "Your OTP Code - Demo Admin Panel";
   $body = '
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
body{
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#667eea,#764ba2);
    margin:0;padding:0;
}
.container{
    max-width:600px;
    margin:50px auto;
    background:#fff;
    border-radius:20px;
    padding:40px 30px;
    box-shadow:0 12px 40px rgba(0,0,0,0.2);
    text-align:center;
}
h2{
    color:#333;
    font-size:26px;
    margin-bottom:15px;
}
p{
    color:#555;
    font-size:16px;
    line-height:1.6;
}
.otp{
    display:block;
    font-size:36px;
    letter-spacing:6px;
    font-weight:bold;
    margin:25px 0;
    color:#667eea;
    text-align:center;
    background:#f0f4ff;
    padding:15px 0;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
.footer{
    font-size:12px;
    color:#999;
    margin-top:30px;
}
</style>
</head>
<body>
<div class="container">
    <h2>Your OTP Code</h2>
    <p>Hello,</p>
    <p>Use the following One-Time Password (OTP) to verify your email. It is valid for <strong>5 minutes</strong>.</p>
    <span class="otp">'.$otp.'</span>
    <p>If you did not request this OTP, please ignore this email.</p>
    <div class="footer">&copy; '.date('Y').' Demo Admin Panel. All rights reserved.</div>
</div>
</body>
</html>';


    $mail = new PHPMailer(true);
    try{
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = "mail.shagor.top";
        $mail->SMTPAuth = true;
        $mail->Username = "admin@shagor.top";
        $mail->Password = "demo-password";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('no-reply@shagor.top','Demo Admin Panel');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
       $_SESSION['success'] = "OTP has been sent to <strong>$email</strong>. Please check your inbox or spam folder.";
    }catch(Exception $e){
        $_SESSION['error'] = "Oops! Something went wrong while sending the email. Please try again.";
    }
}else{
      $_SESSION['error'] = "The email <strong>$email</strong> does not match our records. Please try again.";
}
}

    // Login user
    public function login($usernameOrEmail, $password, $remember = false) {
        // Fetch user by username or email
        $sql = "SELECT * FROM users WHERE user_name=:username OR email=:email LIMIT 1";
        $user = $this->db->fetch($sql, [
            ':username' => $usernameOrEmail,
            ':email' => $usernameOrEmail
        ]);

        if ($user && password_verify($password, $user['password'])) {
            // Correct password, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Remember me cookie
            if ($remember) {
                $cookieData = json_encode(['user_id' => $user['id']]);
                setcookie($this->cookieName, $cookieData, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            }
            return true;
        } else {
            return false; // invalid credentials
        }
    }

    // Check login
    public function checkLogin() {
        // Session check
        if (isset($_SESSION['user_id'])) {
            $sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
            $user = $this->db->fetch($sql, [':id' => $_SESSION['user_id']]);
            if ($user) {
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                return true;
            } else {
                $this->logout();
                return false;
            }
        }

        // Cookie check
        if (isset($_COOKIE[$this->cookieName])) {
            $data = json_decode($_COOKIE[$this->cookieName], true);
            if ($data && isset($data['user_id'])) {
                $sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
                $user = $this->db->fetch($sql, [':id' => $data['user_id']]);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    return true;
                } else {
                    $this->logout();
                    return false;
                }
            } else {
                $this->logout();
                return false;
            }
        }

        return false;
    }

    // Logout user
    public function logout() {
        if (isset($_SESSION)) {
            session_unset();
            session_destroy();
        }
        if (isset($_COOKIE[$this->cookieName])) {
            setcookie($this->cookieName, '', time() - 3600, "/");
        }
    }
}
?>
