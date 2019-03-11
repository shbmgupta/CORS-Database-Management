<?php
		session_start();
		$connect=mysqli_connect('localhost','root','','learning_database');
		mysqli_set_charset($connect, "utf8");
		// Check connection
		if (!$connect) {
		    die("<script>console.log(\"Connection failed: " . mysqli_connect_error()."\"</script>");
		}
		// echo "Connected successfully<br/><br/>";
		if(isset($_GET['course_id'])){
			$cid=$_GET['course_id'];
			$_SESSION['course_id']=$cid;
			// echo "<script>console.log(\"$cid\")</script>";
		}
		else{
			$cid=$_SESSION['course_id'];
		}
		echo "<script>console.log(\"$cid\")</script>";
		// ------------------------------------------------------------------------------------
		$query="select * from course_tutorials where course_id=$cid ";
		// if(isset($_GET['sortbyupvotesup'])){
		// 	$order=$_SESSION['pquery']."order by upvotes";
		// 	// echo "<script>console.log('$query');</script>";
		// }
		// else if(isset($_GET['sortbyupvotesdown'])){
		// 	$order=$_SESSION['pquery']."order by upvotes desc";
		// }
		// else if(isset($_GET['sortbyrecentup'])){
		// 	$order=$_SESSION['pquery']."order by date ";
		// }
		// else if(isset($_GET['sortbyrecentdown'])){
		// 	$order=$_SESSION['pquery']."order by date desc";
		// }


		if(isset($_GET['type'])){
			$type=$_GET['type'];
			if(sizeof($type)>0 &&$type[0]){
				$query=$query."and (course_type=\"$type[0]\" ";
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
			if(sizeof($content)>0 &&$content[0]){
				$query=$query."and (content=\"$content[0]\" ";
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
				$query=$query."and (level=\"$level[0]\" ";
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
		
		// ------------------------------------------------------------------------------------
		if(isset($order)){
			echo "<script>console.log('$order');</script>";
			$result=mysqli_query($connect,$order);
			echo "<script>console.log(\"".$order."\");</script>";
		}
		else{
			$query.=" order by upvotes desc";
			echo "<script>console.log('$query');</script>";
			$result=mysqli_query($connect,$query);
			$_SESSION['pquery']=$query;	
		}
		$html = file_get_contents("1up.html");
		$ans="";
		$course_id=$cid;

		// echo "<script>console.log(\"".$course_id." and ".$tutorial_id."\")</script>";
		if($result){
			while($row = mysqli_fetch_array($result)){
	      		$ans=$ans."<div class='three'>
					&emsp;<div class='upvotes' id='upvoteVal'>".$row['upvotes']."
					</div><a href=\"tdetails.php?course_id=".$row['course_id']."&tutorial_id=".$row['tutorial_id']."\" >
					<div class='desc'>".$row['tutorial_name']."</a>
						<br/>
						<div class='source'>
							<div class='categories'>".$row['course_type']."</div>&nbsp;<div class='categories'>".$row['content']."</div>&nbsp;<div class='categories'>".$row['level']."</div>&nbsp;																			<!-- beginner, easy, free, video-->
						</div>
					</div>
				</div>";
	      	}
	      	$q2="select * from course where course_id=$course_id";
	      	$result=mysqli_query($connect,$q2);
	      	$row=mysqli_fetch_array($result);
	      	$course_title=$row['course_name'];
	      	// echo "<script>console.log(\"".$course_title."\");</script>";
	      	$html = str_replace(array("{{row}}","{{course_id}}","{{course_title}}"),array( $ans,$course_id,$course_title), $html);
	      	echo $html;
	    }
	    else{
	    	printf("Error: %s\n", mysqli_error($connect));
    		exit();
	    }
	?>