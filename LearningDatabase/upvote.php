<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	$cid=$_POST['course_id'];
	$tid=$_POST['tutorial_id'];
	$query="
    UPDATE course_tutorials
    SET upvotes = upvotes + 1
    WHERE course_id = $cid AND tutorial_id=$tid";
	mysqli_query($connect,$query);
	$result=mysqli_query($connect,"SELECT upvotes FROM course_tutorials WHERE course_id = $cid AND tutorial_id=$tid");
	$row = mysqli_fetch_array($result);
	echo $row['upvotes'];
	// $result=mysqli_query($connect,"select * from course_tutorials where course_id=$cid");
?>