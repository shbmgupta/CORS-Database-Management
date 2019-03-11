<?php
	
	$connect=mysqli_connect('localhost','root','','learning_database');
	mysqli_set_charset($connect, "utf8");
	// Check connection
	if (!$connect) {
	    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
	}

	$query="select * from course_tutorials";
	$q=0;
	if(isset($_GET['type'])){
		$type=$_GET['type'];
		if(sizeof($type)>0 &&$type[0]){
			$q+=1;
			$query=$query." where (course_type=\"$type[0]\" ";
			echo "<script>console.log(\"$type[0]\")</script>";
			if(sizeof($type)>1 && $type[1]){
				$query=$query."or course_type=\"$type[1]\" )";
			}
			else{
				$query=$query.")";
			}
		}
	}


	if(isset($_GET['content'])){
		$content=$_GET['content'];
		if(sizeof($content)>0 && $content[0]){
			if($q==0)	$query.=" where ";
			else 	$query.=" and ";
			$q+=1;
			$query=$query."(content=\"$content[0]\" ";
			if(sizeof($content)>1 && $content[1]){
				$query=$query."or content=\"$content[1]\" ";
				if(sizeof($content)>2 && $content[2]){
					$query=$query."or content=\"$content[2]\" )";
				}
				else{
					$query=$query.")";
				}
			}
			else{
				$query=$query.")";
			}
		}
		// $query=$query."and content=\"$content\" ";
	}


	if(isset($_GET['level'])){
		$level=$_GET['level'];
		if(sizeof($level)>0 &&$level[0]){
			if($q==0)	$query.=" where ";
			else 	$query.=" and ";
			$q+=1;
			$query=$query." (level=\"$level[0]\" ";
			echo "<script>console.log(\"$level[0]\")</script>";
			if(sizeof($level)>1 && $level[1]){
				$query=$query."or level=\"$level[1]\" ";
				echo "<script>console.log(\"$level[1]\")</script>";
				if(sizeof($level)>2 && $level[2]){
					$query=$query."or level=\"$level[2]\" )";
					echo "<script>console.log(\"$level[2]\")</script>";
				}
				else{
					$query=$query.")";
				}
			}
			else{
				$query=$query.")";
			}
		}
		// $query=$query."and level=\"$level\" ";
	}
	$query2=" order by date desc limit 25";
	echo '<script>console.log(\''.$query.$query2.'\');</script>';
	$query.=$query2;
	$result=mysqli_query($connect,$query);
	echo "<script>console.log(\"".$query."\");</script>";
	$html = file_get_contents("specialCourses.html");
	$ans="";
	while($row = mysqli_fetch_array($result)){
		$ans=$ans."<div class='three'>
					&emsp;<div class='upvotes' id='upvoteVal'>".$row['upvotes']."
					</div><a href=\"tdetails.php?course_id=".$row['course_id']."&tutorial_id=".$row['tutorial_id']."\">
					<div class='desc'>".$row['tutorial_name']."</a>
						<br/>
						<div class='source'>
							<div class='categories'>".$row['course_type']."</div>&nbsp;<div class='categories'>".$row['content']."</div>&nbsp;<div class='categories'>".$row['level']."</div>&nbsp;																			<!-- beginner, easy, free, video-->
						</div>
					</div>
				</div>";
	}
	$html = str_replace(array("{{row}}","{{title}}"),array( $ans,"Latest Tutorials"), $html);
	echo $html;
?>