<?php
include('DBConnect.php');
if($link){
	//finding and displaying sub comments
	mysqli_select_db($link, 'natalie');
	$sub=mysqli_real_escape_string($link, $_POST['sub']);
	$command="SELECT commentID FROM comments WHERE subject LIKE '$sub' LIMIT 1;";
	$result=mysqli_query($link, $command);
	if($result){
		$row=mysqli_fetch_array($result);
		$oID=$row[0];
		$command="SELECT userID FROM sub_comments WHERE origComID=$oID LIMIT 1;";
		$result=mysqli_query($link, $command);
		if($result){
			$row=mysqli_fetch_array($result);
			$uID=$row[0];
			$command="SELECT username FROM users WHERE userID=$uID;";
			$result=mysqli_query($link, $command);
			if($result){
				$row=mysqli_fetch_array($result);
				$usrnm=$row[0];
				$command="SELECT comment FROM sub_comments WHERE origComID=$oID ORDER BY newComID;";
				$result=mysqli_query($link, $command);
				if($result){
					while($row=mysqli_fetch_array($result)){
						echo "<tr> <td>";
						echo "<textarea readonly rows='8' cols='80'>";
						echo "Comment by: " . $usrnm ."\n";
						echo $row['comment'] . "</textarea>";
						echo "</td></tr>";
				}	
				}
				else{
					echo "Error pulling the sub comments.";
			
				}
			}
			else{
			//	echo "Error pulling username." . mysqli_error($link);
			}
		}
		else{
		//	echo "Error pulling user ID.";
		}
}	
	else{

		echo "Error pulling original comment ID.";
	}
}
else{
 echo "Error connecting to database.";
}
?>
