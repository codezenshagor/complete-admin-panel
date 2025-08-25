<div class="app-wrapper">
     <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                  
                    <!--end::Navbar Search-->

                    <!--begin::Messages Dropdown Menu-->
                    <li class="nav-item dropdown d-none">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="fa-regular fa-comments"></i>
                            <span class="navbar-badge badge text-bg-danger">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="<?=$urls?>views/admin/script/assets/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"><i class="fa-solid fa-star"></i></span>
                                        </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="fa-regular fa-clock me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="<?=$urls?>views/admin/script/assets/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-end fs-7 text-secondary">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">I got your message bro</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="fa-regular fa-clock me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="<?=$urls?>views/admin/script/assets/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-end fs-7 text-warning">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">The subject goes here</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="fa-regular fa-clock me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!--end::Messages Dropdown Menu-->

                    <!--begin::Notifications Dropdown Menu-->
                    <li class="nav-item dropdown d-none">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="fa-regular fa-bell"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-users me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa-solid fa-file me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">
                                See All Notifications
                            </a>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?=$urls?>views/admin/script/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline"><?=$_SESSION['user_name']?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="<?=$urls?>views/admin/script/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">

                                <p>
                                    <?=$_SESSION['user_name']?>
                                   
                                </p>
                            </li>
                            <!--end::User Image-->

                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                <a href="/logout" class="btn btn-default btn-flat float-end">Log out</a>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="<?=$urls?>dashboard" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="<?=$urls?>views/admin/script/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">Email Marketing</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>
                                    Dashboard
                                    <i class="nav-arrow fa-solid fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=$urls?>dashboard" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=$urls?>blank" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Blank</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>

                                <p>
                                   Users
                                    <i class="nav-arrow fa-solid fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=$urls?>add-user" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Add Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=$urls?>users-list" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Users List</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                       
                        <li class="nav-item">
                            <a href="../docs/introduction.html" class="nav-link ">
                                <i class="nav-icon fa-solid fa-download"></i>
                                <p>information</p>
                            </a>
                        </li>

                    <li class="nav-item">
                            <a href="/profile" class="nav-link ">
                               <i class="nav-icon fa-solid fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                  <i class="nav-icon text-danger fa-solid fa-right-from-bracket"></i>
                                <p class='text-danger fw-bold'>Log out</p>
                            </a>
                        </li>

                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Current page
    const currentPage = window.location.pathname.split("/").pop();

    // Get all sidebar links
    const links = document.querySelectorAll('.sidebar-wrapper a.nav-link');

    links.forEach(link => {
        const linkPage = link.getAttribute('href').split('/').pop();

        if(linkPage === currentPage) {
            // Add active class to the current link
            link.classList.add('active');

            // Check if it's inside a submenu
            const treeviewUl = link.closest('.nav-treeview');
            if(treeviewUl) {
                const parentLi = treeviewUl.closest('.nav-item'); // this is the parent menu
                if(parentLi) {
                    parentLi.classList.add('menu-open');
                    const parentLink = parentLi.querySelector(':scope > .nav-link');
                    if(parentLink) parentLink.classList.add('active');
                }
            }
        }
    });
});

</script>



        