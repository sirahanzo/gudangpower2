<div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/ac_distribution'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'AC')? 'active':''; ?> ">AC </a>
    </div>
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/rectifier_module'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'RM')? 'active':''; ?> ">RECTIFIER MODULE </a>
    </div>
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/dc_distribution1'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'DC1')? 'active':''; ?> ">DC  1</a>
    </div>
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/dc_distribution2'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'DC2')? 'active':''; ?> ">DC  2</a>
    </div>
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/dc_distribution3'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'DC3')? 'active':''; ?> ">DC  3</a>
    </div>
    <div class="btn-group" role="group">
        <a href="<?php echo site_url('controll/other'); ?>" type="button" class="btn btn-info <?php echo ($subpage == 'Other')? 'active':''; ?> ">OTHER</a>
    </div>
</div>