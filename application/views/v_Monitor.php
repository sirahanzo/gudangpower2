<?php $this->load->view('template/v_Head') ?>
    <style>
        #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th
        {
            padding: 3px;
            font-size: 13px;
        }

        #rectifier_alarm{
            border-bottom-color: red;
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
                        <div class="pages pages_dashboard">
                            <div class="row" id="monitoring">

                                <!--Content Page-->
                                <section >

                                    <!--Rectifier System-->
                                    <section id="col1">
                                        <div class="col-md-3">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">rectifier system</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6" cellspacing="0" width="100%">
                                                        <tbody>
                                                        <tr class="hide">
                                                            <td>Numbers of rectifier module </td>
                                                            <td class=""><b class="text-danger"><?php if(!empty($numbers_of_rect->group_rect)){ echo $numbers_of_rect->group_rect;}else{ echo '';} ?></b></td>
                                                        </tr>
                                                        <?php foreach ($rect_system as $rs): ?>
                                                            <tr>
                                                                <td><?php echo $rs->name; ?></td>
                                                                <td class=""><b class="text-danger"><?php echo  $rs->value .'&nbsp;'.$rs->unit; ?></b></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                    <!--Rectifier System-->

                                    <!--Rectifier Module-->
                                    <section id="col2">
                                        <div class="col-md-3 ">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title dropdown">rectifier module :  <span href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle "><span>   <?php echo $this->uri->segment(3); ?>&nbsp;<i class="caret"></i></span></span>


                                                        <ul class="dropdown-menu">
                                                            <?php foreach ($rectifier  as $rc): ?>
                                                                <li class=" <?php echo($rc->status == 0)?'hide':''; ?>"><a href="<?php echo site_url('monitor/rectifier').'/'.$rc->id; ?>"><span> <?php echo 'Rect. Module '.  $rc->id?></span></a></li>
                                                            <?php endforeach; ?>

                                                        </ul>


                                                    </h3>

                                                </div>

                                                <!--view on ajax/a_Monitor_Col2_Rect-->
                                                <section id="rect_module">
                                                    <div class="panel-body" id="">
                                                        <section class="col-sm-12" >

                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6 " cellspacing="0" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Rectifier Voltage</td>
                                                                    <td> <?php if (!empty($rect_voltage)){echo round($rect_voltage,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>V</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rectifier Current</td>
                                                                    <td> <?php if (!empty($rect_current)){echo round($rect_current,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr class="hide">
                                                                    <td>Fan Rotation</td>
                                                                    <td> <?php if (!empty($rect_fan)){echo round($rect_fan,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>rpm</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6 " cellspacing="0" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Temperature of rectifier module
                                                                    </td>
                                                                    <td> <?php if (!empty($rect_temp)){echo round($rect_temp,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>

                                                                    <td>&deg;C</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Remote Shutdown
                                                                    </td>
                                                                    <!--<td colspan="2">--><?php //if(!empty($remote_shutdown)){echo  '<button class="btn btn-xs btn-success">ON</button>';}else{echo '<button class="btn btn-xs btn-danger">OFF</button>';} ?><!-- </td>-->
                                                                    <td colspan="2">
                                                                        <form action="<?php echo site_url('monitor/remote_shutdown').'/'.$this->uri->segment(3); ?>" method="post">
                                                                            <input type="text" class="hide" name="value" id="" value="<?php if (!empty($remote_shutdown)){echo '0';}else{echo '1';}; ?>">
                                                                            <input type="text" class="hide" name="rect" id="" value="<?php echo $this->uri->segment(3);?>">

                                                                            <?php if(!empty($remote_shutdown)){echo  '<button class="btn btn-xs btn-success">ON</button>';}else{echo '<button class="btn btn-xs btn-danger">OFF</button>';} ?>

                                                                        </form>                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>



                                                        </section>
                                                        <section class="col-sm-6 ">

                                                        </section>
                                                    </div>
                                                </section>
                                                <!--view on ajax/a_Monitor_Col2_Rect-->

                                            </div>

                                            <!--view on ajax/a_Monitor_Col2_Alarm-->
                                            <section id="alarm">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Rectifier Module <?php echo $this->uri->segment(3);?>  Alarm</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                            <tbody>

                                                            <tr>
                                                                <td>Rectifier Module Connected</td>
                                                                <td><?php if (!empty($rectModuleConected)){echo  ($rectModuleConected == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Rectifier Comm.Lost</td>
                                                                <td><?php if (!empty($rectCommLost)){echo  ($rectCommLost == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr>
                                                                <td>Rectifier Protection</td>
                                                                <td><?php if (!empty($rectProtection)){echo  ($rectProtection == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr>
                                                                <td>AC Fail</td>
                                                                <td><?php if (!empty($rectACFail)){echo  ($rectACFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Rectifier Fan Fail</td>
                                                                <td><?php if (!empty($rectFanFail)){echo  ($rectFanFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr>
                                                                <td>Hibernation</td>
                                                                <td><?php if (!empty($rectHibernation)){echo  ($rectHibernation == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr>
                                                                <td>StartUp/Shutdwon</td>
                                                                <td><?php if (!empty($rectStartShut)){echo  ($rectStartShut == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Rectifier Current Limit</td>
                                                                <td><?php if (!empty($rectCurLimit)){echo  ($rectCurLimit == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>


                                                            <tr>
                                                                <td>Rectifier Fail</td>
                                                                <td><?php if (!empty($rectFail)){echo  ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>
                                                            </tr>


                                                            <tr>
                                                                <td>Rectifier High Temp</td>
                                                                <td><?php if (!empty($rectHiTemp)){echo  ($rectHiTemp == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr class="hide">
                                                                <td>Rectifier Over Temperature</td>
                                                                <td><?php if (!empty($rectOverTemp)){echo  ($rectOverTemp == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>

                                                            <tr class="hide">
                                                                <td>Rectifier Over Voltage</td>
                                                                <td><?php if (!empty($rectOverVoltage)){echo  ($rectOverVoltage == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                                                            </tr>





                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </section>
                                            <!--view on ajax/a_Monitor_Col2_Alarm-->

                                        </div>
                                    </section>
                                    <!--Rectifier Module-->

                                    <!--view on ajax/a_Monitor_Col3-->
                                    <div id="col3">
                                        <section>
                                            <div class="col-md-3">
                                            <div class="panel panel-info " id="">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Alarm</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <section class="col-sm-12">
                                                        <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                            <tbody>
                                                            <?php foreach ($alarm1 as $a): ?>
                                                                <tr>
                                                                    <td><?php echo $a->name ;?> </td>
                                                                    <td><b class="<?php echo ($a->severity == 'Major')?'text-danger':'text-warning';?>">
                                                                            <?php
                                                                            if($a->value > 0){echo '<span class="blink"><i class="fa fa-bell"></i> Act</span>';}else{echo '';};
                                                                            ?></b></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                        <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                            <tbody>
                                                            <?php foreach ($alarm2 as $a): ?>
                                                                <tr>
                                                                    <td><?php echo $a->name ;?> </td>
                                                                    <td><b class="<?php echo ($a->severity == 'Major')?'text-danger':'text-warning';?>">
                                                                            <?php
                                                                            if($a->value > 0){echo '<span class="blink"><i class="fa fa-bell"></i> Act</span>';}else{echo '';};
                                                                            ?></b></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>

                                                    </section>
                                                    <section class="col-sm-6">

                                                    </section>
                                                </div>
                                            </div>

                                        </div>
                                            <div class="col-md-3">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Relay status</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                            <tbody>
                                                            <?php foreach ($relay_status as $di): ?>
                                                                <tr>
                                                                    <td><?php echo $di->name;?></td>
                                                                    <td class="hide"><?php echo $di->value .'&nbsp;'.$di->unit ;?> </td>

                                                                    <td class=""> <?php echo ($di->value == 0 )?'Connect':'Disconnect'; ?></td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                    <!--view on ajax/a_Monitor_Col3-->


                                </section>
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
<script>
    setTimeout(function refreshTable() {
        $.ajax({
            url: '<?php echo site_url('monitor/ajax_col1') . '/' . $this->uri->segment(3) ?>',

            dataType: 'html',
            data: {
                someparam: 'someval'
            },
            success: function (data) {
                $('#col1').find('div').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);

    setTimeout(function refreshTable() {
        $.ajax({
            url: '<?php echo site_url('monitor/ajax_col2_rect') . '/' . $this->uri->segment(3) ?>',

            dataType: 'html',
            data: {
                someparam: 'someval'
            },
            success: function (data) {
                $('#rect_module').find('div').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);

    setTimeout(function refreshTable() {
        $.ajax({
            url: '<?php echo site_url('monitor/ajax_col2_alarm') . '/' . $this->uri->segment(3) ?>',

            dataType: 'html',
            data: {
                someparam: 'someval'
            },
            success: function (data) {
                $('#alarm').find('div').empty().append(data);
                setTimeout(refreshTable, 5000);
            }
        });
    }, 1000);
    setTimeout(function refreshTable() {
        $.ajax({
            url: '<?php echo site_url('monitor/ajax_col3') . '/' . $this->uri->segment(3) ?>',

            dataType: 'html',
            data: {
                someparam: 'someval'
            },
            success: function (data) {
                $('#col3').find('section').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);
</script>
