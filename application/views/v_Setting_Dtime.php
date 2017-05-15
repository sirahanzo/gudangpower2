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
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Date & time</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form">
                                                <form action="<?php echo site_url('settings/save_dtime') ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Date</label>
                                                                <div class="input-group date">
                                                                    <input type="text" value="2016-09-30" class="form-control" name="date">
                                                                    <div class="input-group-addon">
                                                                        <div class="fa fa-calendar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Time</label>
                                                                <div class="input-group timepicker bootstrap-timepicker">
                                                                    <input type="text" class="form-control" name="time">
                                                                    <div class="input-group-addon">
                                                                        <div class="fa fa-clock-o"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 hide">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Logs</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-6 control-label">Maximum Of Datalog</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" placeholder="3000" class="form-control" name="max_datalog">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="col-sm-6 control-label">Rows
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-6 control-label">Interval Of Datalog
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <select placeholder="Select" class="selectpicker form-control" name="interval">
                                                            <option>1</option>
                                                            <option>3</option>
                                                            <option>5</option>
                                                            <option>7</option>
                                                            <option>10</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="col-sm-6 control-label">Minutes
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-6 control-label">Maximum Of Eventlog</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" placeholder="3000" class="form-control" name="max_eventlog">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="col-sm-6 control-label">Rows
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-6">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
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