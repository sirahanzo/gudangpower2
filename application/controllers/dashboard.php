<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 4:18 PM  10/11/2016,Author Hardianto Haris.
 */


/**
 * Class Dashboard
 * @property Monitoring_Model $monitoring_model
 */
class Dashboard extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index($rect = 1)
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = 'Dashboard';

        $data = $this->GetAllData($rect, $data);

        $this->load->view('v_Dashboard2', $data);
    }


    public function rectifier($rect = 1)
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = 'Dashboard';

        $data = $this->GetAllData($rect, $data);

        //echo json_encode($data['phase']);


        $this->load->view('v_Dashboard2', $data);
    }


    public function ajax_dashboard($rect = 1)
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = 'Dashboard';

        $data = $this->GetAllData($rect, $data);


        $this->load->view('ajax/a_Dashboard', $data);
    }


    public function ajax_time()
    {
        $this->load->view('ajax/a_time');
    }


    public function alarm_active()
    {
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();
        $this->load->view('ajax/a_Alarm_Active', $data);

    }


    /**
     * @param $rect
     * @param $data
     * @return mixed
     */
    protected function GetAllData($rect, $data)
    {
        $data['user'] = $this->session->userdata('logged_in')['username'];

        $data['busvoltage'] = $this->monitoring_model->getBusVoltage();
        $data['phase'] = $this->monitoring_model->getPhase($rect);


        # Start: Get Rectifier Voltage
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
            case $rctV1==0 && $rctV2 ==0 && $rctV3 ==0 ;
                $data['rect_voltage'] = 0;
                break;
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

        if (!empty($this->monitoring_model->getRectifierVoltage($mapV[0]->rect)->unit)){
            $data['volt'] = $this->monitoring_model->getRectifierVoltage($mapV[0]->rect)->unit;
        }else{
            $data['volt'] = 'mV';
        };
        # End.

        # Start: Get Rectifier Current
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
        # End.


        # Start : Get Remote Shutdown
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
        # End.

        $data['battcurrent'] = $this->monitoring_model->getBattCurrent();
        $data['batttemp'] = $this->monitoring_model->getBattTemp();
        $data['loadcurrent'] = $this->monitoring_model->getLoadCurrent();
        $data['rectifier'] = $this->monitoring_model->getRectifer();



        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();
        return $data;
    }


    public function dummy($rect)
    {
        # Start: Get Rectifier Voltage
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
            case $rctV1==0 && $rctV2 ==0 && $rctV3 ==0 ;
                $data['rect_voltage'] = 0;
                break;
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
        # End.


        echo  $data['rect_voltage'].$this->monitoring_model->getRectifierVoltage($mapV[0]->rect)->unit;
    }



}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */