<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully<br/><br/>";
	$user_name=$_POST['user_name'];
	$user_about=$_POST['user_about'];
	// echo $user_name;
	// echo $user_about;
	$query="INSERT INTO users (user_name,user_about) VALUES ('$user_name','$user_about')";
	// echo "<script>console.log(\"".$query."\")</script>";
	// echo "<script>console.log(\"$query\");</script>";
	$result=mysqli_query($connect,$query);
	$query2="select user_id from users where user_name='$user_name' and user_about='$user_about'";
	$result2=mysqli_query($connect,$query2);
	// echo "<script>console.log(\"".$query2."\")</script>";
	$row = mysqli_fetch_array($result2);
	$user_id=$row['user_id'];
	echo $user_id;
	header("Location: udetails.php?user_id=".$user_id);
    // ob_end_flush();
?>