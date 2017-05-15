<?php $this->load->view('template/v_Head') ?>
    <style>
        #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
            padding: 3px;
            font-size: 13px;
        }
    </style>

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
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <?php $this->load->view('template/v_Menu_Controll'); ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-8">
                                                <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                                </div>
                                                <form action="<?php echo site_url('controll/save_log'); ?>" method="post" id="myform">
                                                    <div class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-sm-6 control-label"><?php echo $datalog->name; ?></label>
                                                            <div class="col-sm-6">
                                                                <input type="text" placeholder="3000"  class="form-control" name="max_datalog" value="<?php echo $datalog->value; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-6 control-label"><?php echo $interval->name; ?></label>
                                                            <div class="col-sm-6">
                                                                <input type="text" placeholder="3000"  class="form-control" name="interval" value="<?php echo $interval->value; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-6 control-label"><?php echo $eventlog->name; ?></label>
                                                            <div class="col-sm-6">
                                                                <input type="text" placeholder="3000"  class="form-control" name="max_eventlog" value="<?php echo $eventlog->value; ?>">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="col-sm-6 col-sm-offset-6">
                                                                <button type="submit" class="btn btn-info">WRITE</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>



                                            </div>


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