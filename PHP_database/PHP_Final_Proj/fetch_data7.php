<?php
include('DBConnect.php');
if($link){
	mysqli_select_db($link, 'natalie');
	$sub=mysqli_real_escape_string($link, $_POST['sub']);
	$command="SELECT commentID FROM comments WHERE subject LIKE '$sub';";
	$result=mysqli_query($link, $command);
	if($result){
		$row=mysqli_fetch_array($result);
		$cID=$row[0];
		$command="DELETE FROM comments WHERE commentID=$cID;";
		$result=mysqli_query($link, $command);
		if($result){
			$command="DELETE FROM sub_comments WHERE origComID=$cID;";
			$result=mysqli_query($link, $command);
			if($result){
				echo "Success";
			}
			else{
				echo "Could not delete sub comments.";
			}
		}
		else{
			echo "Could not delete original comment.";
		}

	}
	else{
		echo "Could not select comment ID.";
	}
}
else{
	echo "Sorry, could not connect to database.";
}
?>
