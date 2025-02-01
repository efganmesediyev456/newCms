<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="utf-8" />
    <title> | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    App favicon
    <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

   @include('inc.styles')

</head>


<body id="body" class="dark-sidebar">
<!-- leftbar-tab-menu -->
<div class="left-sidebar">
    <!-- LOGO -->
    <div class="brand">
        <a href="index.html" class="logo">
                    <span>
                        <img src="/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
            <span>
                        <img src="/assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                    </span>
        </a>
    </div>


    <!-- Tab panes -->

    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical">
            @include('inc.sidebar')
        </div>
    </div>
</div>
<!-- end left-sidenav-->
<!-- end leftbar-tab-menu-->

<!-- Top Bar Start -->
<!-- Top Bar Start -->
<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom" id="navbar-custom">
        <ul class="list-unstyled topbar-nav float-end mb-0">


            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-mail"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                    <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Emails <span class="badge bg-soft-primary badge-pill">3</span>
                    </h6>
                    <div class="notification-menu" data-simplebar>
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="assets/images/users/user-1.jpg" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">10 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="assets/images/users/user-4.jpg" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">40 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="assets/images/users/user-2.jpg" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">1 hr ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="assets/images/users/user-5.jpg" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 hrs ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="assets/images/users/user-3.jpg" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-bell"></i>
                    <span class="alert-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                    <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Notifications <span class="badge bg-soft-primary badge-pill">2</span>
                    </h6>
                    <div class="notification-menu" data-simplebar>
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-chart-arcs"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">10 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-device-computer-camera"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">40 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-diamond"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">1 hr ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-drone"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 hrs ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img src="/assets/images/users/user-4.jpg" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                        <div>
                            <span class="d-none d-md-block fw-semibold font-12">{{ auth()->user()->name }} <i
                                    class="mdi mdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Settings</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
                </div>
            </li><!--end topbar-profile-->

        </ul><!--end topbar-nav-->


    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->
<!-- Top Bar End -->

<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

        <div class="container-fluid">
            @include('inc.breadcrumbs')
            @yield('content')
        </div><!-- container -->

        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h6>Account Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch1">
                        <label class="form-check-label" for="settings-switch1">Auto updates</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                        <label class="form-check-label" for="settings-switch2">Location Permission</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch3">
                        <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->
                <h6>General Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch4">
                        <label class="form-check-label" for="settings-switch4">Show me Online</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                        <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch6">
                        <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->
            </div><!--end offcanvas-body-->
        </div>
        <!--end Rightbar/offcanvas-->
        <!--end Rightbar-->

        <!--Start Footer-->
        <!-- Footer Start -->
        <footer class="footer text-center text-sm-start">
            &copy; <script>
                document.write(new Date().getFullYear())
            </script>  <span class="text-muted d-none d-sm-inline-block float-end"><a href="https://166tech.az">166 TECH</a> tərəfindən hazırlanıb</span>
        </footer>
        <!-- end Footer -->
        <!--end footer-->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- Javascript  -->
<!-- App js -->

@include('inc.scripts')
@stack('js')

</body>
<!--end body-->
</html>
