<div class = "container">
    <div class = "col-md-12">
    
    <div class="row" style="background-color:#222; color:#fff;">
        <h2>
        <div class="col-md-6" style="text-align:center">
            <?php echo $course_code; ?> 
        </div>

        <div class="col-md-6" style="text-align:center">
            <?php echo $section_code; ?>
        </div>
        <br>
        </h2>

    </div>
    <br>
    <div class="row" >
        <div class = "col-md-5" style="background-color:#222; color:#fff; text-align:center; padding:10px;">
            <a href="#openStudent"><b>New Search</b></a> 
                <div id="openStudent" class="modalDialog">
                    <div>
                        <a href="" title="Close" class="close">X</a>
                        <br>
                        <div style="background-color:#444; color:#fff; padding:5px;">
                            <h3>Search Student To Add</h3>
                        </div>
                        <?php echo form_open('professorhome/search_student/'.$section_code.'/'.$course_code); ?>
                                        
                        <br>
                        <input type="text" size="20" id="search_student" name="search_student" class="form-control" placeholder="Student Name or Student Number"/>
                        
                        <br>
                        <input type="submit" value="Add This Student To Class" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;"/>
                        </form>
                        <br>              
                    </div>      
                </div>
        </div>    
        <div class="col-md-2" style="text-align:center;">|</div>
        <div class="col-md-5" style="background-color:#222; color:#fff; text-align:center; padding:10px;">
             <b><?php echo anchor("professorhome/show_students/".$section_code.'/'.$course_code.'/'.$schedule_id, 'Return to Previous Page' ); ?></b>
             
        </div>
    </div>
        <div class = "table-responsive">
            <table class = "table" style="width:100%; text-align:center;">
                <thead style="background-color:#222; color:#fff;text-align:center;">
                    <tr>
                        <th style="text-align:center;">Student Number </th>
                        <th style="text-align:center;">Student Name</th>
                        <th style="text-align:center;">Program/Year</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody class = "table-striped" style="background-color:#e5e5ff;"> 
                    <?php
                        $count = 0; 
                        if(isset($matched_students)) : foreach ($matched_students as $row) : 
                    ?>
                        <tr>
                            <td style="text-align:left;"> 
                                <b><?php echo $row->student_number; ?></b>
                            </td>
                            <td style="text-align:left;"><b> <?php echo $row->student_lname . ', ' . $row->student_fname ?></b></td>
                            <td style="text-align:left;"> <b><?php echo $row->student_program . '</b>/<b>' . $row->student_yrlvl ?></b></td>
                            <td style="text-align:center;"> <b><?php echo anchor("professorhome/add_student/".$section_code.'/'.$course_code.'/'.$row->student_username.'/'.$schedule_id, 'Add' ); ?></b></td>
                            <?php $count++; ?>
                        </tr>
                        
                    <?php endforeach; ?>
                        <tr>
                            <td colspan="3"> Search Result Total:</td>
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
</div>
