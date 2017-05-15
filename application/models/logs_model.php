<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 2:13 PM 10/19/2016, Author Hardianto Haris.
 */


/**
 * Class Logs_Model
 * @property Model_Name $model_name
 */
class Logs_Model extends CI_Model {


    public function datalog($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left', 'DSC');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->order_by('l.updated_at', "desc");

        return $this->db->get()->result();
    }


    public function datalogPhaseA($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->where('p.id', 208);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalogBusVoltage($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->where('p.id', 201);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalogBattCurrent($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->where('p.id', 202);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalogLoadCurrent($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->where('p.id', 203);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalogBattTemp($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.updated_at >=', $from);
        $this->db->where('l.updated_at <=', $to);
        $this->db->where('p.id', 204);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalogRectCurent($from, $to)
    {
        $limit = $this->getMaxDatalog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring_rectifier l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where('l.dtime >=', $from);
        $this->db->where('l.dtime <=', $to);
        $this->db->where('p.id', 102);
        $this->db->where('l.rectifier_id', 1);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    public function datalog_hour()
    {
        $this->db->select('p.*,l.*');
        $this->db->from('log_monitoring l');
        $this->db->join('parameter_monitoring p', 'p.id=l.parameter_id', 'left');
        $this->db->where("l.updated_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR)", NULL, FALSE);
        $this->db->limit(200);
        $this->db->order_by('l.updated_at', "desc");


        return $this->db->get()->result();
    }


    function eventloga($from, $to)
    {
        $this->db->select('*');
        $this->db->from('log_event');
        $this->db->join('parameter_all', 'alarm_event_log.parameter_id = parameter_all.id');
        $this->db->where('alarm_event_log.dtime >=', $from);
        $this->db->where('alarm_event_log.dtime <=', $to);


        return $this->db->get()->result();
    }


    public function eventlog($from, $to)
    {
        $limit = $this->getMaxEvenlog()->value;
        $this->db->limit($limit);

        $this->db->select('p.*,e.*');
        $this->db->from('log_event e');
        $this->db->join('parameter_alarm p', 'p.id=e.alarm_id', 'left');
        $this->db->where('e.dtime >=', $from);
        $this->db->where('e.dtime <=', $to);
        $this->db->order_by('e.dtime', "desc");


        return $this->db->get()->result();
    }


    public function eventlog_hour()
    {
        $this->db->select('p.*,e.*');
        $this->db->from('log_event e');
        $this->db->join('parameter_alarm p', 'p.id=e.alarm_id', 'left');
        $this->db->where("e.dtime >= DATE_SUB(NOW(),INTERVAL 1 HOUR)", NULL, FALSE);
        $this->db->limit(200);
        $this->db->order_by('e.dtime', "desc");

        return $this->db->get()->result();
    }


    public function getMaxDatalog()
    {
        return $this->db->select('*')->where('id', 480)->from('parameter_setting')->get()->row();
    }


    public function getMaxEvenlog()
    {
        return $this->db->select('*')->where('id', 482)->from('parameter_setting')->get()->row();
    }


    public function destroy_monitoring()
    {

        $this->db->from('log_monitoring');
        $this->db->truncate();

        $this->db->from('log_monitoring_rectifier');
        $this->db->truncate();
    }


    public function destroy_eventlog()
    {
        $this->db->from('log_event');
        $this->db->truncate();

        $this->db->from('log_event_rectifier');
        $this->db->truncate();
    }


}


/* End of file Logs_Model  */
/* Location: ./application/models/Logs_Model .php */
