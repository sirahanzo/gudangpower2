<?php $this->load->view('template/v_Head') ?>
<style>

    #rect_table>tbody>tr>td, #rect_table>tbody>tr>th, #rect_table>tfoot>tr>td, #rect_table>tfoot>tr>th, #rect_table>thead>tr>td, #rect_table>thead>tr>th{
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
    }

    #phase{
        margin-right: 10px;
        padding-right: 0px;
        color: red;
    }

    #rect{
        margin-right: 10px;
        margin-left: -15px;
        padding-right: 0px;
        color: green;
    }
    #batt,#iload{
        margin-right: 10px;
        margin-left: -15px;
        padding-right: 0px;
        color: black;
        border-color: grey;
    }

    #v_bus{
        left: -150px;
        top: -40px;
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
                            <div class="row " id="monitoring">

                                <!--Content Page-->
                                <section >

                                    <div class="col-md-8">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">schematic rectifier <?php echo $this->uri->segment(3); ?></h3>
                                            </div>
                                            <div class="panel-body" >
                                                <div class="col-sm-3">
                                                        <table class="table1">

                                                            <tbody>
                                                            <tr>
                                                                <td><span id="phase">R</span></td>
                                                                <td>
                                                                    <div class="form-group1 has-error has-feedback col-xs-6 col-md-12 col-lg-10 ">
                                                                        <input type="text" value="<?php echo (!empty($phase[0]->value))?number_format($phase[0]->value,1): '0'; ?> V " class="form-control" disabled id="phase">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><span id="phase">S</span></td>
                                                                <td>
                                                                    <div class="form-group1 has-error has-feedback col-xs-6 col-md-12 col-lg-10 ">
                                                                        <input type="text" value="<?php echo (!empty($phase[1]->value))?number_format($phase[1]->value,1): '0'; ?> V " class="form-control" disabled id="phase">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><span id="phase">T</span></td>
                                                                <td>
                                                                    <div class="form-group1 has-error has-feedback col-xs-6 col-md-12 col-lg-10 ">
                                                                        <input type="text" value="<?php echo (!empty($phase[2]->value))?number_format($phase[2]->value,1): '0'; ?> V " class="form-control" disabled id="phase">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="col-sm-6 " >
                                                        <img src="<?php echo base_url('assets/img/schematic6a.png'); ?>" alt="">
                                                        <table class="table1 col-sm-offset-5" style="margin-top: -40px">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback  col-sm-7">
                                                                        <!--rectifier voltage-->
                                                                        <input type="text" value="<?php echo (!empty($rect_voltage))? number_format($rect_voltage ,1): '0' ?> V" class="form-control" disabled id="rect">
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback  col-sm-7">
                                                                        <!--rectifier current 1-->
                                                                        <input type="text" value="<?php echo (!empty($rectA1))? number_format($rectA1 ,1): '0' ?> A" class="form-control" disabled id="rect">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback  col-sm-7">
                                                                        <!--rectifier current 2-->
                                                                        <input type="text" value="<?php echo (!empty($rectA2))? number_format($rectA2 ,1): '0' ?> A" class="form-control" disabled id="rect">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback  col-sm-7">
                                                                        <!--rectifier current 3-->
                                                                        <input type="text" value="<?php echo (!empty($rectA3))? number_format($rectA3 ,1): '0' ?> A" class="form-control" disabled id="rect">
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-sm-6 col-sm-offset-9 ">
                                                        <table class="table1" style="margin-top: -220px; margin-left: 30px" >

                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback1  col-sm-6" id="v_bus">
                                                                        <!--bus voltage-->
                                                                        <input type="text" value="<?php echo (!empty($busvoltage[0]->value))? number_format($busvoltage[0]->value,1):'0' ?> V" class="form-control" disabled >
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback1  col-sm-6" >
                                                                        <!--load current-->
                                                                        <input type="text" value="<?php echo (!empty($loadcurrent[0]->value))? number_format($loadcurrent[0]->value,1):'0' ?> A" class="form-control" disabled id="iload" >
                                                                    </div>
                                                                </td>
                                                            </tr>


                                                            </tbody>
                                                        </table>
                                                        <table class="table1" style="margin-top: 20px" >

                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback1  col-sm-6">
                                                                        <!--batterty current-->
                                                                        <input type="text" value="<?php echo (!empty($battcurrent[0]->value))? number_format($battcurrent[0]->value,1):'0' ?> A" class="form-control" disabled id="batt">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group1 has-success has-feedback1  col-sm-6">
                                                                        <!--battery temperature-->
                                                                        <input type="text" value="<?php echo (!empty($batttemp[0]->value))? number_format($batttemp[0]->value,1):'0' ?> &deg;C" class="form-control" disabled id="batt">
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                <div class="col-sm-4">
                                                    <table class="table ">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2">Parameter Name</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                            <td>Phase R</td>
                                                            <td><?php echo (!empty($phase[0]->value))?number_format($phase[0]->value,1): '0'; ?> V</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phase S</td>
                                                            <td><?php echo (!empty($phase[1]->value))?number_format($phase[1]->value,1): '0'; ?> V</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phase T</td>
                                                            <td><?php echo (!empty($phase[2]->value))?number_format($phase[2]->value,1): '0'; ?> V</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-4   ">
                                                    <table id="" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                        <thead class="">
                                                        <tr>
                                                            <th colspan="2" class="center">Parameter Name</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Rect. Voltage</td>
                                                            <td><?php if (!empty($rect_voltage)){echo number_format($rect_voltage,1) .'&nbsp;V';}else{echo '0 V';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rect. Current 1 </td>
                                                            <td><?php if (!empty($rectA1)){echo number_format($rectA1,1) .'&nbsp;A';}else{echo '0 A';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>

                                                        </tr>

                                                        <tr>
                                                            <td>Rect. Current 2</td>
                                                            <td><?php if (!empty($rectA2)){echo number_format($rectA2,1) .'&nbsp;A';}else{echo '0 A';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>

                                                        </tr>
                                                        <tr>
                                                            <td>Rect. Current 3</td>
                                                            <td><?php if (!empty($rectA3)){echo number_format($rectA3,1) .'&nbsp;A';}else{echo '0 A';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>

                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-sm-4 ">
                                                    <table id="" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                        <thead class="">
                                                        <tr>
                                                            <th colspan="2" class="center">Parameter Name</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($busvoltage as $sc1): ?>
                                                            <tr>
                                                                <td><?php echo $sc1->name; ?> </td>
                                                                <td><?php echo (!empty($sc1->value))? number_format($sc1->value,1) . '&nbsp;V' :'0&nbsp;V' ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($loadcurrent as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo number_format($sc2->value,1). '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                        <?php foreach ($battcurrent as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo number_format($sc2->value,1). '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($batttemp as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo number_format($sc2->value,1). '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Rectifier identity</h3>
                                            </div>
                                            <div class="panel-body">

                                                <table class="table table-condensed1 " style="border-collapse:collapse;" id="rect_table">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>S/N</th>
                                                        <th>S/w</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($rectifier as $rt): ?>
                                                        <tr class=" <?php echo  ($rt->status == 0 )? 'hide': '';?>">
                                                            <td>
                                                                <a type="button" class="btn  btn-default btn-xs"  href="<?php echo site_url('dashboard/rectifier').'/'. $rt->id ?>" >Rectifier <?php echo $rt->id ?> </a>
                                                            </td>
                                                            <td><?php //echo $rt->serial_number ?>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary btn-xs"><?php echo $rt->serial_number ?></button>
                                                                    <div class="btn-group">
                                                                        <button type="button " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-primary btn-xs dropdown-toggle"><span class="caret"></span></button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">SN0001A</a></li>
                                                                            <li><a href="#">SN0001B</a></li>
                                                                            <li><a href="#">SN0001C</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $rt->software_ver ?></td>
                                                            <td class="hide"><?php echo ($rt->status == 1)? 'Enable':''; echo ($rt->status == 2)? 'Disable':'' ?></td>
                                                        </tr>

                                                    <?php endforeach; ?>

                                                    </tbody>
                                                </table>
                                                <table id="" class=" hide table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>S/N</th>
                                                        <th>S/W</th>
                                                        <th class="hide">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($rectifier as $rt): ?>
                                                        <tr class=" <?php echo  ($rt->status == 0 )? 'hide': '';?>">
                                                            <td><a href="<?php echo site_url('dashboard/rectifier').'/'. $rt->id ?>">Rect. <?php echo $rt->id ?></a></td>
                                                            <td><?php echo $rt->serial_number ?></td>
                                                            <td><?php echo $rt->software_ver ?></td>
                                                            <td class="hide"><?php echo ($rt->status == 1)? 'Enable':''; echo ($rt->status == 2)? 'Disable':'' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>

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

<script>
    /*setTimeout(function refreshTable() {
        $.ajax({
            url:'<?php echo site_url('dashboard/ajax_dashboard').'/'.$this->uri->segment(3) ?>',

            dataType:'html',
            data:{
                someparam:'someval'
            },
            success:function(data) {
                $('#monitoring').find('section').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);

    setTimeout(function refreshTable() {
        $.ajax({
            url:'<?php echo site_url('dashboard/active_alarm').'/'.$this->uri->segment(3) ?>',

            dataType:'html',
            data:{
                someparam:'someval'
            },
            success:function(data) {
                $('#active_alarm').find('section').empty().append(data);
                setTimeout(refreshTable, 1000);
            }
        });
    }, 1000);*/

    $(function () {
        $('[data-toggle="tooltip"]').tooltip('show')
    })
</script>


<?php $this->load->view('template/v_Foot') ?>

