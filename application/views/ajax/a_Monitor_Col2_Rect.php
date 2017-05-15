<section class="col-sm-12" >

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
            <td>Temperature of rectifier module
            </td>
            <td> <?php if (!empty($rect_temp)){echo round($rect_temp,2); }else{echo '';} ;//echo round($rect_voltage,2) ;?></td>

            <td>&deg;C</td>
        </tr>
        <tr>
            <td>Remote Shutdown
            </td>
            <td colspan="2">
                <form action="<?php echo site_url('monitor/remote_shutdown').'/'.$this->uri->segment(3); ?>" method="post">
                    <input type="text" class="hide" name="value" id="" value="<?php if (!empty($remote_shutdown)){echo '0';}else{echo '1';}; ?>">
                    <input type="text" class="hide" name="rect" id="" value="<?php echo $this->uri->segment(3);?>">

                    <?php if(!empty($remote_shutdown)){echo  '<button class="btn btn-xs btn-success">ON</button>';}else{echo '<button class="btn btn-xs btn-danger">OFF</button>';} ?>

                </form>

            </td>
        </tr>

        </tbody>
    </table>


</section>
<section class="col-sm-6 ">


</section>