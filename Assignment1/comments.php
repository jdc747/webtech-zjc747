<?php 

	session_start();

	include('database.php');
	include('functions.php');

	

	//get data from the form
	$PID = $_POST['PID'];
	$content = $_POST['content'];
	$UID = $_POST['UID'];

	//connect to DB
	$conn = connect_db();

	$content = sanitizeString($conn, $content);


	//query DB for this Post

	$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$UID'");

	$row = mysqli_fetch_assoc($result);
	$name = $row["Name"];
	$profile_pic = $row["profile_pic"];


	
	$result_insert = mysqli_query($conn, "INSERT INTO comments(content, UID, name, profile_pic, likes) VALUES ('$content', '$UID', '$name', '$profile_pic', 0)");

	if($result_insert){
		header('Location: feed.php');
	}else{

		echo "Error: " . $result_insert . "<br>" . mysqli_error($conn);
	}

 ?>