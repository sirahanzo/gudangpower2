<?php $this->load->view('template/v_Head') ?>
<link href="<?php echo base_url(); ?>assets/libs/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
<style>
    #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
        padding: 3px;
        font-size: 14px;
    }

</style>
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
                        <div class="pages pages_dashboard template template__table_data  template__controls">
                            <div class="row">

                                <!--Content Page-->
                                <div class="col-md-5">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Registration form</h3> </div>
                                        <div class="panel-body">
                                            <div class="alert alert-danger <?php if ($this->session->flashdata('error') == '') echo 'hide';; ?>">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                            <form data-toggle="validator" data-disable="false" role="form" method="post" action="<?php echo site_url('auth/register'); ?>">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label">Username</label>
                                                    <input type="text" class="form-control" id="inputName"  required="" name="username" > </div>
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label">Password</label>
                                                    <div class="container-fluid half-padding">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <input type="password" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required="" name="password"> <span class="help-block">Minimum of 6 characters</span> </div>
                                                            <div class="form-group col-sm-6">
                                                                <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required="" name="passconf">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                    <button type="reset" class="btn btn-default">REFRESH</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">User database</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="container-fluid half-padding">
                                                <div id="buttons"></div>
                                                <br/>
                                                <table id="table" class="table datatable display table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th class="col-sm-2">No</th>
                                                        <th class="col-sm-8">Name</th>
                                                        <th>Option</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php foreach ($userlist as $list): ?>
                                                        <tr>
                                                            <td><?php echo ($list->id -1)  ?></td>
                                                            <td><?php echo $list->username ?></td>
                                                            <td>
                                                                <button type="button" data-toggle="modal" data-target="#delete<?php echo $list->id ?>" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash"></i></button>
                                                                <button type="button" data-toggle="modal" data-target="#edit<?php echo $list->id ?>" class="btn btn-success btn-xs "><i class="fa fa-fw fa-pencil"></i></button>
                                                                <a href="<?php echo site_url('administrator/edit'.'/'.$list->username); ?>">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <!--Modals Delete-->
                                                        <div id="delete<?php echo $list->id ?>" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title text-danger"><i class="alert-ico fa fa-fw fa-warning"></i><strong>Warning !</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div role="alert" class="alert1 alert-danger1">
                                                                            <b> <?php echo $list->username ?></b>
                                                                            will be delete, Continue ?
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="<?php echo site_url('auth/delete').'/'.$list->id; ?>" type="button" class="btn btn-danger">Yes</a>
                                                                        <a href="<?php //echo site_url('auth/delete').'/'.$list->id; ?>" type="button" data-dismiss="modal" class="btn btn-default">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Modals Delete-->

                                                        <!--Modals Edit-->

                                                        <div id="edit<?php echo $list->id ?>" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title text-danger"><i class="alert-ico fa fa-fw fa-warning"></i><strong>Warning !</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo site_url('auth/update'); ?>" method="post">
                                                                            <input type="hidden" value="<?php echo $list->id ?>" name="id">
                                                                            <div class="row">
                                                                                <div class="col-md-8 col-sm-offset-1">
                                                                                    <div class="form-group">
                                                                                        <label>Username </label>
                                                                                        <div class="">
                                                                                            <input type="text" value="<?php echo $list->username?>" name="username" class="form-control">

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Password </label>
                                                                                        <div class="">
                                                                                            <input type="password" value="" name="password" class="form-control">

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label> Password Confirmation </label>
                                                                                        <div class="">
                                                                                            <input type="password" value="" name="passconf" class="form-control">

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="col-sm-10">
                                                                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                                                            <button type="submit" class="btn btn-default">REFRESH</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                    <div class="modal-footer hide">
                                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                                        <a href="<?php //echo site_url('auth/delete').'/'.$list->id; ?>" type="button" data-dismiss="modal" class="btn btn-default">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--Modals Edit-->



                                                    <?php endforeach; ?>


                                                    </tbody>
                                                </table>
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
        <!--MAIN CONTENT-->

    </div>
</div>




<?php $this->load->view('template/v_Foot') ?>
<script src="<?php echo base_url(); ?>assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/bootstrap-validator/dist/validator.min.js"></script>
<script>
    $(document).ready(function () {
        if ($('.template__table_data .datatable').length) {
            var table = $('.datatable').DataTable(
                {
                    ordering: true
                }
            );
        }
    });
</script>
