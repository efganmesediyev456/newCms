<div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
    <!-- Navigation -->
    <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="ti ti-home menu-icon fs-5"></i>
                <span>Ana Səhifə</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="ti ti-clipboard menu-icon fs-5"></i>
                <span>Sifarişlər</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.index') }}">
            <i class="ti ti-user fs-5 menu-icon"></i> 
            <span>Müştərilər</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#sidebarAnalytics" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAnalytics">
                <i class="ti ti-settings menu-icon fs-5"></i>
                <span>Tənzimləmələr</span>
            </a>
            <div class="collapse" id="sidebarAnalytics">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('call_statuses.index') }}">
                            <i class="ti ti-phone menu-icon fs-5 "></i> Zəng statusları
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a href="{{ route('order_statuses.index') }}" class="nav-link">
                            <i class="ti ti-shopping-cart menu-icon fs-5"></i> Sifariş statusları
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a href="{{ route('sources.index') }}" class="nav-link">
                            <i class="ti ti-map-pin menu-icon fs-5"></i> Mənbə
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a href="{{ route('customer_sources.index') }}" class="nav-link">
                            <i class="ti ti-database menu-icon fs-5"></i> Müştəri mənbələri
                        </a>
                    </li>
                </ul><!--end nav-->
            </div><!--end sidebarAnalytics-->
        </li>


    </ul>
    <ul class="navbar-nav tab-pane" id="Extra" role="tabpanel">
        <li>
            <div class="update-msg text-center position-relative">
                <button type="button" class="btn-close position-absolute end-0 me-2" aria-label="Close"></button>
                <img src="assets/images/speaker-light.png" alt="" class="" height="110">
                <h5 class="mt-0">Mannat Themes</h5>
                <p class="mb-3">We Design and Develop Clean and High Quality Web Applications</p>
                <a href="javascript: void(0);" class="btn btn-outline-warning btn-sm">Upgrade your plan</a>
            </div>
        </li>
    </ul><!--end navbar-nav--->
</div><!--end sidebarCollapse-->
