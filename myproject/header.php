<?php
	session_start();
?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>

	<title></title>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <h3><a class="navbar-brand" href="home.php">My Project</a></h3>

	    <?php 
	    	$url = strtok($_SERVER["REQUEST_URI"],'?');
	    	$url = str_replace(".php", "", str_replace("/myproject/","",$url));


	    	$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
	    	$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : null;
	    ?>

		<?php 
			if( !empty($first_name) && !empty($last_name) ){
		    	echo'<ul class="navbar-nav ml-auto">' .
					'<li style="margin-right: 10px; margin-top: 7px;" ><label> Hi <b>' . ucfirst($first_name) . " " . ucfirst($last_name) . '</b></label></li>' .
					'<li><a class="btn btn-success my-2 my-sm-0" href="includes/logout.inc.php" role="button">Log Out</a></li>' .
					'</ul>';
			}

		?>
		
		<?php if($url != "userinfo" && empty($first_name) && empty($last_name)){ ?>
		    <ul class="navbar-nav ml-auto">
			   <a class="btn btn-success my-2 my-sm-0" href="userinfo.php" role="button">Sign Up</a>
			</ul>
		<?php } ?>

	  </div>
 </nav>
