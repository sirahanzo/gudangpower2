<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 6:14 AM 10/19/2016, Author Hardianto Haris.
 */


/**
 * Class Debug_Model
 * @property Model_Name $model_name
 */
class Debug_Model extends CI_Model{
    
  
    public function getArray()
    {
        $this->db->select('*');
        $this->db->from('table_name');
        
        return $this->db->get()->result();
    }


    public function getRow()
    {
        $this->db->select('*');
        $this->db->from('table_name');
        
        return $this->db->get()->row();
    }


    public function joinRect()
    {
        $this->db->select('r.*,m.*');
        $this->db->from('monitoring_rectifier1 m');
        $this->db->join('rectifier_mapping r', 'r.rect=m.rectifier_id', 'left');

        return $this->db->get()->result();
    }

    



}


/* End of file Debug_Model  */
/* Location: ./application/models/Debug_Model .php */
