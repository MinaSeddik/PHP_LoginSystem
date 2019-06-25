

<?php include 'header.php';?>

<script type="text/javascript">
	  $("#btnRegister").click(function(event) {

    //Fetch form to apply custom Bootstrap validation
    var form = $("#formRegister")

    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
    
    form.addClass('was-validated');
  });

</script>

<section>
	

	<?php
		if(isset($_GET["error"]))
			$error = htmlspecialchars($_GET["error"]);

		if(isset($_GET["status"]))
			$status = htmlspecialchars($_GET["status"]);

		$form_title = "Registeration Form";
		$actionName = "Sign Up";
		$update_mode = false;

		if(isset($_GET["mode"]) && $_GET["mode"] == "update"){			
			$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
			$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : null;
			$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
			$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;
			$city = isset($_SESSION['city']) ? $_SESSION['city'] : null;

			$form_title = "User Profile";		
			$actionName = "Update";	
			$update_mode = true;
			$old_pwd = $password;
		}

	?>

	<?php 
		if( isset($error) ){
	    	echo'<div class="alert alert-danger alert-dismissible">' .
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
				'<strong>Error! </strong>' . $error . '</div>';
		}

		if( isset($status) ){
	    	echo'<div class="alert alert-success alert-dismissible">' .
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
				'<strong>Passed! </strong>' . $status . '</div>';
		}
	?>

	<div class="container py-5">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="row">
	                <div class="col-md-6 mx-auto">

	                    <!-- form card login -->
	                    <div class="card rounded-0">
	                        <div class="card-header">
	                            <h3 class="mb-0">
	                            	<?php 
	                            		echo $form_title;
	                            	?>
	                            </h3>
	                        </div>
	                        <div class="card-body">
	                            <form class="form" role="form" autocomplete="off" id="formRegister" novalidate="" method="POST" action="includes/userinfo.inc.php">

	                                <div class="form-group">
	                                    <label for="fname">First Name</label>
	                                    <input type="text" class="form-control form-control-lg rounded-1" name="fname" id="fname" required="" 
											<?php
												if( isset($first_name) )
													echo 'value="' . $first_name . '"';
											?>
	                                    >
	                                    <div class="invalid-feedback">Enter your First Name!</div>
	                                </div>

	                                <div class="form-group">
	                                    <label for="lname">Last Name</label>
	                                    <input type="text" class="form-control form-control-lg rounded-1" name="lname" id="lname" required=""
		                                    <?php
													if( isset($last_name) )
														echo 'value="' . $last_name . '"';
											?>
		                                >
	                                    <div class="invalid-feedback">Enter your Last Name!</div>
	                                </div>

	                                <div class="form-group">
	                                    <label for="email">Email</label>
	                                    <input type="text" class="form-control form-control-lg rounded-1" name="email" id="email" required=""
		                                    <?php
													if( isset($email) )
														echo 'value="' . $email . '"';

													if( $update_mode )
														echo 'readonly="readonly"';
											?>
		                                >	                                    
	                                    <div class="invalid-feedback">Enter your e-mail!</div>
	                                </div>

	                                <div class="form-group">
	                                    <label>Password</label>
	                                    <input type="password" class="form-control form-control-lg rounded-1" name="pwd" id="pwd" required="" autocomplete="new-password"
		                                    <?php
													if( isset($password) )
														echo 'value="' . $password . '"';

											?>
		                                >	                                    
	                                    <div class="invalid-feedback">Enter your password!</div>
	                                </div>
	                        
	                                <div class="form-group">
	                                    <label>Confirm Password</label>
	                                    <input type="password" class="form-control form-control-lg rounded-1" name="pwd2" id="pwd2" required="" autocomplete="new-password"
		                                    <?php
													if( isset($password) )
														echo 'value="' . $password . '"';

											?>
		                                >	                                    
	                                    <div class="invalid-feedback">Confirm your password!</div>
	                                </div>


	                                <div class="form-group">
	                                    <label for="city">City</label>
	                                    <input type="text" class="form-control form-control-lg rounded-1" name="city" id="city" required=""
		                                    <?php
													if( isset($city) )
														echo 'value="' . $city . '"';
											?>
		                                >	                                    
	                                    <div class="invalid-feedback">Enter your City!</div>
	                                </div>

									<?php
										if( $update_mode ){
											echo '<input type="hidden" name="mode" value="update" >';
											echo '<input type="hidden" name="old_pwd" value="' . $old_pwd . '" >';
										}
									?>

	                                <input type="submit" name="submit"
									<?php
										echo 'value="' . $actionName . '"';
									?>
	                                class="btn btn-success btn-lg float-right" id="btnRegister">

	                            </form>
	                        </div>
	                    </div>


	                </div>


	            </div>
	            <!--/row-->

	        </div>
	        <!--/col-->
	    </div>
	    <!--/row-->
	</div>
	<!--/container-->

</section>

<?php include 'footer.php';?>



