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
                            <td class=""><b class="text-danger"><?php echo  $rs->value .'&nbsp;'.$rs->unit; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

