<?php
$db = new Database($pdo);
$userModel = new UserModel($db);

// Handle Add / Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'user_name' => $_POST['user_name'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'password' => $_POST['password'],
        'address' => $_POST['address'] ?? null,
        'birthday' => $_POST['birthday'] ?? null,
        'nid_card' => $_POST['nid_card'] ?? null
    ];

    if (!empty($_POST['id'])) {
        // Update existing user
       $userss = $userModel->updateUser($_POST['id'], $data);
        if($userss==1){
            $_SESSION['success'] = "User updated successfully.";
        }else{
            $_SESSION['error'] = "Username or Email already exists.";
        }
        
        header("Location: /users-list");
        exit;
    } else {
        // Insert new user
       $userss1 = $userModel->insertUser($data);
       if($userss1==1){
            $_SESSION['success'] = "User add successfully.";
        }else{
            $_SESSION['error'] = "Username or Email already exists.";
        }
        header("Location: /users-list");
        exit;
    }
}

// Handle Edit
$editUser = null;
if (isset($_GET['edit_id'])) {
    $editUser = $userModel->getUserById($_GET['edit_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <?php include 'views/admin/section/css.php'; ?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<?php include 'views/admin/section/navber.php'; ?>

<main class="app-main">
    <div class="container-fluid mt-5">

        <!-- Add / Edit Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><?= $editUser ? 'Edit User' : 'Add User' ?></h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if ($editUser): ?>
                        <input type="hidden" name="id" value="<?= $editUser['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required value="<?= $editUser['name'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="user_name" class="form-control" required value="<?= $editUser['user_name'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="<?= $editUser['email'] ?? '' ?>">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="" disabled <?= !isset($editUser) ? 'selected' : '' ?>>Select role</option>
                            <option value="admin" <?= (isset($editUser['role']) && $editUser['role']=='admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="users" <?= (isset($editUser['role']) && $editUser['role']=='users') ? 'selected' : '' ?>>Users</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" 
                            placeholder="<?= $editUser ? 'Leave blank to keep current password' : 'Enter password' ?>" 
                            <?= $editUser ? '' : 'required' ?>>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?= $editUser['address'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Birthday</label>
                        <input type="date" name="birthday" class="form-control" value="<?= $editUser['birthday'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NID Card</label>
                        <input type="text" name="nid_card" class="form-control" value="<?= $editUser['nid_card'] ?? '' ?>">
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $editUser ? 'Update User' : 'Add User' ?></button>
                    <?php if ($editUser): ?>
                        <a href="/user-list" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        

    </div>
</main>

<?php include 'views/admin/section/footer.php'; ?>
