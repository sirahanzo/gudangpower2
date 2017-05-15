<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created 12:44 PM 12/12/2015, Author Haris Hardianto
 */

/**
 * Class Login
 */
class Login extends CI_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    | If you dont have a valide license key then you will be redirect to input
    | the valid license key.
    | Load a login&register page, if the user has authenticated logged in then,
    | user will be redirected to home page.
    |
    */

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form'));

        //$this->UseDataBase();

    }


    public function index()
    {
        if ($this->session->userdata('logged_in')) {

            redirect('dashboard', 'refresh');
        }

        $this->load->view('v_Login');
    }


}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */