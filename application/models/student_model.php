<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Student_model extends CI_Model {

		public function __construct(){
			$this->load->database();
			$this->load->library('session');		
		}

		function view($data){
          	$this->db->select('a.student_username, c.course_code, c.course_desc, c.credit_unit, d.professor_fname, d.professor_lname, f.days, f.time_start, f.time_end, f.room, g.section_code');
			
			/*$this->db->from('students_courses a, sections f');
			$this->db->join('courses b', 'a.course_code = b.course_code');
			$this->db->join('profs_courses c', 'b.course_code = c.course_code');
			$this->db->join('professors d', 'c.professor_username = d.professor_username');
			$this->db->join('schedules e', 'b.course_code = e.course_code');
			$this->db->join('students_sections g', 'f.section_code = g.section_code');
			$this->db->where('a.student_username', $data['username']);*/
			
			$this->db->from('students a, students_courses b, courses c, professors d, profs_courses e, schedules f, sections g, professors_sections h');
			$this->db->where('b.student_username = a.student_username');
			$this->db->where('c.course_code = b.course_code');
			$this->db->where('e.course_code = c.course_code');
			$this->db->where('e.professor_username = d.professor_username');
			$this->db->where('f.professor_username = d.professor_username');
			$this->db->where('f.course_code = c.course_code');
			$this->db->where('f.section_code = g.section_code');
			$this->db->where('d.professor_username = h.professor_username');
			$this->db->where('h.section_code = g.section_code');
			$this->db->where('a.student_username', $data['username']);

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