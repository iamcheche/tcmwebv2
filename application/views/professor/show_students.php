<div class = "container">
    <div class="row">
        <div class="row" style="background-color:#222; color:#fff;">
            <h2>
            <div class="col-md-6" style="text-align:center;">
                Course: <?php echo $course_code; ?> 
            </div>

            <div class="col-md-6" style="text-align:center;">
                Section: <?php echo $section_code; ?>
            </div>
            <br>
            </h2>

        </div>
        <div class="row" style="background-color:#222;padding:10px;">
            <hr>
            <div class="col-md-2" style="background-color:#e5e5ff; color:#fff; text-align:center; padding:10px; border-radius:10px; ">
                <a href="#openActivity"><b>Add Activity</b></a> 
                <div id="openActivity" class="modalDialog">
                    <div>
                        <a href="" title="Close" class="close">X</a>
                        <br>
                        <div style="background-color:#444; color:#fff; padding:5px;">
                            
                            <h3>Activity</h3>

                        </div>
                        <br>
                        <?php echo form_open('professorhome/add_activity/'. $section_code.'/'.$course_code.'/'.$schedule_id ); ?>
                            <p style="text-align:left;"><b>Term/Period:</b></p>
                            <select class="form-control" name = 'term' id = 'term'>
                                <option value="Prelim">Prelim Period</option>
                                <option value="Midterm">Midterm Period</option>
                                <option value="Finals">Finals Period</option>
                            </select> <br>
                            <p style="text-align:left;"><b>Activity Type:</b></p>
                            <select class="form-control" name = 'act_type' id = 'act_type'>
                                <option value="seatworks">Seatworks</option>
                                <option value="assignments">Assignments</option>
                                <option value="recitations">Recitation</option>
                                <option value="attendance">Attendance</option>
                                <option value="quizzes">Quizzes</option>
                                <option value="lab_activities">Laboratory Activities</option>
                                <option value="exams">Exams</option>
                            </select> <br>
                            <p style="text-align:left;"><b>Activity Name:</b></p>
                            <input type="text" size="20" id="act_name" name="act_name" class="form-control" placeholder="Activity Name"/>
                            <br>
                            <p style="text-align:left;"><b>Number of Items:</b></p>
                            <input type="text" size="20" id="act_wgt" name="act_wgt" class="form-control" placeholder="Number of Items:"/>
                            <br>
                            <input type="submit" value="Create Activity" class = "form-control" style = "background-color:#444; color:#fff; border-radius:5px;"/>
                         </form>
                        <br>              
                    </div>      
                </div>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2" style="background-color:#e5e5ff; color:#fff; text-align:center; padding:10px; border-radius:10px; ">
                <a href="#openFormula"><b>View Grades Formula</b></a> 
                <div id="openFormula" class="modalDialog">
                    <div>
                        <a href="" title="Close" class="close">X</a>
                        <br>
                        <div class="row" style="background-color:#444; color:#fff;">
                            <h3>Grades Formula</h3>
                            <br>
                            <div class="col-md-6" style="background-color:#444; color:#fff; padding:5px;">
                                <a href="">Edit Grading Formula</a>
                            </div>    
                            <div class="col-md-6" style="background-color:#444; color:#fff; padding:5px;">
                                <a href="">Close</a>
                            </div>    
                            
                        </div>
                        <form style="text-align:left; padding:20px;">
                            <div class="row">
                                <h4>Class Standings</h4>
                            </div>
                            <div class="row">

                                <p><b>Assignments @ </b> % | <b>Seatworks @ </b> % |
                                <b>Recitation @ </b> % | <b>Attendance @ </b>  /> % | 
                                <b>Quizzes @ </b>  % | <b>Lab. Activities @ </b> %
                                <hr style="border:1px #191919 dotted">
                                <p><b>Final Grade: Class Standings @ </b></b> % + <b> Exams @ </b>  %</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2" style="background-color:#e5e5ff; color:#fff; text-align:center; padding:10px; border-radius:10px; ">
                <a href="" ><b>Seat Plan</b></a>                            
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3" style="background-color:#e5e5ff; color:#fff; text-align:center; padding:10px; border-radius:10px; ">
                    <b><?php echo anchor("professorhome", 'Return Home' ); ?></b>
            </div>     
        </div>
        <br>

    </div>
    <br>
    <div class="row">
    <div class = "col-md-6" style="background-color:#333; color:#fff;text-align:center;">
    
    <h3>Class List</h3>

    <div class="row" style="border: 1px #191919 solid; padding:10px;">

        <div class = "col-md-5" style="background-color:#222; color:#fff; text-align:center; padding:10px;">
            <a href="#openStudent"><b>Add Student</b></a> 
                <div id="openStudent" class="modalDialog">
                    <div>
                        <a href="" title="Close" class="close">X</a>
                        <br>
                        <div style="background-color:#444; color:#fff; padding:5px;">
                            <h3>Search Student To Add</h3>
                        </div>
                        <?php echo form_open('professorhome/search_student/'.$section_code.'/'.$course_code.'/'.$schedule_id); ?>
                                        
                        <br>
                        <input type="text" size="20" id="search_student" name="search_student" class="form-control" placeholder="Student Name or Student Number"/>
                        
                        <br>
                        <input type="submit" value="Search Student" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;"/>
                        </form>
                        <br>              
                    </div>      
                </div>
        </div>       

        <div class="col-md-2" style="text-align:center;"></div>
        <div class="col-md-5" style="background-color:#222; color:#fff; text-align:center; padding:10px;">
            <a href="#csv"><b>Upload List</b></a>
            <div id="csv" class="modalDialog">
                <div>
                    <a href="" title="Close" class="close">X</a>
                    <br>
                    <div style="background-color:#444; color:#fff; padding:5px;">
                        <h3>Add Student List</h3>
                    </div>
                    <?php 
                        $attributes = array('enctype' => 'multipart/form-data');
                        echo form_open('professorhome/upload_students/' . $section_code . '/' . $course_code . '/' . $schedule_id, $attributes);
                    ?>
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
                <table class = "table" style="width:100%; text-align:center;">
                    <thead style="background-color:#222; color:#fff;text-align:center;">
                        <tr>
                            <th style="text-align:center;">Student Number </th>
                        <th style="text-align:center;">Student Name</th>
                        <th style="text-align:center;">Program/Year</th>
                    </tr>
                </thead>
                <tbody class = "table-striped" style="background-color:#e5e5ff; color:#191919"> 
                    <?php
                        $count = 0; 

                        if(isset($students)) : foreach ($students as $row) : 
                    ?>
                        <tr>
                            <td style="text-align:left;"> 
                                <b><?php echo $row->student_number ?></b>
                            </td>
                            <td style="text-align:left;"><b> <?php echo $row->student_lname . ', ' . $row->student_fname ?></b></td>
                            <td style="text-align:left;"> <b><?php echo $row->student_program . '</b>/<b>' . $row->student_yrlvl ?></b></td>
                            <?php $count++; ?>
                        </tr>
                        
                    <?php endforeach; ?>
                        <tr>
                            <td colspan="2"> Total Number of Students Enrolled:</td>
                            <td><?php echo $count ?></td>
                        </tr>
                    <?php else : ?>     
                    <h2>No records were returned.</h2>
                    <?php endif; ?>                                     
                    <hr >
                    </tbody>
            </table>
        </div> 
        </div>
        <div class= "col-md-1"></div>
        <div class="col-md-5">
            <div class="row" style="background-color:#222; color:#fff;text-align:center;">    
                <h3>Grades Graph</h3>
                <div id="grades" style="min-width: 310px; height: 400px; margin: 0 auto; margin:1%;"></div>
                <br>
            </div>
            <br>
    </div>
    </div>
</div>