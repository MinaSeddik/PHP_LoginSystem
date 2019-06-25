

<?php include 'header.php';?>

<script type="text/javascript">
	  $("#btnLogin").click(function(event) {

    //Fetch form to apply custom Bootstrap validation
    var form = $("#formLogin")

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
	?>

	<?php 
		if( isset($error) ){
	    	echo'<div class="alert alert-danger alert-dismissible">' .
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
				'<strong>Error! </strong>' . $error . '</div>';
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
	                            <h3 class="mb-0">Login</h3>
	                        </div>
	                        <div class="card-body">
	                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST" action="includes/login.inc.php">
	                                <div class="form-group">
	                                    <label for="email">Email</label>
	                                    <input type="text" class="form-control form-control-lg rounded-1" name="email" id="email" required="">
	                                    <div class="invalid-feedback">Enter your Email!</div>
	                                </div>
	                                <div class="form-group">
	                                    <label>Password</label>
	                                    <input type="password" class="form-control form-control-lg rounded-1" name="pwd" id="pwd" required="" autocomplete="new-password">
	                                    <div class="invalid-feedback">Enter your password!</div>
	                                </div>
	                        
	                                <input type="submit" name="submit" value="Sign in" class="btn btn-success btn-lg float-right" id="btnLogin">
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



