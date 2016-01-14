<?php
include('DBConnect.php');
//storing sub comments in database
if($link){
	mysqli_select_db($link, 'natalie');
	$usr=mysqli_real_escape_string($link, $_POST['usr']);
	$sub=mysqli_real_escape_string($link, $_POST['orig_id']);
	$comment=mysqli_real_escape_string($link, $_POST['comment']);
	$time=date('Y-m-d G:i:s');
	$command="SELECT commentID FROM comments WHERE subject LIKE '$sub' LIMIT 1;";
	$result=mysqli_query($link, $command);
	if($result){
		$row=mysqli_fetch_array($result);
		$cID=$row[0];
		$cID= (int) $cID;
		$command="SELECT userID FROM users WHERE username LIKE '$usr' LIMIT 1;";
		$result=mysqli_query($link, $command);
		if($result){
			$row=mysqli_fetch_array($result);
			$uID=$row[0];
			$Tbl_Nm='sub_comments';
			$command="INSERT INTO $Tbl_Nm (origComID, comment, timestamp, userID) VALUES ($cID, '$comment', '$time', $uID);";
			$result=mysqli_query($link, $command);
			if($result){
				echo "Success";
			}	
			else{
				echo mysqli_error($link);
				echo "There was an error storing your comment.";
			}
			}
			else{
				echo mysqli_error($link);
				echo "Could not retrieve original userID";
			}
	}
	else{
		echo mysqli_error($link);
		echo "Could not retrieve original comment ID.";
	}
	mysqli_close($link);
	exit;
	
}
else{
	echo "Error connecting to the database.";
}
?>
