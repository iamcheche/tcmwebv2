<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Professor_model extends CI_Model {

		function __construct(){
			$this->load->database();
			$this->load->library('session');
		}

		function update_token($data){
			$this->db->where('professor_username', $data['professor_username']);
			$this->db->update('professors', $data);
		}

		function update_token_logout($data){
			$this->db->where('professor_username', $data['professor_username']);
			$this->db->update('professors', 'login_token');
		}

		function schedule($data){
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where('professor_username', $data['username']);
			$this->db->order_by('course_code');
			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}

		function show_students($data){
			$this->db->select('a.*, b.*, c.*, d.*, e.*, f.*, g.*');
			$this->db->from('students a, students_sections b, sections c, professors_sections d, professors e, courses_sections f, courses g');
			$this->db->where('b.section_code = c.section_code');
			$this->db->where('b.student_username = a.student_username');
			$this->db->where('d.section_code = b.section_code');
			$this->db->where('d.professor_username = e.professor_username');
			$this->db->where('f.section_code = c.section_code');
			$this->db->where('f.course_code = g.course_code ');

			$this->db->where('b.section_code', $this->uri->segment(3));
			$this->db->where('f.course_code', $this->uri->segment(4));
			$this->db->where('e.professor_username', $data['username']);
			//section_code = $this->uri->segment(3)
			//professor_username = $data['username']
			//course_code = $this->uri->segment(4)

			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}

		function view_professor($data){
          	$this->db->select('*');
			$this->db->from('professors');
			$this->db->where('professor_username', $data['username']);

			$query = $this->db->get();

			$result = $query->result();
			return $result;	
		}

		function account($data){
			$this->db->select('*');
			$this->db->from('professors');
			$this->db->where('professor_username', $data['username']);

			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}
		
		function update_professor($data){
			$this->db->where('professor_username', $data['professor_username']);
			$this->db->update('professors', $data);
		}
		
		function search_student(){
			$match = $this->input->post('search_student');
			$this->db->like('student_number',$match);
  			$this->db->or_like('student_fname',$match);
  			$this->db->or_like('student_lname',$match);
  			
  			$show_students = $this->db->get('students');
  			return $show_students->result();
		}

		function get_students() {     
	        $query = $this->db->get('schedules_courses_sections_professors_students');
	        if ($query->num_rows() > 0) {
	            return $query->result_array();
	        } else {
	            return FALSE;
	        }
    	}
        function upload_students($insert_data){
            $this->db->insert('schedules_courses_sections_professors_students', $insert_data);
        }

        function activity($data){
            $this->db->insert('activities', $data);
        }
	}
?>