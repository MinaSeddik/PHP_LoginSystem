<?php

session_start();

if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$email 	  = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['pwd']);

	// Handle empty fields error
	if ( empty($email) || empty($password) ){
		header("Location: " . "../index.php?error=Missed Email or Password.");
		exit();
	}

	// check if the user exits
	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($conn, $sql);
	$result_check = mysqli_num_rows($result);
	if($result_check < 1){
		$err = "Email " . $email . " doesn't exist.";
		header("Location: " . "../index.php?error=". $err);
		exit();
	}

	if( $row = mysqli_fetch_assoc($result) ){
		// de-hashing the password
		$hashed_password_check = password_verify($password, $row['password']);

		if($hashed_password_check == false){
			header("Location: " . "../index.php?error=Incorrect Password, Please try Again.");
			exit();
		} elseif ($hashed_password_check == true) {
			// Log in the user here
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['city'] = $row['city'];

			// redirect to home page
			header("Location: ../home.php");
			exit();

		}
	}


} else{
	header("Location: ../index.php");
	exit();
}