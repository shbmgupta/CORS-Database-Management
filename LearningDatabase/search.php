<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}
	$word=$_POST['word'];
	// echo $word;
	$ans="";
	$query="select course_name from course where course_name like '%$word%'";
	$result=mysqli_query($connect,$query);
	echo "<script>console.log(\"".$query."\");</script>";
	while($row=mysqli_fetch_array($result)){
		$ans=$ans.$row['course_name']."<br/>";
	}
	echo $ans;
?>
