<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}
	if(isset($_POST['user_id']) && isset($_POST['filter'])){
		// echo "hello php";
		$x=$_POST['user_id'];
		// echo $x;
		if($_POST['filter']=="Teaching"){
			$query="SELECT * FROM course_tutorials RIGHT JOIN users ON course_tutorials.taught_by_id = users.user_id WHERE users.user_id=$x ORDER BY course_tutorials.upvotes desc";
		}
		else if($_POST['filter']=="Submitted"){
			$query="SELECT * FROM course_tutorials RIGHT JOIN users ON course_tutorials.submitter_id = users.user_id WHERE users.user_id=$x ORDER BY course_tutorials.upvotes desc";
		}
		echo "<script>console.log(\"".$query."\");</script>";
		$result=mysqli_query($connect,$query);
		$ans="";
		// echo "$query";
		while($row = mysqli_fetch_array($result))
		{
			// $ans=$ans.$row['upvotes']."__".$row['tutorial_name']."__".$row['course_type']."__".$row['content']."__".$row['level']."<br/>";
			$ans=$ans."&emsp;<div class='upvotes' id='upvoteVal'>".$row['upvotes']."</div><a href=\"tdetails.php?course_id=".$row['course_id']."&tutorial_id=".$row['tutorial_id']."\">
				<div class='desc'>".$row['tutorial_name']."</a><br/>
				<div class='source'>
					<div class='categories'>".$row['course_type']."</div>	
					<div class='categories'>".$row['content']."</div>	
					<div class='categories'>".$row['level']."</div>
				</div></div><hr class='hclass'>";
		}
		// $html = file_get_contents("user.html");
		echo $ans;
		// echo "<script>console.log(\"".$row['course_id']."\");</script>";
	}
	else{
		$uid=$_GET['user_id'];
		echo "<script>console.log(\"$uid\")</script>";
		$query="select * from users where user_id=$uid ";
		echo "<script>console.log(\"".$query."\");</script>";
		$result=mysqli_query($connect,$query);
		$row = mysqli_fetch_array($result);
		$query2="SELECT DISTINCT course_name FROM course RIGHT JOIN course_tutorials ON course_tutorials.course_id = course.course_id where course_tutorials.submitter_id=$uid or course_tutorials.taught_by_id=$uid order by course.course_name";
		$result2=mysqli_query($connect,$query2);
		$ans="";
		echo "<script>console.log(\"".$query2."\");</script>";
		while($row2 = mysqli_fetch_array($result2)){
			$ans=$ans."<div class='categories'>".$row2['course_name']."</div>&emsp;";
		}
		$html = file_get_contents("user.html");
		// $ans="";
		// echo "<script>console.log(\"-------".$row['tutorials_submitted_count']."\");</script>";
		// echo "<script>console.log(\"-------".$row['tutorials_taught_count']."\");</script>";
		$html=str_replace(
			array("{{user_id}}","{{user_name}}","{{user_about}}","{{tags}}","{{taught_count}}","{{submitted_count}}"),
			array($row['user_id'],$row['user_name'],$row['user_about'],$ans,$row['tutorials_taught_count'],$row['tutorials_submitted_count']),
			$html);
		echo $html;
	}
?>