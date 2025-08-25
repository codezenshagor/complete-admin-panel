<?php
if($request[0]=='dashboard'){
    require_once 'views/admin/dashboard/index.php';
    die();
}
if($request[0]=='blank'){
    require_once 'views/admin/dashboard/blank.php';
    die();
}
?>