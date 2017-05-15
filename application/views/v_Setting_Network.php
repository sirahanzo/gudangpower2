<?php $this->load->view('template/v_Head') ?>

    <body class="framed main-scrollable">

<div class="wrapper">

    <?php $this->load->view('template/v_NavBar'); ?>

    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
            <?php $this->load->view('template/v_SidebarMenu') ?>
            <!--Sidebar Menu-->
        </div>
        <!--ASIDE-->

        <!--MAIN CONTENT-->
        <div class="main">
            <div class="main__scroll scrollbar-macosx">
                <div class="main__cont">

                    <div class="container-fluid half-padding">
                        <div class="pages pages_dashboard">
                            <div class="row">

                                <!--Content Page-->
                                <div class="col-md-5">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">NETWORK CONNECTION</h3> </div>
                                        <div class="panel-body">

                                            <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                            </div>

                                            <form data-toggle="validator" data-disable="false" role="form" method="post" action="<?php echo site_url('settings/save_network'); ?>">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">IP address</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="192.168.137.100" required="" name="ipaddress" value="<?php echo $network->ipaddress; ?>"> </div>

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">Subnet Mask</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="255.255.255.0" required="" name="netmask" value="<?php echo $network->netmask; ?>"> </div>

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">Default Gateway</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="192.168.137.1" required="" name="gateway" value="<?php echo $network->gateway; ?>"> </div>


                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                                    <button type="reset" class="btn btn-default">RERESH</button>
                                                    <button type="button" data-toggle="modal" data-target="#modal2" class="btn btn-danger">REBOOT</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">SNMP Protocol</h3> </div>
                                        <div class="panel-body">

                                            <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                            </div>

                                            <form data-toggle="validator" data-disable="false" role="form" method="post" action="<?php echo site_url('settings/save_snmp'); ?>">

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">SNMP Server </label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="192.168.137.1" required="" name="snmp1" value="<?php echo $network->snmp_server1; ?>"> </div>

                                                <div class="form-group hide">
                                                    <label for="inputName" class="control-label">SNMP Server 2</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="192.168.137.1" required="" name="snmp2" value="<?php echo $network->snmp_server2; ?>"> </div>

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">SNMP Version</label>
                                                    <select name="snmp_ver" id="inputID" class="form-control">
                                                    	<option value="<?php echo $network->snmp_version?>"><?php echo $network->snmp_version?></option>
                                                    	<option value="V. 1">V. 1</option>
                                                    	<option value="V. 2">V. 2</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                                    <button type="reset" class="btn btn-default">RERESH</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 hide">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Serial port</h3> </div>
                                        <div class="panel-body">

                                            <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                            </div>

                                            <form data-toggle="validator" data-disable="false" role="form" method="post" action="<?php echo site_url('settings/save_serial'); ?>">

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">Baudrate </label>
                                                    <select name="baudrate" id="inputID" class="form-control">
                                                    	<option value="<?php echo $network->port_baudrate; ?>"> <?php echo $network->port_baudrate; ?> </option>
                                                    	<option value="9600"> 9600 </option>
                                                    	<option value="51200"> 51200 </option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">Address </label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="1" required="" name="address" value="<?php echo $network->port_address; ?>">
                                                </div>


                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                                    <button type="reset" class="btn btn-default">RERESH</button>
                                                </div>
                                            </form>
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
        <!--MAIN CONTENT-->

    </div>
</div>

<!--  POPUP MODAL  -->
<div id="modal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation.</h4>
            </div>
            <div class="modal-body">
                <p>Continue to Reboot ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">NO</button>
                <a href="<?php echo site_url('auth/reboot'); ?>" type="button" class="btn btn-danger">YES</a>
            </div>
        </div>
    </div>
</div>
<!--  POPUP MODAL  -->


<?php $this->load->view('template/v_Foot') ?>