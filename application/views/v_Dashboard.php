<?php $this->load->view('template/v_Head') ?>
    <style>
        /* Small Devices, Tablets */
        @media only screen and (max-width: 480px) {
            #input1 {
                margin-left: 240px;
                margin-top: 60px;
                width: 70px;
            }

            #input8 {
                margin-left: 80px;
                width: 70px;

            }

            #input2 {
                margin-left: 155px;
                margin-top: 80px;
                width: 70px;

            }

            #input3 {
                margin-left: 200px;
                margin-top: 60px;
                opacity: 1;
                width: 70px;


            }

            #input4 {
                margin-left: -100px;
                margin-top: 115px;
                opacity: 1;
            }

            #input5 {
                margin-left: 0px;
                margin-top: 180px;
                opacity: 1;

            }

            #input6, #input7 {
                margin-left: 0px;
                margin-top: 160px;
                opacity: 1;
            }

            #schematic {
                margin-top: -95px;
            }

        }

        /* Large Devices, Wide Screens */
        @media only screen and (min-width: 1200px) {

            #input1 {
                margin-left: 240px;
                margin-top: 60px;
            }

            #input8 {
                margin-left: 80px;
            }

            #input2 {
                margin-left: 155px;
                margin-top: 80px;
            }

            #input3 {
                margin-left: 200px;
                margin-top: 60px;
                opacity: 1;

            }

            #input4 {
                margin-left: -100px;
                margin-top: 115px;
                opacity: 1;
            }

            #input5 {
                margin-left: 0px;
                margin-top: 180px;
                opacity: 1;

            }

            #input6, #input7 {
                margin-left: 0px;
                margin-top: 160px;
                opacity: 1;
            }

           /* #schematic {
                margin-top: -95px;
                background-image: url(<?php echo base_url('assets/img/schematic2.png'); ?>);
                height: 300px;
                width: 510px;
                border: 0px solid black;
                background-repeat: no-repeat;
                margin-top: 10px;
                margin-left: 30px;
            }*/

        }

        #input1 {
            margin-left: 240px;
            margin-top: 60px;
            width: 70px;
        }

        #input8 {
            margin-left: 80px;
        }

        #input2 {
            margin-left: 155px;
            margin-top: 80px;
            width: 70px;

        }

        #input3 {
            margin-left: 200px;
            margin-top: 60px;
            width: 70px;

            opacity: 1;

        }

        #input4 {
            margin-left: -100px;
            margin-top: 115px;
            opacity: 1;
        }

        #input5 {
            margin-left: 0px;
            margin-top: 180px;
            opacity: 1;

        }

        #input6, #input7 {
            margin-left: 0px;
            margin-top: 160px;
            opacity: 1;
        }

        /*#schematic {
            margin-top: -95px;
            background-image: url(<?php echo base_url('assets/img/schematic3.png'); ?>);
            height: 300px;
            width: 510px;
            border: 0px solid black;
            background-repeat: no-repeat;
            margin-top: 10px;
            margin-left: 30px;
        }*/

        .hiddenRow {
            padding: 0 !important;
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

                                    <div class="col-md-7">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">schematic</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div style="display: block;" class="content  ">

                                                    <div
                                                        style="background-image: url(<?php echo base_url('assets/img/schematic2.png'); ?>);height: 300px;width: 510px;border: 0px solid black;background-repeat: no-repeat;margin-top: 10px;margin-left: 30px;"
                                                        id="schematic">

                                                        <?php
                                                        foreach ($busvoltage as $sc1): ?>
                                                            <div class="col-md-2  col-sm-1  has-success">
                                                                <input type="text" class="form-control" id="input1" size="5"
                                                                       value="<?php echo (!empty($sc1->value))? $sc1->value . '&nbsp;V' :'0&nbsp;V' ?>">
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>


                                                        <div class="col-sm-2  has-success">
                                                            <input type="text" class="form-control" id="input2" size="5"
                                                                   value="<?php if (!empty($rect_voltage)){echo round($rect_voltage,2) .'&nbsp;'. $volt;}else{echo '0 V';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?>">
                                                        </div>
                                                        <br>



                                                        <?php
                                                        foreach ($loadcurrent as $sc2): ?>
                                                            <div class="col-sm-2  has-success">
                                                                <input type="text" class="form-control" id="input3" size="5"
                                                                       value="<?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?>">
                                                            </div>

                                                            <br>
                                                        <?php endforeach; ?>

                                                        <?php
                                                        //foreach ($rectcurrent as $sc2): ?>

                                                        <div class="col-sm-2  has-success">
                                                            <input type="text" class="form-control" id="input4" size="5"
                                                                   value="<?php if (!empty($rect_current)){echo round($rect_current,2) . '&nbsp;A';}else{echo '0 A';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?>">
                                                        </div>
                                                        <br>
                                                        <?php //endforeach; ?>


                                                        <?php
                                                        foreach ($battcurrent as $sc2): ?>
                                                            <div class="col-sm-2  has-success">
                                                                <input type="text" class="form-control" id="input5" size="5" disabled
                                                                       value="<?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?>">
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>
                                                        <?php
                                                        foreach ($batttemp as $sc2): ?>
                                                            <div class="col-sm-2  has-success">
                                                                <input type="text" class="form-control" id="input6" size="5" disabled
                                                                       value="<?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?>">
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>


                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <table id="" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                        <thead class="">
                                                        <tr>
                                                            <th colspan="2" class="center">Parameter</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($busvoltage as $sc1): ?>
                                                            <tr>
                                                                <td><?php echo $sc1->name; ?> </td>
                                                                <td><?php echo (!empty($sc1->value))? $sc1->value . '&nbsp;V' :'0&nbsp;V' ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php //foreach ($rectvoltage as $sc1): ?>
                                                        <tr>
                                                            <td><?php //echo $sc1->name; ?> Rectifier Voltage</td>
                                                            <td><?php if (!empty($rect_voltage)){echo round($rect_voltage,2) .'&nbsp;V';}else{echo '0 V';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>
                                                        </tr>
                                                        <?php //endforeach; ?>
                                                        <?php //foreach ($rectcurrent as $sc1): ?>
                                                        <tr>
                                                            <td><?php //echo $rect_current; ?>Rectifer Current </td>
                                                            <td><?php if (!empty($rect_current)){echo round($rect_current,2) .'&nbsp;'. $volt;}else{echo '0 A';} ;//echo round($rect_voltage,2) . '&nbsp;V'  ?></td>

                                                        </tr>
                                                        <?php //endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-sm-6 ">
                                                    <table id="" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                                                        <thead class="">
                                                        <tr>
                                                            <th colspan="2" class="center">Parameter</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($loadcurrent as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($battcurrent as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($batttemp as $sc2): ?>
                                                            <tr>
                                                                <td><?php echo $sc2->name; ?> </td>
                                                                <td><?php if(!empty($sc2->value)){echo $sc2->value. '&nbsp;' . $sc2->unit;}else{echo '0 '. $sc2->unit;}; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                        </tbody>
                                                    </table>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Recitfier identity</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
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

                            <div class="col-md-12">
                                <table class="table table-condensed" style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Name</th>
                                        <th>S/N</th>
                                        <th>S/w</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr data-toggle="collapse" >
                                        <td>1</td>
                                        <td>Rectifier 1</td>
                                        <td data-toggle="collapse" data-target=".demo1">Detail</td>
                                        <td data-toggle="collapse" data-target=".demo1">Detail</td>

                                    </tr>
                                    <tr>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"></div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"> &nbsp; Module A</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SN-0001</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SW-0001</div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"></div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"> &nbsp; Module B</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SN-0001</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SW-0001</div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"></div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1"> &nbsp; Module C</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SN-0001</div>
                                        </td>
                                        <td class="hiddenRow">
                                            <div class="collapse demo1">SW-0001</div>
                                        </td>

                                    </tr>



                                    </tbody>
                                </table>
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
   setTimeout(function refreshTable() {
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
   }, 1000);
</script>


<?php $this->load->view('template/v_Foot') ?>

