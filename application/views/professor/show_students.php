<h1>
<?php 
	foreach ($show_students as $row) {
		echo $row->student_lname;
		echo $row->section_code;
		echo $row->professor_lname;
		echo $row->course_code;	
		echo "<br>";
	}
?>
</h1>