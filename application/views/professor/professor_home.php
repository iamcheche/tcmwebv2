<div class = "container">
	<div class="row">
		<div class="col-md-12" style="background-color:#222; color:#fff; border-radius:10px;">
			<div class="row">
				<div class = "col-md-6">
					<h3>Name: <?php echo $fname . ' ' . $lname ?></h3>
				</div>
				<div class = "col-md-6">
					<h3>Department: <?php echo $dept ?></h3>	
				</div>	
			</div>
								
		</div>

	</div>
	<br>
	<div class = "row">
		<div class = "col-md-5" style="background-color:#444; color:#fff;border-radius:10px;">
			<div style="background-color:#444; color:#fff;">
				<h4 style=" text-align: center; ">My Schedule</h4>
				<br>

				<div class = "table-responsive">
			        <table class = "table" style="width:100%;">
			            <thead style="background-color:#222; color:#fff; text-align:center;">
			                <tr>
			                	<th>Days</th>
			            		<th>Course</th>
			            		<th>Time</th>
			            		<th>Room</th>
			            		<th>Section</th>
			            		<th>Options</th>
			                </tr>
			            </thead>                        
			            <tbody style="background-color:#e5e5ff; color:#191919;">
			            	<?php if(isset($schedule)) : foreach ($schedule as $row) : ?>
	                    	<tr>
	                    		<td><?php echo $row->days ?></td>
	                    		<td><?php echo $row->course_code ?></td>
	                    		<td><?php echo $row->time_start . ' - ' . $row->time_end ?></td>
	                            <td><?php echo $row->room ?></td>
	                            <td><?php echo $row->section_code ?></td>
	                            <td><a href=""> View Students</a></td>
	                    	</tr>
		                    <?php endforeach; ?>
		            		<?php else : ?>     
			            	<h2>No records were returned.</h2>
			            	<?php endif; ?>
			            </tbody>
			        </table>
				</div>
					
			</div>
		</div>

		<div class = "col-md-1"></div>
		
		<div class = "col-md-6" style="background-color:#444; color:#fff;">
			<div style="background-color:#444; color:#fff; text-align: center;">
				<h2>Grades of Students</h2>

			</div>
			<div id="grades" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			<br>
		</div>
		
			
	</div>
	<br>
	
</div>