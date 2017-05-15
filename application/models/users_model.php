<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 8:37 PM 1/8/2016, Author Haris Hardianto
 */

/**
 * Class Users_Model
 */
class Users_Model extends CI_Model {

    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);

        return $this->db->get();
    }


    public function register1($name, $email, $username, $password)
    {
        $data = [
            'name'     => $name,
            'username' => $username,
            'email'    => $email,
            'password' => md5($password),
        ];

        $this->db->insert('users', $data);
    }


    public function register($data)
    {

        $this->db->insert('users', $data);

    }


    public function get_license()
    {
        $this->db->select('*');
        $this->db->from('license');

        return $this->db->get()->row();
    }


    public function getUserList()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id >', 1);

        return $this->db->get()->result();
    }


    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }


    public function edit($name)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$name);

        return $this->db->get()->row();
    }


}

/* End of file Users_Model.php */
/* Location: ./application/models/Users_Model.php */