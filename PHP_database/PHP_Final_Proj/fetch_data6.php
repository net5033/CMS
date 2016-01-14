<?php
include('DBConnect.php');
if($link){
	mysqli_select_db($link, 'natalie');
	$sub=mysqli_real_escape_string($link, $_POST['sub']);
	$new_com=mysqli_real_escape_string($link, $_POST['new_com']);
	$command="UPDATE comments SET comment='$new_com' WHERE subject LIKE '$sub';";
	$result=mysqli_query($link, $command);
	if($result){
		$command="SELECT comment FROM comments WHERE subject LIKE '$sub';";
		$result=mysqli_query($link, $command);
		if($result){
			$row=mysqli_fetch_array($result);
			$com=$row[0];
			echo $com;
		}
		else{
			echo "Error pulling comment.";
		}
	}
	else{
		echo "Error inserting comment.";
	}
}
else{
	echo "Error connecting to the database.";
}
?>
