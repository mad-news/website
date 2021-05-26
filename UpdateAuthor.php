<!DOCTYPE html>
<html>
<head>
 <title>Title of the document</title>
 <meta name="description" content="Type a Short Description Here" />
 <meta name="keywords" content="type, keywords, here" />
 <meta name="author" content="Your Name" />
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
 <link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>
<body>
<div style="position:absolute;z-index:-1;width:100%;height:100%;">
    	<img src="beauty.jpg" width="100%" height="100%" />
</div>

<?php

	session_start();

	// --- Declare Variable ---------------------------------------------------------------------------------------
	$serverName = "localhost";
	$DBName = "mad_news";
	$userName = "root";
	$userPassword = "";
	
	$autID = "";
	$autFName = "";
	$autLNamr = "";
	$autPName = "";
	$autPhone = "";
	$autEmail = "";
	$autGender = "";

	If(!ISSET($_SESSION["Admin"])){
		$_SESSION["Admin"] = 0;
	}

	if (ISSET($_REQUEST["AddAuthor"])){
		$autID=$_REQUEST["RoomID"];
		$RoomName=$_REQUEST["RoomName"];
		$RoomType=$_REQUEST["RoomType"];
		$RoomPrice=$_REQUEST["RoomPrice"];
	}

	if (ISSET($_REQUEST["Update"])){
		$RoomID1=$_REQUEST["rooID"];
		$rooColumn=$_REQUEST["Data"];
		$rooInformation=$_REQUEST["Text"];
	}

	if (ISSET($_REQUEST["Delete"])){
		$RoomID1=$_REQUEST["rooID"];
	}
?>