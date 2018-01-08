<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <a href="{{ url('/') }}"><img src="{{ asset(getSetting('SITE_LOGO')) }}" class="" alt="Logo"></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            @php

            $menus = \App\AdminMenu::pluck('title', 'name');


            @endphp
            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="{{ Request::is('admin/dashboard') ? 'active': '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ $menus['dashboard'] }}</span>
                </a>
            </li>
            <li class="{{ Request::is('/') ? 'active': '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-desktop"></i> <span>{{ $menus['home'] }}</span>
                </a>
            </li>
			
            <li class="treeview {{ Request::is('admin/user*') ? 'active': '' || Request::is('admin/role*') ? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{ $menus['users'] }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/users')? 'active': '' }}">
                        <a href="{{ url('admin/users') }}">
                            <i class="fa fa-list"></i> <span>{{ $menus['users_list'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/users/create')? 'active': '' }}">
                        <a href="{{ url('admin/users/create') }}">
                            <i class="fa fa-plus"></i> <span>{{ $menus['user_add'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/role*')? 'active': '' }}">
                        <a href="#"><i class="fa fa-key"></i> {{ $menus['user_roles'] }} <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('admin/roles')? 'active': '' }}"><a
                                        href="{{ url('admin/roles') }}"><i class="fa fa-list"></i> {{ $menus['user_roles_list'] }}</a></li>
                            <li class="{{ Request::is('admin/roles/create')? 'active': '' }}"><a
                                        href="{{ url('admin/roles/create') }}"><i class="fa fa-plus"></i> {{ $menus['user_role_add'] }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/package*') || Request::is('admin/feature*') ? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span>{{ $menus['packages'] }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/packages')? 'active': '' }}">
                        <a href="{{ url('admin/packages') }}">
                            <i class="fa fa-list"></i> <span>{{ $menus['packages_list'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/packages/create')? 'active': '' }}">
                        <a href="{{ url('admin/packages/create') }}">
                            <i class="fa fa-plus"></i> <span>{{ $menus['package_add'] }}</span>
                        </a>
                    </li>
                    <?php /*<li class="{{ Request::is('admin/features')? 'active': '' }}">
                        <a href="{{ url('admin/features') }}">
                            <i class="fa fa-list"></i> <span>管理方案細項</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/features/create')? 'active': '' }}">
                        <a href="{{ url('admin/features/create') }}">
                            <i class="fa fa-plus"></i> <span>增加方案細項</span>
                        </a>
                    </li> */ ?>
                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/page*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-files-o"></i> <span>{{ $menus['pages'] }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/pages')? 'active': '' }}">
                        <a href="{{ url('admin/pages') }}">
                            <i class="fa fa-list"></i> <span>{{ $menus['pages_list'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/pages/create')? 'active': '' }}">
                        <a href="{{ url('admin/pages/create') }}">
                            <i class="fa fa-plus"></i> <span>{{ $menus['page_add'] }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/frontpages*')? 'active': '' }}">
                <a href="#"><i class="fa fa-home"></i> 選單設定 <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/frontpages/2')? 'active': '' }}"><a
                                href="{{ url('admin/frontpages/2') }}"><i class="fa fa-chevron-right"></i> Front Page</a>
                    </li>
                    <li class="{{ Request::is('admin/frontpages/1')? 'active': '' }}"><a
                                href="{{ url('admin/frontpages/1') }}"><i class="fa fa-chevron-right"></i> Self Storage</a></li>

                    <li class="{{ Request::is('admin/frontpages/3')? 'active': '' }}"><a
                                href="{{ url('admin/frontpages/3') }}"><i class="fa fa-chevron-right"></i> Ondemand Storage</a></li>
                </ul>
            </li>
			<li class="{{ Request::is('admin/orders') ? 'active': '' }}">
                <a href="{{ url('admin/orders') }}">
                    <i class="fa fa-database"></i> <span>{{ $menus['orders'] }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/logistics') ? 'active': '' }}">
                <a href="{{ url('admin/logistics') }}">
                    <i class="fa fa-car"></i> <span>{{ $menus['logistics'] }}</span>
                </a>
            </li>
			<li class="{{ Request::is('admin/payments') ? 'active': '' }}">
                <a href="{{ url('admin/payments') }}">
                    <i class="fa fa-money"></i> <span>{{ $menus['payments'] }}</span>
                </a>
            </li>
			<li class="{{ Request::is('admin/top-bar-news') ? 'active': '' }}">
                <a href="{{ url('admin/top-bar-news') }}">
                    <i class="fa fa-newspaper-o"></i> <span>{{ $menus['topbar_news'] }}</span>
                </a>
            </li>
			
            <li class="treeview {{ Request::is('admin/setting*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>{{ $menus['settings'] }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/settings')? 'active': '' }}">
                        <a href="{{ url('admin/settings') }}">
                            <i class="fa fa-list"></i> <span>{{ $menus['settings_list'] }}</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/adminMenus')? 'active': '' }}" style="display: none">
                        <a href="{{ url('admin/adminMenus') }}">
                            <i class="fa fa-list-alt"></i> <span>{{ $menus['admin_menus'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/settings/create')? 'active': '' }}">
                        <a href="{{ url('admin/settings/create') }}">
                            <i class="fa fa-plus"></i> <span>{{ $menus['setting_add'] }}</span>
                        </a>
                    </li>
                </ul>
            </li>
			<li class="treeview {{ Request::is('admin/coupon*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-barcode"></i> <span>{{ $menus['coupon'] }}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/coupon')? 'active': '' }}">
                        <a href="{{ url('admin/coupon') }}">
                            <i class="fa fa-list"></i> <span>{{ $menus['coupon_list'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/coupon/create')? 'active': '' }}">
                        <a href="{{ url('admin/coupon/create') }}">
                            <i class="fa fa-plus"></i> <span>{{ $menus['coupon_add'] }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->