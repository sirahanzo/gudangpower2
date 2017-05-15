<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 11:15 AM 11/5/2016, Author Hardianto Haris.
 */


/**
 * Class Alarms_Model
 * @property Model_Name $model_name
 */
class Alarms_Model extends CI_Model {


    public function getParameterAlarm1()
    {
        $this->db->select('*');
        $this->db->from('parameter_alarm');
        $this->db->where('id >=', 1);
        $this->db->where('id <=', 15);

        return $this->db->get()->result();
    }


    public function getParameterAlarm2()
    {
        $this->db->select('*');
        $this->db->from('parameter_alarm');
        $this->db->where('id >=', 16);
        $this->db->where('id <=', 31);

        return $this->db->get()->result();
    }


    public function save_alarms($records)
    {
        $errors = [];
        foreach ($records as $id => $values):
            $this->db->where('id', $id)->update('parameter_alarm', $values) or $errors[] = $id;
        endforeach;

        return $errors;
    }


}


/* End of file Alarms_Model  */
/* Location: ./application/models/Alarms_Model .php */
