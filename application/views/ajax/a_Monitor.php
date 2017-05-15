<section >

    <!--Coloumn 1-->
    <div class="col-md-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">rectifier system</h3>
            </div>
            <div class="panel-body">
                <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6" cellspacing="0" width="100%">
                    <tbody>
                    <?php foreach ($rect_system as $rs): ?>
                        <tr>
                            <td><?php echo $rs->name; ?></td>
                            <td class=""><b class="text-danger"><?php echo  $rs->value .'&nbsp;'.$rs->unit; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <!--Coloumn 1-->

    <!--Coloumn 2-->
    <div class="col-md-6 ">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title dropdown">rectifier module :  <span href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle "><span> Rectifier  <?php echo $this->uri->segment(3); ?>&nbsp;<i class="caret"></i></span></span>


                    <ul class="dropdown-menu">
                        <?php foreach ($rectifier  as $rc): ?>
                            <li class=" <?php echo($rc->status == 0)?'hide':''; ?>"><a href="<?php echo site_url('monitor/rectifier').'/'.$rc->id; ?>"><span> <?php echo 'Rectfier '.  $rc->id?></span></a></li>
                        <?php endforeach; ?>

                    </ul>


                </h3>

            </div>
            <div class="panel-body">
                <section class="col-sm-6">
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
                        <tr>
                            <td>Fan Rotation</td>
                            <td> <?php if (!empty($rect_fan)){echo round($rect_fan,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>
                            <td>rpm</td>
                        </tr>
                        </tbody>
                    </table>

                </section>
                <section class="col-sm-6 ">
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
                            <td colspan="2"><button class="btn btn-xs">ON</button> </td>
                        </tr>

                        </tbody>
                    </table>

                </section>

            </div>
            <div class="panel-heading hide" id="rectifier_alarm">
                <h3 class="panel-title dropdown">Rectifier Alarm
                </h3>

            </div>
            <div class="panel-body hide ">
                <section class="col-sm-6">
                    <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6 " cellspacing="0" width="100%">
                        <tbody>
                        <?php foreach ($rectifier_alarm1 as $ra): ?>
                            <tr>
                                <td><?php echo $ra->name; ?></td>
                                <td class=""><?php echo ($ra->value == 1 )? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'   ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>
                <section class="col-sm-6">
                    <table id="table" class="table table_sortable {sortlist: [[0,0]]} h6 " cellspacing="0" width="100%">
                        <tbody>
                        <?php foreach ($rectifier_alarm2 as $ra): ?>
                            <tr>
                                <td><?php echo $ra->name; ?></td>
                                <td class=""><?php echo ($ra->value == 1 )? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'   ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>


            </div>
        </div>

        <div class="panel panel-danger  ">
            <div class="panel-heading">
                <h3 class="panel-title">Alarm</h3>
            </div>
            <div class="panel-body">
                <section class="col-sm-6">
                    <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                        <tbody>
                        <?php foreach ($alarm1 as $a): ?>
                            <tr>
                                <td><?php echo $a->name ;?> </td>
                                <td><b class="text-danger">
                                        <?php
                                        if($a->value > 0){echo '<span class="blink"><i class="fa fa-bell"></i> Active</span>';}else{echo '';};
                                        ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>
                <section class="col-sm-6">
                    <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                        <tbody>
                        <?php foreach ($alarm2 as $a): ?>
                            <tr>
                                <td><?php echo $a->name ;?> </td>
                                <td><b class="text-danger">
                                        <?php
                                        if($a->value > 0){echo '<span class="blink"><i class="fa fa-bell"></i> Active</span>';}else{echo '';};
                                        ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>
            </div>
        </div>

    </div>
    <!--Coloumn 2-->

    <!--Coloumn 3-->
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Rectifier <?php echo $this->uri->segment(3);?>  Alarm</h3>
            </div>
            <div class="panel-body">
                <table id="table" class="table table_sortable {sortlist: [[0,0]]} " cellspacing="0" width="100%">
                    <tbody>

                    <tr>
                        <td>Rectifier Fail</td>
                        <td><?php if (!empty($rectFail)){echo  ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>
                    </tr>
                    <tr>
                        <td>Rectifier Fan Fail</td>
                        <td><?php if (!empty($rectFanFail)){echo  ($rectFanFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                    </tr>
                    <tr>
                        <td>Rectifier Over Temperature</td>
                        <td><?php if (!empty($rectOverTemp)){echo  ($rectOverTemp == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                    </tr>
                    <tr>
                        <td>Rectifier Current Limit</td>
                        <td><?php if (!empty($rectCurLimit)){echo  ($rectCurLimit == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                    </tr>
                    <tr>
                        <td>Rectifier Over Voltage</td>
                        <td><?php if (!empty($rectOverVoltage)){echo  ($rectOverVoltage == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}else{echo '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>';}; //echo ($rectFail == 1)? '<b class="text-danger "><i class="fa fa-bell blink"></i> Alrm</b>': '<b class="text-success"><i class="fa fa-circle blink"></i> Nrml</b>'; ?></td>

                    </tr>


                    </tbody>

                </table>
            </div>
        </div>
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
    <!--Coloumn 3-->

</section>
