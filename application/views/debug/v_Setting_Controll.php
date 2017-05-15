<?php $this->load->view('template/v_Head') ?>


    <body class="framed main-scrollable">

<div class="wrapper">

    <!--Navbar-->
    <?php $this->load->view('template/v_NavBar'); ?>
    <!--Navbar-->

    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
            <?php $this->load->view('template/v_SidebarMenu') ?>
            <!--Sidebar Menu-->
        </div>
        <!--ASIDE-->

        <!--Page-->
        <div class="main">
            <div class="main__scroll scrollbar-macosx">
                <div class="main__cont">
                    <div class="container-fluid half-padding">
                        <div class="template template__controls">
                            <div class="row">

                                <!--Content Page-->
                                <div class="col-md-12">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <div class="btn-group hide ">
                                                <button class="btn btn-info active">AC Distribution</button>
                                                <button class="btn btn-info">DC Distribution 1</button>
                                                <button class="btn btn-info">DC Distribution 2</button>
                                                <button class="btn btn-info">Data & Event</button>
                                                <button class="btn btn-info">5</button>
                                            </div>
                                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                                <div class="btn-group" role="group">
                                                    <a href="#" type="button" class="btn btn-info active">AC </a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a href="#" type="button" class="btn btn-info">RECTIFIER MODULE </a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a href="#" type="button" class="btn btn-info">DC  1</a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a href="#" type="button" class="btn btn-info">DC  2</a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a href="#" type="button" class="btn btn-info">OTHER</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                        </div>
                                    </div>
                                </div>

                                <!--Content Page-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Page-->

    </div>
</div>

<?php $this->load->view('template/v_Foot') ?>