<?php

	
	//start session
	session_start();	

	include('database.php');
	include('functions.php');

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "";
	$dbname = "myDB";

	$conn = connect_db();
	

	$username = sanitizeString($conn, $_POST['username']);
	$password = sanitizeString($conn, $_POST['password']);
	$name = sanitizeString($conn, $_POST['name']);
	$email = sanitizeString($conn, $_POST['email']);
	$dob = sanitizeString($conn, $_POST['dob']);
	$gender = sanitizeString($conn, $_POST['gender']);
	$verification_question = sanitizeString($conn, $_POST['verification_question']);
	$verification_answer = sanitizeString($conn, $_POST['verification_answer']);
	$location = sanitizeString($conn, $_POST['location']);
	$profile_pic = sanitizeString($conn, $_POST['profile_pic']);

	$phash = password_hash($password, PASSWORD_DEFAULT);


	$insert_database = mysqli_query($conn, "INSERT INTO `users`(`username`, `password`, `name`, `email`, `dob`, `gender`, `verification_question`, `verification_answer`, `location`, `profile_pic`) VALUES ('$username', '$phash','$name','$email','$dob','$gender','$verification_question','$verification_answer','$location','$profile_pic')");

	

		//check if insert was okay
	if($insert_database){

		//redirect to feed page 
		$_SESSION["username"] = $username;
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Error: " . $insert_database . "<br>" . mysqli_error($conn);
 	}
?>