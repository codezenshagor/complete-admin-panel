<?php
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
?>
