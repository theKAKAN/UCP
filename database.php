<?php
require( "config.php" );
	
	if ( !in_array( "mysql", PDO::getAvailableDrivers() ) ) die( "The MySQL PDO Driver has not been found on your server. Please contact your host to enable the MySQL PDO driver." );
	else
	{
		try {
		$database = new PDO('mysql:host='.$mysql_host.';dbname='.$mysql_dbname,$mysql_user,$mysql_pass);
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die( "Eeek! We couldn't connect to the MySQL database. Error: " . $e->getMessage() );
			//echo 'Sorry, but the server is currently off';
		}
	}
?>