<?php
include('DBConnect.php');
if($link){
		mysqli_select_db($link, 'natalie');
	  	 $sub=mysqli_real_escape_string($link, $_GET['bvalue']);
                 $command="SELECT allowComments FROM comments WHERE subject LIKE '$sub' LIMIT 1;";
                 $result=mysqli_query($link, $command);
                 if($result){
                         $row=mysqli_fetch_array($result, MYSQL_BOTH);
                         $allow=$row['allowComments'];
                         if($allow=== "Y"){
                               echo "Comments";
                         }
                         else{
				echo "No Comments";
                         }
                 }
                 else{   
                         echo mysqli_error($link);
                         echo "<br/>";
                 }
}
else{
	echo "Error connecting to database.";
}
?>

