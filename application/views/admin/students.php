<div class = "container">
    <div class = "col-md-1"></div>
    <div class = "col-md-10">
        <div class="row">
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            
            <div class="col-md-5" style="background-color:#222; color:#fff; padding:10px;text-align:center;">
                <a href="#addstudent">New Student</a> 
                    <div id="addstudent" class="modalDialog">
                        <div>
                            <a href="" title="Close" class="close">X</a>
                            <br>
                            <div style="background-color:#444; color:#fff; padding:5px;">
                                <h3>Add New Student</h3>
                            </div>
                                <?php 
                                    $student_number = array('id' => 'student_number' , 'name' => 'student_number', 'class' => 'form-control', 'placeholder' => 'Student Nunmber'  );
                                    $student_fname = array('id' => 'student_fname' , 'name' => 'student_fname', 'class' => 'form-control', 'placeholder' => 'Student First Name'  );
                                    $student_mi = array('id' => 'student_mi' , 'name' => 'student_mi', 'class' => 'form-control', 'placeholder' => 'Student Midlle Initial'  );
                                    $student_lname = array('id' => 'student_lname' , 'name' => 'student_lname', 'class' => 'form-control', 'placeholder' => 'Student Last Name'  );
                                    $student_program = array('id' => 'student_program' , 'name' => 'student_program', 'class' => 'form-control', 'placeholder' => 'Student Program'  );
                                    $student_yrlvl = array('id' => 'student_year' , 'name' => 'student_year', 'class' => 'form-control', 'placeholder' => 'Student Year'  );
                                    $student_email = array('id' => 'student_email' , 'name' => 'student_email', 'class' => 'form-control', 'placeholder' => 'Student Email Address'  );
                                    $student_contact = array('id' => 'student_contact' , 'name' => 'student_contact', 'class' => 'form-control', 'placeholder' => 'Student Contact Number'  );
                                    $student_address = array('id' => 'student_address' , 'name' => 'student_address', 'class' => 'form-control', 'placeholder' => 'Student Address'  );
                                ?>

                                <?php
                                    echo form_open('adminhome/add_student');
                       
                                    echo form_label('Student Number');
                                    echo form_input($student_number);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_number') . '</div>';
                                    echo '<br /><br />';
                                                    
                                    echo form_label('Student First Name');
                                    echo form_input($student_fname);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_fname') . '</div>';
                                    echo '<br /><br />';
                                    
                                    echo form_label('Student Middle Initial');
                                    echo form_input($student_mi);
                                    echo '<br>';

                                    echo form_label('Student Last Name');
                                    echo form_input($student_lname);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_lname') . '</div>';
                                    echo '<br /><br />';

                                    echo form_label('Student Program');
                                    echo form_input($student_program);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_program') . '</div>';
                                    echo '<br /><br />';

                                    echo form_label('Student Year');
                                    echo form_input($student_yrlvl);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_yrlvl') . '</div>';
                                    echo '<br /><br />';
                                    
                                    echo form_label('Student Email Address');
                                    echo form_input($student_email);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_yrlvl') . '</div>';
                                    echo '<br /><br />';
                                    
                                    echo form_label('Student Contact Number');
                                    echo form_input($student_contact);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_contact') . '</div>';
                                    echo '<br /><br />';

                                    echo form_label('Student Address');
                                    echo form_input($student_address);
                                    echo '<br>';
                                    echo '<div id = "error">' . form_error('student_address') . '</div>';
                                    echo '<br /><br />';

                                    echo form_submit('submit', 'Add Student');
                                    echo '<br /><br />';
                                    echo form_close();
                                ?>
                            <br>              
                        </div>      
                    </div>
            </div>            
            <div class="col-md-2" style="text-align:center">|</div>
            <div class="col-md-5" style="background-color:#222; color:#fff; padding:10px;text-align:center;">
                <a href="#studentcsv">Import Student List</a> 
                    <div id="studentcsv" class="modalDialog">
                        <div>
                            <a href="" title="Close" class="close">X</a>
                            <br>
                            <div style="background-color:#444; color:#fff; padding:5px;">
                                <h3>Add Student List</h3>
                            </div>
                                <form method="post" action="<?php echo base_url() ?>adminhome/upload_students" enctype="multipart/form-data">
                                    <br>
                                    <center><input type="file" name="userfile" ></center>
                                    <br>
                                    <input type="submit" name="submit" value="UPLOAD" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;">
                                </form>
                            <br>              
                        </div>      
                    </div>               
            </div>
        </div>


            <div class = "table-responsive">
    			<table class = "table" style="width:100%; text-align:center; ">
                	<thead style="background-color:#222; color:#fff;">
                		<tr>
                            <td>Student Number</td>
                            <td>Student Name</td>
                            <td>Student Program</td>
                            <td>Year / Level</td>
                            <td>Student Email Address</td>
                            <td>Student Contact Number</td>
                            <td>Student Address</td>
                		</tr>
                	</thead>

                	<tbody class = "table-striped" style="background-color:#e5e5ff;"> 
                		<?php if(isset($records)) : foreach ($records as $row) : ?>
                        	<tr>
                        		<td><?php echo $row->student_number ?></td>
                        		<td><?php echo $row->student_fname ?> <?php echo $row->student_mi ?> <?php echo $row->student_lname ?> </td>
                        		<td><?php echo $row->student_program ?></td>
                                <td><?php echo $row->student_yrlvl ?></td>
                                <td><?php echo $row->student_email ?></td>
                                <td><?php echo $row->student_address ?></td>
                                <td><?php echo $row->student_contact ?></td>
                            </tr>
                        <?php endforeach; ?>
                		<?php else : ?>     
    	            	<h2>No records were returned.</h2>
    	            	<?php endif; ?>                                     
    	            	<hr >
                		</tbody>
    			</table>
    		</div> 
    	</div>	
    </div>
    <div class="col-md-1"></div>
</div>