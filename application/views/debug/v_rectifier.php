<?php $this->load->view('template/v_Head') ?>
<style>
    #table > tbody > tr > td, #table > tbody > tr > th, #table > tfoot > tr > td, #table > tfoot > tr > th, #table > thead > tr > td, #table > thead > tr > th {
        padding: 3px;
        font-size: 13px;
    }

    #rectifier_alarm {
        border-bottom-color: red;
    }

</style>

<body class="framed main-scrollable">

<div class="wrapper">


    <div class="dashboard">

        <!--ASIDE-->
        <div class="sidebar">
            <!--Sidebar Menu-->
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
                                <section>
                                    <section id="col2">
                                        <?php
                                        $rect_voltage = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'];
                                        $rect_current = [1,2,0,4,0,0,0,0,0,0,0,0,0,0,0,0];
                                        $rect_temp = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'];
                                        ?>

                                        <?php $a=$b=$c=$d=$e=$f =$y=$z=0;  for ($x = 0; $x <= 15;  ) {  ?>
                                            <div class="col-md-2 ">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title dropdown">Rect <?php echo  $x++;?>
                                                        </h3>
                                                    </div>

                                                    <!--view on ajax/a_Monitor_Col2_Rect-->

                                                    <section id="rect_module" >
                                                        <div class="panel-body " id="">

                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6 " cellspacing="0" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Voltage</td>
                                                                    <td> <?php echo round($rect_voltage[$a++],2);//if (!empty($rect_voltage[$a++])){echo round($rect_voltage[$b++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>V</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Current</td>
                                                                    <td> <?php echo round($rect_current[$b++],2);// if (!empty($rect_current[$c++])){echo round($rect_current[$d++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
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
                                                                    <td>Temp.
                                                                    </td>
                                                                    <td> <?php echo round($rect_temp[$c++],2);// if (!empty($rect_temp[$e++])){echo round($rect_temp[$f++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>

                                                                    <td>&deg;C</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                                <tbody>

                                                                <tr>
                                                                    <td>Connect</td>
                                                                    <td>
                                                                        <?php if (!empty($rectModuleConected)){echo  ($rectModuleConected == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Comm.Lost</td>
                                                                    <td><?php if (!empty($rectCommLost)){echo  ($rectCommLost == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>Protect</td>
                                                                    <td><?php if (!empty($rectProtection)){echo  ($rectProtection == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>AC Fail</td>
                                                                    <td><?php if (!empty($rectACFail)){echo  ($rectACFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Fan Fail</td>
                                                                    <td><?php if (!empty($rectFanFail)){echo  ($rectFanFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>Hibernation</td>
                                                                    <td><?php if (!empty($rectHibernation)){echo  ($rectHibernation == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr>
                                                                    <td>StartUp/Shutdwon</td>
                                                                    <td><?php if (!empty($rectStartShut)){echo  ($rectStartShut == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>
                                                                <tr>
                                                                    <td> Curr. Limit</td>
                                                                    <td><?php if (!empty($rectCurLimit)){echo  ($rectCurLimit == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>


                                                                <tr>
                                                                    <td>Module Fail</td>
                                                                    <td><?php if (!empty($rectFail)){echo  ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>
                                                                </tr>


                                                                <tr>
                                                                    <td>High Temp</td>
                                                                    <td><?php if (!empty($rectHiTemp)){echo  ($rectHiTemp == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td> Over Temp</td>
                                                                    <td><?php if (!empty($rectOverTemp)){echo  ($rectOverTemp == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td> Over V</td>
                                                                    <td><?php if (!empty($rectOverVoltage)){echo  ($rectOverVoltage == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>';}else{echo '<b class="text-success"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?></td>

                                                                </tr>





                                                                </tbody>

                                                            </table>

                                                        </div>
                                                    </section>
                                                    <!--view on ajax/a_Monitor_Col2_Alarm-->


                                                </div>
                                            </div>
                                        <?php  } ?>


                                    </section>


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

</script>
