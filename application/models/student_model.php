<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Student_model extends CI_Model {

		public function __construct(){
			$this->load->database();
			$this->load->library('session');		
		}

		function view($data){
			$this->db->select('*');
			$this->db->from('schedules_courses_sections_professors_students a, schedules b, courses c, professors d, sections e, schedules f');
			$this->db->where('a.course_code = c.course_code');
			$this->db->where('a.professor_username = d.professor_username');
			$this->db->where('a.section_code = e.section_code');
			$this->db->where('a.schedule_id = f.schedule_id');
			$this->db->where('student_username', $data['username']);
			$this->db->group_by('a.course_code');
			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}

		function get_query($data, $table_name){
			$this->db->select('*');
			$this->db->from($table_name);
			$this->db->where('student_username',  $data['username']);
			$this->db->where('course_code', $this->uri->segment(3));			

			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}


		function profile($data){
			$this->db->select('*');
			$this->db->from('students');
			$this->db->where('student_username', $data['username']);
			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}

		function view_grade($data){
			$this->db->where('course_code', $data, $this->uri->segment(3));
		}

		function view_student($data){
          	$this->db->select('*');
			$this->db->from('students');
			$this->db->where('student_username', $data['username']);
			$this -> db -> limit(1);
			$query = $this->db->get();

			$result = $query->result();
			return $result;	
		}

		function account($data){
			$this->db->select('*');
			$this->db->from('students');
			$this->db->where('student_username', $data['username']);
			$this -> db -> limit(1);
			$query = $this->db->get();

			$result = $query->result();
			return $result;
		}
		
		function update_student($data){
			$this->db->where('student_username', $data['student_username']);
			$this->db->update('students', $data);
		}
	}
?>