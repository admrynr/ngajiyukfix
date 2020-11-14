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
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="{{ route('dashboard.index')}}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('order.index') }}" class="waves-effect">
                                        <i class="mdi mdi-shopping"></i><span> Order </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('auction.index') }}" class="waves-effect">
                                    <i class="mdi mdi-layers"></i><span> Auction </span>
                                </a>
                            </li>
                            @if(Auth::user()->level == 1)
                            <li class="menu-title">Shop Management</li>
                            <li>
                                <a href="{{ route('shop.index') }}" class="waves-effect">
                                        <i class="mdi mdi-home"></i><span> Shop </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('payment.index') }}" class="waves-effect">
                                        <i class="mdi mdi-credit-card"></i><span> Payment </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shipping.index') }}" class="waves-effect">
                                        <i class="mdi mdi-truck-delivery"></i><span> Shipping </span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('product.index') }}" class="waves-effect">
                                        <i class="mdi mdi-package-variant-closed"></i><span> Shipment </span>
                                </a>
                            </li> --}}
                            <li class="menu-title">Product Management</li>
                            <li {{Request::segment(2) == 'product' ? 'class="active"' : ''}}>
                                <a href="{{ route('product.index') }}" class="waves-effect {{Request::segment(2) == 'product' ? 'active' : ''}}">
                                    <i class="mdi mdi-shopping"></i><span> Product </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}" class="waves-effect">
                                    <i class="mdi mdi-layers"></i><span> Category </span>
                                </a>
                            </li>
                            
                            <li class="menu-title">Content Management</li>
                            
                            <li>
                                <a href="{{ route('page.index') }}" class="waves-effect">
                                        <i class="mdi mdi-file"></i><span> Pages </span>
                                </a>
                            </li>
                           
                            <li {{Request::segment(2) == 'blog' ? 'class="active"' : ''}}>
                                <a href="{{ route('blog.index') }}" class="waves-effect {{Request::segment(2) == 'blog' ? 'active' : ''}}">
                                        <i class="mdi mdi-file"></i><span> Blog </span>
                                </a>
                            </li>
                            <li class="menu-title">User Management</li>
                            <li>
                                <a href="{{ route('user.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-multiple"></i><span> Admin </span>
                                </a>
                            </li>
                            @elseif(Auth::user()->level == 3)
                            <li>
                                <a href="{{ route('cashier.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-multiple"></i><span> Cashier </span>
                                </a>
                            </li>
                            @endif
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
