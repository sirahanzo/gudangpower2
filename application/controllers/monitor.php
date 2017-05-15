<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 7:08 PM  10/11/2016,Author Hardianto Haris.
 */


/**
 * Class Monitor
 * @property Monitoring_Model $monitoring_model
 */
class Monitor extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index($rect = 1)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('v_Monitor', $data);
    }


    public function rectifier($rect = 1)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';
        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('v_Monitor', $data);
    }


    public function ajax_monitor($rect)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('ajax/a_Monitor', $data);
    }


    public function ajax_col1($rect)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('ajax/a_Monitor_Col1', $data);
    }


    public function ajax_col2_rect($rect)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('ajax/a_Monitor_Col2_Rect', $data);
    }


    public function ajax_col2_alarm($rect)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('ajax/a_Monitor_Col2_Alarm', $data);
    }


    public function ajax_col3($rect)
    {
        $data['page'] = 'Monitor';
        $data['subpage'] = 'Monitor';

        $data = $this->GetAllDataMonitoring($rect, $data);

        $this->load->view('ajax/a_Monitor_Col3', $data);
    }


    public function remote_shutdown()
    {
        $value = $this->input->post('value');
        $rect = $this->input->post('rect');
        $parameter_id = '484';

        //Execute command shutdown
        shell_exec(" cmd $rect $parameter_id $value");

        redirect("monitor/rectifier/$rect");
    }


    /**
     * @param $rect
     * @param $data
     * @return mixed
     */
    protected function GetAllDataMonitoring($rect, $data)
    {
        //$data = $this->GetAllDataMonitoring($rect, $data);
        $data['rect_system'] = $this->monitoring_model->getRectifierSystem();
        $data['relay_status'] = $this->monitoring_model->relayStatus();

        //Get Alarm List
        $data['alarm1'] = $this->monitoring_model->getAlarm1();
        $data['alarm2'] = $this->monitoring_model->getAlarm2();

        //dropdown alarm active on navbar
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //droopdown rect list
        $data['rectifier'] = $this->monitoring_model->getRectifer();

        $data['numbers_of_rect'] = $this->monitoring_model->getRectGroup($this->monitoring_model->getNumberOfRectifers()->value);

        //get alarm rect modulu
        //todo: make 3 as 1 with logic OR
        $data['rectifier_alarm1'] = $this->monitoring_model->getRectiferAlarm1($rect);
        $data['rectifier_alarm2'] = $this->monitoring_model->getRectiferAlarm2($rect);

        //get Rectifier Voltage
        $mapV = $this->monitoring_model->getRectMap($rect);

        if (!empty($this->monitoring_model->getRectifierVoltage($mapV[0]->rect)->value)) {
            $rctV1 = $this->monitoring_model->getRectifierVoltage($mapV[0]->rect)->value;
        } else {
            $rctV1 = '0';
        }

        if (!empty($this->monitoring_model->getRectifierVoltage($mapV[1]->rect)->value)) {
            $rctV2 = $this->monitoring_model->getRectifierVoltage($mapV[1]->rect)->value;
        } else {
            $rctV2 = '0';
        }

        if (!empty($this->monitoring_model->getRectifierVoltage($mapV[2]->rect)->value)) {
            $rctV3 = $this->monitoring_model->getRectifierVoltage($mapV[2]->rect)->value;
        } else {
            $rctV3 = '0';
        }

        switch ($rect) {
            case  $rctV1 == 0 && $rctV2 == 0:
                //echo "v1=0 v2=0, v= v3";
                $data['rect_voltage'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage'] = ($rctV1 + $rctV2 + $rctV3) / 3;
                break;
        }

        //get Rectifier Current
        $mapA = $this->monitoring_model->getRectMap($rect);

        if (!empty($this->monitoring_model->getRectifierCurrent($mapA[0]->rect)->value)) {
            $recA1 = $this->monitoring_model->getRectifierCurrent($mapA[0]->rect)->value;
        } else {
            $recA1 = '0';
        }

        if (!empty($this->monitoring_model->getRectifierCurrent($mapA[1]->rect)->value)) {
            $recA2 = $this->monitoring_model->getRectifierCurrent($mapA[1]->rect)->value;
        } else {
            $recA2 = '0';
        }

        if (!empty($this->monitoring_model->getRectifierCurrent($mapA[2]->rect)->value)) {
            $recA3 = $this->monitoring_model->getRectifierCurrent($mapA[2]->rect)->value;
        } else {
            $recA3 = '0';
        }

        $data['rect_current'] = ($recA1 + $recA2 + $recA3);


        //get Rectifier Fan Rotation
        //todo : this rectifi
        $mapF = $this->monitoring_model->getRectMap($rect);
        $recFan1 = $this->monitoring_model->getRectifierFan($mapF[0]->rect);
        $recFan2 = $this->monitoring_model->getRectifierFan($mapF[1]->rect);
        $recFan3 = $this->monitoring_model->getRectifierFan($mapF[2]->rect);
        if (!empty($recFan1->value) or !empty($recFan2->value) or !empty($recFan3->value)) {

            $data['rect_fan'] = ($recFan1->value + $recFan2->value + $recFan3->value) / 3;
        }


        $mapT = $this->monitoring_model->getRectMap($rect);
        if (!empty($this->monitoring_model->getRectifierTemp($mapT[0]->rect)->value)) {
            $rectTemp1 = $this->monitoring_model->getRectifierTemp($mapT[0]->rect)->value;
        } else {
            $rectTemp1 = '0';
        }


        if (!empty($this->monitoring_model->getRectifierTemp($mapT[1]->rect)->value)) {
            $rectTemp2 = $this->monitoring_model->getRectifierTemp($mapT[1]->rect)->value;
        } else {
            $rectTemp2 = '0';
        }

        if (!empty($this->monitoring_model->getRectifierTemp($mapT[2]->rect)->value)) {
            $rectTemp3 = $this->monitoring_model->getRectifierTemp($mapT[2]->rect)->value;
        } else {
            $rectTemp3 = '0';
        }


        switch ($rect) {
            case  $rectTemp1 == 0 && $rectTemp2 == 0:
                //echo "c1=0 c2=0, c= c3";
                $data['rect_temp'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;
                break;
        }


        $mapR = $this->monitoring_model->getRectMap($rect);
        if (!empty($this->monitoring_model->getRemoteShutdown($mapR[0]->rect)->value)) {
            $recR1 = $this->monitoring_model->getRemoteShutdown($mapR[0]->rect)->value;
        } else {
            $recR1 = '0';
        }

        if (!empty($this->monitoring_model->getRemoteShutdown($mapR[1]->rect)->value)) {
            $recR2 = $this->monitoring_model->getRemoteShutdown($mapR[1]->rect)->value;
        } else {
            $recR2 = '0';
        }

        if (!empty($this->monitoring_model->getRemoteShutdown($mapR[2]->rect)->value)) {
            $recR3 = $this->monitoring_model->getRemoteShutdown($mapR[2]->rect)->value;
        } else {
            $recR3 = '0';
        }

        $data['remote_shutdown'] = ($recR1 + $recR2 + $recR3);


        /**
         * All Alarm Rectifier
         */

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected'] = 1;
            } else {
                $data['rectModuleConected'] = 0;
            }
        } else {
            $data['rectModuleConected'] = 0;
        }


        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost'] = 1;
            } else {
                $data['rectCommLost'] = 0;
            }
        } else {
            $data['rectCommLost'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection'] = 1;
            } else {
                $data['rectProtection'] = 0;
            }
        } else {
            $data['rectProtection'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail'] = 1;
            } else {
                $data['rectACFail'] = 0;
            }
        } else {
            $data['rectACFail'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail'] = 1;
            } else {
                $data['rectFanFail'] = 0;
            }
        } else {
            $data['rectFanFail'] = 0;
        }


        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation'] = 1;
            } else {
                $data['rectHibernation'] = 0;
            }
        } else {
            $data['rectHibernation'] = 0;
        }

        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut'] = 1;
            } else {
                $data['rectStartShut'] = 0;
            }
        } else {
            $data['rectStartShut'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit'] = 1;
            } else {
                $data['rectCurLimit'] = 0;
            }
        } else {
            $data['rectCurLimit'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail'] = 1;
            } else {
                $data['rectFail'] = 0;
            }
        } else {
            $data['rectFail'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp'] = 1;
                return $data;
            } else {
                $data['rectHiTemp'] = 0;
                return $data;
            }
        } else {
            $data['rectHiTemp'] = 0;
            return $data;
        }
    }


}

/* End of file Monitor.php */
/* Location: ./application/controllers/Monitor.php */