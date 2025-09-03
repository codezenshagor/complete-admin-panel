<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Dashboard</title>
    <?php include 'views/admin/section/css.php'; ?>

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <?php include 'views/admin/section/navber.php'; ?>

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->


<!-- ✅ TOTAL USERS (only admin) -->
<?php if($_SESSION['role']=='admin'): ?>
<div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
        <div class="inner">
            <h3>
                <?php
                   $select = $db->fetch("SELECT COUNT(*) as total FROM users WHERE role='users'");
                   echo $select['total'];
                ?>
            </h3>
            <p>Total Users</p>
        </div>
        <svg class="small-box-icon" ...></svg>
        <a href="/users-list" class="small-box-footer">
            More info <i class="fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<?php endif; ?>

<!-- ✅ TOTAL MAIL LOG -->
<div class="col-lg-3 col-6">
    <div class="small-box text-bg-success">
        <div class="inner">
            <h3>00</h3>
            <p>Total Mail Send</p>
        </div>
        <svg class="small-box-icon" ...></svg>
        <a href="/email-list" class="small-box-footer">
            More info <i class="fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<!-- ✅ PENDING MAIL -->
<div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
        <div class="inner">
            <h3>00
                <sup style="font-size:16px">00</sup>
            </h3>
            <p>Pending Email</p>
        </div>
        <svg class="small-box-icon" ...></svg>
        <a href="/reply-rcv-list" class="small-box-footer">
            More info <i class="fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<!-- ✅ SEEN MAIL -->
<div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
        <div class="inner">
            <h3> 
                00
            </h3>
            <p>Total Seen</p>
        </div>
        <svg class="small-box-icon" ...></svg>
        <a href="/send-mail" class="small-box-footer">
            More info <i class="fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<!-- ✅ UNSEEN MAIL -->
<div class="col-lg-3 col-6">
    <div class="small-box text-bg-info">
        <div class="inner">
            <h3>0
                
            </h3>
            <p>Total Unseen</p>
        </div>
        <svg class="small-box-icon" ...></svg>
        <a href="/send-mail" class="small-box-footer">
            More info <i class="fa-solid fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<!--end::Col-->
</div>
<!--end::Row-->


                    <!--begin::Row-->
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Email Feedback</h3>
                                </div>

                                    <div class="card-body">
                                        <canvas id="feedback-chart" style="width:100%; height:400px;"></canvas>
                                    </div>


                            </div>
                            <!-- /.card -->

                        
                        </div>
                        <!-- /.Start col -->

                    
                        <!-- /.Start col -->
                    </div>
                    <!-- /.row (main row) -->

                    <div class="row mt-4">

</div>

                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <?php include 'views/admin/section/footer.php'; ?>


