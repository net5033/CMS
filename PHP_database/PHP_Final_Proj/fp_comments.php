<?php
session_start();
?>
<html>
<head>
	<title>Comments</title>
	
	<link rel="stylesheet" href="cp.css" type="text/css">

	<script src="jquery.js"></script>
	<script src="cp_jquery.js"></script>
</head>
<body>
<?php
include("DBConnect.php");

if($link){
	//selecting database to use
	$DBName='natalie';
	$command='USE $DBName';
	$result=mysqli_query($link, $command);
	if(!(mysqli_select_db($link, $DBName))){
		echo "Could not connect to ' . $DBName";
	}
	else{
		//error checking for variables/getting variables ready to put in database
		if(isset($_POST['submit'])){
			$Errors=0;
			if(isset($_SESSION['usrnm'])){
				$user=$_SESSION['usrnm'];
			}
			else{
				echo "Whoops! There was a problem! Please go back and log in again.";
				echo "<br/>";
				++$Errors;
			}
			if(!empty($_POST['com_txt'])){
				$comment=$_POST['com_txt'];
			}
			else{
				echo "I think you forgot something...like entering some text for your comment.";
				echo "<br/>";
				++$Errors;
			}
			$timestamp=date('Y-m-d G:i:s');
			$command="SELECT userID FROM users WHERE username LIKE '$user' LIMIT 1;";
			$result=mysqli_query($link, $command);
			if(!$result){
				echo "Whoops we couldn't find your username in our database.";
				echo "<br/>";
				echo mysqli_error($link);
				echo "<br/>";
				++$Errors;
			}
			else{
				if(mysqli_num_rows($result)===0){
					echo "Hmmm, we can't seem to find your account.";
					echo "<br/>";
					echo "Please log back in or register.";
					echo "<br>";
					++$Errors;
				}
				else{
					$row=mysqli_fetch_row($result);
					$usrID=$row[0];
					mysqli_free_result($result);
				}	
			}
			$allow_coms=$_POST['allow_coms'];
			if(isset($_POST['subject'])){
				$subject=$_POST['subject'];
				$command="SELECT subject FROM comments WHERE subject like '$subject';";
				$result=mysqli_query($link, $command);
				if($result){
					if(mysqli_num_rows($result) != 0){
						echo "That subject has already been used. <br/>";
						echo "Please enter a new one. <br/>";
						++$Errors;
					}
				}
				else{
					echo "Error validating subject. <br/>";
					++$Errors;
				}
			}
			else{
				echo "Please enter a subject. <br/>";
				++$Errors;
			}
			if($Errors===0){
				$Tbl_Nm="comments";
				$command="INSERT INTO $Tbl_Nm (userID, comment, timestamp, allowComments, subject) VALUES ($usrID, '$comment', '$timestamp', '$allow_coms', '$subject');";
				$result=@mysqli_query($link, $command);
				if(!$result){
					echo "Unable to store your comment.";
					echo "<br/>";
					echo mysqli_error($link);
					echo "<br/>";
				}
				else{
					echo "Yay! Your comment was successfully saved.";
					echo "<br/>";
				}
			}
		}
	}
		
}
else{
	die('Could not connect to ' . $DBName);
}

?>

<div id="container">
	<div id="wlcm_txt">
	<form action="logout.php" method="POST" align="right">
		<input type="submit" name="logout" value="Log out"> 
	</form>
	<center><h1>Welcome, <?php echo $_SESSION['usrnm']; ?>!</h1></center>
	<center><h2>Now is your chance to vent your rage with the other angry users!</h2></center>
	</div>
	<div id="com_tbl">
		<br/>
		<form action="fp_comments.php" method="POST">
			<table align="left" id="ctbl" class="tables" >
				<tr>
					<th><h3>Comment and let the world experience your wrath!</h3></th>
				</tr>
				<tr>
					<td>
						<center><label for="subject">Subject: </label>
						<input type="text" name="subject" maxlength="50">
						</center>
					</td>
					
				</tr>
				<tr>
					<td>
						<textarea id="com_txt" name="com_txt" rows="7" cols="90" maxlength="900"></textarea>
					</td>
				</tr>
				<tr>
				<tr>
					<td>
						<center><strong><label for="allow_coms">Allow other users to comment on my comment?</label>
						<input type="radio" name="allow_coms" value="Y" checked>Yes!
						<input type="radio" name="allow_coms" value="N">No, I'm no fun :(
						</strong></center>
					</td>
				</tr>
					<td>
						<center><input type="submit" name="submit" value="Submit"></center>
					</td>
				<tr>
			</table>
		</form>
		<div id="view_coms">
			<table id="coms_tbl" class="tables">
				<tr>
					<th><h3>Whose comment's would you like to view?</h3></th>
				</tr>
				<tr>
					<td>
						<center>
						<label for="users">Select user: </label>
						<select name="users" id="users">
							<option value=""></option>
						<?php
						$command="SELECT username FROM users";
						$result=mysqli_query($link, $command);
						if(!$result){
							echo "Error populating user list!";
						}
						else{
							while($row=mysqli_fetch_array($result)){
								echo "<option value=" . $row['username'] . ">" . $row['username'] . "</option>";
							}
						}
						?>
						</select>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<center>
						<label for="coms">Select comment: </label>
						<select name="coms" id="coms" disabled>
						</select>
						<center>
					</td>
				</tr>
				<tr>
					<td>
						<textarea readonly id="view_txt" name="view_txt" rows="8" cols="80"></textarea>
						<textarea id="edit_txt" name="edit_txt" rows="8" cols="80" maxlength="900"></textarea>
						
					</td>
				</tr>
				<tr>
					<td>
						<center>
						<input type="button" name="ed_sub" id="ed_sub" value="Submit">
						<br/>
						<input type="button" name="sub_coms" id="sub_coms" value="Comment on this post" class="hide">
						<br/>
						<input type="button" name="edit" id="edit" value="Edit this post" class="hide">
						<br/>
						<input type="button" name="delete" id="delete" value="Delete this post" class="hide">
						<br/>
						<input type="hidden" name="usrnmH" id="usrnmH" value="<?php echo $_SESSION['usrnm'];?>">
						</center>
					</td>
				</tr>
				<tr id="com_row">
					<td>
						<strong>Leave a comment on this post!</strong>	
					</td>
				</tr>
				<tr id="com_row2">
					<td>
						<textarea id="sub_text" name="sub_text" rows="8" cols="80" maxlength="900"></textarea>
						<br/>
						<center><input type="button" name="sub_submit" id="sub_submit" value="Submit"></center>
					</td>
					</form>
				</tr>
				<tr>
					<td name="sub_head" id="sub_head">
						<center><strong>Comments on this comment:</strong></center>
					</td>
				</tr>
				<tr name="disp_sub" id="disp_sub">
					<td>
				
				</div>
			</table>
		</div>
	</div>
</div>
</body>
</html>
