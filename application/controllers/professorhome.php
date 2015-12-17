<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    session_start(); //we need to call PHP's session object to access it through CI
    class ProfessorHome extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model('professor_model');
            $this->load->helper('url');
            $this->load->helper('form');

        }

        function index(){
            
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];

                $data['title'] = 'Tablet Class Manager';
                $data['schedule'] = $this->professor_model->schedule($data);

                
                if ($query = $this->professor_model->schedule($data)){
                    $data['schedule'] = $query;
                }
                
                $this->load->view('template/professor/professor_header', $data);
                $this->load->view('template/professor/professor_navbar', $data);
                $this->load->view('template/professor/professor_footer');
           

                $this->load->view('professor/professor_home', $data);

            }else{
                //If no session, redirect to login page
                redirect('professorlogin', 'refresh');
            }
        }

        function show_students(){
             if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];

                $data['title'] = 'Tablet Class Manager';
                $data['show_students'] = $this->professor_model->show_students();

                
                if ($query = $this->professor_model->show_students()){
                    $data['show_students'] = $query;
                }
                
                $this->load->view('template/professor/professor_header', $data);
                $this->load->view('template/professor/professor_navbar', $data);
                $this->load->view('template/professor/professor_footer');
           

                $this->load->view('professor/show_students', $data);

            }else{
                //If no session, redirect to login page
                redirect('professorlogin', 'refresh');
            }
        }

    }

?>