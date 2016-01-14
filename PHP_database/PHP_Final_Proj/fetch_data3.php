<?php
include('DBConnect.php');
if($link){
	mysqli_select_db($link, 'natalie');
	$usr=mysqli_real_escape_string($link, $_POST['selectValue']);
	$sub=mysqli_real_escape_string($link, $_POST['selVal']);
	$command="SELECT userID FROM users WHERE username LIKE '$usr' LIMIT 1;";
	$result=mysqli_query($link, $command);
	if($result){
		$row=mysqli_fetch_array($result);
		$uID=$row[0];
		$command="SELECT userID FROM comments WHERE subject LIKE '$sub' LIMIT 1;";
		$result=mysqli_query($link, $command);
		$row=mysqli_fetch_array($result);
		$ownID=$row[0];
		if($uID===$ownID){
			echo "Owner";
		}
		else{
			echo "Not Owner";
		}			
		mysqli_free_result($result);	
		mysqli_close($link);
		}	
	else{
		echo "Error";
	}
exit;
}

else{
	echo "Error connecting to database";
}
?>
