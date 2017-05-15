<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 4:17 PM 1/28/2016, Author Haris Hardianto
 */

/**
 * Class License_Model
 */
class License_Model extends CI_Model {

    public function get_license()
    {
        $this->db->select('*');
        $this->db->from('license');

        return $this->db->get()->row();
    }


    public function save_license($license)
    {
        $data = [
            'key'        => $license,
            'updated_at' => date('Y-m-d h:i:s'),
        ];

        $this->db->update('license', $data);
    }
}

/* End of file License_Model.php */
/* Location: ./application/models/License_Model.php */