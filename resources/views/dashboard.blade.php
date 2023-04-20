@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Index')


@section('content')

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1>Hi, Welcomeback!</h1>
                <span>JustDo @yield('title'),</span>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 text-lg-right">
                <div class="d-flex align-items-center justify-content-lg-end mt-4 mt-lg-0 flex-wrap vivify pullUp delay-550">
                    <div class="border-right pr-4 mr-4 mb-2 mb-xl-0 hidden-xs">
                        <p class="text-muted mb-1">Purchases <span id="mini-bar-chart3" class="mini-bar-chart"></span></p>
                        <h5 class="mb-0">6,520</h5>
                    </div>
                    <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                        <p class="text-muted mb-1">Today’s profit <span id="mini-bar-chart2" class="mini-bar-chart"></span></p>
                        <h5 class="mb-0">$541.00 M</h5>
                    </div>
                    <div class="mb-3 mb-xl-0">
                        <p class="text-muted mb-1">Balance <span id="mini-bar-chart1" class="mini-bar-chart"></span></p>
                        <h5 class="mb-0">$982.60 M</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                <a class="navbar-brand" href="javascript:void(0);">M.</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars text-muted"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="{{ Request::segment(2) === 'index' ? 'nav-item active' : null }}"><a class="nav-link" href="">Analytics</a></li>
                        <li class="{{ Request::segment(2) === 'cryptocurrency' ? 'nav-item active' : null }}"><a class="nav-link" href="">Cryptocurrency</a></li>
                        <li class="{{ Request::segment(2) === 'campaign' ? 'nav-item active' : null }}"><a class="nav-link" href="">Campaign</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" role="button" data-toggle="dropdown">More</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="">eCommerce Analytics</a>
                                <a class="dropdown-item" href="javascript:void(0);">Sales Monitoring</a>
                                <a class="dropdown-item" href="javascript:void(0);">Finance Performance</a>
                            </div>
                        </li>
                    </ul>
                    <div class="ml-auto">
                        <a href="" class="btn btn-default">ToDo</a>
                        <a href="" class="btn btn-default">Settings</a>
                        <a href="javascript:void(0);" class="btn btn-dark">Buy this item</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-12">
            <div class="card theme-bg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider1" class="carousel vert slide" data-ride="carousel" data-interval="2700">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Total Income</div>
                                                <div class="mt-3 h1">$13,025</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">3.78% <i class="fa fa-caret-down"></i></div>
                                                    <span>This year</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Total Revenue</div>
                                                <div class="mt-3 h1">$9,452</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">0.85% <i class="fa fa-caret-up"></i></div>
                                                    <span>This year</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Total Expense</div>
                                                <div class="mt-3 h1">$4,124</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">2.04% <i class="fa fa-caret-down"></i></div>
                                                    <span>This year</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="2800">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Total User</div>
                                                <div class="mt-3 h1">1,258</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">7% <i class="fa fa-caret-up"></i></div>
                                                    <span>This month</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Sessions</div>
                                                <div class="mt-3 h1">451</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">23.5% <i class="fa fa-caret-up"></i></div>
                                                    <span>This month</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Bounce Rate</div>
                                                <div class="mt-3 h1">36.80</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">5% <i class="fa fa-caret-up"></i></div>
                                                    <span>This month</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider3" class="carousel vert slide" data-ride="carousel" data-interval="3000">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Bitcoin Wallet</div>
                                                <div class="mt-3 h1">4.25762</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">5.23% <i class="fa fa-caret-up"></i></div>
                                                    <span>This Week</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Ethereum Wallet</div>
                                                <div class="mt-3 h1">3.15948</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">1.85% <i class="fa fa-caret-up"></i></div>
                                                    <span>This Week</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>NioWallet</div>
                                                <div class="mt-3 h1">2.75342</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">1.25% <i class="fa fa-caret-down"></i></div>
                                                    <span>This Week</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider4" class="carousel vert slide" data-ride="carousel" data-interval="2500">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Number of Meetings</div>
                                                <div class="mt-3 h1">781</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">0.56% <i class="fa fa-caret-up"></i></div>
                                                    <span>(30 days)</span>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Number of Clients</div>
                                                <div class="mt-3 h1">10K</div>
                                                <div class="d-flex">
                                                    <div class="mr-3">0.56% <i class="fa fa-caret-up"></i></div>
                                                    <span>(30 days)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="section_title">
                <div class="mr-3">
                    <h3>Overview</h3>
                    <small>Statistics, Predictive Analytics Data Visualization, Big Data Analytics, etc.</small>
                </div>
                <div>
                    <div class="btn-group mb-3">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">14 March 2020</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);">Today’s</a>
                                <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
                                <a class="dropdown-item" href="javascript:void(0);">This Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last 12 Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Custom Dates</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default"><i class="fa fa-send"></i> <span class="hidden-md">Report</span></button>
                        <button type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> <span class="hidden-md">Export</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix row-deck">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>This Year's Total Revenue</h2>
                    <small class="text-muted font-12">It is the period time a user is actively engaged with your website, page or app, etc</small>
                    <ul class="header-dropdown dropdown">
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu theme-bg gradient">
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                </div>
                <div class="body">
                    <div class="d-flex flex-row">
                        <div class="pb-3">
                            <h5 class="mb-0">$3,056</h5>
                            <small class="text-muted font-11">Total Sales</small>
                        </div>
                        <div class="pb-3 pl-4 pr-4">
                            <h5 class="mb-0">$1,098</h5>
                            <small class="text-muted font-11">Total Profit</small>
                        </div>
                        <div class="ml-auto">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-default">Day</button>
                                <button type="button" class="btn btn-sm btn-default">Week</button>
                                <button type="button" class="btn btn-sm btn-primary theme-bg">Month</button>
                            </div>
                        </div>
                    </div>
                    <div id="flotChart" class="flot-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Sales By Campaign</h2>
                    <small class="font-12">The total number of Page Impressions within the date range</small>
                </div>
                <div class="body">
                    <div class="d-flex flex-row">
                        <div class="pb-3">
                            <h5 class="mb-0">$356</h5>
                            <small class="text-muted font-11">Paid</small>
                        </div>
                        <div class="pb-3 pl-4 pr-4">
                            <h5 class="mb-0">$198</h5>
                            <small class="text-muted font-11">Viral</small>
                        </div>
                        <div class="ml-auto">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-default">D</button>
                                <button type="button" class="btn btn-sm btn-primary theme-bg">W</button>
                                <button type="button" class="btn btn-sm btn-default">M</button>
                            </div>
                        </div>
                    </div>
                    <div id="chart-bar-rotated" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix row-deck">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Portfolio</h2>
                    <small class="font-12">The total number of Page Impressions within the date range</small>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>Apple</td>
                                <td class="text-right">984.52</td>
                                <td class="text-right"><span class="text-success">(0.25%) <i class="fa fa-caret-up"></i></span></td>
                            </tr>
                            <tr>
                                <td>Google</td>
                                <td class="text-right">956.3</td>
                                <td class="text-right"><span class="text-danger">(-0.15%) <i class="fa fa-caret-down"></i></span></td>
                            </tr>
                            <tr>
                                <td>DMKT</td>
                                <td class="text-right">89.74</td>
                                <td class="text-right"><span class="text-success">(0.85%) <i class="fa fa-caret-up"></i></span></td>
                            </tr>
                            <tr>
                                <td>Lenovo</td>
                                <td class="text-right">89.74</td>
                                <td class="text-right"><span class="text-success">(0.85%) <i class="fa fa-caret-up"></i></span></td>
                            </tr>
                            <tr>
                                <td>TMLS</td>
                                <td class="text-right">210.04</td>
                                <td class="text-right"><span class="text-success">(0.65%) <i class="fa fa-caret-up"></i></span></td>
                            </tr>
                            <tr>
                                <td>Dell</td>
                                <td class="text-right">210.04</td>
                                <td class="text-right"><span class="text-success">(0.65%) <i class="fa fa-caret-up"></i></span></td>
                            </tr>
                            <tr>
                                <td>YOUS</td>
                                <td class="text-right">218.47</td>
                                <td class="text-right"><span class="text-danger">(-0.42%) <i class="fa fa-caret-down"></i></span></td>
                            </tr>
                            <tr>
                                <td>TCS</td>
                                <td class="text-right">48.75</td>
                                <td class="text-right"><span class="text-danger">(-0.63%) <i class="fa fa-caret-down"></i></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Campaign By Channel</h2>
                    <small class="font-12">The total number of Page Impressions within the date range</small>
                </div>
                <div class="body">
                    <div id="chart-donut-d" style="height: 220px"></div>
                    <div class="mt-2">
                        <div class="form-group">
                            <label class="d-block">Organic Search <span class="float-right">2,098</span></label>
                            <div class="progress progress-xs">
                                <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%; background-color: #2c83b6;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Email Campaign <span class="float-right">1,002</span></label>
                            <div class="progress progress-xs">
                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%; background-color: #a5d8a2;"></div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="d-block">Referral Links <span class="float-right">780</span></label>
                            <div class="progress progress-xs">
                                <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%; background-color: #9367b4;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Page Impressions</h2>
                    <small class="font-12">The total number of Page Impressions within the date range</small>
                    <ul class="header-dropdown dropdown">
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu theme-bg gradient">
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                </div>
                <div class="body">
                    <div class="d-flex flex-row">
                        <div class="pb-3">
                            <h5 class="mb-0">$356</h5>
                            <small class="text-muted font-11">Paid</small>
                        </div>
                        <div class="pb-3 pl-4 pr-4">
                            <h5 class="mb-0">$198</h5>
                            <small class="text-muted font-11">Viral</small>
                        </div>
                        <div class="ml-auto">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-default">D</button>
                                <button type="button" class="btn btn-sm btn-primary theme-bg">W</button>
                                <button type="button" class="btn btn-sm btn-default">M</button>
                            </div>
                        </div>
                    </div>
                    <div id="chart-bar-stacked" style="height: 320px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix row-deck">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Organic Visits & Conversions</h2>
                    <small class="font-12">The total number of Page Impressions within the date range</small>
                    <ul class="header-dropdown dropdown">
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu theme-bg gradient">
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                </div>
                <div class="body">
                    <div class="d-flex flex-row">
                        <div class="pb-3">
                            <h5 class="mb-0">$356</h5>
                            <small class="text-muted font-11">Rate</small>
                        </div>
                        <div class="pb-3 pl-4 pr-4">
                            <h5 class="mb-0">$198</h5>
                            <small class="text-muted font-11">Value</small>
                        </div>
                        <div class="ml-auto">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-sm btn-default">Day</button>
                                <button type="button" class="btn btn-sm btn-default">Week</button>
                                <button type="button" class="btn btn-sm btn-primary theme-bg">Month</button>
                            </div>
                        </div>
                    </div>
                    <div id="chart-OrganicVisits" style="height: 200px"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Overall Rating</h2>
                </div>
                <div class="body">
                    <div class="d-flex align-items-end">
                        <h2 class="mb-0">4.3</h2>
                        <div class="ml-2 mr-2">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                    </div>
                    <div class="avatar-list avatar-list-stacked mt-3">
                        <img class="avatar avatar-sm" src="{{ asset('assets/images/xs/avatar5.jpg') }}" data-toggle="tooltip" title="" data-original-title="Avatar">
                        <img class="avatar avatar-sm" src="{{ asset('assets/images/xs/avatar6.jpg') }}" data-toggle="tooltip" title="" data-original-title="Avatar">
                        <img class="avatar avatar-sm" src="{{ asset('assets/images/xs/avatar1.jpg') }}" data-toggle="tooltip" title="" data-original-title="Avatar">
                        <img class="avatar avatar-sm" src="{{ asset('assets/images/xs/avatar4.jpg') }}" data-toggle="tooltip" title="" data-original-title="Avatar">
                    </div>
                    <ul class="list-group list-group-flush ratings font-13 mt-3">
                        <li class="list-group-item">
                            <div>5.0</div>
                            <div class="stars ml-2 mr-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="ml-auto">
                                <span>4,178</span>
                                <span class="font-10">58%</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div>4.0</div>
                            <div class="stars ml-2 mr-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="ml-auto">
                                <span>2,091</span>
                                <span class="font-10">28%</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div>3.0</div>
                            <div class="stars ml-2 mr-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="ml-auto">
                                <span>984</span>
                                <span class="font-10">15%</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div>2.0</div>
                            <div class="stars ml-2 mr-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="ml-auto">
                                <span>430</span>
                                <span class="font-10">8%</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div>1.0</div>
                            <div class="stars ml-2 mr-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="ml-auto">
                                <span>307</span>
                                <span class="font-10">18%</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Users Overview</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 border-right">
                            <label class="mb-0">New Users</label>
                            <h4 class="font-22 font-weight-bold">2,025</h4>
                        </div>
                        <div class="col-6">
                            <label class="mb-0">Return Visitors</label>
                            <h4 class="font-22 font-weight-bold">1,254</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="d-block">New Users <span class="float-right">77%</span></label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Return Visitors <span class="float-right">50%</span></label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Engagement <span class="float-right">23%</span></label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                        </div>
                    </div>
                    <small class="font-12">The total number of Page Impressions within the date range<a href="">View more</a></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="section_title">
                <div class="mr-3">
                    <h3>Earning By Countries</h3>
                    <small>Statistics, Predictive Analytics Data Visualization, Big Data Analytics, etc.</small>
                </div>
                <div>
                    <div class="btn-group mb-3">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">14 March 2020</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);">Today’s</a>
                                <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
                                <a class="dropdown-item" href="javascript:void(0);">This Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last 12 Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Custom Dates</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default"><i class="fa fa-send"></i> <span class="hidden-md">Report</span></button>
                        <button type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> <span class="hidden-md">Export</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div id="world-map-markers" class="jvector-map" style="height: 305px"></div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="w60">
                                                <img src="{{ asset('assets/images/flag/au.svg') }}" class="w30 rounded">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" title="">Australia</a>
                                                <p class="mb-0">Scott Ortega</p>
                                            </td>
                                            <td>
                                                <div>231K <span class="text-red font-10">4% <i class="fa fa-level-down"></i></span></div>
                                                <small class="font-12 text-muted">Total Orders</small>
                                            </td>
                                            <td>
                                                <div>21K <span class="text-green font-10">3% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Returns</small>
                                            </td>
                                            <td>
                                                <div>21M <span class="text-green font-10">8% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Earnings</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w60">
                                                <img src="{{ asset('assets/images/flag/ca.svg') }}" class="w30 rounded">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" title="">Canada</a>
                                                <p class="mb-0">Scott Ortega</p>
                                            </td>
                                            <td>
                                                <div>231K <span class="text-red font-10">4% <i class="fa fa-level-down"></i></span></div>
                                                <small class="font-12 text-muted">Total Orders</small>
                                            </td>
                                            <td>
                                                <div>21K <span class="text-green font-10">3% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Returns</small>
                                            </td>
                                            <td>
                                                <div>21M <span class="text-green font-10">8% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Earnings</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w60">
                                                <img src="{{ asset('assets/images/flag/france.svg') }}" class="w30 rounded">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" title="">France</a>
                                                <p class="mb-0">Scott Ortega</p>
                                            </td>
                                            <td>
                                                <div>231K <span class="text-red font-10">4% <i class="fa fa-level-down"></i></span></div>
                                                <small class="font-12 text-muted">Total Orders</small>
                                            </td>
                                            <td>
                                                <div>21K <span class="text-green font-10">3% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Returns</small>
                                            </td>
                                            <td>
                                                <div>21M <span class="text-green font-10">8% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Earnings</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w60">
                                                <img src="{{ asset('assets/images/flag/us.svg') }}" class="w30 rounded">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" title="">USA</a>
                                                <p class="mb-0">Scott Ortega</p>
                                            </td>
                                            <td>
                                                <div>231K <span class="text-red font-10">4% <i class="fa fa-level-down"></i></span></div>
                                                <small class="font-12 text-muted">Total Orders</small>
                                            </td>
                                            <td>
                                                <div>21K <span class="text-green font-10">3% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Returns</small>
                                            </td>
                                            <td>
                                                <div>21M <span class="text-green font-10">8% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Earnings</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w60">
                                                <img src="{{ asset('assets/images/flag/nl.svg') }}" class="w30 rounded">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" title="">Netherlands</a>
                                                <p class="mb-0">Scott Ortega</p>
                                            </td>
                                            <td>
                                                <div>231K <span class="text-red font-10">4% <i class="fa fa-level-down"></i></span></div>
                                                <small class="font-12 text-muted">Total Orders</small>
                                            </td>
                                            <td>
                                                <div>21K <span class="text-green font-10">3% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Returns</small>
                                            </td>
                                            <td>
                                                <div>21M <span class="text-green font-10">8% <i class="fa fa-level-up"></i></span></div>
                                                <small class="font-12 text-muted">Total Earnings</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/c3/c3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css') }}">
@stop

@section('vendor-script')
<script src="{{ asset('assets/bundles/flotscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
@stop

@section('page-script')
<script src="{{ asset('assets/js/index.js') }}"></script>
@stop
