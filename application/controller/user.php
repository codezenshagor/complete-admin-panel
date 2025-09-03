<?php
if($request[0]=='add-user'){
    adminAuth();
    require_once 'views/admin/users/add-user.php';
    die();
}

if($request[0]=='users-list'){
    adminAuth();
    require_once 'views/admin/users/user-list.php';
    die();
}

?>