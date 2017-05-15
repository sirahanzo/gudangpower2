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