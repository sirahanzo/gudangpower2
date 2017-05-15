<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 11:02 AM 11/3/2016, Author Hardianto Haris.
 */


/**
 * Class Controll
 * @property Settings_Model $settings_model
 * @property Monitoring_Model $monitoring_model
 */
class Controll extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'Dtime';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $this->load->view('v_Controll', $data);
    }


    public function ac_distribution()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'AC';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //AC Voltage High Alarm Set Point
        $data['parameter21'] = $this->settings_model->getParameterSetting21();

        $this->load->view('v_Controll_AC', $data);
    }


    public function rectifier_module()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'RM';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //Current Limit Set Point
        $data['parameter22'] = $this->settings_model->getParameterSetting22();

        $this->load->view('v_Controll_Rectifier', $data);
    }


    public function dc_distribution1()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'DC1';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //float charge voltage
        $data['parameter1'] = $this->settings_model->getParameterSetting1();

        //temp compensation enable
        $data['parameter2'] = $this->settings_model->getParameterSetting2();

        //temp compensation coefisien
        $data['parameter3'] = $this->settings_model->getParameterSetting3();

        //periodic equal charge
        $data['parameter4'] = $this->settings_model->getParameterSetting4();

        //periodical equal charge interval
        $data['parameter5'] = $this->settings_model->getParameterSetting5();

        //batttery test enable
        $data['parameter6'] = $this->settings_model->getParameterSetting6();

        //battery test start voltage
        $data['parameter7'] = $this->settings_model->getParameterSetting7();

        //auto battery test
        $data['parameter8'] = $this->settings_model->getParameterSetting8();

        //battery test interval
        $data['parameter9'] = $this->settings_model->getParameterSetting9();
        $data['parameter9a'] = $this->settings_model->getParameterSetting9a();
        $data['parameter9b'] = $this->settings_model->getParameterSetting9b();
        $data['parameter9c'] = $this->settings_model->getParameterSetting9c()->result();

        //lvd1
        $data['parameter10'] = $this->settings_model->getParameterSetting10();

        //hibernation
        $data['parameter11'] = $this->settings_model->getParameterSetting11();

        //hibernation interval
        $data['parameter12'] = $this->settings_model->getParameterSetting12();
        $data['parameter12a'] = $this->settings_model->getParameterSetting12a();


        //start battery test
        $data['parameter14'] = $this->settings_model->getParameterSetting14();

        //battery test Terminal voltage
        $data['parameter15'] = $this->settings_model->getParameterSetting15();
        $data['parameter15a'] = $this->settings_model->getParameterSetting15a();

        $this->load->view('v_Controll_DC1', $data);
    }


    public function dc_distribution2()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'DC2';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //Battery Temperature Gain
        $data['parameter16'] = $this->settings_model->getParameterSetting16();
        $data['parameter16a'] = $this->settings_model->getParameterSetting16a();
        $data['parameter16b'] = $this->settings_model->getParameterSetting16b();

        //Manual Equalizing Charge Enable
        $data['parameter17'] = $this->settings_model->getParameterSetting17();

        //Battery Cuurent Slope
        $data['parameter18'] = $this->settings_model->getParameterSetting18();

        //Fast Charge Enable
        $data['parameter19'] = $this->settings_model->getParameterSetting19();

        //Fast Charge Voltage Set Point
        $data['parameter20a'] = $this->settings_model->getParameterSetting20a();
        $data['parameter20'] = $this->settings_model->getParameterSetting20();

        $this->load->view('v_Controll_DC2', $data);
    }


    public function dc_distribution3()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'DC3';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        $data['relay_map'] = $this->settings_model->getRellayMapping();

        //relay set
        $data['parameter13'] = $this->settings_model->getParameterSetting13();

        //relay type
        $data['parameter23'] = $this->settings_model->getParameterSetting23();


        $this->load->view('v_Controll_DC3', $data);
    }


    public function other()
    {
        $data['page'] = 'Controll';
        $data['subpage'] = 'Other';

        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();

        //Max number row of datalog
        $data['datalog'] = $this->settings_model->getParameterSetting24();
        $data['interval'] = $this->settings_model->getParameterSetting25();
        $data['eventlog'] = $this->settings_model->getParameterSetting26();


        $this->load->view('v_Controll_Other', $data);
    }


    public function save_log()
    {
        $this->form_validation->set_rules('max_datalog', 'Maximum Number of Datalog', 'trim|required|less_than[3001]|greater_than[0]');
        $this->form_validation->set_rules('interval', 'Interval', 'trim|required|less_than[600]|greater_than[60]');
        $this->form_validation->set_rules('max_eventlog', 'Maximum Number of Eventlog', 'trim|required|less_than[3001]|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('controll/other');
        }

        //$interval = set_value('interval');
        //$eventlog = set_value('max_eventlog');

        $this->settings_model->save_log(['id' => 480], ['value' => set_value('max_datalog')]);
        $this->settings_model->save_log(['id' => 481], ['value' => set_value('interval')]);
        $this->settings_model->save_log(['id' => 482], ['value' => set_value('max_eventlog')]);


        $this->db->query('ALTER EVENT log_monitoring_scheduler ON SCHEDULE EVERY ' . set_value('interval') . ' SECOND STARTS CURRENT_TIMESTAMP;');
        $this->db->query('ALTER EVENT log_monitoring_rectifier_scheduler ON SCHEDULE EVERY ' . set_value('interval') . ' SECOND STARTS CURRENT_TIMESTAMP;');

        redirect('controll/other');

    }


    public function save_controll()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = $values['value'];

            //shell_exec(" cmd $id $val ");
            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');


    }


    public function save_controll_10()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = ($values['value'] * 10);

            //shell_exec(" cmd $id $val ");
            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');


    }


    public function save_controll_100()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = ($values['value'] * 100);

            //shell_exec(" cmd $id $val ");
            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');


    }


    public function save_controll_hibernation()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = $values['value'];
            if ($val == 1) {
                $this->db->query('ALTER EVENT hibernation_scheduller ENABLE');

            } else {
                $this->db->query('ALTER EVENT hibernation_scheduller DISABLE ');
            }

            //shell_exec(" cmd $id $val ");

            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');

    }


    public function save_controll_interval_hibernation()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = $values['value'];


            $this->db->query('ALTER EVENT hibernation_scheduller ON SCHEDULE EVERY ' . $val . ' HOUR STARTS CURRENT_TIMESTAMP;');

            //shell_exec(" cmd $id $val ");
            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');
    }


    public function save_controll_battery_test()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        //get start battery test interval
        $batt_test_interval = $this->settings_model->getParameterSetting9c()->row()->value;


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = $values['value'];
            if ($val == 1) {
                $this->db->query('ALTER EVENT auto_battery_test_scheduller ENABLE');
                $this->db->query('UPDATE parameter_setting SET updated_at = NOW() WHERE  id= 437');
                $this->db->query('UPDATE parameter_setting SET updated_at= DATE_ADD(updated_at,INTERVAL ' . $batt_test_interval . ' DAY) WHERE id = 437 ');

            } else {
                $this->db->query('ALTER EVENT auto_battery_test_scheduller DISABLE ');


            }

            //shell_exec(" cmd $id $val ");

            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');

    }


    public function save_controll_battery_test_interval()
    {
        $uri = $this->input->post('uri');

        $records = $this->input->post('id');
        $errors = $this->settings_model->save_controll($records);


        $num_errors = count($errors);
        if ($num_errors > 0) {
            echo "There were {$num_errors} errors!";

            // You can optionally print which records had errors
            echo "There were errors updating these rows: " . implode(', ', $errors);
        }

        //Execute Setting Command
        foreach ($records as $id => $values):
            $val = $values['value'];

            $this->db->query('ALTER EVENT auto_battery_test_scheduller ON SCHEDULE EVERY ' . $val . ' DAY STARTS CURRENT_TIMESTAMP DO BEGIN UPDATE parameter_setting SET updated_at= DATE_ADD(updated_at,INTERVAL ' . $val . ' DAY) where id = 437;UPDATE parameter_setting SET value = 1 WHERE id= 407;END');


            //shell_exec(" cmd $id $val ");
            $this->write($id, $val);


        endforeach;

        redirect("controll/$uri", 'refresh');

    }


    /**
     * @param $id
     * @param $val
     */
    protected function write($id, $val)
    {
        //execute write command here
        shell_exec("echo cmd $id $val > /home/pi/log_cmd/log1 ");
    }


    /**
     * @param $uri
     * @param $id
     */
    public function read($uri, $id)
    {
        //execute read command here
        shell_exec("cmd $id");

        redirect("controll/$uri");
    }


}

/* End of file Controll.php */
/* Location: ./application/controllers/Controll.php */


