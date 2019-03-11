<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}
	// echo "Connected successfully<br/><br/>";
	$cid=$_GET['course_id'];
	$tid=$_GET['tutorial_id'];
	$result=mysqli_query($connect,"select * from course_tutorials where course_id=$cid and tutorial_id=$tid");
	// echo "<script>console.log(\"".$query."\");</script>";
	$row = mysqli_fetch_array($result);
	$result2=mysqli_query($connect,"select user_name from users where user_id=".$row['submitter_id']);
	$row2=mysqli_fetch_array($result2);
	$result3=mysqli_query($connect,"select user_name from users where user_id=".$row['taught_by_id']);
	$row3=mysqli_fetch_array($result3);
	$html = file_get_contents("2up.html");
	$submitter_url="udetails.php?user_id=".$row['taught_by_id'];
	$taught_by_url="udetails.php?user_id=".$row['submitter_id'];
	$html=str_replace(
		array("{{course_id}}","{{tutorial_id}}","{{tutorial_name}}","{{upvotes}}","{{tutorial_url}}","{{submitter_id}}","{{faculty_id}}","{{course_type}}","{{course_content}}","{{level}}","{{submitter_url}}","{{faculty_url}}"),
		array($row['course_id'],$row['tutorial_id'],$row['tutorial_name'], $row['upvotes'],$row['tutorial_url'],$row2['user_name'],$row3['user_name'],$row['course_type'],$row['content'],$row['level'],$submitter_url,$taught_by_url),
		$html);
	echo $html;
?>