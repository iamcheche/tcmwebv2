<div class = "container">
	<div class = "col-md-12">
	
	<div class="row" style="background-color:#222; color:#fff;">
		<h2>
		<div class="col-md-6" style="text-align:center;">
			<?php echo $course; ?> 
		</div>

		<div class="col-md-6" style="text-align:center;">
			<?php echo $section; ?>
		</div>
		<br>
		</h2>

	</div>
	<br>
	<div class="row" >

		<div class = "col-md-4" style="background-color:#444; color:#fff; text-align:center; padding:10px;border:1px solid #191919;border-radius:5px;">
			<a href="#openStudent">Search Student</a> 
				<div id="openStudent" class="modalDialog">
                    <div>
                    	<a href="" title="Close" class="close">X</a>
                    	<br>
                        <div style="background-color:#444; color:#fff; padding:5px;">
                            <h3>Search Student To Add</h3>
                        </div>
                        <?php echo form_open('professorhome/search_student/'.$section.'/'.$course); ?>
                                        
                        <br>
                        <input type="text" size="20" id="search_student" name="search_student" class="form-control" placeholder="Student Name or Student Number"/>
                        
                        <br>
                        <input type="submit" value="Search Student" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;border-radius:5px;"/>
                        </form>
                        <br>              
                    </div>      
                </div>
        </div>    
		<div class="col-md-4" style="background-color:#444; color:#fff; text-align:center; padding:10px;border:1px solid #191919;border-radius:5px;">
			<a href="">Import Students</a>
		</div>
		<div class="col-md-4" style="background-color:#444; color:#fff; text-align:center; padding:10px;border:1px solid #191919;border-radius:5px;">
			<?php echo anchor("professorhome/class_list_pdf/" . $section . '/' . $course , 'Print Class List' ); ?>
		</div>
		
	</div>
		<div class = "table-responsive">
			<table class = "table" style="width:100%; text-align:center;">
            	<thead style="background-color:#222; color:#fff;text-align:center; ">
            		<tr>
            			<th style="text-align:center;border:1px solid #fff;">Student Number </th>
            			<th style="text-align:center;border:1px solid #fff;">Student Name</th>
            			<th style="text-align:center;border:1px solid #fff;">Program/Year</th>
            		</tr>
            	</thead>
            	<tbody class = "table-striped" style="background-color:#e5e5ff;"> 
            		<?php
            			$count = 0; 
            			if(isset($show_students)) : foreach ($show_students as $row) : 
            		?>
                    	<tr>
                    		<td style="text-align:left;border:1px solid #222;"> 
                    			<b><?php echo $row->student_number ?></b>
                    		</td>
                    		<td style="text-align:left;border:1px solid #222;"><b> <?php echo $row->student_lname . ', ' . $row->student_fname ?></b></td>
                    		<td style="text-align:left;border:1px solid #222;"> <b><?php echo $row->student_program . '</b>/<b>' . $row->student_yrlvl ?></b></td>
                    		<?php $count++; ?>
                    	</tr>
                    	
                    <?php endforeach; ?>
                        <tr style="border:1px solid #222;">
                    		<td colspan="2" style="border:1px solid #222;"><b> Total Number of Students Enrolled:</b></td>
                    		<td style="border:1px solid #222;"><?php echo $count ?></td>
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
