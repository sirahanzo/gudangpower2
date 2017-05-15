<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 7:03 PM  10/12/2016,Author Hardianto Haris.
 */


/**
 * Class Settings
 * @property Settings_Model $settings_model
 * @property Monitoring_Model $monitoring_model
 */
class Settings extends CI_Controller {


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
        $data['page'] = 'Settings';

        $this->load->view('v_Settings', $data);
    }


    public function dtime()
    {
        $data['page'] = 'Settings';
        $data['subpage'] = 'Dtime';
        $data['user'] = $this->session->userdata('logged_in')['username'];

        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();


        $this->load->view('v_Setting_Dtime', $data);
    }


    public function save_dtime()
    {
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        //$dtime = $date . ' ' . $time;
        $new_date = date("d M Y", strtotime($date));
        $char = '"';

        //Edit file change_time
        shell_exec(" echo > /var/www/change_time.sh ");
        shell_exec(" echo '#!/bin/bash -e' >> /var/www/change_time.sh ");
        shell_exec(" echo 'sudo date -s $char $new_date $time $char ' >> /var/www/change_time.sh ");

        //execute changetime script
        shell_exec("sh /var/www/change_time.sh");

        redirect('settings/dtime');

    }


    public function network()
    {
        $data['page'] = 'Settings';
        $data['subpage'] = 'Network';
        $data['user'] = $this->session->userdata('logged_in')['username'];

        $data['network'] = $this->settings_model->getNetwork();
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();


        $this->load->view('v_Setting_Network', $data);

    }


    public function save_network()
    {
        $this->form_validation->set_rules('ipaddress', 'IP Address', 'trim|required|valid_ip');
        $this->form_validation->set_rules('netmask', 'Netmask', 'trim|required|valid_ip');
        $this->form_validation->set_rules('gateway', 'Gateway', 'trim|required|valid_ip');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('settings/network');
        }

        $ipaddress = set_value('ipaddress');
        $netmask = set_value('netmask');
        $gateway = set_value('gateway');

        $network = [
            'ipaddress' => $ipaddress,
            'netmask'   => $netmask,
            'gateway'   => $gateway,
        ];

        $this->settings_model->saveNetwork($network);


        //save variable network setting to interfaces_temp
        shell_exec(" echo > /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'auto lo' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'iface lo inet loopback' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '#iface eth0 inet dhcp' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'auto eth0' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'iface eth0 inet static' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'address $ipaddress' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'netmask $netmask' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo 'gateway $gateway' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '#allow-hotplug wlan0' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '#iface wlan0 inet manual' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '#wpa-roam /etc/wpa_supplicant/wpa_supplicant.conf' >> /var/www/goldpower/uploads/interfaces_temp ");
        shell_exec("echo '#iface default inet dhcp' >> /var/www/goldpower/uploads/interfaces_temp ");

        //copy file interfaces_temp to interface, to change ipaddress setting
        shell_exec("sudo cp /var/www/goldpower/uploads/interfaces_temp /etc/network/interfaces  ");

        redirect('settings/network');

    }


    public function save_snmp()
    {
        $this->form_validation->set_rules('snmp1', 'SNMP Server 1', 'trim|required|valid_ip');
        $this->form_validation->set_rules('snmp2', 'SNMP Server 2', 'trim|required|valid_ip');
        $this->form_validation->set_rules('snmp_ver', 'SNMP Version', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('settings/network');
        }


        $network = [
            'snmp_server1' => set_value('snmp1'),
            'snmp_server2' => set_value('snmp2'),
            'snmp_version' => set_value('snmp_ver'),
        ];

        $this->settings_model->saveNetwork($network);
        redirect('settings/network');

    }


    public function save_serial()
    {
        $this->form_validation->set_rules('baudrate', 'Baudrate', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('settings/network');
        }


        $network = [
            'port_baudrate' => set_value('baudrate'),
            'port_address'  => set_value('address'),
        ];

        $this->settings_model->saveNetwork($network);
        redirect('settings/network');

    }


    public function controll()
    {
        $data['page'] = 'Settings';
        $data['subpage'] = 'Controll';

        $data['parameter1'] = $this->settings_model->getParameterSetting1();
        $data['parameter2'] = $this->settings_model->getParameterSetting2();
        $data['parameter3'] = $this->settings_model->getParameterSetting3();
        $data['parameter4'] = $this->settings_model->getParameterSetting4();
        $data['parameter5'] = $this->settings_model->getParameterSetting5();
        $data['parameter6'] = $this->settings_model->getParameterSetting6();
        $data['parameter7'] = $this->settings_model->getParameterSetting7();
        $data['parameter8'] = $this->settings_model->getParameterSetting8();
        $data['parameter9'] = $this->settings_model->getParameterSetting9();
        $data['parameter10'] = $this->settings_model->getParameterSetting10();
        $data['parameter11'] = $this->settings_model->getParameterSetting11();
        $data['parameter12'] = $this->settings_model->getParameterSetting12();
        $data['parameter13'] = $this->settings_model->getParameterSetting13();
        $data['parameter14'] = $this->settings_model->getParameterSetting14();
        $data['parameter15'] = $this->settings_model->getParameterSetting15();
        //$data['parameter16'] = $this->settings_model->getParameterSetting16();
        //$data['parameter17'] = $this->settings_model->getParameterSetting17();
        //$data['parameter18'] = $this->settings_model->getParameterSetting18();

        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();


        $this->load->view('v_Setting_Controll', $data);
        //$this->load->view('debug/v_Setting_Controll',$data);
    }


    public function save_controll()
    {
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
            //shell_exec("echo cmd $id $val > /home/pi/log_cmd/log1 ");

            shell_exec("sudo /home/TM/log/seting $id $val &");
            shell_exec("sleep 1");
            shell_exec("echo $id $val > /var/tmp/setinglog");


        endforeach;

        redirect('settings/controll', 'refresh');

    }


    public function read_controll()
    {
        //Execute Read Command
        shell_exec("sudo /home/TM/log/par &");
        //	shell_exec("sleep 1");
        redirect('settings/controll', 'refresh');

    }


}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */