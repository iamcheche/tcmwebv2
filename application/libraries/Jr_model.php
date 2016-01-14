<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Jr_model extends CI_Model{

		function __construct(){
			parent::__construct();
		}

		function getEmail($pu){ 
			$this->db->where('professor_username', $pu);
			return $this->db->get('professors')->row()->professor_email;
		}

		function getSchedules($pu){ 
			$this->db->select('schedules.days, courses.course_code, schedules.time_start, schedules.time_end, schedules.room, sections.section_code, professors.professor_username, schedules.schedule_id');
			$this->db->from('schedules_courses_sections_professors_students, courses, schedules, sections, professors');
			$wh = array(
				'schedules_courses_sections_professors_students.course_code = courses.course_code',
				'schedules_courses_sections_professors_students.schedule_id = schedules.schedule_id',
				'schedules_courses_sections_professors_students.section_code = sections.section_code',
				'schedules_courses_sections_professors_students.professor_username = professors.professor_username',
				'professors.professor_username =\''.$pu.'\''
			);
			foreach ($wh as $i) { $this->db->where($i); }
			//$this->db->group_by('courses.course_code');
			$this->db->order_by('courses.course_code');
			return $this->db->get()->result();
		}

        function addStudent($su, $sc, $cc, $si, $pu){ 
        	$x = array(
        		'student_username' => $su,
        		'section_code' => $sc,
        		'course_code' => $cc,
        		'schedule_id' => $si,
        		'professor_username' => $pu
        		);
            foreach ($x as $k => $v) { $this->db->set($k, $v); } 
            $this->db->insert('schedules_courses_sections_professors_students');
        }

		function getStudents($pu, $si, $cc, $sc){ 
			$this->db->from('schedules_courses_sections_professors_students, courses, schedules, sections, professors, students');			
			$wh = array(
				'schedules_courses_sections_professors_students.course_code = courses.course_code',
				'schedules_courses_sections_professors_students.schedule_id = schedules.schedule_id',
				'schedules_courses_sections_professors_students.section_code = sections.section_code',
				'schedules_courses_sections_professors_students.professor_username = professors.professor_username',
				'schedules_courses_sections_professors_students.student_username = students.student_username',
				'professors.professor_username =\''.$pu.'\'',
				'schedules.schedule_id = \''.$si.'\'',
				'courses.course_code = \''.$cc.'\'',
				'sections.section_code = \''.$sc.'\''
			);
			foreach ($wh as $i) { $this->db->where($i); }
			return $this->db->get()->result();
		}
		
		function getActivities($pu, $si, $cc, $sc){ 
			$this->db->from('activities, courses, schedules, sections, professors, students');			
			$wh = array(
				'activities.course_code = courses.course_code',
				'activities.schedule_id = schedules.schedule_id',
				'activities.section_code = sections.section_code',
				'activities.professor_username = professors.professor_username',
				'professors.professor_username =\''.$pu.'\'',
				'schedules.schedule_id = \''.$si.'\'',
				'courses.course_code = \''.$cc.'\'',
				'sections.section_code = \''.$sc.'\''
			);
			foreach ($wh as $i) { $this->db->where($i); }
			$this->db->group_by('activity_name');		
			return $this->db->get()->result();
		}

		function getMatchedStudents($wildcard){ 
			$this->db->like('student_number', $wildcard);
  			$this->db->or_like('student_fname', $wildcard);
  			$this->db->or_like('student_lname', $wildcard);
  			return $this->db->get('students')->result();
		}

		function isStudentInSchedule($s_uname, $p_uname, $sc, $cc, $si){
			$this->db->select('*');
			$this->db->from('schedules_courses_sections_professors_students, students, professors, sections, courses, schedules');
			
			$wh = array(
				'schedules_courses_sections_professors_students.course_code = courses.course_code',
				'schedules_courses_sections_professors_students.schedule_id = schedules.schedule_id',
				'schedules_courses_sections_professors_students.section_code = sections.section_code',
				'schedules_courses_sections_professors_students.professor_username = professors.professor_username',
				'schedules_courses_sections_professors_students.student_username = students.student_username',
				'students.student_username = \''.$s_uname.'\'',
				'professors.professor_username = \''.$p_uname.'\'',
				'sections.section_code = \''.$sc.'\'',
				'courses.course_code = \''.$cc.'\'',
				'schedules.schedule_id = '.$si
				);
			foreach ($wh as $i) { $this->db->where($i); }
			return $this->db->get()->num_rows();
		}

		function getProfessor($pu){
			$this->db->where('professor_username', $pu);
			return $this->db->get('professors')->result();
		}
	}
?>