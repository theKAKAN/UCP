<?php
session_start();
include("database.php");
$szAction = ""; $szAction2= ""; 
?>
<html>
	<head>
		<title><?php echo $Servername; ?> UCP</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>	
	<body>
	<center>
			<div class = "background_box_left">
				<h1>Control Panel</h1>
				<hr>
				<button onclick="window.location.href='http://www.vcmp.hostzi.com/forum'">Forum</button>
				<br>
				<button onclick="window.location.href='profile.php'">Profile</button>
				<br>
				<button onclick="window.location.href='actions.php'">Transfer stats/change password</button>
				<br>	
				<button onclick="window.location.href='http://web.vcmp.hostzi.com/index.php'">Webstats</button>
				<br>	
				<button onclick="window.location.href='logout.php'">Logout</button>	
				<br>					
			</div>
            <div class = "background_box_center">
							<div class ="content" >
					<h1><u>Change Password</u></h1>
					<form action="actions.php" method="post">
						<input type="password" name="newPass" placeholder="Enter new password" />
						<input type="password" name="newPass2" placeholder="Re-type new password" />
						<?php echo $szAction; ?>
						<input type="submit" value="Change" name="done" />
					</form>
					<br>
					<h1><u>Transfer Stats</u></h1>
					<form action="actions.php" method="post">
						<input type="text" name="newName" placeholder="Enter new name" />
						<input type="text" name="newName2" placeholder="Re-type new name" />
						<?php echo $szAction2; ?>
						<input type="submit" value="Change" name="done2" />
					</form>
									</div>		
				
			</div>
		</center>	
<?php
error_reporting(0);

$submit = $_POST['done'];
$pass = $_POST['newPass'];
$pass2 = $_POST['newPass2'];

$submit2 = $_POST['done2'];
$name = $_POST['newName'];
$name2 = $_POST['newName2'];

if($submit){
	if($pass){
		if($pass2){
			if( $pass == $pass2 ){
			$sql = "UPDATE Accounts SET Password='".hash( 'sha256',$pass )."' WHERE Name='".$_SESSION['username']."'";
			$database->exec($sql);
			$szAction = "Successfully changed the password.";
			}
			else $szAction = "The given password doesn't match either.";
		}
		else $szAction = "Please Re-Type the new password.";
	}
	else $szAction = "Please type the password";
}
else if($submit2){
	if($name){ if($name2){ if( $name == $name2 ){
				$stmt = $database->prepare("SELECT Name FROM Accounts WHERE Name=:a");
				$stmt->bindParam(':a',$name);
				$stmt->execute();
				$rows = $stmt->fetch();
				if( $rows == false ){
				$stmt = $database->prepare("UPDATE Accounts SET Name=:name AND NameLower=:name2 WHERE Name=:name3");
				$stmt->bindParam(":name",$name);
				$stmt->bindParam(':name2', strtolower( $name ) );
				$stmt->bindParam(':name3', $_SESSION['username'] );
				$stmt->execute();
				$szAction = "Successfully changed your name";
				$_SESSION['username'] = $name;
				} else $szAction2 = "The new nick is already registered.";
			} else $szAction2 = "The given names doesn't match either";
		} else $szAction2 = "Please Re-Type the new nickname";
	} else $szAction2 = "Please type the name";
} else {$szAction2 = ""; $szAction = "";}
?>
	</body>
</html>