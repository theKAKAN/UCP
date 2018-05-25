<?php 
include("database.php"); //including our config.php where is connecting to mysql... 
session_start(); //starting session for profile.php (Dunno how to explain better) look little down 
error_reporting(0); //without this we will always get some stupid notice that variable isn't defined.... 

$submit = $_POST['submit']; //variable for submit button, in this variable we save button that player press in <input type='submit' name="submit" value='Login' />.... 
$username = sanitize($_POST['username']); //variable for username, in this variable we save text that user type in <input type="text" name="username".... 
$password = sanitize($_POST['password']); //variable for password, in this variable we save text that user type in <input type="password" name="password".... 
$Abc = "Please enter your nick and password";

if($submit) //if he press submit button 
{     
    if($username && $password) //if he type both of username and password not just one of them 
    { 
        $stmt = $database->prepare("SELECT * FROM ".$StatsTable." WHERE ".$Fields['Nickname']." = :user");		//selecting user name and password, change it to your field names,  chage users to your table name, $username means username that he type... 
		$stmt->bindParam(':user',$username);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$rowc = $stmt->rowCount();
		if($rowc != null) //if user exists 
        { 
            foreach($result as $row) //loop thought table that we select in mysql_query 
            { 
                $dbusername = $row[ $Fields['Nickname'] ]; //setting dbusername as variable from table, change 'username' to your field! 
                $dbpassword = $row[ $Fields['Password'] ]; //setting dbpassword as variable from table, change 'password' to your field! 
            } 
            if( $username == $dbusername ) //if username is same as one from table and if password is the same as one from table... 
            { 
			if( hash('sha256',$password) == $dbpassword ){
                $_SESSION['username'] = $dbusername; //setting session username to one from table, this is useful if you login, that restart your browser and than you go in url where is your profile.php... Anyway this is useful :D 
                echo header('location: profile.php'); //redirecting user to his profile page (profile.php) 
				$Abc = "Please enter your nick and password";
			}
			else $Abc = "Wrong Password";
            } 
            else $Abc = "Username doesn't exist."; //else if user type wrong password he will get this... 
        } 
        else $Abc = "Username doesn't exist!"; //if username doesn't exist in table user will get this 
    } 
    else $Abc = "Type name and password"; //else if user doesn't type all fields he will get this... 
} 
else $Abc = "Please enter your nick and password"
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<title><?php echo $Servername; ?> UCP</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<body style="background-color: #3A80C2">
		<center>
			<h1 style="color: white"><u><?php echo $Servername; ?>: User Control Panel</u></h1>
			<div class="loginF">
				<h2>In-Game Account</h2>
<form action='index.php' method='POST'> 
<input type="text" name="username" value='<?php echo $username?>' placeholder="Nickname"/> <br>
<input type="password" name="password" placeholder="Password" /> <br>
<br />
<input type='submit' name="submit" value='Login' /> 
</form>
			</div>
			<br>
			<div class="loginF">
			<h3><?php echo $Abc; ?></h3>			</div>
		</center>
</head>
</html>