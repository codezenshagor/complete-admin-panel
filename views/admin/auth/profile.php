<?php 
$userModel = new UserModel($db);
$auth = new LoginModel($db);

if (!$auth->checkLogin()) {
    header("Location: /login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$user = $userModel->getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name       = trim($_POST['name'] ?? '');
    $username   = trim($_POST['username'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $birthday   = trim($_POST['birthday'] ?? '');
    $nid_card   = trim($_POST['nid_card'] ?? '');

    // Unique check for username
    $checkUser = $db->fetch("SELECT id FROM users WHERE user_name = ? AND id != ?", [$username, $userId]);
    if ($checkUser) {
        $_SESSION['error'] = "Username already taken.";
        header("Location:/profile");
        exit;
    }

    // Unique check for email
    $checkEmail = $db->fetch("SELECT id FROM users WHERE email = ? AND id != ?", [$email, $userId]);
    if ($checkEmail) {
        $_SESSION['error'] = "Email already exists.";
        header("Location:/profile");
        exit;
    }

    // Update profile
    $db->update("UPDATE users SET 
                    name = ?, 
                    user_name = ?, 
                    email = ?, 
                    address = ?, 
                    birthday = ?, 
                    nid_card = ?
                 WHERE id = ?", 
                [$name, $username, $email, $address, $birthday, $nid_card, $userId]);

    $_SESSION['success'] = "Profile updated successfully!";
    header("Location:/profile");
    exit;
}


// Change password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
         $_SESSION['error'] = "Passwords do not match.";
    } elseif (strlen($newPassword) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters.";
    } else {
        $user['password'] = $newPassword;
        $userModel->updateUser($userId, $user);
        $_SESSION['success'] = "Password updated successfully!";
    }
    header("Location:/profile");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <?php include 'views/admin/section/css.php'; ?>
    <style>
        body { background: #f8f9fa; }
        .profile-container { width: 95%; margin: 30px auto; }
        .profile-card {
            border: none;
            border-radius: .75rem;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .btn-custom {
            border-radius: .5rem;
            padding: 0.5rem 1.5rem;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<?php include 'views/admin/section/navber.php'; ?>

<main class="app-main">
    <div class="profile-container">
        <div class="card profile-card p-4">
            <h4 class="mb-3">Edit Profile</h4>

            <!-- Profile Update Form -->
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="update_profile" value="1">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['user_name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="birthday" value="<?= htmlspecialchars($user['birthday']) ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">NID Card</label>
                    <input type="text" name="nid_card" value="<?= htmlspecialchars($user['nid_card']) ?>" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-custom">Save Changes</button>
                <button type="button" class="btn btn-outline-secondary btn-custom" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
            </form>
        </div>
    </div>
</main>

<!-- Password Change Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-3 shadow border-0">
            <div class="modal-header bg-light">
                <h6 class="modal-title">Change Password</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-body p-3">
                    <input type="hidden" name="change_password" value="1">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" minlength="6" required>
                        <div class="invalid-feedback">At least 6 characters.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                        <div class="invalid-feedback">Passwords must match.</div>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary w-100 btn-custom">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'views/admin/section/footer.php'; ?>
<script>
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();
</script>

