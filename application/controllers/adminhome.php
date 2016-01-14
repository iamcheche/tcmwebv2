<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    session_start(); //we need to call PHP's session object to access it through CI
    class AdminHome extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model('admin_model');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('csvimport');

        }

        function index(){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['title'] = 'Tablet Class Manager';
                
                $this->load->view('template/admin/admin_header', $data);
                $this->load->view('template/admin/admin_navbar', $data);
                $this->load->view('template/admin/admin_footer');
           

                $this->load->view('admin/admin_home', $data);

            }else{
                //If no session, redirect to login page
                redirect('studentlogin', 'refresh');
            }
        }

        function get_table_name($table_name){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['title'] = 'Tablet Class Manager';
                
                $this->load->view('template/admin/admin_header', $data);
                $this->load->view('template/admin/admin_navbar', $data);
                $this->load->view('template/admin/admin_footer');
        
                if ($query = $this->admin_model->get_table($table_name)){
                    $data['records'] = $query;
                }

                $this->load->view('admin/'. $table_name, $data);     

            }else{
                //If no session, redirect to login page
                redirect('adminlogin', 'refresh');
            }
        }


        function students(){
            $this->get_table_name('students');
        }

        function courses(){
            $this->get_table_name('courses');
        }

        function professors(){
            $this->get_table_name('professors');
        }

        function profs_courses(){
            $this->get_table_name('profs_courses');
        }

        function schedules(){
            $this->get_table_name('schedules');
        }

        function students_courses(){
            $this->get_table_name('students_courses');
        }

        function create_student(){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['title'] = 'Tablet Class Manager';
                
                $this->load->view('template/admin/admin_header', $data);
                $this->load->view('template/admin/admin_navbar', $data);
                $this->load->view('template/admin/admin_footer');
                $this->load->view('admin/add_student', $data);

            }else{
                //If no session, redirect to login page
                redirect('adminlogin', 'refresh');
            }
        }
        
        
        function add_student(){
           $rules = array(
                array('field' => 'student_number', 'rules' => 'required|numeric'),
                array('field' => 'student_fname', 'rules' => 'required'),
                array('field' => 'student_mi', 'rules' => 'required'),
                array('field' => 'student_lname', 'rules' => 'required'),
                array('field' => 'student_program', 'rules' => 'required'),
                array('field' => 'student_year', 'rules' => 'required'),
                array('field' => 'student_email', 'rules' => 'required|valid_email'),
                array('field' => 'student_contact', 'rules' => 'required|numeric'),
                array('field' => 'student_address', 'rules' => 'required'),
            );
            
            $this->form_validation->set_rules($rules);

            if($this->form_validation->run() == FALSE){
                if($this->session->userdata('logged_in')){
                    $session_data = $this->session->userdata('logged_in');
                    $data['username'] = $session_data['username'];
                    $data['title'] = 'Tablet Class Manager';
                    
                    $this->load->view('template/admin/admin_header', $data);
                    $this->load->view('template/admin/admin_navbar', $data);
                    $this->load->view('template/admin/admin_footer');
                    //$this->load->view('admin/add_student', $data);
                    
                     $this->admin_model->create_student();
                    redirect('adminhome/students', 'refresh');

                }else{
                    //If no session, redirect to login page
                    redirect('adminlogin', 'refresh');
                }
            }else{
                $this->admin_model->create_student();
                redirect('adminhome/students', 'refresh');
            }
        }

        function create_table($table_name){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['title'] = 'Tablet Class Manager';
                
                if ($table_name == 'student_courses') {
                    $data['get_course'] = $this->admin_model->get_course();
                    $data['get_student'] = $this->admin_model->get_student();
                
                } elseif ($table_name == 'profs_courses'){
                    $data['get_course'] = $this->admin_model->get_course();
                    $data['get_professors'] = $this->admin_model->get_professors();
                
                } elseif ($table_name == 'schedule'){
                    $data['get_professors'] = $this->admin_model->get_professors();
                    $data['get_course'] = $this->admin_model->get_course();                
                }

                $this->load->view('template/admin/admin_header', $data);
                $this->load->view('template/admin/admin_navbar', $data);
                $this->load->view('template/admin/admin_footer');
                $this->load->view('admin/add_' . $table_name, $data);

            }else{
                //If no session, redirect to login page
                redirect('adminlogin', 'refresh');
            }
        }

        function create_professor(){
            $this->create_table('professor');
        }
        
       function create_course(){
            $this->create_table('course');
        }

       function create_schedule(){
            $this->create_table('schedule');
        }


        function create_students(){
            $this->create_table('student');
        }

        function create_student_course(){
            $this->create_table('student_courses');
        }        

        function create_profs_courses(){
            $this->create_table('profs_courses');
        }        






        function add_table($table_name, $rules){

            $this->form_validation->set_rules($rules);

            if($this->form_validation->run() == FALSE){
                if($this->session->userdata('logged_in')){
                    $session_data = $this->session->userdata('logged_in');
                    $data['username'] = $session_data['username'];
                    $data['title'] = 'Tablet Class Manager';
                    
                    $this->load->view('template/admin/admin_header', $data);
                    $this->load->view('template/admin/admin_navbar', $data);
                    $this->load->view('template/admin/admin_footer');
            
                    redirect('adminhome/'.$table_name, 'refresh');

                }else{
                    //If no session, redirect to login page
                    redirect('adminlogin', 'refresh');
                }
            }else{
                switch ($table_name) {
                    case 'schedules':
                        $this->admin_model->create_schedule();
                        break;          
                    case 'professors':
                        $this->admin_model->create_professor();
                        break;          
                    case 'courses':
                        $this->admin_model->create_course();
                        break;          
                    case 'students_courses':
                        $this->admin_model->create_schedule();
                        break;          
                                        
                    default:
                        $this->admin_model->create_student_course();
                        break;
                }
                
                redirect('adminhome/'.$table_name, 'refresh');
            }
        }


        function add_schedule(){
           $rules = array(
                array('field' => 'days', 'rules' => 'required'),
                array('field' => 'time_start', 'rules' => 'required'),
                array('field' => 'time_end', 'rules' => 'required'),
                array('field' => 'room', 'rules' => 'required'),
                array('field' => 'professor', 'rules' => 'required'),
                array('field' => 'course_code', 'rules' => 'required')
            );
            
            $this->add_table('schedules', $rules);            
        }


        function add_professor(){
           $rules = array(
                array('field' => 'professor_number', 'rules' => 'required|numeric'),
                array('field' => 'professor_fname', 'rules' => 'required'),
                array('field' => 'professor_lname', 'rules' => 'required'),
                array('field' => 'professor_dept', 'rules' => 'required'),
                array('field' => 'professor_email', 'rules' => 'required|valid_email'),
                array('field' => 'professor_contact', 'rules' => 'required|numeric'),
                array('field' => 'professor_address', 'rules' => 'required'),
            );
            $this->add_table('professors', $rules);            
        }
        function add_course(){
           $rules = array(
                array('field' => 'course_code', 'rules' => 'required'),
                array('field' => 'course_desc', 'rules' => 'required'),
                array('field' => 'credit_unit', 'rules' => 'required')
            );
            
             $this->add_table('courses', $rules);
        }
        
        function add_student_course(){
           $rules = array(
                array('field' => 'course_code', 'rules' => 'required'),
                array('field' => 'course_desc', 'rules' => 'required'),
                array('field' => 'credit_unit', 'rules' => 'required')
            );
            $this->add_table('student_courses', $rules);            
        }
    
        function upload_students(){
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
            
                $data['username'] = $session_data['username'];
                $data['title'] = 'Tablet Class Manager';  
                $data['students'] = $this->admin_model->get_students();
                $data['error'] = '';    //initialize image upload error array to empty

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // If upload failed, display error
                if (!$this->upload->do_upload()) {
                    $data['error'] = $this->upload->display_errors();

                    $this->load->view('template/admin/admin_header', $data);
                    $this->load->view('template/admin/admin_navbar', $data);
                    $this->load->view('template/admin/admin_footer');        
                    $this->load->view('admin/students', $data);
                } else {
                    $file_data = $this->upload->data();
                    $file_path =  './uploads/'.$file_data['file_name'];
                     
                    if ($this->csvimport->get_array($file_path)) {
                        $csv_array = $this->csvimport->get_array($file_path);
                        foreach ($csv_array as $row) {
                            $student_username = strtolower(substr($row['student_fname'], 0, 1) . $row['student_lname']);

                            $insert_data = array(
                                'student_number' => $row['student_number'],
                                'student_fname' => $row['student_fname'],
                                'student_mi' => $row['student_mi'],
                                'student_lname' => $row['student_lname'],
                                'student_program' => $row['student_program'],
                                'student_yrlvl' => $row['student_yrlvl'],
                                'student_email' => $row['student_email'],
                                'student_contact' => $row['student_contact'],
                                'student_address' => $row['student_address'],
                                'student_username' => $student_username,
                                'student_password' => '123456'                          
                            );

                            $this->admin_model->upload_students($insert_data);
                        }
                        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                        redirect(base_url().'adminhome/students');
                        //echo "<pre>"; print_r($insert_data);
                    } else 
                        $data['error'] = "Error occured";
                        $this->load->view('admin/students', $data);
                    }
                }else{
                    //If no session, redirect to login page
                    redirect('adminlogin', 'refresh');
                }

        }
    }
?>