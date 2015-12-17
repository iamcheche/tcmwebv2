<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class ProfessorLogout extends CI_Controller {

    	function __construct(){
            parent::__construct();
            $this->load->model('professor_model');
            $this->load->library('session');
        }

        function index(){
             $data = array(
                'professor_username' => $this->session->userdata['logged_in']['username'], 
                'login_token' => ''
            );

            $this->professor_model->update_token_logout($data);

        	$this->session->unset_userdata('logged_in');
        	redirect('professorlogin', 'refresh');
        }
	}
?>
