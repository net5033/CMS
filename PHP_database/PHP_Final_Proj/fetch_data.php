<?php
	include("DBConnect.php");
	if($link){
		//populating subject text box
		mysqli_select_db($link,'natalie');
		$opt=mysqli_real_escape_string($link, $_GET['svalue']);
		$command="SELECT userID FROM users WHERE username LIKE '$opt' LIMIT 1;";
		$result=mysqli_query($link, $command);
		$row=mysqli_fetch_array($result);
		$uID=$row[0];
		$command="SELECT subject FROM comments WHERE userID like '$uID';";
		$result=mysqli_query($link, $command);
		if($result){
			echo '<option value=""></option>';
			while($row=mysqli_fetch_array($result)){
				echo "<option>" . $row['subject'] . "</option>";
			}
		}
		else{
			echo mysqli_error($link);
		}
		
		//displaying comments
		$tbox=mysqli_real_escape_string($link, $_GET['nvalue']);
		$command="SELECT comment FROM comments WHERE subject like '$tbox';";
		$result=mysqli_query($link, $command);
		if($result){
			$row=mysqli_fetch_array($result);
			$comment=$row[0];
			if($comment != ""){
				echo $comment;
			}
			else{
				echo "";
			}
		}
		else{
			echo mysqli_error($link);
		}	
		mysqli_free_result($result);

		
		mysqli_close($link);
	}
	else{
		echo "Error connecting to DB";
	}
exit;

	

?>
