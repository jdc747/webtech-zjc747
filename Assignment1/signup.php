<?php

	
	//start session
	session_start();	

	include('database.php');

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "";
	$dbname = "myDB";

	$conn = connect_db();
	

	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$verification_question = $_POST['verification_question'];
	$verification_answer = $_POST['verification_answer'];
	$location = $_POST['location'];
	$profile_pic = $_POST['profile_pic'];

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