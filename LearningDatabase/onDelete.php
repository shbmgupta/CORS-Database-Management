<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}
	$cid=$_GET['course_id'];
	$tid=$_GET['tutorial_id'];
	$query="DELETE FROM `course_tutorials` WHERE course_id=$cid and tutorial_id=$tid";
	$result=mysqli_query($connect,$query);
	echo "<script>console.log(\"".$query."\");</script>";
	header("Location: cdetails.php?course_id=$cid");
?>