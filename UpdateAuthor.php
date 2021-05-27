<!DOCTYPE html>
<html>
<head>
 <title>Update Author</title>
 <meta name="description" content="Type a Short Description Here" />
 <meta name="keywords" content="type, keywords, here" />
 <meta name="author" content="Zhiwei Song" />
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
 <link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>
<body>
<div style="position:absolute;z-index:-1;width:100%;height:100%;">
    	<img src="wall.jpg" width="100%" height="100%" />
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
	$autLName = "";
	$autPName = "";
	$autPhone = "";
	$autEmail = "";
	$autGender = "";

	If(!ISSET($_SESSION["Admin"])){
		$_SESSION["Admin"] = 0;
	}

	if (ISSET($_REQUEST["CreateAuthor"])){
		$autID=$_REQUEST["autID"];
		$autFName=$_REQUEST["autFName"];
		$autLName=$_REQUEST["autLName"];
		$autPName=$_REQUEST["autPName"];
		$autPhone=$_REQUEST["autPhone"];
		$autEmail=$_REQUEST["autEmail"];
		$autGender=$_REQUEST["autGender"];
	}

	if (ISSET($_REQUEST["Update"])){
		$RoomID1=$_REQUEST["rooID"];
		$rooColumn=$_REQUEST["Data"];
		$rooInformation=$_REQUEST["Text"];
	}

	if (ISSET($_REQUEST["Delete"])){
		$RoomID1=$_REQUEST["rooID"];
	}
	
	// ---- Main Prog
	If($_SESSION["Admin"] != 0){
		fLogout();
		
		echo "<h1 align=\"center\"> Insert New Author Record </h1>";
		fFormCreateAuthor();
		
		if(ISSET($_REQUEST["CreateAuthor"])){
			fAddAuthors();
		}
		
		if(ISSET($_REQUEST["Logout"])){
			header( "Location: IndexAdmin.php" );
		}
		
	}else{
		header( "Location: IndexAdmin.php" );
	}
	
	
	
	// ---- Functions -----------------------------------------------------------
	function fFormCreateAuthor(){
		echo "<div style=\" margin: auto; width: 172px;\">\n";
		echo "<form action='UpdateAuthor.php' method='post'>\n";
		echo "autID<br/>";
		echo "<input type='text' name='autID' value=''>\n";
		echo "<br/>autFName<br/>";
		echo "<input type='text' name='autFName' value=''>\n";
		echo "<br/>autLName<br/>";
		echo "<input type='text' name='autLName' value=''>\n";
		echo "<br/>autPName<br/>";
		echo "<input type='text' name='autPName' value=''>\n";
		echo "<br/>autPhone<br/>";
		echo "<input type='text' name='autPhone' value=''>\n";
		echo "<br/>autEmail<br/>";
		echo "<input type='text' name='autEmail' value=''>\n";
		echo "<br/>autGender<br/>";
		echo "<input type='text' name='autGender ( 1 = M, 0 = F)' value=''>\n";
		echo "<br/><br><input type='submit' name='CreateAuthor' value='CreateAuthor'>\n";
		echo "<input type='reset'>";
		echo "</form>\n";
		echo "</div>\n\n";
	}
	
	//--------------------------------------------------------------------------
	
	function fAddAuthors(){
		global $serverName, $userName, $userPassword, $DBName;
		global $autID, $autFName, $autLName, $autPName, $autPhone, $autEmail, $autGender;
		
		// Connect to the database
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery= "INSERT INTO tauthors (autID, autFName, autLName, autPName, autPhone, autEmail, autGender) 
				   VALUES ($autID, \"$autFName\", \"$autLName\", \"$autPName\", \"$autPhone\", \"$autEmail\", $autGender);";
		
		$result = mysqli_query($conn, $myQuery);
		//If there is a result...
		if ($result){
			echo "This Room was added $autID, $autFName, $autLName, $autPName, $autPhone, $autEmail, $autGender";
		} else {
			echo "Insert failed! " .mysqli_error($conn);
		
		}
		
		mysqli_close($conn);
		
	}
	
	//-----------------------------------------------------------------------------------

	function fLogout(){
		echo "<form action='UpdateAuthor.php' method='post'>\n";
		echo "<input type='submit' name='Logout' value='Logout'>\n";
		echo "</form>\n";
	}
?>