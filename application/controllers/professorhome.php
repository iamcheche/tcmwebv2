<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    session_start(); //we need to call PHP's session object to access it through CI
    class ProfessorHome extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model('professor_model');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('cezpdf');
            $this->load->helper('pdf');
        
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

                $section = $this->uri->segment(3);
                $course = $this->uri->segment(4);
                
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];
                $data['section'] = $section;
                $data['course'] = $course;
                
                $data['title'] = 'Tablet Class Manager';
                $data['show_students'] = $this->professor_model->show_students($data);

                
                if ($query = $this->professor_model->show_students($data)){
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

         function show_professor(){
           
            if($this->session->userdata('logged_in')){

                $username = $this->uri->segment(3);

                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['title'] = 'Tablet Class Manager';
                $data['username'] = $username;



                $data['professors'] =$this->professor_model->view_professor($data);
                $this->professor_model->account($data);
                
                $this->load->view('template/professor/professor_header', $data);
                $this->load->view('template/professor/professor_navbar', $data);
                $this->load->view('template/professor/professor_footer');
                $this->load->view('professor/update_account', $data);
             }else{
                //If no session, redirect to login page
                 redirect('professorlogin', 'refresh');
            } 
            
        }

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

        function search_student(){

                if($this->session->userdata('logged_in')){

                $section = $this->uri->segment(3);
                $course = $this->uri->segment(4);
                
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];
                $data['section'] = $section;
                $data['course'] = $course;
                
                $data['title'] = 'Tablet Class Manager';

                $data['show_students'] = $this->professor_model->search_student();
                
                $this->load->view('template/professor/professor_header', $data);
                $this->load->view('template/professor/professor_navbar', $data);
                $this->load->view('template/professor/professor_footer');
           

                $this->load->view('professor/search_result', $data);
             
             }else{
                redirect('professorhome/show_students', 'refresh');
            }
        
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
                    
                /*if ($query = $this->professor_model->schedule($data)){
                    foreach ($query as $row) {

                    }   
                }*/

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
                    'section_code' => 'Section',
                );

                $this->cezpdf->ezTable($data_table , $column_header, $title, array('height'=>975));
                $this->cezpdf->ezStream();
            
            }else{
                //If no session, redirect to login page
                redirect('professorlogin', 'refresh');
            }
        }

        function class_list_pdf(){    

            if($this->session->userdata('logged_in')){
                $section = $this->uri->segment(3);
                $course = $this->uri->segment(4);

                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['fname'] = $session_data['fname'];
                $data['lname'] = $session_data['lname'];
                $data['dept'] = $session_data['dept'];

                $data['title'] = 'Tablet Class Manager';
                $data['schedule'] = $this->professor_model->schedule($data);

                $data_table = array();
                
                $query =  $this->db->query('SELECT * FROM students a, students_sections b, sections c, professors_sections d, professors e, courses_sections f, courses g 
                    where b.section_code = c.section_code and b.student_username = a.student_username and d.section_code = b.section_code and d.professor_username = e.professor_username and f.section_code = c.section_code and f.course_code = g.course_code
                    and b.section_code = \'' . $this->uri->segment(3) . '\' and f.course_code = \'' . $this->uri->segment(4) . '\' and e.professor_username = \'' . $data['username'] . '\''  );
                
                $data_table = array();
                foreach ($query->result_array() as $row) {
                    $data_table[] = $row;
                }
                
                $title = $course . ' - ' . $section . ' Class List';

                $column_header=array(
                    'student_number' => 'Student Number',
                    'student_fname' => 'Student First Name',
                    'student_lname' => 'Student Last Name',
                    'student_program' => 'Program',
                    'student_yrlvl' => 'Year',
                      
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