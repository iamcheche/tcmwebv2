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

		function show_students(){
			$this->db->select('a.student_lname, b.section_code, e.professor_lname, g.course_code');
			$this->db->from('students a, students_sections b, sections c, professors_sections d, professors e, courses_sections f, courses g');
			$this->db->where('b.section_code = c.section_code');
			$this->db->where('b.student_username = a.student_username');
			$this->db->where('d.section_code = b.section_code');
			$this->db->where('d.professor_username = e.professor_username');
			$this->db->where('f.section_code = c.section_code');
			$this->db->where('f.course_code = g.course_code ');
			

			$query = $this->db->get();

			$result = $query->result();
			return $result;

		}
		
	}
?>