<?php
$db = mysql_connect("localhost", "test_user", "barland");

if(!$db) {
	die('Could not connect: '. mysql_error());
}

//echo "Connected successfully to Mysql Installation.";

if(!mysql_select_db("test_data",$db)) {
  die("No database selected.");
}

//echo "<br>";
//echo "Test connect database found!";

?>
