 <div class="container">

    <div class="col-md-2">
        <div style="background-color:#333;color:#fff;border-radius:5px;width:100%;text-align:center; padding:1px;">
            <h3><a href="<?php echo base_url('professorhome');?>" style = "text-decoration:none; color:#fff;"> Return Home</a></h3>
        </div>
        <hr>
        <h4 style="color:#ff1212;">*Note: You can only change your password, email, contact number, and password</h4>
     </div>

     <div class="col-md-1"></div>
    
     <div class="col-md-8">
        <?php foreach ($professors as $professor): ?>
        <?php 
            $professor_number = array('id' => 'professor_number' , 'name' => 'professor_number', 'class' => 'form-control', 'placeholder' => 'professor Nunmber', 'value' => $professor->professor_number, 'readonly' => TRUE  );
            $professor_fname = array('id' => 'professor_fname' , 'name' => 'professor_fname', 'class' => 'form-control', 'placeholder' => 'professor First Name' , 'value' => $professor->professor_fname, 'readonly' => TRUE   );
            $professor_lname = array('id' => 'professor_lname' , 'name' => 'professor_lname', 'class' => 'form-control', 'placeholder' => 'professor Last Name'  , 'value' => $professor->professor_lname, 'readonly' => TRUE  );
            $professor_dept = array('id' => 'professor_dept' , 'name' => 'professor_dept', 'class' => 'form-control', 'placeholder' => 'professor Program'  , 'value' => $professor->professor_dept, 'readonly' => TRUE  );
            $professor_email = array('id' => 'professor_email' , 'name' => 'professor_email', 'class' => 'form-control', 'placeholder' => 'professor Email Address'  , 'value' => $professor->professor_email  );
            $professor_contact = array('id' => 'professor_contact' , 'name' => 'professor_contact', 'class' => 'form-control', 'placeholder' => 'professor Contact Number'  , 'value' => $professor->professor_contact  );
            $professor_username = array('id' => 'professor_username' , 'name' => 'professor_username', 'class' => 'form-control', 'placeholder' => 'professor Username' , 'value' => $professor->professor_username, 'readonly' => TRUE    );
            $professor_password = array('id' => 'professor_password' , 'name' => 'professor_password', 'class' => 'form-control', 'placeholder' => 'professor Password' , 'value' => $professor->professor_password   );

            echo form_open('professorhome/account_update');
            
            echo '<h2 style = "background-color:#444; color:#fff; text-align:center; border-radius:5px;">Account Information</h2>';                           
            echo form_label('professor Number');
            echo form_input($professor_number);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_number') . '</div>';
            
                                                                    
            echo form_label('professor First Name');
            echo form_input($professor_fname);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_fname') . '</div>';
                                                                    
            echo form_label('professor Last Name');
            echo form_input($professor_lname);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_lname') . '</div>';
            

            echo form_label('professor Department');
            echo form_input($professor_dept);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_dept') . '</div>';
                                                        
            echo form_label('professor Email Address');
            echo form_input($professor_email);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_email') . '</div>';
            
                                                    
            echo form_label('professor Contact Number');
            echo form_input($professor_contact);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_contact') . '</div>';

            echo form_label('professor Username');
            echo form_input($professor_username);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_username') . '</div>';
            

            echo form_label('professor Password');
            echo form_password($professor_password);
            echo '<br>';
            echo '<div id = "error">' . form_error('professor_password') . '</div>';
            

            /*echo form_submit('submit', 'Update Account');
            echo form_close();
            echo '<br>';*/
        ?>

        <input type="submit" value="Update My Account" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;"/>
        
        <?php 
            endforeach;
        ?>

     </div> 
    <div class="col-md-1"></div>

 </div>
 