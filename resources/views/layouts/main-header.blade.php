<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ route('admin') }}"><img src="{{ asset('Admin/images/setting/' . $setting->logo) }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ route('admin') }}"><img src="{{ asset('Admin/images/setting/' . $setting->logo) }}"
                        class="logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="javascript:void();" onclick="sidebar_session(true, 1)"><i
                        class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="javascript:void();" onclick="sidebar_session(true, 0)"><i
                        class="header-icons fe fe-x"></i></a>
            </div>
        </div>
        @include('layouts.footer')
        <div class="main-header-right">
            @if (app()->getLocale() == 'ar')
                <ul class="nav">
                    <li class="">
                        <div class="dropdown  nav-itemd-none d-md-flex">
                            <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('assets/img/flags/saudi_arabia.png') }}" width="50px"
                                        alt="img"></span>
                                <div class="my-auto">
                                    <strong class="mr-2 ml-2 my-auto">العربية</strong>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                <a href="{{ route('lang', 'en') }}" class="dropdown-item d-flex ">
                                    <span class="avatar  ml-3 align-self-center bg-transparent"><img
                                            src="{{ URL::asset('assets/img/flags/us_flag.jpg') }}"
                                            alt="img"></span>
                                    <div class="d-flex">
                                        <span class="mt-2">English</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            @else
                <ul class="nav">
                    <li class="">
                        <div class="dropdown  nav-itemd-none d-md-flex">
                            <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('assets/img/flags/us_flag.jpg') }}" alt="img"></span>
                                <div class="my-auto">
                                    <strong class="mr-2 ml-2 my-auto">English</strong>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                <a href="{{ route('lang', 'ar') }}" class="dropdown-item d-flex ">
                                    <span class="avatar  ml-3 align-self-center bg-transparent"><img
                                            src="{{ URL::asset('assets/img/flags/saudi_arabia.png') }}"
                                            alt="img"></span>
                                    <div class="d-flex">
                                        <span class="mt-2">العربية</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
            <div class="nav nav-item">
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="{{ auth()->user()->image }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt="" src="{{ auth()->user()->image }}"
                                        class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ auth()->user()->name }}</h6>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item " href="{{ route('logout') }}"><i
                                class="bx bx-log-out"></i>{{ __('admin.logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
