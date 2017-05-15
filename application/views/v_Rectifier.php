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
                                <section>
                                    <section id="col2">

                                        <?php $a=$b1=$b2=$b3=$c=$d=$e=$f=$g=$h=$i=$j=$k=$l=$m=$n=$o=$p =$y=$z=0;  for ($x = 1; $x <= 16;  ) {  ?>
                                            <div class="col-md-2 ">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title dropdown">Rect <?php echo  $x++;?>
                                                        </h3>
                                                    </div>

                                                    <!--view on ajax/a_Monitor_Col2_Rect-->

                                                    <section id="rect_module" >
                                                        <div class="panel-body " id="">

                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Voltage</td>
                                                                    <td> <?php echo round($rect_voltage[$a++],2);//if (!empty($rect_voltage[$a++])){echo round($rect_voltage[$b++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>V</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Current A</td>
                                                                    <td> <?php echo round($rect_current[$b1++],2);// if (!empty($rect_current[$c++])){echo round($rect_current[$d++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Current B</td>
                                                                    <td> <?php echo round($rect_current[$b2++],2);// if (!empty($rect_current[$c++])){echo round($rect_current[$d++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Current C</td>
                                                                    <td> <?php echo round($rect_current[$b3++],2);// if (!empty($rect_current[$c++])){echo round($rect_current[$d++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Temp.</td>
                                                                    <td> <?php echo round($rect_temp[$c++],2);// if (!empty($rect_current[$c++])){echo round($rect_current[$d++],2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                                                                    <td>&deg;C</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                            <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                                <tbody>

                                                                <tr class="hide">
                                                                    <td>Connect</td>
                                                                    <td>
                                                                        <?php echo  ($rectModuleConected[$d++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Comm.Lost</td>
                                                                    <td>
                                                                        <?php echo  ($rectCommLost[$e++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>


                                                                </tr>

                                                                <tr>
                                                                    <td>Protect</td>
                                                                    <td>
                                                                        <?php echo  ($rectProtection[$f++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>

                                                                <tr class="">
                                                                    <td>AC Fail</td>
                                                                    <td>
                                                                        <?php echo  ($rectACFail[$g++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>
                                                                <tr class="hide">
                                                                    <td>Fan Fail</td>
                                                                    <td>
                                                                        <?php echo  ($rectFanFail[$h++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td>Hibernation</td>
                                                                    <td>
                                                                        <?php echo  ($rectHibernation[$i++] == 1)? '<b class="text-danger "></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td>StartUp/Shutdwon</td>
                                                                    <td>
                                                                        <?php echo  ($rectStartShut[$j++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>
                                                                <tr class="hide">
                                                                    <td> Curr. Limit</td>
                                                                    <td>
                                                                        <?php echo  ($rectCurLimit[$k++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>


                                                                <tr >
                                                                    <td>Module Fail</td>
                                                                    <td>
                                                                        <?php echo  ($rectFail[$l++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>
                                                                </tr>


                                                                <tr class="hide">
                                                                    <td>High Temp</td>
                                                                    <td>
                                                                        <?php echo  ($rectHiTemp[$m++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td> Over Temp</td>
                                                                    <td>
                                                                        <?php echo  ($rectOverTemp[$n++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

                                                                </tr>

                                                                <tr class="hide">
                                                                    <td> Over V</td>
                                                                    <td>
                                                                        <?php echo  ($rectOverVoltage[$p++] == 1)? '<b class="text-danger "> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"></i> Nrml</b>'; ?>
                                                                    </td>

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
    setTimeout(function refreshTable() {
        $.ajax({
            url:'<?php echo site_url('rectifier/ajax_rectifier')  ?>',

            dataType:'html',
            data:{
                someparam:'someval'
            },
            success:function(data) {
                $('#monitoring').find('section').empty().append(data);
                setTimeout(refreshTable, 3000);
            }
        });
    }, 1000);
</script>
