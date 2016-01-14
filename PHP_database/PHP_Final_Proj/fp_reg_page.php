<?php
//starting session and creating session variables
session_start();
if(isset($_POST['nu_usrnm'])){
	$_SESSION['usrnm']=$_POST['nu_usrnm'];
}
else if(isset($_POST['ru_usrnm'])){
	$_SESSION['usrnm']=$_POST['ru_usrnm'];
}

//adding cookies
	$rUsrnm=$_POST['ru_usrnm'];
	$rPswd=$_POST['ru_pswd'];
	if(isset($_POST['remember'])){
		//setting cookies if checkbox is checked
		setcookie('usrnm', $rUsrnm, time()+60*60*24*365, '/~ntorretti/PHP_database/PHP_Final_Proj/fp_reg_page.php', 'sabre.southhills.edu');	
	}
	
?>
<html>
<head>
	<title>Registration Page</title>
	
	
	<link rel="stylesheet" href="fp.css" type="text/css">
	
	
	
</head>
<body>
<?php
include("DBConnect.php");
include("PHP_functions.php");

   if($link){
        //selecting database to use
          $DBName='natalie';
          $command='USE $DBName';
          $result=mysqli_query($link, $command);
          if(!(mysqli_select_db($link, $DBName))){
                  echo 'Could not connect to ' . $DBName;
		echo "<br/>";
          }
          else{
		//returning user entry
		//checking for cookies
		if(isset($_COOKIE['usrnm'])){
			echo "<center><h2>Welcome back, {$_COOKIE['usrnm']}!</h2></center>";
		}
		//starting login process
		if(isset($_POST['ru_submit'])){
		if(isset($_POST['ru_usrnm']) && isset($_POST['ru_pswd'])){
				$ret_usr=$_POST['ru_usrnm'];
				$ret_pswd=$_POST['ru_pswd'];
		$command="SELECT * FROM users WHERE username LIKE '$ret_usr';";
		$result=mysqli_query($link, $command);
		if(!$result){
			echo "Uh Oh! There was a problem!";
			echo mysqli_error($link);
			echo "<br/>";
		}
		else{
			if(mysqli_num_rows($result)===0){
			echo "Sorry, there is no account associated with this username.";
			echo "<br/>";
			echo "Create an account by using the sign-up form on the left!";
			echo "<br/>";
			}		
			else{
			$command="SELECT password FROM users WHERE username like '$ret_usr' LIMIT 1;";
			$result=mysqli_query($link, $command);
			if(mysqli_num_rows($result)===0){
				echo "Sorry there was an error fetching your password, please enter it again.";
				echo "<br/>";
			}
			else{
				$row=mysqli_fetch_row($result);
				$db_pswd=$row[0];	
				if(!(hash_equals($db_pswd, crypt($ret_pswd, $db_pswd)))){
					echo "Sorry your password is incorrect, please enter it again";
					echo "<br/>";
				}
				else if(hash_equals($db_pswd, crypt($ret_pswd, $db_pswd))){
					mysqli_free_result($result);
					header('Location: fp_comments.php'); 
				}
				}
					
				
		}
	}
}
}
		//new user entry
                //validating new user fields
                  if(isset($_POST['nu_submit'])){
                          $Errors=0;
                          $Error_Msg="Could not complete your regisration <br/>";
                          if(isset($_POST['nu_fn'])){
                                  $fname=stripslashes($_POST['nu_fn']);
                                  $fname=trim($fname);
                                  if(strlen($fname)==0){
                                          echo $Error_Msg;
                                          echo "You must enter your first name. <br/>";
                                          ++$Errors;
                                  }
                          }
                          else{
                                 echo "Form submittal error (No 'nu_fn' field).<br/>";
                                 ++$Errors;
                         }
                          if(isset($_POST['nu_ln'])){
                                  $lname=stripslashes($_POST['nu_ln']);
                                 $lname=trim($lname);
                                  if(strlen($lname)==0){
                                          echo $Error_Msg;
                                          echo "You must enter your last name. <br/>";
                                          ++$Errors;
                                  }
                          }
                          else{
                                  echo "Form submittal error (No 'nu_ln' field).<br/>";
                                  ++$Errors;
                     }
                        if(isset($_POST['nu_email'])){
                                $email=$_POST['nu_email'];
                                $email=filter_var($email, FILTER_SANITIZE_EMAIL);
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                          echo "Invalid email format. <br/>";
                                          ++$Errors;
                                  }
				$Tbl_Nm="users";
				$command="SELECT * FROM $Tbl_Nm WHERE email LIKE '$email';";
				$result=mysqli_query($link, $command);
				if(!$result){
					echo "Sorry could not complete your request to check for multiple email addresses.";
					++$Errors;
				}
				else{
					if(mysqli_num_rows($result) != 0){
						echo "Sorry that email is already registered.";
						echo "<br/>";
						echo "Login to write and view comments!";
						echo "<br/>";
						++$Errors;
					}	
				}
				mysqli_free_result($result);
			}
                          else{
                                  echo "Form submittal error (No 'nu_email' field).<br/>";
                                  ++$Errors;
                          }
                          if(isset($_POST['nu_usrnm'])){
                                  $usrnm=stripslashes($_POST['nu_usrnm']);
                                  $usrnm=trim($usrnm);
                                  if(strlen($usrnm)==0){
                                          echo $Error_Msg;
                                          echo "You must enter a username.<br/>";
                                          ++$Errors;
                                  }
				$Tbl_Nm="users";
				$command="SELECT * FROM $Tbl_Nm WHERE username LIKE '$usrnm';";
				$result=mysqli_query($link, $command);
				if(!$result){
					echo "Sorry could not check for duplicate usernames.";
					++$Errors;
				}
				else{
					if(mysqli_num_rows($result) != 0){
						echo "Sorry, that username is already taken!";
						echo "<br/>";
						echo "Please enter an alternate username.";
						echo "<br/>";
						++$Errors;
					}		
				}
				mysqli_free_result($result);
                          }
                          else{
                                  echo "Form submittal error (No 'nu_usrnm' field).<br/>";
                                  ++$Errors;
                          }
                          if(isset($_POST['nu_pswd'])){
                                  $pswd=stripslashes($_POST['nu_pswd']);
                                  $pswd=trim($pswd);
                                  if(strlen($pswd)==0){
                                          echo $Error_Msg;
                                          echo "You must enter a password.<br/>";
                                          ++$Errors;
                                  }
                          }
                          else{
                                  echo "Form submittal error (No 'nu_pswd' field).<br/>.";
                                  ++$Errors;
                          }
                          if(isset($_POST['nu_cnf_pswd'])){
                                  $cnf_pswd=stripslashes($_POST['nu_cnf_pswd']);
                                  $cnf_pswd=trim($cnf_pswd);
                                  if(strlen($cnf_pswd)==0){
                                          echo $Error_Msg;
                                          echo "You must confirm your password<br/>";
                                          ++$Errors;
                                  }
                          }
                         else{
                                 echo "Form submittal error (No 'nu_cnf_pswd' field).<br/>";
                                 ++$Errors;
                         }
                         if($pswd != $cnf_pswd){
                                echo $Error_Msg;
                                echo "Your passwords do not match";
                                ++$Errors;
                         }	
			//encrypting password and putting info into table	
                        if($Errors===0){
				$TblErrors=0;
				$cost=10;
				$salt=strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
				$salt=sprintf("$2a$%02d$", $cost) . $salt;
				$hash=crypt($pswd, $salt);
                                $Tbl_Nm="users";
                                $command="INSERT INTO $Tbl_Nm (first_name, last_name, email, username, password) VALUES ('$fname', '$lname', '$email', '$usrnm', '$hash')";
                                
				$result=mysqli_query($link, $command);
				if(!($result)){
					echo "Unable to insert values into the users table.";
					echo mysqli_error($link);
					++$TblErrors;
				}
				else{
					mysqli_free_result($result);
					$command="SELECT userID FROM users WHERE username LIKE '$usrnm' LIMIT 1";
					$result=mysqli_query($link, $command);
					if(!($result)){
						echo "Unable to complete your request";
						++$TblErrors;
					}
					else{
						
						$row=mysqli_fetch_row($result);
						$uID=$row[0];
						$Tbl_Nm="permissions";
						$command="INSERT INTO $Tbl_Nm VALUES ($uID, $uID, 'Y', 'Y', 'Y');";
						$result=mysqli_query($link, $command);
						if(!($result)){
							echo "There was an error inserting values into the permissions table";
							echo mysqli_error($link);
							++$TblErrors;
						}
						else{
							
							$Tbl_Nm="permissions";
							$command="SELECT ownerID FROM $Tbl_Nm;";
							$result=mysqli_query($link, $command);
							if(!$result){
								echo "Error pulling information from permissions table.";
								++$TblErrors;
							}	
							else{
								for($i=0; $array[$i]=mysqli_fetch_assoc($result); $i++);
								array_pop($array);
								$Tbl_Nm="permissions";
								foreach($array as $row){
										if($uID != $row['ownerID']){
										$vID=$row['ownerID'];
										$command="INSERT INTO $Tbl_Nm VALUES ($uID, $vID, 'Y', 'N', 'N');";
										$result=mysqli_query($link, $command);
										if(!($result)){
											echo "Error populating permissions table.";
											echo mysqli_error($link);
											++$TblErrors;
										}
									}
								}	

							}
						}
						
					}
				}
				
                        }
				if($TblErrors===0){
					mysqli_free_result($result);
					header('Location: fp_comments.php');
				
				}
		}
                 }

        }
 

 else {
         die('Could not connect to ' . $DBName);
 }


?>
	<div id="container">
		<h1 align="center">Register or Login to Complain!</h1>
		<div id="table">
			<form action="fp_reg_page.php" method="POST">
			<table align="right" id="rg_table" class="tables">
				<tr>
						
					<th>New Angered Friends Sign-Up!</th>
					<th>Login to Unleash Your Wrath!</th>
				</tr>
				<tr>
					<td>
					
						<label for="nu_fn">First Name:</label>
						<input type="text" id="nu_fn" name="nu_fn" size="30"/>
						<br/>
						<label for="nu_ln">Last Name:</label>
						<input type="text" id="nu_ln" name="nu_ln" size="30" />
						<br/>
						<label for="nu_email">Email:</label>
						<input type="text" id="nu_email" name="nu_email" size="35" />
						<br/>
						<label for="nu_usrnm">Username:</label>
						<input type="text" id="nu_usrnm" name="nu_usrnm" size="31"/>
						<br/>
						<label for="nu_pswd">Password:</label>
						<input type="password" id="nu_pswd" name="nu_pswd" size="31" />
						<br/>
						<label for="cnf_nu_pswd">Confirm Password:</label>
						<input type="password" id="nu_cnf_pswd" name="nu_cnf_pswd" size="23" />
						<br/>
						<input type="submit" id="nu_submit" name="nu_submit" value="Submit">
			</form>
					</td>
					<td>
			<form action="fp_reg_page.php" method="POST">
						<label for="ru_usrnm">Username:</label>
						<input type="text" id="ru_usrnm" name="ru_usrnm" value="<?php echo $_COOKIE['usrnm']; ?>" size="20" />
						<br/>
						<label for="ru_pswd">Password:</label>
						<input type="password" id="ru_pswd" name="ru_pswd" size="20"/>
						<br/>
						<label for "remember">Remember Me:</label>
						<input type="checkbox" name="remember" value="1">
						<br/>
						<input type="submit" id="ru_submit" name="ru_submit" value="Log In">
					</td>
				</tr>


			</table>
		</div>
	</form>
	</div>
</body>
</html>
