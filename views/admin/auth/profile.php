<?php
$userModel = new UserModel($db);
$auth = new LoginModel($db);

if (!$auth->checkLogin()) {
    header("Location: /login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$user = $userModel->getUserById($userId);

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        $error = "❌ Passwords do not match.";
    } elseif (strlen($newPassword) < 6) {
        $error = "❌ Password must be at least 6 characters.";
    } else {
        $user['password'] = $newPassword;
        $userModel->updateUser($userId, $user);
        $success = "✅ Password updated successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <?php include 'views/admin/section/css.php'; ?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<?php include 'views/admin/section/navber.php'; ?>

<main class="app-main">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <!-- Profile Card -->
                <div class="card shadow-sm border-0 rounded-4 mb-3">
                    <div class="card-header text-white text-center rounded-top-4"
                         style="background: linear-gradient(135deg, #0d6efd, #6610f2);">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle bg-light d-flex justify-content-center align-items-center mb-2"
                                 style="width:80px; height:80px; font-size:32px;">
                                <i class="fa-solid fa-user text-primary"></i>
                            </div>
                            <h5 class="mb-0"><?= htmlspecialchars($user['name']) ?></h5>
                            <p class="mb-0 small">👤 <?= htmlspecialchars($user['role']) ?></p>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item"><b>Username:</b> <?= htmlspecialchars($user['user_name']) ?></li>
                            <li class="list-group-item"><b>Email:</b> <?= htmlspecialchars($user['email']) ?></li>
                            <li class="list-group-item"><b>Address:</b> <?= htmlspecialchars($user['address']) ?></li>
                            <li class="list-group-item"><b>Birthday:</b> <?= htmlspecialchars($user['birthday']) ?></li>
                            <li class="list-group-item"><b>NID Card:</b> <?= htmlspecialchars($user['nid_card']) ?></li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fa-solid fa-key"></i> Change Password
                        </button>
                    </div>
                </div>

                <!-- Alerts -->
                <?php if ($error): ?>
                    <div class="alert alert-danger small mt-2"><?= $error ?></div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success small mt-2"><?= $success ?></div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<!-- Password Change Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-dark text-white rounded-top-4">
                <h6 class="modal-title"><i class="fa-solid fa-key"></i> Change Password</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-body p-3">
                    <input type="hidden" name="change_password" value="1">
                    <div class="mb-2">
                        <label class="form-label small fw-bold">New Password</label>
                        <input type="password" name="new_password" class="form-control form-control-sm" minlength="6" required>
                        <div class="invalid-feedback">At least 6 characters.</div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm" required>
                        <div class="invalid-feedback">Passwords must match.</div>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        <i class="fa-solid fa-save"></i> Update
                    </button>
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
</body>
</html>
