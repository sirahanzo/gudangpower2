<nav class="navbar navbar-static-top header-navbar">
    <div class="header-navbar-mobile">
        <div class="header-navbar-mobile__menu">
            <button type="button" class="btn"><i class="fa fa-bars"></i></button>
        </div>
        <div class="header-navbar-mobile__title "><span><?php echo date('d M , Y') ?></span></div>

        <div class="header-navbar-mobile__settings dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn dropdown-toggle"><i class="fa fa-power-off"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="<?php echo site_url('auth/logout'); ?>">Log Out</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-header"><a href="<?php echo site_url('dashboard');?>" class="navbar-brand">
            <div class="logo text-nowrap">
                <div class="logo__img"></div><span class="logo__text">
                    <img src="<?php echo base_url('assets/img/logo.png') ?>">
                </span>
            </div></a></div>
    <div class="topnavbar ">
        <ul class="nav navbar-nav navbar-left">
            <li class="active hide"><a href="index.html"><span>Dashboard</span></a></li>
            <li class="hide"><a href="inbox.html"><span>Mailbox</span></a></li>
            <li class="dropdown hide"><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><span>Pages&nbsp;<i class="caret"></i></span></a>
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
        <ul class="userbar nav navbar-nav" >


            <li class="dropdown active " id="alarm_active"><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><span><i class="fa fa-bell text-danger blink"></i> Active Alarms&nbsp;<i class="caret"></i></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($alarmactive as $act): ?>

                        <li><a href="<?php echo site_url('monitor/rectifier/1');?>"><span><?php echo  $act->name ;?></span></a></li>


                    <?php endforeach;  ?>

                    <?php foreach ($rectifier_alarm_active as $act): ?>

                        <li><a href="<?php echo site_url('monitor/rectifier/1');?>"><span><?php if(!empty($act->name)){ echo $act->name; }else ;echo  $act->name ;?></span></a></li>


                    <?php endforeach;  ?>


                </ul>
            </li>

            <li class="active" id="dtime"><a href="#"><span><?php echo date('D H:i:s , d M Y') ?></span></a></li>

            <li class="dropdown active ">
                <a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="userbar__settings dropdown-toggle"><i class="fa fa-user"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><span><?php echo $user ;?></span></a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="#<?php //echo site_url('auth/logout'); ?>" data-toggle="modal" data-target="#logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>