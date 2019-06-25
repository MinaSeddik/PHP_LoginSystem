

<?php 

	include 'header.php';

	if( !isset($_SESSION['email'])){
		header("Location: index.php");
		exit();
	}

?>

<section>
	
	<div class="container py-5">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="row">
	                <div class="col-md-6 mx-auto">

						<div class="card">
						  <div class="card-body">
						    <h5 class="card-title">

						    	<?php 

							    	$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
							    	$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : null;
							    	$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

						    		echo "Welcome <b> " . ucfirst($first_name) . " " . ucfirst($last_name) . " </b>";
						    	?>

						    </h5>
						    <p class="card-text">
						    
						    <?php 
						    	echo $email;
						    ?>

							</p>

							<?php
							 	echo '<a class="btn btn-success btn-lg float-right" href="userinfo.php?mode=update" role="button">Edit Profile</a>';
							?>

						  </div>
						</div>


					</div>	
				</div>	
			</div>	
		</div>	
	</div>	

</section>

<?php include 'footer.php';?>



