<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="20">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>Dummy Monitoring</title>
</head>
<body>
<h2>Dummy Monitoring:</h2>
<hr>
<div class="main">
    <div class="main__scroll scrollbar-macosx">
        <div class="main__cont">

            <div class="container-fluid half-padding">
                <div class="pages pages_dashboard">
                    <div class="row">

                        <!--Content Page-->
                        <div class="col-md-4">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">System</h3></div>
                                <div class="panel-body">

                                    <?php
                                    /* for ($x = 0; $x <= 10; $x++) {
                                         echo "The number is: $x <br>";
                                     }*/

                                    $ibat1 = rand(50,51);
                                    $ibat2 = rand(1,9);
                                    $value_alarm = rand(0,1);


                                    foreach ($ibatt as $p):
                                        echo $p->id.'.'.$p->name .'='.$ibat1.','.$ibat2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $ibat1.'.'.$ibat2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;


                                    $load1 = rand(200,201);
                                    $load2 = rand(1,9);
                                    $value_alarm = rand(0,1);


                                    foreach ($iload as $p):
                                        echo $p->id.'.'.$p->name .'='.$load1.','.$load2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $load1.'.'.$load2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;

                                    $value1 = rand(54,55);
                                    $value2 = rand(1,9);
                                    $value_alarm = rand(0,1);


                                    foreach ($busV as $p):
                                        echo $p->id.'.'.$p->name .'='.$value1.','.$value2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $value1.'.'.$value2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;


                                    $vac1= rand(250,251);
                                    $vac2= rand(1,10);
                                    //dummy parameter_monitoring for log
                                    foreach ($parameter as $p):
                                        echo $p->id.'.'.$p->name .'='.$vac1.'.'.$vac2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $vac1.'.'.$vac2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;


                                   /* //dummy parameter_monitoring for log
                                    foreach ($relay as $p):
                                        echo $p->id.'.'.$p->name .'='.$value_alarm.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $value_alarm,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;*/





                                    ?>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Rectifier</h3></div>
                                <div class="panel-body">

                                    <?php
                                    $irect1 = rand(150,151);
                                    $irect2 = rand(1,10);

                                    foreach ($irect as $p):
                                        echo $p->id.'.' .$p->name .'='.$irect1.'.'.$irect2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $irect1.'.'.$irect2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;


                                    $temp1 = rand(28,29);
                                    $temp2 = rand(1,10);

                                    foreach ($temp as $p):
                                        echo $p->id.'.' .$p->name .'='.$temp1.'.'.$temp2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $temp1.'.'.$temp2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring',$data);

                                    endforeach;




                                   /* $value_alarm = rand(0,2);


                                    //dummy rectifier for log
                                    foreach ($rect as $p):
                                        echo $p->id.'.' .$p->name .'='.$value1*$value2++.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $value1*$value2++,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring_rectifier',$data);

                                    endforeach;*/

                                    echo '<hr>';
                                    echo 'ALARM RECTIFIER :<br/>';
                                    //dummy alarm for trigers
                                    foreach ($alarm_rect as $p):


                                        echo $p->id.'.'. $p->name .'='.$value_alarm.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $value_alarm,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring_rectifier',$data);

                                    endforeach;
                                    ?>



                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">alarm</h3></div>
                                <div class="panel-body">

                                    <?php

                                    foreach ($alarm_all as $p):

                                        //echo '<hr>';
                                        //echo 'ALARM RECTIFIER :<br/>';
                                        echo $p->id.'.'. $p->name .':'.$value_alarm.'<br/>';
                                        $value = ['value'];
                                        $data = [
                                            'value' => $value_alarm,
                                        ];

                                        $this->db->where('parameter_id',$p->id);
                                        $this->db->update('monitoring_alarm',$data);

                                    endforeach;

                                    ?>

                                </div>
                            </div>

                        </div>

                        <!--Content Page-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>