<html>
<head></head>
<body>
<input type="button" name="home_button" value="Home" onClick="window.location.href='http://sabre.southhills.edu/~ntorretti'">
<br/>
<br/>
<?php
echo "<form name='FirstForm' action='page2.php' method='get'>";
echo "<label for='fnlabel'> First Name </label>";
echo "<input type='text' name='fName'><br/>";
echo "<label for='lnlabel'> Last Name </label>";
echo "<input type='text' name='lName'><br/>";
echo "<label for='pswLabel'> Password </label>";
echo "<input type='text' name='pswd'><br/>";
echo "<textarea name='area'> </textarea><br/>";
echo "Car Type";
echo "<br/>";
echo "<input type='radio' name='rGroup1' value='Mazda'>";
echo "Mazda";
echo "<br/>";
echo "<input type='radio' name='rGroup1' value='Jeep' checked>";
echo "Jeep";
echo "<br/>";
echo "<input type='radio' name='rGroup1' value='BWM'>";
echo "BMW";
echo "<br/>";
echo "<br/>";
echo "Number of Doors";
echo "<br/>";
echo "<input type='checkbox' name= 'numDoors[]' value='2 Doors'/> 2 Doors<br/>"; 
echo "<input type='checkbox' name= 'numDoors[]' value='3 Doors'/> 3 Doors<br/>"; 
echo "<input type='checkbox' name= 'numDoors[]' value='4 Doors'/> 4 Doors<br/>"; 
echo "<input type='checkbox' name= 'numDoors[]' value='5 Doors'/> 5 Doors<br/>";
echo "<input type='reset' value='reset'>";
echo "<br/>"; 
echo "<input type='submit' name='subButton' value='Submit'>";
echo "</form>";
echo "<br/>";

echo "<form name='SecondForm' action= 'page3.php' method='get'";
echo "<label for='fnLabel2'> First Name </label>";
echo "<input type='text' name='fName2'><br/>";
echo "<label for='lnLabel2'> Last Name </label>";
echo "<input type='text' name='lName2'><br/>";
echo "<label for='strLabel'> Street </label>";
echo "<input type='text' name='street'><br/>";
echo "<label for='ctLabel'> City </label>";
echo "<input type='text' name='city'><br/>";
echo "<label for='stLabel'> State </label>";
echo "<input type='text' name='state'><br/>";
echo "<input type='submit' name='subButton2' value='Submit'><br/>";
echo "</form>";
echo "<br/>";

?>
</body>
</html>
