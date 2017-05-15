<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 2:14 PM 11/9/2016, Author Hardianto Haris.
 */


/**
 * Class Administrator
 * @property Users_Model $users_model
 * @property Monitoring_Model $monitoring_model
 */
class Administrator extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('monitoring_model');


        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index()
    {
        $data['page'] = 'Administrator';
        $data['subpage'] = 'Administrator';
        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $data['userlist'] = $this->users_model->getUserList();

        $this->load->view('v_Administrator', $data);
    }


    public function edit($name)
    {
        $data['page'] = 'Administrator';
        $data['subpage'] = 'Administrator';
        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $data['edit'] = $this->users_model->edit($name);
        $data['userlist'] = $this->users_model->getUserList();

        $this->load->view('v_Administrator_Edit', $data);

    }


}

/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */


