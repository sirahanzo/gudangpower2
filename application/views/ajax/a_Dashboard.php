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
