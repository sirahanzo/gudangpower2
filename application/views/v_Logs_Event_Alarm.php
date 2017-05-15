<?php $this->load->view('template/v_Head') ?>
<link href="<?php echo base_url(); ?>assets/libs/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
<style>
    #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th
    {
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

                                <div class="col-md-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">eventlog</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="container-fluid half-padding">
                                                <div id="buttons"></div>
                                                <form action="<?php echo site_url('logs/event_alarm') ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="">Event Log : </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <div class="input-group date">
                                                                    <input type="text" placeholder="Start" class="form-control" name="from">
                                                                    <div class="input-group-addon">
                                                                        <div class="fa fa-calendar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <div class="input-group date">
                                                                    <input type="text" placeholder="End" class="form-control" name="to">
                                                                    <div class="input-group-addon">
                                                                        <div class="fa fa-calendar"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-sm btn-info hide" type="submit">Show</button>
                                                                <input type="submit" name="show" value="Show" class="btn btn-sm btn-info" />
                                                                <input type="submit" name="download" value="Download" class="btn btn-sm btn-success"/>
                                                                <button class="btn btn-sm " type="submit"><i class="fa fa-refresh"></i></button>
                                                                <button type="button" data-toggle="modal" data-target="#modal1" class="btn btn-sm btn-danger">Clear</button>

                                                            </div>
                                                        </div>


                                                    </div>

                                                </form>
                                                <br/>
                                                <table id="table" class="table datatable display table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Dtime</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php foreach($eventlog as $data){ ?>
                                                        <tr class="gradeB">
                                                            <td>
                                                                <?php echo $data->name ?>
                                                            </td>
                                                            <td><?php echo $data->dtime; ?></td>
                                                            <td class="">
                                                                <?php /* if($data->event > 1){
                                                                    //echo 'show alarm';
                                                                    echo 'Alarm Start';
                                                                }else{ echo 'Alarm Cleared';};*/

                                                               //echo $data->event;
                                                                if ($data->event ==0){echo 'Alarm Start';}
                                                                if ($data->event ==1){echo 'Alarm Cleared';}

                                                                ?>
                                                            </td>



                                                        </tr>
                                                    <?php } ?>

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

<!--modal delete-->
<div id="modal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alert!</h4>
            </div>
            <div class="modal-body">
                <div role="alert" class="alert alert-danger">
                    <h4><i class="alert-ico fa fa-fw fa-ban"></i><strong>Delete Eventlog ? &thinsp;</strong></h4>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo site_url('logs/delete_eventlog'); ?>" type="" class="btn btn-primary">Continue</a>
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--modal delete-->

<?php $this->load->view('template/v_Foot') ?>
<script src="<?php echo base_url(); ?>assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables/media/js/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        if ($('.template__table_data .datatable').length) {
            var table = $('.datatable').DataTable(
                {
                    ordering: true
                }
            );
        }
    });
</script>
