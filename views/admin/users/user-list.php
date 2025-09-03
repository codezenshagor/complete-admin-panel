<?php
$userModel = new UserModel($db);
if (isset($_GET['delete_id'])) {
    $userModel->deleteUser($_GET['delete_id']);
    $_SESSION['success'] = "User deleted successfully.";
    header("Location: /users-list");
    exit;
}

// Handle Edit
$editUser = null;
if (isset($_GET['edit_id'])) {
    $editUser = $userModel->getUserById($_GET['edit_id']);
}

// Fetch all users
$users = $userModel->getAllUsers();
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

        <!-- Users Table -->
        <div class="card">
            <div class="card-header"><h3>Users List</h3></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered p-2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>NID Card</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['user_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td><?= $user['address'] ?></td>
                            <td><?= $user['birthday'] ?></td>
                            <td><?= $user['nid_card'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td>
                                <a href="/add-user?edit_id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/users-list?delete_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if(empty($users)): ?>
                        <tr><td colspan="10" class="text-center">No users found</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<?php include 'views/admin/section/footer.php'; ?>
