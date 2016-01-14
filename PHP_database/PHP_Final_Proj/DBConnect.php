<?php
//database to use
$DBName="natalie";

//establishing connection
$link=@mysqli_connect("localhost","natalie", "password");

//validating connection
if(!($link)){
	echo "<p>Connection error: " . mysql_error() . "</p>\n";
}
else{
	//selecting database to use
	if(!(@mysqli_select_db($link,$DBName))){
		//error message if database can't be selected
		echo "<p>Could not select the \"$DBName\" " . "database: " . mysql_error($link) . "</p>\n";
		mysqli_close($link);
		$link=FALSE;
	}
}

?>
