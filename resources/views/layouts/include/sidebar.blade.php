            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

                            <li class="nav-item start ">
                                <a href="{{ url('/dashboard') }}" class="nav-link ">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    {{-- <span class="selected"></span> --}}
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Features</h3>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-users"></i>
                                    <span class="title">User</span>
                                    <span class="arrow"></span>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">

                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-users') }}" class="nav-link ">
                                            <i class="icon-user"></i>
                                            <span class="title">Users</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/add-roles') }}" class="nav-link ">
                                            <i class="icon-user-following"></i>
                                            <span class="title">Add Roles</span>
                                        </a>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-roles') }}" class="nav-link ">
                                            <i class="icon-list"></i>
                                            <span class="title">List Roles</span>
                                        </a>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="{{ url('/view-roles') }}" class="nav-link " target="_blank">
                                            <i class="icon-eye"></i>
                                            <span class="title">View Roles</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/logs-list') }}" class="nav-link ">
                                            <i class="icon-info"></i>
                                            <span class="title">Logs</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Employees</span>
                                    <span class="arrow"></span>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">

                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-employees') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Employees List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/add-employees-document') }}" class="nav-link ">
                                            <i class="icon-doc"></i>
                                            <span class="title">Employees Document</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-handbag"></i>
                                    <span class="title">Purchases</span>
                                    <span class="arrow"></span>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">

                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-supplier') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Suppliers List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/item-categories') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Item Categories</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/manage-items') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Manage Item</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/manage-purchases') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Manage Purchases</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/purchases-summary') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Purchase Summary</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-share"></i>
                                    <span class="title">Projects</span>
                                    <span class="arrow"></span>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">

                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-projects') }}" class="nav-link nav-toggle">
                                            <i class="icon-layers"></i>
                                            <span class="title">Projects</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/add-project-task') }}" class="nav-link nav-toggle">
                                            <i class="icon-layers"></i>
                                            <span class="title">Add Task</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-project-task') }}" class="nav-link nav-toggle">
                                            <i class="icon-layers"></i>
                                            <span class="title">Task List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-project-milestones') }}" class="nav-link nav-toggle">
                                            <i class="icon-graph"></i>
                                            <span class="title">Projects Milestones</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-project-estimations') }}" class="nav-link nav-toggle">
                                            <i class="icon-pie-chart"></i>
                                            <span class="title">Projects Estimations</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/add-project-purchases') }}" class="nav-link nav-toggle">
                                            <i class="icon-bag"></i>
                                            <span class="title">Projects Purchases</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-project-invoice') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-file-text-o"></i>
                                            <span class="title">Invoices</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ url('/list-project-types') }}" class="nav-link nav-toggle">
                                            <i class="icon-list"></i>
                                            <span class="title">Project Types</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            {{-- <li class="nav-item  ">
                                <a href="{{ url('/list-employees') }}" class="nav-link nav-toggle">
                                    <i class="icon-social-dribbble"></i>
                                    <span class="title">Employees</span>
                                </a>

                            </li> --}}
                            {{-- @if($menuitems)
                            @foreach($menuitems as $key => $val)
                            @if($val['enabled'] == 1)
                            <li class="nav-item">
                                <a class="nav-link collapsed text-truncate" href="#abc{{$key}}" data-toggle="collapse" data-target="#abc{{$key}}">
                                    @if($val['icon'] == 1)
                                    <img src="{{asset($val['image'])}}">
                                    @else
                                    <i class="fas {{$val['image']}}"></i>
                                    @endif
                                        {{$val['name']}}
                                    @if($val['dropdown'] == 1)
                                    <i class="fas fa-angle-down rotate"></i>
                                    @endif
                                </a>
                                @if($val['dropdown'] == 1)
                                <div class="collapse submenu" id="abc{{$key}}" aria-expanded="false">
                                    <ul>
                                    @foreach($val['child'] as $child)
                                    <!--@if(in_array($child->url, $rights_array))-->
                                        <li><a href="{{ url($child->url) }}">{{$child->name}}</a></li>
                                    <!--@endif-->
                                    @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endif
                            @endforeach
                            @endif --}}
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->

