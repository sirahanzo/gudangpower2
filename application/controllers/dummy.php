<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 3:09 PM 11/4/2016, Author Hardianto Haris.
 */


/**
 * Class Dummy
 * @property Dummy_Model $dummy_model
 */
class Dummy extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('dummy_model');

    }


    public function index()
    {
        $data['page']  = 'Dummy';
        $data['parameter'] = $this->dummy_model->getParameter();
        $data['busV'] = $this->dummy_model->busVoltage();
        $data['ibatt'] = $this->dummy_model->ibatt();
        $data['iload'] = $this->dummy_model->iLoad();
        $data['rect'] = $this->dummy_model->getParameterRect();
        $data['irect'] = $this->dummy_model->irect();
        $data['temp'] = $this->dummy_model->getTemp();
        $data['relay'] = $this->dummy_model->getParameterRelay();
        $data['alarm_all'] = $this->dummy_model->getParameterAlarmAll();
        $data['alarm_rect'] = $this->dummy_model->getParameterAlarmRect();

       
        $this->load->view('debug/v_Dummy',$data);
    }


}

/* End of file Dummy.php */
/* Location: ./application/controllers/Dummy.php */


