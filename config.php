<?php 
//DEFINE('HASH_TYPE','sha256'); //The hashing algorithm
//MySQL database information
$mysql_host = "127.0.0.1";
$mysql_dbname = "";
$mysql_user = "";
$mysql_pass = "";
	
	//Server name.
	$Servername = "L's Server";
	
	//The Table name where your Kills and Deaths are stored
	$StatsTable	= "Accounts";
	
	$Fields = array(
	'Kills' => "Kills", // <- Edit this, if it's different. Leave the first Kills there though!
	'Deaths' => "Deaths", //Same here
	'Cash' => "Cash",
	'Bank' => "Bank",
	'Level' => "Level",
	'Nickname' => "Name", //And same here
	'Password' => "Password"
	);
	
	//Level names
	$LevelTag = array(
	'1' => "User",
	'2' => "V.I.P",
	'3' => "Moderator",
	'4' => "Administrator",
	'5' => "Head Administrator",
	'6' => "Owner"
	);
	
	

	/*function sanitize($string){  
    $string = strip_tags($string); 
    return $string;  
    }*/ 
function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>