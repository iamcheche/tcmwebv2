<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Jr_ctlr extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model('professor_model');
            $this->load->library('jr_model');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('csvimport');
        }

        function getLoginData(){  
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];
                $data['title'] = 'Tablet Class Manager';
                $this->load->view('template/professor/professor_header', $data);
                $this->load->view('template/professor/professor_navbar', $data);
                $this->load->view('template/professor/professor_footer');
            }else{
                //If no session, redirect to login page
                redirect('professorlogin', 'refresh');
            }
            return $data;
        }

        function index(){  
            $login_data = $this->getLoginData();
            $data['schedules'] = $this->jr_model->getSchedules($login_data['username']);           
            $this->load->view('professor/professor_home', $data);
        }

        function addStudent($sc, $cc, $su, $si){ 
            $login_data = $this->getLoginData();
            $data['section_code'] = $sc; 
            $data['course_code'] = $cc; 
            $data['student_username'] = $su; 
            $data['schedule_id'] = $si; 
            if($this->jr_model->isStudentInSchedule($data['student_username'], $login_data['username'], $data['section_code'], $data['course_code'], $data['schedule_id'])){
                    $this->load->view('professor/show_students', $data);
            
                echo 'note: mag-prompt ka modalDialog saying STUDENT ALREADY EXISTS!';
            } else {
                $this->jr_model->addStudent($data['student_username'], $data['section_code'], $data['course_code'],  $data['schedule_id'], $login_data['username']);
                $data['students'] = $this->jr_model->getStudents($login_data['username'], $data['schedule_id'], $data['course_code'], $data['section_code']); 
                $this->load->view('professor/show_students', $data);
            }     
        }

        function showStudents($sc, $cc, $si){   
            $login_data = $this->getLoginData();
            $data['section_code'] = $sc; 
            $data['course_code'] = $cc; 
            $data['schedule_id'] = $si; 
            $data['students'] = $this->jr_model->getStudents($login_data['username'], $data['schedule_id'], $data['course_code'], $data['section_code']); 
            $data['activities'] = $this->jr_model->getActivities($login_data['username'], $data['schedule_id'], $data['course_code'], $data['section_code']); 
            $this->load->view('professor/show_students', $data);
        }

        function showProfessor($pu){ 
            $login_data = $this->getLoginData();
            $data['professors'] = $this->jr_model->getProfessor($login_data['username']);
            $this->professor_model->account($login_data);
            $this->load->view('professor/update_account', $data);
        }

        function searchStudent($sc, $cc, $si){   
            $this->getLoginData();
            $data['section_code'] = $sc; 
            $data['course_code'] = $cc; 
            $data['schedule_id'] = $si;       
            $data['matched_students'] = $this->jr_model->getMatchedStudents($this->input->post('search_student')); 
            $this->load->view('professor/search_result', $data);      
        }

        function uploadStudents($sc, $cc, $si){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

            
                // If upload failed, display error
                if (!$this->upload->do_upload()) {
                    $data['error'] = $this->upload->display_errors();
                    $login_data = $this->getLoginData();   
                } else {
                    $file_data = $this->upload->data();
                    $file_path =  './uploads/'.$file_data['file_name'];         
                        if ($this->csvimport->get_array($file_path)){
                            $csv_array = $this->csvimport->get_array($file_path);
                            foreach ($csv_array as $row) {
                                $su = strtolower(substr($row['student_fname'], 0, 1) . $row['student_lname']);

                                $insert_data = array(
                                    'course_code' => $cc,
                                    'section_code' => $sc,
                                    'professor_username' => $data['username'],
                                    'student_username' => $su,                          
                                    'schedule_id' => $si
                                );

                                $this->professor_model->upload_students($insert_data);
                            }
                            
                            $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                            redirect(base_url().'professorhome/show_students/'. $sc . '/' . $cc . '/' . $si);
                        } else {
                            $data['error'] = "Error occured";
                            $this->load->view('professor/show_students', $data);
                        }
                    }
                }else{
                    redirect('professorlogin', 'refresh');
                }
            }
    }
?>