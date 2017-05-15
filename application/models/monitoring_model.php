<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 1:20 PM 10/14/2016, Author Hardianto Haris.
 */


/**
 * Class Monitoring_Model
 */
class Monitoring_Model extends CI_Model {


    public function getBusVoltage()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 201);

        return $this->db->get()->result();

    }


    public function getRectVoltage()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 101);

        return $this->db->get()->result();
    }


    public function getLoadCurrent()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 203);

        return $this->db->get()->result();
    }


    public function getBattCurrent()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 202);

        return $this->db->get()->result();
    }


    public function getBattTemp()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 204);

        return $this->db->get()->result();
    }


    public function getRectifer()
    {
        $this->db->select('*');
        $this->db->from('rectifier');
        $this->db->where('id >=', 1);
        $this->db->where('id <=', 16);

        return $this->db->get()->result();
    }


    public function getPhase($id)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring_rectifier m', 'p.id=m.parameter_id', 'left');
        $this->db->where('p.id >=', 208);
        $this->db->where('p.id <=', 210);
        $this->db->where('m.rectifier_id', $id);

        return $this->db->get()->result();
    }


    public function getRectifierSystem()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        //$this->db->where('p.id >=', 201);
        //$this->db->where('p.id <=', 213);
        //id 213 un-use
        $this->db->or_where_in('p.id', ['201', '202', '203', '204', '205', '207', '208', '209', '210', '211', '212']);

        return $this->db->get()->result();
    }


    public function getNumberOfRectifers()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 206);

        //return $this->db->get()->result();
        return $this->db->get()->row();
    }


    public function getRectGroup($rect)
    {
        $this->db->select('*');
        $this->db->from('rectifier_mapping');
        $this->db->where('rect', $rect);

        return $this->db->get()->row();
    }


    public function relayStatus()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id >=', 301);
        $this->db->where('p.id <=', 310);

        return $this->db->get()->result();
    }


    public function getRectiferAlarm1($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        //$this->db->join('rectifier r','m.rectifier_id = r.id');
        $this->db->where('p.id >=', 2);
        $this->db->where('p.id <=', 6);
        $this->db->where('p.state', 1);
        $this->db->where('m.rectifier_id', $rect);


        return $this->db->get()->result();
    }


    public function getRectiferAlarm2($rect)
    {
        $this->db->select('m.*,r.*,p.*');
        $this->db->from('rectifier r');
        $this->db->join('monitoring_rectifier m', 'm.rectifier_id=r.id', 'left');
        $this->db->join('parameter_alarm p', 'p.id=m.parameter_id', 'left');
        $this->db->where('m.parameter_id >=', 7);
        $this->db->where('m.parameter_id <=', 11);
        $this->db->where('p.state', 1);

        $this->db->where('m.rectifier_id', $rect);


        return $this->db->get()->result();
    }


    public function getAlarm1()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_alarm m', 'm.parameter_id=p.id', 'left');
        $this->db->or_where_in('p.id', ['01', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22']);
        $this->db->where('state', 1);

        return $this->db->get()->result();
    }


    public function getAlarm2()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_alarm m', 'm.parameter_id=p.id', 'left');
        $this->db->or_where_in('p.id', ['23', '25', '26', '27', '28', '29', '30', '31', '32',]);
        $this->db->where('state', 1);

        return $this->db->get()->result();
    }


    public function getAlarmActive()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_alarm m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id >=', 1);
        $this->db->where('p.id <=', 32);
        $this->db->where('m.value >', 0);
        $this->db->where('p.state', 1);

        return $this->db->get()->result();
    }


    public function getRectAlarmActive()
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id >=', 1);
        $this->db->where('p.id <=', 32);
        $this->db->where('m.value >', 0);
        $this->db->where('p.state', 1);

        return $this->db->get()->result();
    }


    public function getRectMap($rect)
    {
        $this->db->select('*');
        $this->db->where('group_rect', $rect);
        $this->db->from('rectifier_mapping');

        return $this->db->get()->result();
    }


    public function getRectifierVoltage($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_monitoring p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('m.rectifier_id', $rect);
        $this->db->where('p.id', 101);

        return $this->db->get()->row();
    }


    public function getRectifierCurrent($rect)
    {
        $this->db->select('*');
        $this->db->where('rectifier_id', $rect);
        $this->db->where('parameter_id', 102);
        $this->db->from('monitoring_rectifier');

        return $this->db->get()->row();
    }


    public function getRectifierFan($rect)
    {
        $this->db->select('*');
        $this->db->where('rectifier_id', $rect);
        $this->db->where('parameter_id', 103);
        $this->db->from('monitoring_rectifier');

        return $this->db->get()->row();
    }


    public function getRectifierTemp($rect)
    {
        $this->db->select('*');
        $this->db->where('rectifier_id', $rect);
        $this->db->where('parameter_id', 104);
        $this->db->from('monitoring_rectifier');

        return $this->db->get()->row();
    }


    public function getRemoteShutdown($rect)
    {
        $this->db->select('*');
        $this->db->where('rectifier_id', $rect);
        $this->db->where('parameter_id', 8);
        $this->db->from('monitoring_rectifier');

        return $this->db->get()->row();
    }


    public function getRectModuleConected($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 2);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectCommLost($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 3);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectProtection($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 4);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectACFail($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 5);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getFanFail($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 6);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectHibernation($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 7);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectStartShut($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 8);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectCurrentLimit($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 9);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectFail($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 10);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


    public function getRectHiTemp($rect)
    {
        $this->db->select('m.*,p.*');
        $this->db->from('parameter_alarm p');
        $this->db->join('monitoring_rectifier m', 'm.parameter_id=p.id', 'left');
        $this->db->where('p.id', 11);
        $this->db->where('m.rectifier_id', $rect);

        return $this->db->get()->row();
    }


}


/* End of file Monitoring_Model  */
/* Location: ./application/models/Monitoring_Model .php */
