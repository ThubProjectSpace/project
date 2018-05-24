<?php
	$server_name="localhost";
	$username="root";
	$password="";
	$db_name="staff_attendance";

	$con = mysqli_connect($server_name,$username,$password,$db_name);

	date_default_timezone_set('Asia/kolkata');

	session_start();

	error_reporting(0);
?>