<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	// echo "Connected successfully<br/><br/>";
	$course=$_GET['courseName'];
	$query="INSERT INTO course (course_name) VALUES ('$course')";
	$result=mysqli_query($connect,$query);
	// $row=mysqli_fetch_array($result);
	echo "<script>console.log(\"".$query."\");</script>";
	$query2="SELECT  course_id FROM course WHERE course_name='$course'";
	$result2=mysqli_query($connect,$query2);
	$row2=mysqli_fetch_array($result2);
	$course_id=$row2['course_id'];
	echo "<script>console.log(\"".$query2."\");</script>";
	// echo $course_id;
	header("Location: cdetails.php?course_id=$course_id");
?>