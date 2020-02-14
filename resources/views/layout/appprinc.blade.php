
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Admin {{auth()->user()->name}}</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />


    <link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />


    <link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />


    <link rel="stylesheet" href="{{asset('assets/css/ace-part2.min.css')}}" class="ace-main-stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/ace-ie.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/mdb.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/mdb.min.css')}}">
    <!-- data table -->

    <script src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>


    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap.min.css')}}">

    <!-- end tada table -->


    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/ui.jqgrid.min.css')}}" />





    <script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/respond.min.js')}}"></script>



    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>



    <script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>

    <script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{asset("assets/js/jquery.mobile.custom.min.js")}}'>"+"<"+"/script>");
    </script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/respond.min.js')}}"></script>
    <script src="{{asset('assets/js/excanvas.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.sparkline.index.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.resize.min.js')}}"></script>

    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>




    <!-- page specific plugin scripts -->

</head>

<body class="no-skin" onload=" document.getElementById('sr').focus(); ">

<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="{{url('principal')}}" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    @lang('app.admin') {{auth()->user()->name}}
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-grey dropdown-modal" style="margin-right: 5px;padding: 2px;">
                    <a class="dropdown-toggle" href="locale/fr">
                        <img class="msg-photo" style="width: 30px;height: 25px;"src="{{asset('img/fr.png')}}"  alt="Fr" />
                        <span class="badge badge-grey">Fr</span>
                    </a>

                    <!--   <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-check"></i>
                                4 Tasks to complete
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Software Update</span>
                                                <span class="pull-right">65%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:65%" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Hardware Upgrade</span>
                                                <span class="pull-right">35%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Unit Testing</span>
                                                <span class="pull-right">15%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Bug Fixes</span>
                                                <span class="pull-right">90%</span>
                                            </div>

                                            <div class="progress progress-mini progress-striped active">
                                                <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-footer">
                                <a href="#">
                                    See tasks with details
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>-->
                </li>
                <li class="light-grey dropdown-modal" style="padding:2px;margin-right: 5px;">
                    <a class="dropdown-toggle" href="locale/en">
                        <img class="msg-photo" style="width: 30px;height: 25px;" src="{{asset('img/en.png')}}"  alt="En" />
                        <span class="badge badge-grey">En</span>
                    </a>
                </li>
                <!--<li class="purple dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                        <span class="badge badge-important">8</span>
                    </a>

                    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-exclamation-triangle"></i>
                            8 Notifications
                        </li>

                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                <li>
                                    <a href="#">
                                        <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
                                            <span class="pull-right badge badge-info">+12</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="btn btn-xs btn-primary fa fa-user"></i>
                                        Bob just signed up as an editor ...
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
                                            <span class="pull-right badge badge-success">+8</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
                                            <span class="pull-right badge badge-info">+11</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">
                                See all notifications
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="green dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">5</span>
                    </a>

                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-envelope-o"></i>
                            5 Messages
                        </li>

                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li>
                                    <a href="#" class="clearfix">
                                        <img src="{{asset('assets/images/avatars/avatar.png')}}" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="clearfix">
                                        <img src="{{asset('assets/images/avatars/avatar3.png')}}" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="clearfix">
                                        <img src="{{asset('assets/images/avatars/avatar4.png')}}" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="clearfix">
                                        <img src="{{asset('assets/images/avatars/avatar2.png')}}" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="clearfix">
                                        <img src="{{asset('assets/images/avatars/avatar5.png')}}" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown-footer">
                            <a href="inbox.html">
                                See all messages
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>-->

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{asset('img/user.png')}}" alt="Jason's Photo" />
								<span class="user-info">
									<small>@lang('app.welcom'),</small>
                                    <?php if($user = Auth::user()){ ?>
                                    {{auth()->user()->name}} <?php }?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="menu-icon fa fa-picture-o"></i>
                                @lang('home.deco_menu')
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">@lang('home.home_menu')</a>
        </li>
        <li class="active">Dashboard {{app()->getLocale()}}</li>
    </ul><!-- /.breadcrumb -->
    <div class="col-xs-3 col-sm-3" style="float: right;margin-right: -30px;padding: 10px;">

        <div class="nav-search" id="nav-search" >

            <form class="form-search" action="{{url('profil')}}" method="get" id="frm">
                <!--<span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                  <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default" ><i class="fa fa-search"></i></button>
                </div>-->
                {{ csrf_field() }}
                <div class="input-group">
			<span class="input-group-addon">
			<i class="ace-icon fa fa-check"></i>
			</span>
                    <input type="text" class="form-control search-query" name="cne" placeholder="@lang('app.cherche')" id="sr"/>
				<span class="input-group-btn">
				<button type="submit" class="btn btn-purple btn-sm">
                    <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                    @lang('app.button_ch')
                </button>
				</span>
                </div>
            </form>
        </div><!-- /.nav-search -->
    </div>
</div>
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="active">
                <a href="index.html">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>
            @hasanyrole('SuperAdmin|admin_ESTM|admin_ENSAM|admin_ENS|admin_FS|admin_FSLH|admin_FPE|admin_FST|admin_FSJES|Agent_ESTM')
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								@lang('home.inscription_menu')
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">


                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>

                            List Etudiants
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <ul class="submenu">
                            @hasanyrole('SuperAdmin')
                            <li class="">
                                <a href="{{url('list')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Toutes etablissements
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ESTM||Agent_ESTM')
                            <li class="">
                                <a href="{{url('list_estm')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ESTM
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ENSAM')
                            <li class="">
                                <a href="{{url('list_ensam')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ENSAM
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FSJES')
                            <li class="">
                                <a href="{{url('list_fsjes')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FSJES
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FLSH')
                            <li class="">
                                <a href="{{url('list_fslh')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FSLH
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FS')
                            <li class="">
                                <a href="{{url('list_fs')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FS
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FPE')
                            <li class="">
                                <a href="{{url('list_fpe')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FPE
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FST')
                            <li class="">
                                <a href="{{url('list_fst')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FST
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ENS')
                            <li class="">
                                <a href="{{url('list_ens')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ENS
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole


                        </ul>
                    </li>

                    <li class="">
                        <a href={{url('filiere')}}>
                            <i class="menu-icon fa fa-caret-right"></i>
                            Gestion Filieres
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Changement filiere
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>
                        <ul class="submenu">
                            @hasanyrole('SuperAdmin')
                            <li class="">
                                <a href="{{url('cne')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Toutes Filieres
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ESTM|Agent_ESTM')')
                            <li class="">
                                <a href="{{url('cneestm')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ESTM
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ENSAM')
                            <li class="">
                                <a href="{{url('cneensam')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ENSAM
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FSJES')
                            <li class="">
                                <a href="{{url('cnefsjes')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FSJES
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FLSH')
                            <li class="">
                                <a href="{{url('cnefslh')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FSLH
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FS')
                            <li class="">
                                <a href="{{url('cnefs')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FS
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FPE')
                            <li class="">
                                <a href="{{url('cnefpe')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FPE
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_FST')
                            <li class="">
                                <a href="{{url('cnefst')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    FST
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole
                            @hasanyrole('SuperAdmin|admin_ENS')
                            <li class="">
                                <a href="{{url('cneens')}}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    ENS
                                </a>

                                <b class="arrow"></b>
                            </li>
                            @endhasanyrole


                        </ul>
                    </li>





                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('SuperAdmin|admin_ESTM|admin_ENSAM|admin_ENS|admin_FS|admin_FSLH|admin_FPE|admin_FST|admin_FSJES')
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text">  @lang('home.para_menu') </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="{{url('opi')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Gestion OPI
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{url('recherche')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transfert
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="{{url('export')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Exporter List
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endhasanyrole


            @hasanyrole('SuperAdmin|admin_ESTM|admin_ENSAM|admin_ENS|admin_FS|admin_FSLH|admin_FPE|admin_FST|admin_FSJES')
            <li>
                <a href="{{url('statistique_all')}}" class="dropdown-toggle"  >
                    <i class="menu-icon fa fa-pie-chart"></i>
                    <span class="menu-text">   @lang('home.statistique_menu')</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>


                <b class="arrow"></b>

                <ul class="submenu">
                    @hasanyrole('SuperAdmin')
                    <li class="">
                        <a href="{{url('statistique_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Toutes etablissements
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_ESTM')
                    <li class="">
                        <a href="{{url('statistique_estm_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            ESTM
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_ENSAM')
                    <li class="">
                        <a href="{{url('statistique_ensam_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            ENSAM
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_FSJES')
                    <li class="">
                        <a href="{{url('statistique_fsjes_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            FSJES
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_FLSH')
                    <li class="">
                        <a href="{{url('statistique_flsh_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            FSLH
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_FS')
                    <li class="">
                        <a href="{{url('statistique_fs_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            FS
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_FPE')
                    <li class="">
                        <a href="{{url('statistique_fpe_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            FPE
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_FST')
                    <li class="">
                        <a href="{{url('statistique_fst_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            FST
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                    @hasanyrole('SuperAdmin|admin_ENS')
                    <li class="">
                        <a href="{{url('statistique_ens_all')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            ENS
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endhasanyrole
                </ul>
            </li>

            @endhasanyrole


            @hasanyrole('SuperAdmin')
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text">  @lang('home.profile_menu')</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="{{route('roles.index')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            gerer les roles
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{route('permissions.index')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            gerer permissions
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{route('users.index')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            gerer les utilisateurs
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endhasanyrole

            <li class="">
                <a href="#"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="menu-icon fa fa-picture-o"></i>
                    <span class="menu-text">@lang('home.deco_menu')</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>



                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="gallery.html">
                    <i class="menu-icon fa fa-picture-o"></i>
                    <span class="menu-text"> @lang('home.information_menu') <!--<span class="badge badge-primary">5</span>--></span>
                </a>

                <b class="arrow"></b>
            </li>





        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="main-container ace-save-state" id="main-container">
            @yield('content')
            <!-- /.content -->
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <!--	<span class="bigger-120">
                        <span class="blue bolder">Ace</span>
                        Application &copy; 2013-2014
                    </span>

            &nbsp; &nbsp;
                    <span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>-->
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->


<!-- page specific plugin scripts -->

<!--[if lte IE 8]>


<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $('.navbar .dropdown').hover(function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

        }, function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

        });

        $('.navbar .dropdown > a').click(function(){
            location.href = this.href;
        });

    });
    $('.dropdown a').filter(function(){

        return $(this).attr('href') == location.pathname

    }).addClass('active').closest('ul').parent().addClass('active');
    $('.easy-pie-chart.percentage').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
        var size = parseInt($(this).data('size')) || 50;
        $(this).easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: parseInt(size/10),
            animate: ace.vars['old_ie'] ? false : 1000,
            size: size
        });
    })

    $('.sparkline').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html',
                {
                    tagValuesAttribute:'data-values',
                    type: 'bar',
                    barColor: barColor ,
                    chartRangeMin:$(this).data('min') || 0
                });
    });


    //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
    //but sometimes it brings up errors with normal resize event handlers
    $.resize.throttleWindow = false;

    var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
    var data = [
        { label: "social networks",  data: 38.7, color: "#68BC31"},
        { label: "search engines",  data: 24.5, color: "#2091CF"},
        { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
        { label: "direct traffic",  data: 18.6, color: "#DA5430"},
        { label: "other",  data: 10, color: "#FEE074"}
    ]
    function drawPieChart(placeholder, data, position) {
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    tilt:0.8,
                    highlight: {
                        opacity: 0.25
                    },
                    stroke: {
                        color: '#fff',
                        width: 2
                    },
                    startAngle: 2
                }
            },
            legend: {
                show: true,
                position: position || "ne",
                labelBoxBorderColor: null,
                margin:[-30,15]
            }
            ,
            grid: {
                hoverable: true,
                clickable: true
            }
        })
    }
    drawPieChart(placeholder, data);

    /**
     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
     so that's not needed actually.
     */
    placeholder.data('chart', data);
    placeholder.data('draw', drawPieChart);


    //pie chart tooltip example
    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
    var previousPoint = null;

    placeholder.on('plothover', function (event, pos, item) {
        if(item) {
            if (previousPoint != item.seriesIndex) {
                previousPoint = item.seriesIndex;
                var tip = item.series['label'] + " : " + item.series['percent']+'%';
                $tooltip.show().children(0).text(tip);
            }
            $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
        } else {
            $tooltip.hide();
            previousPoint = null;
        }

    });

    /////////////////////////////////////
    $(document).one('ajaxloadstart.page', function(e) {
        $tooltip.remove();
    });




    var d1 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d1.push([i, Math.sin(i)]);
    }

    var d2 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d2.push([i, Math.cos(i)]);
    }

    var d3 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.2) {
        d3.push([i, Math.tan(i)]);
    }


    var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
    $.plot("#sales-charts", [
        { label: "Domains", data: d1 },
        { label: "Hosting", data: d2 },
        { label: "Services", data: d3 }
    ], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: { show: true },
            points: { show: true }
        },
        xaxis: {
            tickLength: 0
        },
        yaxis: {
            ticks: 10,
            min: -2,
            max: 2,
            tickDecimals: 3
        },
        grid: {
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#555'
        }
    });


    $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('.tab-content')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }


    $('.dialogs,.comments').ace_scroll({
        size: 300
    });


    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if(ace.vars['touch'] && ace.vars['android']) {
        $('#tasks').on('touchstart', function(e){
            var li = $(e.target).closest('#tasks li');
            if(li.length == 0)return;
            var label = li.find('label.inline').get(0);
            if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
        });
    }

    $('#tasks').sortable({
                opacity:0.8,
                revert:true,
                forceHelperSize:true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize:true,
                tolerance:'pointer',
                stop: function( event, ui ) {
                    //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            }
    );


</script>
@include('sweetalert::alert')
</body>
</html>