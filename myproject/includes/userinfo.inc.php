<?php

session_start();


function build_query_string($error, $mode){
	$qs = "";
	if(!empty($error)){
		$qs .= "error=$error";

		if( !empty($mode))
			$qs .= "&";
	}

	if(!empty($mode)){
		$qs .= "mode=$mode";

	}

	return $qs;
}


include_once 'dbh.inc.php';

if( isset($_POST['submit']) ){

	$first_name = 	mysqli_real_escape_string($link, $_POST['fname']);
	$last_name 	=  	mysqli_real_escape_string($link, $_POST['lname']);
	$email 		= 	mysqli_real_escape_string($link, $_POST['email']);
	$password 	= 	mysqli_real_escape_string($link, $_POST['pwd']);
	$password2 	= 	mysqli_real_escape_string($link, $_POST['pwd2']);
	$city 		= 	mysqli_real_escape_string($link, $_POST['city']);

	$mode 		= 	$_POST['mode'];
	$old_pwd 	= 	$_POST['old_pwd'];


	// Handle empty fields error
	if ( empty($first_name) || empty($last_name) || empty($email) || empty($password) ){
		header("Location: " . "../userinfo.php?" .
			build_query_string("There are a Missed Fields, Please Complete the Form.", $mode));
		exit();
	}

	// validate first name
	$name_pattern = "/^([a-zA-Z' ]+)$/";
	if ( !preg_match($name_pattern, $first_name) ){
		header("Location: " . "../userinfo.php?" . build_query_string("Invalid First Name.", $mode));
		exit();
	}
		
	// validate last name
	if ( !preg_match($name_pattern, $last_name) ){
		header("Location: " . "../userinfo.php?" . build_query_string("Invalid Last Name.", $mode));
		exit();
	}

	// validate email
	if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: " . "../userinfo.php?" . build_query_string("Invalid Email Address.", $mode));
		exit();
	}

	// check if the passwords match
	if( $password != $password2){
		header("Location: " . "../userinfo.php?" . build_query_string("Password Mismatch, Please make sure that you enter the same password in Confirm Password.", $mode));
		exit();	
	}


	// check password strength
	if( empty($mode) || ( !empty($mode) && $mode == "update" && $old_pwd != $_POST['pwd']) ){
	
		if (strlen($password) < 8) {
	        header("Location: " . "../userinfo.php?" . build_query_string("Password too short, please make sure that the password is at lease 8 char.", $mode));
			exit();
	    }

	    if (!preg_match("#[0-9]+#", $password)) {
	    	header("Location: " . "../userinfo.php?" . build_query_string("Password must include at least one number.", $mode));
			exit();
	    }

	    if (!preg_match("#[a-zA-Z]+#", $password)) {
	        header("Location: " . "../userinfo.php?" . build_query_string("Password must include at least one letter.", $mode));
			exit();
	    } 
	}

	
	if( empty($mode) ) {

		// Handle insert mode

		// check if the user email already exits
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		$result_check = mysqli_num_rows($result);
		if($result_check > 0){
			header("Location: " . "../userinfo.php?" . build_query_string("This Email aleady registered.", $mode));
			exit();
		}

		// Hashing the password
		$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

	}elseif ( !empty($mode) && $mode == "update" && $old_pwd == $_POST['pwd'] ) {

		// Handle update mode with no changed password

		// the old password already hashed.
		$hashed_pwd = $old_pwd;
	}elseif ( !empty($mode) && $mode == "update" && $old_pwd != $_POST['pwd'] ) {

		// Handle update mode with a changed password

		$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
	}
	

	// insert mode
	if( empty($mode) ) {

		// Finally insert that user into the db
		$sql = "INSERT INTO users (first_name, last_name, email, password, city) VALUES ('$first_name', '$last_name', '$email', '$hashed_pwd', '$city')";
		$result = mysqli_query($conn, $sql);
		if($result){
			// Log in the user here
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $hashed_pwd;
			$_SESSION['city'] = $city;

			// redirect to home page
			header("Location: ../home.php");

			exit();
		}else{
			// An error occured in the database
			header("Location: " . "../userinfo.php?" . build_query_string("System Error, Please contact your Administrator.", $mode));
			exit();
		}
	}else{
		// update mode

		$sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', password = '$hashed_pwd', city = '$city' WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		if($result){
			// update user info
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $hashed_pwd;
			$_SESSION['city'] = $city;

			// redirect to home page
			header("Location: ../userinfo.php?status=User Profile Saved successfully.&mode=update");

			exit();
		}else{
			// An error occured in the database
			header("Location: " . "../userinfo.php?" . build_query_string("System Error, Please contact your Administrator.", $mode));
			exit();
		}
	}

} else{
	header("Location: ../userinfo.php");
	exit();
}


