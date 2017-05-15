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