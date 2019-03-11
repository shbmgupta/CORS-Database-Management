<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	$uid=$_POST['uid'];
	if($uid!=""){
		$query="select * from users where user_id=$uid";
		echo "<script>console.log(\"".$query."\");</script>";
		$result=mysqli_query($connect,$query);
		$row=mysqli_fetch_array($result);
		if($row==NULL){
			echo "no such user";
		}
	}

?>