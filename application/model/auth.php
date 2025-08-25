<?php
class LoginModel {
    private $db;
    private $cookieName = 'remember_me';

    public function __construct(Database $db) {
        $this->db = $db;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
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
