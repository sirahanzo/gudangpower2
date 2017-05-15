<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 9:04 PM 1/8/2016, Author Haris Hardianto
 */

/**
 * Class Home
 */
class Home extends CI_Controller {

    /*
    |--------------------------------------------------------------------------
    | Authentication Result
    |--------------------------------------------------------------------------
    | If User has authenticted logged_in,then User can access this page
    | otherwise if User not authenticated,User will be redirected to Login page
    |
    */

    function __construct()
    {
        parent::__construct();
        //$this->UseDataBase();

        session_start();
        if (!$this->session->userdata('logged_in')) redirect('login', 'refresh');
    }


    public function index()
    {
        $data['user'] = $this->session->userdata('logged_in')['username'];

        $this->load->view('v_Home', $data);
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */