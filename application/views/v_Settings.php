<?php $this->load->view('template/v_Head') ?>


<body class="framed main-scrollable">

<div class="wrapper">
    <nav class="navbar navbar-static-top header-navbar">
        <div class="header-navbar-mobile">
            <div class="header-navbar-mobile__menu">
                <button type="button" class="btn"><i class="fa fa-bars"></i></button>
            </div>
            <div class="header-navbar-mobile__title"><span>Controls</span></div>
            <div class="header-navbar-mobile__settings dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn dropdown-toggle"><i class="fa fa-power-off"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-header"><a href="index.html" class="navbar-brand">
                <div class="logo text-nowrap">
                    <div class="logo__img"><i class="fa fa-chevron-right"></i></div><span class="logo__text">Right</span>
                </div></a></div>
        <div class="topnavbar">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="index.html"><span>Dashboard</span></a></li>
                <li><a href="inbox.html"><span>Mailbox</span></a></li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><span>Pages&nbsp;<i class="caret"></i></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="products.html"><span>Products</span></a></li>
                        <li><a href="orders.html"><span>Orders</span></a></li>
                        <li><a href="users.html"><span>Users</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="blank.html">Blank</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="userbar nav navbar-nav">
                <li class="dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="userbar__settings dropdown-toggle"><i class="fa fa-power-off"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
            <?php $this->load->view('template/v_SidebarMenu') ?>
            <!--Sidebar Menu-->
        </div>
        <!--ASIDE-->

        <div class="main">
            <div class="main__scroll scrollbar-macosx">
                <div class="main__cont">
                    <div class="container-fluid half-padding">
                        <div class="template template__controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Date & time</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <div class="input-group date">
                                                                <input type="text" value="12/01/2015" class="form-control">
                                                                <div class="input-group-addon">
                                                                    <div class="fa fa-calendar"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Time</label>
                                                            <div class="input-group timepicker bootstrap-timepicker">
                                                                <input type="text" class="form-control">
                                                                <div class="input-group-addon">
                                                                    <div class="fa fa-clock-o"></div>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/v_Foot') ?>