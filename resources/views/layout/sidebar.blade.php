<div id="left-sidebar" class="sidebar {{isset($sidebarlight) ? $sidebarlight : '' }}">
    <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-angle-left"></i></a>
    <div class="navbar-brand">
        <a href="{{url('/')}}">
            <img @if($sidebarlight=='light_active') src="{{ asset('assets/images/Maintenance-logo-icon-black.png') }}" @else  src="{{ asset('assets/images/Maintenance-logo-icon-white.png') }}" @endif  style="max-height: 55px;
            max-width: 55px;
            "  alt="MentenanceCRM Logo" id="main-logo" class="img-fluid logo">
            <span class="ml-0 mt-1"><img @if($sidebarlight=='light_active') src="{{ asset('assets/images/Maintenance-logo-test-black.png') }}" @else  src="{{ asset('assets/images/Maintenance-logo-test-white.png') }}" @endif style="max-height: 80px;
            max-width: 90px;
            " id="main-logo2"></span>
  
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" class="user-photo" alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
                @endif
            </div>
            <div class="dropdown">
                <span>User</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="{{ route('profile.show') }}"><i class="fa fa-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href=""><i class="fa fa-power-off"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu animation-li-delay">
                 @if($menuitems)
                            @foreach($menuitems as $key => $val)
                            @if($val['enabled'] == 1)
                           
                                @if($val['dropdown'] == 0)
                                <li class="header">Main</li>
                                <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                                    
                            <a href="/" > 
                                @if($val['icon'] == 1)
                                <img src="{{asset($val['image'])}}">
                                @else
                                <i class="fa {{$val['image']}}"></i>
                                @endif
                                <span>{{$val['name'] }}</span></a>
                                <li class="header">Features</li>
                                    @else
                                   
                                    <li class="has-child-item">
                                        <a href="#" class="has-arrow"> 
                                            @if($val['icon'] == 1)
                                            <img src="{{asset($val['image'])}}">
                                            @else
                                            <i class="fa {{$val['image']}}"></i>
                                            @endif
                                            <span>{{$val['name'] }}</span></a>
                                @endif

                                    
                                     @if($val['dropdown'] == 1)
                                <ul>
                                    @foreach($val['child'] as $child)
                                    @if(in_array($child->url, $rights_array))
                                            <li class=""><a class="{{ ( 
                                            (request()->is($child->url)) ? 'sidebar_active' : 
                                            ((request()->is($child->url)) ? 'sidebar_active' : '' )
                                            ) }}" href="{{ url($child->url) }}">{{$child->name}}</a></li>
                                    @endif
                                    @endforeach
                                
                                  
                                 
                                </ul>
                                @endif
                                @endif
                                @endforeach
                                @endif
                            </li>
                            
                            {{-- <li class="nav-item">
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
                {{-- <li class="header">Main</li>
                <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}"><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                <li class="header">Features</li>
             
                <li class="has-child-item">
                    <a href="#forms" class="has-arrow"><i class="fa fa-briefcase"></i><span>HR</span></a>
                    <ul>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-employees')) ? 'sidebar_active' : 
                                ((request()->is('add-employees')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-employees') }}">

                                Employees List
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('add-employees-document')) ? 'sidebar_active' : '' )
                                 }}" href="{{ url('/add-employees-document') }}" >

                                Employees Document
                            </a>
                        </li>
                        <li >
                            <a 
                            class="{{ ( 
                                (request()->is('list-leaves-type')) ? 'sidebar_active' : 
                                ((request()->is('add-leavestype')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-leaves-type') }}" >

                                Leaves Type
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-leaves-record')) ? 'sidebar_active' : 
                                ((request()->is('add-leaves')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-leaves-record') }}" >

                                Leaves Record
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-child-item">
                    <a href="#Tables" class="has-arrow"><i class="fa fa-shopping-basket "></i><span>Purchases</a>
                    <ul>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-supplier')) ? 'sidebar_active' : 
                                ((request()->is('add-supplier')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-supplier') }}">

                                Suppliers List
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('item-categories')) ? 'sidebar_active' : 
                                ((request()->is('add-itemcategories')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/item-categories') }}">

                                Item Categories
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('manage-items')) ? 'sidebar_active' : 
                                ((request()->is('add-items')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/manage-items') }}">

                                Manage Item
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('manage-purchases')) ? 'sidebar_active' : 
                                ((request()->is('add-purchases')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/manage-purchases') }}">

                                Manage Purchases
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('purchases-summary')) ? 'sidebar_active' : '' )
                                 }}"  href="{{ url('/purchases-summary') }}">

                                Purchase Summary
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-child-item">
                    <a href="#charts" class="has-arrow"><i class="fa fa-pie-chart"></i><span>Projects</a>
                    <ul>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-projects')) ? 'sidebar_active' : 
                                ((request()->is('add-projects')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-projects') }}">

                                Projects
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('add-project-tasks')) ? 'sidebar_active' : '' )
                                 }}"  href="{{ url('add-project-task') }}">

                                Add Task
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-project-task')) ? 'sidebar_active' : 
                                ((request()->is('add-project-task')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-project-task') }}">

                                Task List
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-project-milestones')) ? 'sidebar_active' : 
                                ((request()->is('add-project-milestones')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-project-milestones') }}">

                                Projects Milestones
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-project-estimations')) ? 'sidebar_active' : 
                                ((request()->is('add-project-estimations')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-project-estimations') }}">

                                Projects Estimations
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('add-project-purchases')) ? 'sidebar_active' : '' )
                                 }}" href="{{ url('/add-project-purchases') }}">

                                Projects Purchases
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-project-invoice')) ? 'sidebar_active' : 
                                ((request()->is('add-project-invoice')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-project-invoice') }}">

                                Invoices
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-project-types')) ? 'sidebar_active' : 
                                ((request()->is('add-project-types')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-project-types') }}">

                                Project Types
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-child-item">
                    <a href="#charts" class="has-arrow"><i class="fa fa-file-text-o"></i><span>Expenses</a>
                    <ul>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-expenses')) ? 'sidebar_active' : 
                                ((request()->is('add-expense')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-expenses') }}">

                                Expenses Management
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-projects-expense')) ? 'sidebar_active' : '' )
                                 }}" href="{{ url('/list-projects-expense') }}">

                                Assign to Projects
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="{{ Request::segment(1) === 'Fleet' ? 'active' : null }}">
                    <a href="#charts" class="has-arrow"><i class="fa fa-money"></i><span>Petty Cash</a>
                    <ul>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-pettycash')) ? 'sidebar_active' : 
                                ((request()->is('add-pettycash')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-pettycash') }}">

                                Manage Petty Cash 
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-assign-employees')) ? 'sidebar_active' : '' )
                                 }}" href="{{ url('/list-assign-employees') }}">

                                Assign to Employees
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-assign-expenses')) ? 'sidebar_active' : '' )
                                 }}"   href="{{ url('/list-assign-expenses') }}">

                                Assign to Expenses
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-assign-purchases')) ? 'sidebar_active' : '' )
                                 }}"  href="{{ url('/list-assign-purchases') }}">

                                Assign to Purchases
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="has-child-item">
                    <a href="#charts" class="has-arrow"><i class="fa  fa-truck"></i><span>Fleet Management</a>
                    <ul>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-fleet')) ? 'sidebar_active' : 
                                ((request()->is('add-vehicle')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-fleet') }}">

                                Vehicle Management
                            </a>
                        </li>
                        <li >
                            <a class="{{ ( 
                                (request()->is('list-driver')) ? 'sidebar_active' : 
                                ((request()->is('add-driver')) ? 'sidebar_active' : '' )
                                ) }}" href="{{ url('/list-driver') }}">

                                Driver Management
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-assign-drivers')) ? 'sidebar_active' : '' )
                                 }}" href="{{ url('/list-assign-drivers') }}">

                                Assign to Drivers
                            </a>
                        </li>
                        <li >
                            <a  class="{{ ( 
                                (request()->is('list-assign-projects')) ? 'sidebar_active' : '' )
                                 }}"  href="{{ url('/list-assign-projects') }}">

                                Assign to Projects
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="{{ Request::segment(1) === 'Fleet' ? 'active' : null }}">
                    <a href="#charts" class="has-arrow"><i class="fa  fa-list-alt"></i><span>Sales</a>
                    <ul>
                        <li >
                            <a href="{{ url('/') }}">

                               Sales Management
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Invoices
                            </a>
                        </li>
            
                       
                    </ul>
                </li>
                <li class="{{ Request::segment(1) === 'Fleet' ? 'active' : null }}">
                    <a href="#charts" class="has-arrow"><i class="fa  fa-list-alt"></i><span>Accounts</a>
                    <ul>
                        <li >
                            <a href="{{ url('/') }}">

                               Employee Salary
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Debit/Credit
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                VAT
                            </a>
                        </li>
            
                       
                    </ul>
                </li>
             
                <li class="{{ Request::segment(1) === 'Fleet' ? 'active' : null }}">
                    <a href="#charts" class="has-arrow"><i class="fa  fa-copy"></i><span>Reporting</a>
                    <ul>
                        <li >
                            <a href="{{ url('/') }}">

                               User Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Employee Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Project Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Expenses Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Purchase Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Petty Cash Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                Accounts Reports
                            </a>
                        </li>
                        <li >
                            <a href="{{ url('/') }}">

                                VAT Reports
                            </a>
                        </li>
            
                       
                    </ul>
                </li>
--}}
                <li class="extra_widget">
                    <div class="form-group">
                        <label class="d-block">Traffic this Month <span class="float-right">77%</span></label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Server Load <span class="float-right">50%</span></label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                </li> 
            </ul>
        </nav>
    </div>
</div>
