<!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Home</li>

                            <li>
                                <a href="{{route('dashboard')}}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboard</span>
                                </a>
                            </li>

                            <li class="menu-title" key="t-apps">Modules</li>

                            @if(auth()->user()->hasRole('admin')) 
                            <li {{ Request::url() == route('users.index') || Request::url() == route('users.create') ?  'class=mm-active' : ''}}>
                                <a href="{{route('users.index')}}" class="waves-effect {{ Request::url() == route('users.index') || Request::url() == route('users.create') ?  'active' : ''}}">
                                    <i class="bx bx-grid-small"></i>
                                    <span key="t-dashboards">Users</span>
                                </a>
                            </li>
                            @endif

                            <li {{ Request::url() == route('posts.index') || Request::url() == route('posts.create') ?  'class=mm-active' : ''}}>
                                <a href="{{route('posts.index')}}" class="waves-effect {{ Request::url() == route('posts.index') || Request::url() == route('posts.create') ?  'active' : ''}}">
                                    <i class="bx bx-grid-small"></i>
                                    <span key="t-dashboards">Posts</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->