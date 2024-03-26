<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ route('admin') }}"><img
                src="{{ asset('Admin/images/setting/' . $setting->logo) }}" class="main-logo" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ route('admin') }}"><img
                src="{{ asset('Admin/images/setting/' . $setting->logo) }}" class="logo-icon" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ auth()->user()->image }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="side-item side-item-category">{{ __('admin.main') }}</li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin') }}"><i class="fe fe-home ml-3"
                        style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.main') }}</span></a>
            </li>
            @can('roles')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-users ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.roles') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('roles') }}">{{ __('admin.roles') }}</a>
                        </li>
                        @can('addRole')
                            <li><a class="slide-item" href="{{ route('addRole') }}">{{ __('admin.addRole') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('employee')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-users ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.employees') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('employee') }}">{{ __('admin.employees') }}</a>
                        </li>
                        @can('addEmployee')
                            <li><a class="slide-item" href="{{ route('addEmployee') }}">{{ __('admin.add_employee') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('admins')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-users ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.admins') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('admins') }}">{{ __('admin.admins') }}</a>
                        </li>
                        @can('addAdmin')
                            <li><a class="slide-item" href="{{ route('addAdmin') }}">{{ __('admin.addAdmin') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('users')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-users ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.users') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('users') }}">{{ __('admin.users') }}</a>
                        </li>
                        @can('addUser')
                            <li><a class="slide-item" href="{{ route('addUser') }}">{{ __('admin.add_user') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('setting_change')
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('setting') }}"><i class="fe fe-settings ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.setting') }}</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-aperture ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.socials') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('socials.index') }}">{{ __('admin.all_socials') }}</a>
                        </li>
                        <li><a class="slide-item" href="{{ route('socials.create') }}">{{ __('admin.add_social') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="side-item side-item-category">{{ __('admin.additional_data') }}</li>
            @can('sliders')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.sliders') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        <li><a class="slide-item" href="{{ route('sliders') }}">{{ __('admin.sliders') }}</a>
                        </li>
                        @can('addSlider')
                            <li><a class="slide-item" href="{{ route('addSlider') }}">{{ __('admin.add_slider') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('categories')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span
                            class="side-menu__label">{{ __('admin.categories') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        <li><a class="slide-item" href="{{ route('categories') }}">{{ __('admin.categories') }}</a>
                        </li>
                        @can('addNews')
                            <li><a class="slide-item" href="{{ route('addNews') }}">{{ __('admin.addNews') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('products')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span
                            class="side-menu__label">{{ __('admin.products') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        <li><a class="slide-item" href="{{ route('products') }}">{{ __('admin.products') }}</a>
                        </li>
                        @can('addProduct')
                            <li><a class="slide-item" href="{{ route('addProduct') }}">{{ __('admin.add_product') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('Chopping')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span
                            class="side-menu__label">{{ __('admin.Chopping') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        <li><a class="slide-item" href="{{ route('Chopping') }}">{{ __('admin.Chopping') }}</a>
                        </li>
                        @can('addChopping')
                            <li><a class="slide-item" href="{{ route('addChopping') }}">{{ __('admin.addChopping') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('Wrapping')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span
                            class="side-menu__label">{{ __('admin.Wrapping') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        <li><a class="slide-item" href="{{ route('Wrapping') }}">{{ __('admin.Wrapping') }}</a>
                        </li>
                        @can('addWrapping')
                            <li><a class="slide-item" href="{{ route('addWrapping') }}">{{ __('admin.addWrapping') }}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('notifications')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span
                            class="side-menu__label">{{ __('admin.notifications') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('notifications')
                            <li><a class="slide-item"
                                    href="{{ route('notifications') }}">{{ __('admin.notifications') }}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('about')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.abouts') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('about')
                            <li><a class="slide-item" href="{{ route('about') }}">{{ __('admin.abouts') }}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('terms')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.terms') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('about')
                            <li><a class="slide-item" href="{{ route('terms') }}">{{ __('admin.terms') }}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('contact')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="javascript:void();"><i class="fe fe-grid ml-3"
                            style="font-size: 16px"></i><span class="side-menu__label">{{ __('admin.contact') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('contact')
                            <li><a class="slide-item" href="{{ route('contact') }}">{{ __('admin.contact') }}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
