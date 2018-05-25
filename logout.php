<?php 
include("datbase.php"); //including our config.php 
session_start(); //starting session 
session_unset(); //Removing all the variables
session_destroy(); //destroying it 
header('location: index.php'); //redirecting user to login.php 
?>