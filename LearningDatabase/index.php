<?php
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}
	// echo "Connected successfully<br/><br/>";
	if(isset($_POST['word']) ){
		$q=$_POST['word'];
		$query="select * from course where course_name like '%$q%' order by course_id";
		$result=mysqli_query($connect,$query);
		echo "<script>console.log(\"".$query."\");</script>";
	}
	else{
		$result=mysqli_query($connect,"select * from course order by course_id");
	}
	$count=0;
	$ans="";
	while($row = mysqli_fetch_array($result)){
  		$ans=$ans."<div class='dn' id=\"".$row['course_id']."\" style='background-color:#fff;vertical-align:middle;'><a style='display:block' href=\"cdetails.php?course_id={$row['course_id']}\"><div class='dn1'>".$row['course_name']."</div></a><br/></div>";
  		$count+=1;
  	}
  	if(isset($_POST['word'])){
  		echo $ans;
  	}
  	else{
	  	$html = file_get_contents("1.html");
	  	$html=str_replace(
				array("{{count}}","{{row}}"),
				array($count,$ans),
				$html);
	  	echo $html;
	}
?>

<!--                          Changes from here            -->