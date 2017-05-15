<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 10:18 AM 11/5/2016, Author Hardianto Haris.
 */


/**
 * Class Alarms
 * @property Alarms_Model $alarms_model
 * @property Monitoring_Model $monitoring_model
 */
class Alarms extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('alarms_model');
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index()
    {
        $data['page'] = 'Alarms';
        $data['subpage'] = 'Alarms';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $data['alarms1'] = $this->alarms_model->getParameterAlarm1();
        $data['alarms2'] = $this->alarms_model->getParameterAlarm2();

        $this->load->view('v_Alarms', $data);
    }


    public function save_alarms()
    {
        $records = $this->input->post('id');
        $errors = $this->alarms_model->save_alarms($records);

        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        redirect('alarms', 'refresh');
    }


}

/* End of file Alarms.php */
/* Location: ./application/controllers/Alarms.php */


