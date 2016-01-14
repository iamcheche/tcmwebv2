<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    session_start(); //we need to call PHP's session object to access it through CI
    class ProfessorHome extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model('professor_model');
            $this->load->library('jr_model');
            $this->load->library('jr_ctlr');
            $this->load->library('cezpdf');
            $this->load->helper('pdf');
            $this->load->library('csvimport');
        }

        function index(){ //$this->jr_ctlr->index(); 
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];
                $data['title'] = 'Tablet Class Manager';
                
                if ($query = $this->professor_model->schedule($data)){
                    $data['schedules'] = $query;
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

        function add_student($sc, $cc, $su, $si){ $this->jr_ctlr->addStudent($sc, $cc, $su, $si);  }
 
        function show_students($sc, $cc, $si){ $this->jr_ctlr->showStudents($sc, $cc, $si); }

        function show_professor($pu){ $this->jr_ctlr->showProfessor($pu); }

        function search_student($sc, $cc, $si){ $this->jr_ctlr->searchStudent($sc, $cc, $si); }

        function upload_students($sc, $cc, $si){ $this->jr_ctlr->uploadStudents($sc, $cc, $si); }

        function account_update(){
            $data['username'] = $this->input->post('professor_username');
            $data = array(
                    'professor_number' => $this->input->post('professor_number'),
                    'professor_fname' => $this->input->post('professor_fname'),
                    'professor_lname' => $this->input->post('professor_lname'),
                    'professor_dept' => $this->input->post('professor_dept'),
                    'professor_email' => $this->input->post('professor_email'),
                    'professor_contact' => $this->input->post('professor_contact'),
                    'professor_username' => $this->input->post('professor_username'),
                    'professor_password' => $this->input->post('professor_password')
                );
            $this->professor_model->update_professor($data);
            $this->show_professor($data['professor_username']);
            redirect('professorhome', 'refresh');
        }


         function schedule_pdf(){    
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];
                $data['title'] = 'Tablet Class Manager';
                $data['schedule'] = $this->professor_model->schedule($data);
                $data_table = array();
                    
                $query =  $this->db->query('SELECT * FROM schedules where professor_username = \'' . $data['username'] . '\'' );
                
                $data_table = array();
                foreach ($query->result_array() as $row) {
                    $data_table[] = $row;
                }
                
                $title = $data['fname'] . ' ' . $data['lname'] . '\'s Schedule';
                $column_header=array(
                    'days' => 'Days',
                    'course_code' => 'Course',
                    'time_start' => 'Time Start',
                    'time_end' => 'Time End',
                    'room' => 'Room',
                    'section_code' => 'Section'
                );
                
                $this->cezpdf->ezTable($data_table , $column_header, $title, array('height'=>975));
                $this->cezpdf->ezStream();
            
            }else{
                //If no session, redirect to login page
                redirect('professorlogin', 'refresh');
            }
        }
    }

?>