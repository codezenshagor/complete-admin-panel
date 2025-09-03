<?php
// $host = 'localhost';     // database host
// $db   = 'zksoftt1_test'; // database name
// $user = 'zksoftt1_test';     // database username
// $pass = '9A7K3k6abd8wbE8.'; // database password
// $charset = 'utf8mb4';    // charset
$host = 'localhost';     // database host
$db   = 'email_sender'; // database name
$user = 'root';     // database username
$pass = ''; // database password
$charset = 'utf8mb4';    // charset
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // fetch associative arrays by default
    PDO::ATTR_EMULATE_PREPARES   => false,                  // use real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



function flash_message() {
    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        $type = isset($_SESSION['success']) ? 'success' : 'error';
        $message = $_SESSION['success'] ?? $_SESSION['error'];

        // Ensure message is string
        if (is_array($message)) {
            // Safely convert array to string
            $message = implode(", ", array_map('strval', $message));
        } else {
            $message = strval($message);
        }

        echo "<script>
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: '5000'
            };
            toastr['$type']('".addslashes($message)."', '".($type === 'success' ? 'Success' : 'Error')."');
        }
        </script>";

        unset($_SESSION['success'], $_SESSION['error']);
    }
}


function adminAuth(){
    if($_SESSION['role']!='admin'){
        $_SESSION['error'] = "This page only access admin";
        header("Location:/dashboard");
        exit;
    }
}
?>
