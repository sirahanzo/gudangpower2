<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 5:28 PM 10/13/2016, Author Hardianto Haris.
 */

/**
 * Class Logs
 * @property Debug_Model $debug_model
 * @property Logs_Model $logs_model
 * @property Monitoring_Model $monitoring_model
 */
class Logs extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->library('excel');//load library phpexcel
        $this->load->model('debug_model');
        $this->load->model('logs_model');
        $this->load->model('monitoring_model');

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');

    }


    public function index()
    {
        $data['page'] = 'Logs';


        $this->load->view('v_Logs', $data);
    }


    function data_monitor()
    {

        $data['page'] = 'Logs';
        $data['subpage'] = 'DataLog';
        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();


        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $show = $this->input->post('show');
        $download = $this->input->post('download');


        /**
         * THIS FOR SHOW DATA LOG
         */
        if (!empty($show)) {
            //echo $show;
            if (empty($from) || empty($to)) {
                // echo 'kosong';
                $dt = new DateTime(date('y-m-d H:i:s'));
                $to1 = $dt->format('Y-m-d H:i:s');
                $dt->modify("-1 hour");
                $from1 = $dt->format('Y-m-d H:i:s');
                $data['datalog'] = $this->logs_model->datalog($from1, $to1);
            } else {
                //echo 'show data';
                if ($to < $from) {
                    //echo 'salah waktu';
                    $data['info'] = 'Wrong Date Picker';
                    $data['datalog'] = $this->logs_model->datalog($from, $to);
                } else {
                    //echo 'showdata date :from-to ';
                    $data['datalog'] = $this->logs_model->datalog($from, $to);
                }
            };
        } else {
            //echo 'show kosong';
            /*$dt = new DateTime(date('y-m-d H:i:s'));
            $to1 = $dt->format('Y-m-d H:i:s');
            $dt->modify("-1 hour");
            $from1 = $dt->format('Y-m-d H:i:s');*/
            //$data['ai'] = $this->datalog_model->datalog($from1, $to1);
            $data['datalog'] = $this->logs_model->datalog_hour();
        }

        /**
         * THIS IS FOR DOWNLOAD DATA TO EXCELL
         */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        ini_set('max_execution_time', 360);

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        //load Excel template from directory file , seuaikan dengan folder pada applikasi pak asep
        $objTpl = PHPExcel_IOFactory::load("assets/log_template/monitoring.xlsx");
        $objTpl->setActiveSheetIndex(0);  //set first sheet as active

        //start cell input
        $cel = 8;
        $cel1 = 8;
        $cel2 = 8;
        $cel3 = 8;
        $cel4 = 8;
        $cel5 = 8;
        $cel6 = 8;
        $cel7 = 8;
        $no = 1;


        $objTpl->getActiveSheet()->setCellValue('C4', $from);
        $objTpl->getActiveSheet()->setCellValue('C5', $to);

        /**
         * START DOWNLOAD CONTENT DATA LOG
         */
        if ($download == 'Download') {
            //echo 'downloadfile';
            if (empty($from) || empty($to)) {

                //echo 'download all';
                //$di = $this->logs_model->datalog_hour();
                $this->DowloadToExcel( $objTpl, $cel, $no, $cel1, $cel2, $cel3, $cel4, $cel5, $cel6, $cel7, $data, $from, $to);

            } else {
                //echo 'download from date';
                if ($to < $from) {
                    //echo 'wrong date picker';
                    $data['info'] = 'Wrong Date Picker';
                } else {
                    //echo 'dowload from date';
                    //$di = $this->logs_model->datalog($from, $to);
                    $this->DowloadToExcel( $objTpl, $cel, $no, $cel1, $cel2, $cel3, $cel4, $cel5, $cel6, $cel7, $data, $from, $to);

                };
            }
        } else {
            echo '';
        };


        $this->load->view('v_Logs_Data_Monitor', $data);

    }


    function event_alarm()
    {

        $data['page'] = 'Logs';
        $data['subpage'] = 'EventLog';
        $data['user'] = $this->session->userdata('logged_in')['username'];
        $data['alarmactive'] = $this->monitoring_model->getAlarmActive();
        $data['rectifier_alarm_active'] = $this->monitoring_model->getRectAlarmActive();


        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $show = $this->input->post('show');
        $download = $this->input->post('download');


        /**
         * THIS FOR SHOW DATA LOG
         */
        if (!empty($show)) {
            //echo $show;
            if (empty($from) || empty($to)) {
                // echo 'kosong';
                $dt = new DateTime(date('y-m-d H:i:s'));
                $to1 = $dt->format('Y-m-d H:i:s');
                $dt->modify("-1 hour");
                $from1 = $dt->format('Y-m-d H:i:s');
                $data['eventlog'] = $this->logs_model->eventlog($from1, $to1);
            } else {
                //echo 'show data';
                if ($to < $from) {
                    //echo 'salah waktu';
                    $data['info'] = 'Wrong Date Picker';
                    $data['eventlog'] = $this->logs_model->eventlog($from, $to);
                } else {
                    //echo 'showdata date :from-to ';
                    $data['eventlog'] = $this->logs_model->eventlog($from, $to);
                }
            };
        } else {
            //echo 'show kosong';
            /*$dt = new DateTime(date('y-m-d H:i:s'));
            $to1 = $dt->format('Y-m-d H:i:s');
            $dt->modify("-1 hour");
            $from1 = $dt->format('Y-m-d H:i:s');*/
            //$data['ai'] = $this->datalog_model->datalog($from1, $to1);
            $data['eventlog'] = $this->logs_model->eventlog_hour();
        }

        /**
         * THIS IS FOR DOWNLOAD DATA TO EXCELL
         */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        ini_set('max_execution_time', 360);

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        //load Excel template from directory file , seuaikan dengan folder pada applikasi pak asep
        $objTpl = PHPExcel_IOFactory::load("assets/log_template/alarm.xlsx");
        $objTpl->setActiveSheetIndex(0);  //set first sheet as active

        //start cell input
        $cel = 8;
        $cel1 = 8;
        $cel2 = 8;
        $cel3 = 8;
        $cel4 = 8;
        $cel5 = 8;
        $cel6 = 8;
        $cel7 = 8;
        $no = 1;


        $objTpl->getActiveSheet()->setCellValue('C3', $from);
        $objTpl->getActiveSheet()->setCellValue('C4', $to);

        /**
         * START DOWNLOAD CONTENT DATA LOG
         */
        if ($download == 'Download') {
            //echo 'downloadfile';
            if (empty($from) || empty($to)) {

                //echo 'download all';
                $eventlog = $this->logs_model->eventlog_hour();
                $this->DowloadEventlogToExcel($eventlog, $objTpl, $cel, $no, $cel1, $cel2, $cel5,$from,$to);

            } else {
                //echo 'download from date';
                if ($to < $from) {
                    //echo 'wrong date picker';
                    $data['info'] = 'Wrong Date Picker';
                } else {
                    //echo 'dowload from date';
                    $eventlog = $this->logs_model->eventlog($from, $to);
                    $this->DowloadEventlogToExcel($eventlog, $objTpl, $cel, $no, $cel1, $cel2, $cel5,$from,$to);

                };
            }
        } else {
            echo '';
        };


        $this->load->view('v_Logs_Event_Alarm', $data);

    }


    /**
     * @param $objTpl
     * @param $cel
     * @param $no
     * @param $cel1
     * @param $cel2
     * @param $cel3
     * @param $cel4
     * @param $cel5
     * @param $cel6
     * @param $cel7
     * @param $from
     * @param $to
     * @param $data
     */
    private function DowloadToExcel( $objTpl, $cel, $no, $cel1, $cel2, $cel3, $cel4, $cel5, $cel6, $cel7, $data, $from, $to)
    {
        /* foreach ($di as $content):
             $objTpl->getActiveSheet()->setCellValue('C' . $cel++, $no++)->setCellValue('D' . $cel1++, $content->name)->setCellValue('E' . $cel2++, $content->dtime)->setCellValue('F' . $cel3++, $content->value)->setCellValue('G' . $cel4++, $content->unit)->setCellValue('H' . $cel5++, $content->alarm);
         endforeach;*/

        //bus voltage
        $busvoltage = $this->logs_model->datalogBusVoltage($from, $to);
        foreach ($busvoltage as $bv):
            $objTpl->getActiveSheet()->setCellValue('A' . $cel++, $no++)->setCellValue('C' . $cel1++, $bv->updated_at)->setCellValue('E' . $cel2++, $bv->value . $bv->unit);
        endforeach;

        //ac voltage phase A
        $acvoltage = $this->logs_model->datalogPhaseA($from, $to);
        foreach ($acvoltage as $acv):
            $objTpl->getActiveSheet()->setCellValue('D' . $cel3++, $acv->value . $acv->unit);
        endforeach;
        //rectifier current
        $rect_current = $this->logs_model->datalogRectCurent($from, $to);
        foreach ($rect_current as $rc):
            $objTpl->getActiveSheet()->setCellValue('F' . $cel4++, ($rc->value * 3) . $rc->unit);
        endforeach;

        //load current
        $load_current = $this->logs_model->datalogLoadCurrent($from, $to);
        foreach ($load_current as $Lc):
            $objTpl->getActiveSheet()->setCellValue('G' . $cel5++, $Lc->value . $Lc->unit);
        endforeach;

        //battery current
        $batt_current = $this->logs_model->datalogBattCurrent($from, $to);
        foreach ($batt_current as $bc):
            $objTpl->getActiveSheet()->setCellValue('H' . $cel6++, $bc->value . $bc->unit);
        endforeach;

        //battery temperature
        $batt_temp = $this->logs_model->datalogBattTemp($from, $to);
        foreach ($batt_temp as $bt):
            $objTpl->getActiveSheet()->setCellValue('I' . $cel7++, $bt->value . 'C');
        endforeach;

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Log_Monitoring_' . $from . '_' . $to . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');
        $objWriter->save('php://output');

    }


    /**
     * @param $eventlog
     * @param $objTpl
     * @param $cel
     * @param $no
     * @param $cel1
     * @param $cel2
     * @param $cel3
     * @param $cel4
     * @param $cel5
     * @param $data
     */
    private function DowloadEventlogToExcel($eventlog, $objTpl, $cel, $no, $cel1, $cel2, $cel5,$from,$to)
    {
        foreach ($eventlog as $content):

            if ($content->event == 0){$alarm = 'Alarm Start';}else{$alarm = 'Alarm Cleared';};

            $objTpl->getActiveSheet()->setCellValue('A' . $cel++, $no++)->setCellValue('C' . $cel1++, $content->name)->setCellValue('D' . $cel2++, $content->dtime)->setCellValue('E' . $cel5++, $alarm);
        endforeach;

        // Redirect output to a client�s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Log_Alarm_Event_Log_'.$from .'_'.$to.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0


        $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');
        $objWriter->save('php://output');
    }


}

/* End of file Logs.php */
/* Location: ./application/controllers/Logs.php */


