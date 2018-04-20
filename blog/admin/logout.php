<?php 
	include('check.php');
	/*session清空*/
	$_SESSION = array();
	header("location:login.php");
?>