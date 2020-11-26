            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Dashboard</li>
                            <li>
                                <a href="{{ route('video.index')}}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i> <span> Videos </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}" class="waves-effect">
                                    <i class="mdi mdi-layers"></i><span> Category </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}" class="waves-effect">
                                        <i class="mdi mdi-file"></i><span> Blog </span>
                                </a>
                            </li>
                            <li class="menu-title">User Management</li>
                            <li>
                                <a href="{{ route('user.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-multiple"></i><span> Admin </span>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
