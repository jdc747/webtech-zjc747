<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);

	echo "<h1>Welcome ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		echo "$row[3] said $row[1] ($row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";
		echo "<br>";


	echo "<form method='POST' action='comments.php'>";
	echo "<p><textarea name='content'>Write comment...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[2]'>";
	echo "<input type='hidden' name='PID' value='$row[0]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";

	$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE PID='$row[0]'");
	$num_rows_comments = mysqli_num_rows($result_comments);

	//show comments
	for($j=0; $j < $num_rows_comments; $j++){
		$row_comments = mysqli_fetch_row($result_comments);
		echo "$row_comments[3] commented $row_comments[1]";
		echo "<form action='comments.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> </form>";
		echo "<br>";
	}	



	}


?>


</body>
</html>
