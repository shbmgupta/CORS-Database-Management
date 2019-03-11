<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	// echo "Connected successfully<br/><br/>";
	$course_id=$_POST['course_id'];
	$tutorialname=$_POST['TutorialName'];
	$tutorialURL=$_POST['TutorialURL'];
	$submitter_id=$_POST['Submitter'];
	$taught_by_id=$_POST['TaughtBy'];
	
	// $upvotes=$_POST['Upvotes'];
	$course_type=$_POST['course_type'];
	$content=$_POST['content'];
	$level=$_POST['level'];
	// $x=$level."__".$content."__".$course_type ;
	// echo "<script>console.log(\"".$x."\")</script>";
	// $query="INSERT INTO course ('course_name') VALUES ('$course')";
	$query="INSERT INTO course_tutorials (course_id,tutorial_name,tutorial_url,submitter_id,taught_by_id,course_type,content,level) VALUES ($course_id,'$tutorialname','$tutorialURL',$submitter_id,$taught_by_id,'$course_type','$content','$level')";
	echo "<script>console.log(\"".$query."\")</script>";
	// echo "<script>console.log(\"$query\");</script>";
	$result=mysqli_query($connect,$query);
	$query="select tutorial_id from course_tutorials where course_id=$course_id and tutorial_url='$tutorialURL'";
	$result=mysqli_query($connect,$query);
	$row = mysqli_fetch_array($result);
	$tutorial_id=$row['tutorial_id'];
	// echo $course_id."<br/>".$tutorial_id;
	// echo $tutorial_id;
	// echo $tutorial_id;
	header("Location: tdetails.php?course_id=$course_id&tutorial_id=$tutorial_id");
    // ob_end_flush();
?>