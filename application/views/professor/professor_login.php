<div class = "container">
	<div class="row">
        <h1>
        <br>  
        </h1>
    </div>

    <div class = "col-md-4">

        <div>
            <div style="width:100%; background-color:#333; color:#fff; padding: 5px; text-align:center; border-radius:5px;">
                <h3 ><a href="#openLogin" style="width:100%; background-color:#333; color:#fff; padding: 5px; text-align:center; border-radius:5px; text-decoration:none">Request Login Token</a></h3>    
            </div>
            <br>
            <div id="openLogin" class="modalDialog">
                    <div>
                        <a href="professorlogin" title="Close" class="close">X</a>
                        <br>
                        <div style="background-color:#444; color:#fff; padding:5px;">
                            <h3>Requesting For My Login Token</h3>
                        </div>
                        <?php echo form_open('accesscode/sendtoprofessor'); ?>
                                        
                        <br>
                        <input type="text" size="20" id="username" name="username" class="form-control" placeholder="Professor Username"/>
                        <br>
                        <input type="submit" value="Get My Login Token" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;"/>
                        </form>
                        <br>              
                    </div>
            </div>    
        </div>
        <div style="background-color:#e5e5ff; border-radius:10px; border: 1px solid #444; padding: 10px;">
            <DIV style="background-color:#444; color: #fff; border-radius:5px;">
                <h1 style="text-align:center; padding: 5px;">Sign In</h1>
            </DIV> 
            <br>
            <div style = "color:#ff1919; text-align:center;">
                <?php echo validation_errors(); ?>
            </div>
            <?php echo form_open('verifyprofessor'); ?>
                                            
            <input type="text" size="20" id="username" name="username" class="form-control" placeholder="Username" />
            <br>
            <input type="password" size="20" id="passowrd" name="password" class="form-control" placeholder="Password"/>
            <br>
            <input type="text" size="20" id="token" name="token" class="form-control" placeholder="Login Token"/>
            <br>
            <input type="submit" value="Login" class = "form-control" style = "background-color:#191919; color:#fff; border-radius:5px;"/>
            </form>
            <br>    
        </div>
        
    </div>

	<div class="col-md-1"></div>
	
    <div class="col-md-7">
        <div>
            <div style="width:100%; background-color:#333; color:#fff; padding: 5px; text-align:center; border-radius:5px;">
                <h3 ><a href="#openAccess" style="width:100%; background-color:#333; color:#fff; padding: 5px; text-align:center; border-radius:5px; text-decoration:none">How to Login?</a></h3>    
            </div>
            <br>
            <div id="openAccess" class="modalDialog">
                    <div>
                    <br>
                        <a href="professorlogin" title="Close" class="close">X</a>
                        <div style="background-color:#444; color:#fff;">
                            <br>
                            <h3> Steps on Logging In. </h3>
                            <br>
                        </div>
                        <h4 style="text-align: left;">1. Click on the <a href="#openLogin">Request Login Token</a>  Button.</h4>
                        <h4 style="text-align: left;">2. On the field provided insert your username, then click Get My Login Token. </h4>
                        <h4 style="text-align: left;">3. Check your registered email. You shall receive an email named as "Login Token - NOREPLY"</h4>
                        <h4 style="text-align: left;">4. You may now login by filling the Sign In form. </h4>
                        
                        <br>              
                    </div>
            </div>    
        </div>
        <?php echo img(array('src'=>'img/slider1.jpg', 'style' => 'height:100%; width:100%; border-radius:10px;')); ?>	
	   
    </div>
</div>