

<nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="index.html"><img src="{{ asset('assets/images/logocrm.png') }}" alt="CRM Logo" class="img-fluid logo"></a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
                </div>
            
            </div>
            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                      
                       
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                           
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="notification-dot info">{{ Auth::user()->unReadNotifications->count() }}</span>
                            </a>
                            
                    
                            <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay mynavbar "  >
                                <li class="external">
                                    
                                    <li class="theme-bg mt-0 text-light myedit ">
                                        <div class="row d-flex justify-content-between ">  
                                            <div class="col-md-4 mt-2 ml-3  pt-2">
                                                <h5>{{ Auth::user()->unReadNotifications->count() }} pending</h5>  
                                            </div>
                                           <div class="col-md=4">
                                            <a class="pt-3 mb-0 pb-0 notification-headertext" href="{{url('mark-all-read')}}">Mark All As Read</a>
                                           </div>
                                    
                                          </div>
                                          
                                           <div class="row d-flex justify-content-end ">
                                            <a class="pt-0 notification-headertext" href="
                                            {{url('notifications')}}">view all</a>
                                           </div>
                                      
                                        
                                    </li>
                                    
                                       
                                </li>
                                <li>
                                   
                                <ul class="pl-1" style="max-height: 260px;
                               
                                overflow-y: scroll;" >

                                        @foreach ( Auth::user()->unReadNotifications as $notification)

                                            
                                                <a href="javascript:void(0);" class="pr-0 notification-body"  onclick="readFunction('mark-single-read/{{$notification->id}}')">
                                                   
                                                        <div class="mr-2" ><i class="fa fa-check notification-text"></i></div>
                                                        <div class="feeds-body">
                                                            
                                                                <h4 class="title notification-text"> {{$notification->data['letter']['title']}} <small class="float-right text-muted font-11">{{$notification->created_at}}</small></h4>
                                                                <small>{{$notification->data['letter']['body']}} </small>
                                                          
                                                            
                                                        </div>
                                                    </a>
                                                </a>
                                            
                                        @endforeach
                                    
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="notification-dot info">4</span>
                            </a>
                            <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay">
                                <li class="header theme-bg mt-0 text-light">You have 4 New Notifications</li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="mr-4"><i class="fa fa-check text-red"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted font-12">9:10 AM</small></h4>
                                            <small>WE have fix all Design bug with Responsive</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="mr-4"><i class="fa fa-user text-info"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-info">New User <small class="float-right text-muted font-12">9:15 AM</small></h4>
                                            <small>I feel great! Thanks team</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="mr-4"><i class="fa fa-question-circle text-warning"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-warning">Server Warning <small class="float-right text-muted font-12">9:17 AM</small></h4>
                                            <small>Your connection is not private</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="mr-4"><i class="fa fa-thumbs-o-up text-success"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-success">2 New Feedback <small class="float-right text-muted font-12">9:22 AM</small></h4>
                                            <small>It will give a smart finishing to your site</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                     
                        <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                      
                            <li >
                                <button class="btn  gradient js-sweetalert" data-type="confirm"> <i class="fa fa-power-off "></i></button>
                            </li>
                            <form id="myForm" method="POST" action="{{ route('logout') }}"  c>
                                @csrf
    
                             
                            </form>
                            
                            {{-- <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="icon-menu btn" title="logout">
                                    <i class="fa fa-power-off "></i>
                                </button>
                            </form> --}}
                            {{-- <a href="{{route('authentication.login')}}" class="icon-menu"><i class="fa fa-power-off"></i></a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="recent_searche" style="display: none;">
                <div class="card mb-0">
                    <div class="header">
                        <h2>Recent search result</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);">Clear data</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-external-link"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-l-0 p-r-0">
                                <h6><a href="javascript:void(0);">Crush it - Bootstrap Admin Application Template &amp; Ui Kit</a></h6>
                                <p class="text-muted">It is a long established fact that a reader will be distracted.</p>
                                <div class="text-muted font-13">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><span class="badge badge-secondary margin-0">React</span></li>
                                        <li class="list-inline-item">Dec 27 2020</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item p-l-0 p-r-0">
                                <h6><a href="javascript:void(0);">Epic Pro - HR &amp; Project Management Admin Template and UI Kit</a></h6>
                                <p class="text-muted">he point of using Lorem Ipsum is that it has a more-or-less English.</p>
                                <div class="text-muted font-13">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><span class="badge badge-success margin-0">HTML</span></li>
                                        <li class="list-inline-item">Oct 13 2020</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item p-l-0 p-r-0">
                                <h6><a href="javascript:void(0);">Qubes - Responsive Admin Dashboard Template</a></h6>
                                <p class="text-muted">Commodo excepteur non ut aliqua ex qui velit sed esse consequat in </p>
                                <div class="text-muted font-13">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><span class="badge badge-danger margin-0">Bootstrap</span></li>
                                        <li class="list-inline-item">Sep 27 2020</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
