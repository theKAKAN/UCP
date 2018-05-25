<html>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<body>
		<center>
			<div class = "background_box_left">
				<h1>Control Panel</h1>
				<hr>
				<button onclick="window.location.href='http://www.vcmp.hostzi.com/forum'">Forum</button>
				<br>
				<button onclick="window.location.href='profile.php'">Profile</button>
				<!--<br>
				<button onclick="window.location.href='actions.php'">Transfer stats/change password</button>
				--><br>	
				<button onclick="window.location.href='http://web.vcmp.hostzi.com/index.php'">Webstats</button>
				<br>	
				<button onclick="window.location.href='logout.php'">Logout</button>	
				<br>					
			</div>
		</center>
<font size="6">
<?php 

include("database.php"); //including our config.php 
session_start(); //starting session 
//error_reporting(0); 

if(isset($_SESSION['username'])) //if session is set, so if user is logged in... 
{ 
    $username = $_SESSION['username']; //setting variable username as one from session 
    $query = "SELECT * FROM ".$StatsTable." WHERE ".$Fields['Nickname']." = '$username'";  //selecting all from table users where username is name that your is loged in  
    foreach($database->query($query) as $row) //looping thousgt table to get informations 
    { 
        $name = $row[ $Fields['Nickname'] ]; //selecting user name, change 'username' to your field name 
        $money = $row[ $Fields['Cash'] ]; //selecting user money, change 'money' to your field name 
        $kills = $row[ $Fields['Kills'] ]; //selecting user kills, change 'kills' to your field name 
        $deaths = $row[ $Fields['Deaths'] ]; //selecting user deaths, change 'deaths' to your field name
		$level = $row[ $Fields['Level'] ];
		$bank = $row[ $Fields['Bank'] ];
    } 
    echo '<center>            <div class = "background_box_center">							
				<div class ="content" >	
					<h1><u>My stats</u></h1>
					<h3> Nick: '.$name.'<br>
						Level: '.$level.' ( '.$LevelTag[$level]. ' )<br>
						Cash: '.$money.' <br>
						Bank: '.$bank.' <br>					
						Kills: '.$kills.' <br>
						Deaths: '.$deaths.' <br>			</div></center>';

} 
else header('location: index.php'); //if user isn't loged in it will redirect him on login.php 

?>
</font>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Servername; ?> UCP</title>
</body>
</head>
</html>