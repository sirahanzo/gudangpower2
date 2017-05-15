<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 2:26 PM 12/9/2016, Author Haris Hardianto.
 */

/**
 * Class Rectifier
 * @property Monitoring_Model $monitoring_model
 */
class Rectifier extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index()
    {
        $data['page'] = 'Rectifier';
        $data['subpage'] = 'Rectifier';
        $data['user'] = $this->session->userdata('logged_in')['username'];

        //Get Alarm List
        $data['alarm1'] = $this->monitoring_model->getAlarm1();
        $data['alarm2'] = $this->monitoring_model->getAlarm2();

        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $data = $this->getDataFromThreeBecomesOne($data);

        $this->load->view('v_Rectifier2', $data);
    }


    public function ajax_rectifier()
    {
        $data['page'] = 'ajax';

        $data = $this->getDataFromThreeBecomesOne($data);

        $this->load->view('ajax/a_Rectifier2', $data);
    }


    /**
     * @param $rect
     * @param $data
     * @return mixed
     */
    public function getRectfier1($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);//from 3 to 1 module
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module


        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier2($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier3($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier4($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module


        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier5($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module


        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier6($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier7($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier8($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier9($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier10($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier11($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier12($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier13($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier14($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier15($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    public function getRectfier16($rect, $data)
    {
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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

        //$data['rect_current1'] = ($recA1 + $recA2 + $recA3);
        $data['rect_current1'] = [$recA1, $recA2, $recA3];//only use 1 module

        //get Temperature
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
                $data['rect_temp1'] = $rectTemp3;
                break;
            case  $rectTemp2 == 0 && $rectTemp3 == 0:
                //echo "c2=0 c3=0, c= c1";
                $data['rect_temp1'] = $rectTemp1;
                break;

            case  $rectTemp1 == 0 && $rectTemp3 == 0:
                //echo "c1=0 c3=0, c= c2";
                $data['rect_temp1'] = $rectTemp2;
                break;
            case $rectTemp1 == 0 :
                //echo "c1=0, c= c2+c3/2";
                $data['rect_temp1'] = ($rectTemp2 + $rectTemp3) / 2;
                break;
            case $rectTemp2 == 0:
                //echo "c2=0, c= c1+c3/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp3) / 2;
                break;
            case $rectTemp3 == 0:
                //echo "c3=0, c= c1+c2/2";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2) / 2;
                break;
            default :
                //echo "c = c1+c2+c3/3";
                $data['rect_temp1'] = ($rectTemp1 + $rectTemp2 + $rectTemp3) / 3;

                break;
        }

        //2.Rect Module Conected
        $mapMC = $this->monitoring_model->getRectMap($rect);
        $rectMC1 = $this->monitoring_model->getRectModuleConected($mapMC[0]->rect);
        $rectMC2 = $this->monitoring_model->getRectModuleConected($mapMC[1]->rect);
        $rectMC3 = $this->monitoring_model->getRectModuleConected($mapMC[2]->rect);
        if (!empty($rectMC1->value) or !empty($rectMC2->value) or !empty($rectMC3->value)) {
            if ($rectMC1->value == 1 or $rectMC2->value == 1 or $rectMC3->value == 1) {
                $data['rectModuleConected1'] = 1;
            } else {
                $data['rectModuleConected1'] = 0;
            }
        } else {
            $data['rectModuleConected1'] = 0;
        }

        // 3.Rect Comm Lost
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCommLost($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCommLost($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCommLost($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {
            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCommLost1'] = 1;
            } else {
                $data['rectCommLost1'] = 0;
            }
        } else {
            $data['rectCommLost1'] = 0;
        }

        // 4.Rect Protection
        $mapRP = $this->monitoring_model->getRectMap($rect);
        $rectRP1 = $this->monitoring_model->getRectProtection($mapRP[0]->rect);
        $rectRP2 = $this->monitoring_model->getRectProtection($mapRP[1]->rect);
        $rectRP3 = $this->monitoring_model->getRectProtection($mapRP[2]->rect);
        if (!empty($rectRP1->value) or !empty($rectRP2->value) or !empty($rectRP3->value)) {
            if ($rectRP1->value == 1 or $rectRP2->value == 1 or $rectRP3->value == 1) {
                $data['rectProtection1'] = 1;
            } else {
                $data['rectProtection1'] = 0;
            }
        } else {
            $data['rectProtection1'] = 0;
        }

        //5. AC Fail
        $mapAF = $this->monitoring_model->getRectMap($rect);
        $rectAF1 = $this->monitoring_model->getRectACFail($mapAF[0]->rect);
        $rectAF2 = $this->monitoring_model->getRectACFail($mapAF[1]->rect);
        $rectAF3 = $this->monitoring_model->getRectACFail($mapAF[2]->rect);
        if (!empty($rectAF1->value) or !empty($rectAF2->value) or !empty($rectAF3->value)) {
            if ($rectAF1->value == 1 or $rectAF2->value == 1 or $rectAF3->value == 1) {
                $data['rectACFail1'] = 1;
            } else {
                $data['rectACFail1'] = 0;
            }
        } else {
            $data['rectACFail1'] = 0;
        }

        //6. Alarm FanFail
        $mapFF = $this->monitoring_model->getRectMap($rect);
        $rectFF1 = $this->monitoring_model->getFanFail($mapFF[0]->rect);
        $rectFF2 = $this->monitoring_model->getFanFail($mapFF[1]->rect);
        $rectFF3 = $this->monitoring_model->getFanFail($mapFF[2]->rect);
        if (!empty($rectFF1->value) or !empty($rectFF2->value) or !empty($rectFF3->value)) {

            if ($rectFF1->value == 1 or $rectFF2->value == 1 or $rectFF3->value == 1) {
                $data['rectFanFail1'] = 1;
            } else {
                $data['rectFanFail1'] = 0;
            }
        } else {
            $data['rectFanFail1'] = 0;
        }

        //7. Hibernation
        $mapHib = $this->monitoring_model->getRectMap($rect);
        $rectHib1 = $this->monitoring_model->getRectHibernation($mapHib[0]->rect);
        $rectHib2 = $this->monitoring_model->getRectHibernation($mapHib[1]->rect);
        $rectHib3 = $this->monitoring_model->getRectHibernation($mapHib[2]->rect);
        if (!empty($rectHib1->value) or !empty($rectHib2->value) or !empty($rectHib3->value)) {
            if ($rectHib1->value == 1 or $rectHib2->value == 1 or $rectHib3->value == 1) {
                $data['rectHibernation1'] = 1;
            } else {
                $data['rectHibernation1'] = 0;
            }
        } else {
            $data['rectHibernation1'] = 0;
        }


        //8.Shutdown/Startup
        $mapStart = $this->monitoring_model->getRectMap($rect);
        $rectStart1 = $this->monitoring_model->getRectStartShut($mapStart[0]->rect);
        $rectStart2 = $this->monitoring_model->getRectStartShut($mapStart[1]->rect);
        $rectStart3 = $this->monitoring_model->getRectStartShut($mapStart[2]->rect);

        if (!empty($rectStart1->value) or !empty($rectStart2->value) or !empty($rectStart3->value)) {
            if ($rectStart1->value == 1 or $rectStart2->value == 1 or $rectStart3->value == 1) {
                $data['rectStartShut1'] = 1;
            } else {
                $data['rectStartShut1'] = 0;
            }
        } else {
            $data['rectStartShut1'] = 0;
        }

        //9.Alarm Rect Current Limit
        $mapCL = $this->monitoring_model->getRectMap($rect);
        $rectCL1 = $this->monitoring_model->getRectCurrentLimit($mapCL[0]->rect);
        $rectCL2 = $this->monitoring_model->getRectCurrentLimit($mapCL[1]->rect);
        $rectCL3 = $this->monitoring_model->getRectCurrentLimit($mapCL[2]->rect);
        if (!empty($rectCL1->value) or !empty($rectCL2->value) or !empty($rectCL3->value)) {

            if ($rectCL1->value == 1 or $rectCL2->value == 1 or $rectCL3->value == 1) {
                $data['rectCurLimit1'] = 1;
            } else {
                $data['rectCurLimit1'] = 0;
            }
        } else {
            $data['rectCurLimit1'] = 0;
        }


        //10. Alarm Rectifier Fail
        $mapRF = $this->monitoring_model->getRectMap($rect);
        $rect_fail1 = $this->monitoring_model->getRectFail($mapRF[0]->rect);
        $rect_fail2 = $this->monitoring_model->getRectFail($mapRF[1]->rect);
        $rect_fail3 = $this->monitoring_model->getRectFail($mapRF[2]->rect);
        if (!empty($rect_fail1->value) or !empty($rect_fail2->value) or !empty($rect_fail3->value)) {
            if ($rect_fail1->value == 1 or $rect_fail2->value == 1 or $rect_fail3->value == 1) {
                $data['rectFail1'] = 1;
            } else {
                $data['rectFail1'] = 0;
            }
        } else {
            $data['rectFail1'] = 0;
        }

        //11. Rect High Temp
        $mapRHT = $this->monitoring_model->getRectMap($rect);
        $rectRHT1 = $this->monitoring_model->getRectHiTemp($mapRHT[0]->rect);
        $rectRHT2 = $this->monitoring_model->getRectHiTemp($mapRHT[1]->rect);
        $rectRHT3 = $this->monitoring_model->getRectHiTemp($mapRHT[2]->rect);
        if (!empty($rectRHT1->value) or !empty($rectRHT2->value) or !empty($rectRHT3->value)) {
            if ($rectRHT1->value == 1 or $rectRHT2->value == 1 or $rectRHT3->value == 1) {
                $data['rectHiTemp1'] = 1;
            } else {
                $data['rectHiTemp1'] = 0;
            }
        } else {
            $data['rectHiTemp1'] = 0;
        }


        return $data;
    }


    /**
     * @param $data
     * @return mixed
     */
    public function getDataFromThreeBecomesOne($data)
    {
        $rect1 = $this->getRectfier1(1, $data);
        $rect2 = $this->getRectfier2(2, $data);
        $rect3 = $this->getRectfier3(3, $data);
        $rect4 = $this->getRectfier4(4, $data);
        $rect5 = $this->getRectfier5(5, $data);
        $rect6 = $this->getRectfier6(6, $data);
        $rect7 = $this->getRectfier7(7, $data);
        $rect8 = $this->getRectfier8(8, $data);
        $rect9 = $this->getRectfier9(9, $data);
        $rect10 = $this->getRectfier10(10, $data);
        $rect11 = $this->getRectfier11(11, $data);
        $rect12 = $this->getRectfier12(12, $data);
        $rect13 = $this->getRectfier13(13, $data);
        $rect14 = $this->getRectfier14(14, $data);
        $rect15 = $this->getRectfier15(15, $data);
        $rect16 = $this->getRectfier16(16, $data);

        //echo $rect1['rect_voltage1'];


        $data['rect_voltage'] = [
            $rect1['rect_voltage1'],
            $rect2['rect_voltage1'],
            $rect3['rect_voltage1'],
            $rect4['rect_voltage1'],
            $rect5['rect_voltage1'],
            $rect6['rect_voltage1'],
            $rect7['rect_voltage1'],
            $rect8['rect_voltage1'],
            $rect9['rect_voltage1'],
            $rect10['rect_voltage1'],
            $rect11['rect_voltage1'],
            $rect12['rect_voltage1'],
            $rect13['rect_voltage1'],
            $rect14['rect_voltage1'],
            $rect15['rect_voltage1'],
            $rect16['rect_voltage1'],
        ];

        $data['rect_current'] = [
            $rect1['rect_current1'],
            $rect2['rect_current1'],
            $rect3['rect_current1'],
            $rect4['rect_current1'],
            $rect5['rect_current1'],
            $rect6['rect_current1'],
            $rect7['rect_current1'],
            $rect8['rect_current1'],
            $rect9['rect_current1'],
            $rect10['rect_current1'],
            $rect11['rect_current1'],
            $rect12['rect_current1'],
            $rect13['rect_current1'],
            $rect14['rect_current1'],
            $rect15['rect_current1'],
            $rect16['rect_current1'],
        ];


        $data['rect_temp'] = [
            $rect1['rect_temp1'],
            $rect2['rect_temp1'],
            $rect3['rect_temp1'],
            $rect4['rect_temp1'],
            $rect5['rect_temp1'],
            $rect6['rect_temp1'],
            $rect7['rect_temp1'],
            $rect8['rect_temp1'],
            $rect9['rect_temp1'],
            $rect10['rect_temp1'],
            $rect11['rect_temp1'],
            $rect12['rect_temp1'],
            $rect13['rect_temp1'],
            $rect14['rect_temp1'],
            $rect15['rect_temp1'],
            $rect16['rect_temp1'],
        ];

        //2
        $data['rectModuleConected'] = [
            $rect1['rectModuleConected1'],
            $rect2['rectModuleConected1'],
            $rect3['rectModuleConected1'],
            $rect4['rectModuleConected1'],
            $rect5['rectModuleConected1'],
            $rect6['rectModuleConected1'],
            $rect7['rectModuleConected1'],
            $rect8['rectModuleConected1'],
            $rect9['rectModuleConected1'],
            $rect10['rectModuleConected1'],
            $rect11['rectModuleConected1'],
            $rect12['rectModuleConected1'],
            $rect13['rectModuleConected1'],
            $rect14['rectModuleConected1'],
            $rect15['rectModuleConected1'],
            $rect16['rectModuleConected1'],
        ];


        //3
        $data['rectCommLost'] = [
            $rect1['rectCommLost1'],
            $rect2['rectCommLost1'],
            $rect3['rectCommLost1'],
            $rect4['rectCommLost1'],
            $rect5['rectCommLost1'],
            $rect6['rectCommLost1'],
            $rect7['rectCommLost1'],
            $rect8['rectCommLost1'],
            $rect9['rectCommLost1'],
            $rect10['rectCommLost1'],
            $rect11['rectCommLost1'],
            $rect12['rectCommLost1'],
            $rect13['rectCommLost1'],
            $rect14['rectCommLost1'],
            $rect15['rectCommLost1'],
            $rect16['rectCommLost1'],
        ];

        //4
        $data['rectProtection'] = [
            $rect1['rectProtection1'],
            $rect2['rectProtection1'],
            $rect3['rectProtection1'],
            $rect4['rectProtection1'],
            $rect5['rectProtection1'],
            $rect6['rectProtection1'],
            $rect7['rectProtection1'],
            $rect8['rectProtection1'],
            $rect9['rectProtection1'],
            $rect10['rectProtection1'],
            $rect11['rectProtection1'],
            $rect12['rectProtection1'],
            $rect13['rectProtection1'],
            $rect14['rectProtection1'],
            $rect15['rectProtection1'],
            $rect16['rectProtection1'],
        ];


        //5
        $data['rectACFail'] = [
            $rect1['rectACFail1'],
            $rect2['rectACFail1'],
            $rect3['rectACFail1'],
            $rect4['rectACFail1'],
            $rect5['rectACFail1'],
            $rect6['rectACFail1'],
            $rect7['rectACFail1'],
            $rect8['rectACFail1'],
            $rect9['rectACFail1'],
            $rect10['rectACFail1'],
            $rect11['rectACFail1'],
            $rect12['rectACFail1'],
            $rect13['rectACFail1'],
            $rect14['rectACFail1'],
            $rect15['rectACFail1'],
            $rect16['rectACFail1'],
        ];


        //6
        $data['rectFanFail'] = [
            $rect1['rectFanFail1'],
            $rect2['rectFanFail1'],
            $rect3['rectFanFail1'],
            $rect4['rectFanFail1'],
            $rect5['rectFanFail1'],
            $rect6['rectFanFail1'],
            $rect7['rectFanFail1'],
            $rect8['rectFanFail1'],
            $rect9['rectFanFail1'],
            $rect10['rectFanFail1'],
            $rect11['rectFanFail1'],
            $rect12['rectFanFail1'],
            $rect13['rectFanFail1'],
            $rect14['rectFanFail1'],
            $rect15['rectFanFail1'],
            $rect16['rectFanFail1'],
        ];

        //7
        $data['rectHibernation'] = [
            $rect1['rectHibernation1'],
            $rect2['rectHibernation1'],
            $rect3['rectHibernation1'],
            $rect4['rectHibernation1'],
            $rect5['rectHibernation1'],
            $rect6['rectHibernation1'],
            $rect7['rectHibernation1'],
            $rect8['rectHibernation1'],
            $rect9['rectHibernation1'],
            $rect10['rectHibernation1'],
            $rect11['rectHibernation1'],
            $rect12['rectHibernation1'],
            $rect13['rectHibernation1'],
            $rect14['rectHibernation1'],
            $rect15['rectHibernation1'],
            $rect16['rectHibernation1'],
        ];

        //8
        $data['rectStartShut'] = [
            $rect1['rectStartShut1'],
            $rect2['rectStartShut1'],
            $rect3['rectStartShut1'],
            $rect4['rectStartShut1'],
            $rect5['rectStartShut1'],
            $rect6['rectStartShut1'],
            $rect7['rectStartShut1'],
            $rect8['rectStartShut1'],
            $rect9['rectStartShut1'],
            $rect10['rectStartShut1'],
            $rect11['rectStartShut1'],
            $rect12['rectStartShut1'],
            $rect13['rectStartShut1'],
            $rect14['rectStartShut1'],
            $rect15['rectStartShut1'],
            $rect16['rectStartShut1'],
        ];

        //9
        $data['rectCurLimit'] = [
            $rect1['rectCurLimit1'],
            $rect2['rectCurLimit1'],
            $rect3['rectCurLimit1'],
            $rect4['rectCurLimit1'],
            $rect5['rectCurLimit1'],
            $rect6['rectCurLimit1'],
            $rect7['rectCurLimit1'],
            $rect8['rectCurLimit1'],
            $rect9['rectCurLimit1'],
            $rect10['rectCurLimit1'],
            $rect11['rectCurLimit1'],
            $rect12['rectCurLimit1'],
            $rect13['rectCurLimit1'],
            $rect14['rectCurLimit1'],
            $rect15['rectCurLimit1'],
            $rect16['rectCurLimit1'],
        ];

        //10
        $data['rectFail'] = [
            $rect1['rectFail1'],
            $rect2['rectFail1'],
            $rect3['rectFail1'],
            $rect4['rectFail1'],
            $rect5['rectFail1'],
            $rect6['rectFail1'],
            $rect7['rectFail1'],
            $rect8['rectFail1'],
            $rect9['rectFail1'],
            $rect10['rectFail1'],
            $rect11['rectFail1'],
            $rect12['rectFail1'],
            $rect13['rectFail1'],
            $rect14['rectFail1'],
            $rect15['rectFail1'],
            $rect16['rectFail1'],
        ];


        //11
        $data['rectHiTemp'] = [
            $rect1['rectHiTemp1'],
            $rect2['rectHiTemp1'],
            $rect3['rectHiTemp1'],
            $rect4['rectHiTemp1'],
            $rect5['rectHiTemp1'],
            $rect6['rectHiTemp1'],
            $rect7['rectHiTemp1'],
            $rect8['rectHiTemp1'],
            $rect9['rectHiTemp1'],
            $rect10['rectHiTemp1'],
            $rect11['rectHiTemp1'],
            $rect12['rectHiTemp1'],
            $rect13['rectHiTemp1'],
            $rect14['rectHiTemp1'],
            $rect15['rectHiTemp1'],
            $rect16['rectHiTemp1'],
        ];
        return $data;
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
                $data['rect_voltage1'] = $rctV3;
                break;
            case  $rctV2 == 0 && $rctV3 == 0:
                //echo "v2=0 v3=0, v= v1";
                $data['rect_voltage1'] = $rctV1;
                break;
            case  $rctV1 == 0 && $rctV3 == 0:
                //echo "v1=0 v3=0, v= v2";
                $data['rect_voltage1'] = $rctV2;
                break;
            case $rctV1 == 0 :
                //echo "v1=0, v= v2+v3/2";
                $data['rect_voltage1'] = ($rctV2 + $rctV3) / 2;
                break;
            case $rctV2 == 0:
                //echo "v2=0, v= v1+v3/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV3) / 2;
                break;
            case $rctV3 == 0:
                //echo "v3=0, v= v1+v2/2";
                $data['rect_voltage1'] = ($rctV1 + $rctV2) / 2;
                break;
            default :
                //echo "v = v1+v2+v3/3";
                $data['rect_voltage1'] = ($rctV1 + $rctV2 + $rctV3) / 3;
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


    public function debug()
    {
        $this->load->view('debug/v_rectifier');
    }


}

/* End of file Rectifier.php */
/* Location: ./application/controllers/Rectifier.php */


