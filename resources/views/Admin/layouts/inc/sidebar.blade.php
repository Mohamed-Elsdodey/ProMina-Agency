<!-- ========== App Menu ========== -->
{{--@php--}}
{{--    $settings=\App\Models\Setting::first();--}}
{{--@endphp--}}
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    {{--    <div class="navbar-brand-box">--}}
    {{--        <!-- Dark Logo-->--}}
    {{--        <a href="{{route('admin.index')}}" class="logo logo-dark">--}}
    {{--                    <span class="logo-sm">--}}
    {{--                        <img src="{{get_file($settings->header_logo)}}" alt="" height="22">--}}
    {{--                    </span>--}}
    {{--            <span class="logo-lg">--}}
    {{--                        <img src="{{get_file($settings->header_logo)}}" alt="" height="17">--}}
    {{--                    </span>--}}
    {{--        </a>--}}
    {{--        <!-- Light Logo-->--}}
    {{--        <a href="{{route('admin.index')}}" class="logo logo-light">--}}
    {{--                    <span class="logo-sm">--}}
    {{--                        <img src="{{get_file($settings->header_logo)}}" alt="" height="22">--}}
    {{--                    </span>--}}
    {{--            <span class="logo-lg">--}}
    {{--                        <img src="{{get_file($settings->header_logo)}}" alt="" height="17">--}}
    {{--                    </span>--}}
    {{--        </a>--}}
    {{--        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"--}}
    {{--                id="vertical-hover">--}}
    {{--            <i class="ri-record-circle-line"></i>--}}
    {{--        </button>--}}
    {{--    </div>--}}

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">ADMHAN</span></li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('albums.index')}}">
                        <i class="  ri-picture-in-picture-2-fill "></i> <span data-key="t-dashboards">الالبومات</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>


