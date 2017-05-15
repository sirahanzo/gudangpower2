<li class="dropdown active "><a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><span><i class="fa fa-bell text-danger blink"></i> Active Alarms&nbsp;<i class="caret"></i></span></a>
    <ul class="dropdown-menu">
        <?php foreach ($alarmactive as $act): ?>

            <li><a href="<?php echo site_url('monitor/rectifier/1');?>"><span><?php echo  $act->name ;?></span></a></li>


        <?php endforeach;  ?>

        <?php foreach ($rectifier_alarm_active as $act): ?>

            <li><a href="<?php echo site_url('monitor/rectifier/1');?>"><span><?php if(!empty($act->name)){ echo $act->name; }else{echo '';};?></span></a></li>


        <?php endforeach;  ?>


    </ul>
</li>