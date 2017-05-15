<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">All Rectifier</h3>
        </div>
        <div class="panel-body">
            <div class="scroll-wrapper scrollable scrollbar-macosx" style="position: relative;">
                <div class="scrollable scrollbar-macosx scroll-content">
                    <table id="table" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
                        <thead class="">
                        <tr class="text-center">
                            <th class="">Name</th>
                            <th class="text-center">Voltage</th>
                            <th class="text-center">Current A</th>
                            <th class="text-center">Current B</th>
                            <th class="text-center">Current C</th>
                            <th class="text-center">Temp</th>
                            <th class="text-center">Comm.Lost</th>
                            <th class="text-center">Protect</th>
                            <th class="text-center">AC Fail</th>
                            <th class="text-center">Module Fail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($y = 0, $x = 1; $x <= 16; [$x++, $y++]) { ?>
                            <tr>
                                <td> Rectifer <?php echo $x ?></td>
                                <td class="text-center"><?php echo round($rect_voltage[$y], 2); ?> V</td>
                                <td class="text-center"><?php echo round($rect_current[$y][0], 2); ?> A</td>
                                <td class="text-center"><?php echo round($rect_current[$y][1], 2); ?> A</td>
                                <td class="text-center"><?php echo round($rect_current[$y][2], 2); ?> A</td>
                                <td class="text-center"><?php echo round($rect_temp[$y], 2); ?> &deg;C</td>

                                <td class="text-center">
                                    <?php echo ($rectCommLost[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo ($rectProtection[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo ($rectACFail[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo ($rectFail[$y] == 1) ? '<b class="text-danger "> Alrm</b>' : '<b class="text-success"></i> Nrml</b>'; ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>