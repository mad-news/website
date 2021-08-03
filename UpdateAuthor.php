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
		$autFName=$_REQUEST["autFName"];
		$autLName=$_REQUEST["autLName"];
		$autPName=$_REQUEST["autPName"];
		$autPhone=$_REQUEST["autPhone"];
		$autEmail=$_REQUEST["autEmail"];
		$autGender=$_REQUEST["autGender"];
	}

	if (ISSET($_REQUEST["UpdateAuthor"])){
		$autID=$_REQUEST["autID"];
		$autPhone=$_REQUEST["autPhone"];
		$autEmail = $_REQUEST["autEmail"];
		$autPName = $_REQUEST["autPName"];
	}

	if (ISSET($_REQUEST["DeleteAuthor"])){
		$autID=$_REQUEST["autID"];
	}
	
	// ---- Main Prog
	If($_SESSION["Admin"] != 0){
		fLogout();
		
		echo "<h1 align=\"center\"> Insert New Author Record </h1>";
		fFormCreateAuthor();

		echo "<h1 align=\"center\"> Update Author Info </h1>";
        fFormUpdateAuthor();
		
		echo "<h1 align=\"center\"> Delete Author </h1>";
        fFormDeleteAuthor();
		
		if(ISSET($_REQUEST["CreateAuthor"])){
			fGetNextID();
			fAddAuthors();
		}

		if(ISSET($_REQUEST["UpdateAuthor"])){
			fUpdateAuthors();
		}

		if(ISSET($_REQUEST["DeleteAuthor"])){
			fDeleteAuthors();
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
		echo "<br/>autGender (1 = M, 0 = F)<br/>";
		echo "<input type='text' name='autGender' value=''>\n";
		echo "<br/><br><input type='submit' name='CreateAuthor' value='CreateAuthor'>\n";
		echo "<input type='reset'>";
		echo "</form>\n";
		echo "</div>\n\n";
	}

	// ---- Functions -----------------------------------------------------------
	function fFormUpdateAuthor(){
		echo "<div style=\" margin: auto; width: 172px;\">\n";
		echo "<form action='UpdateAuthor.php' method='post'>\n";
		echo "<br/>autID<br/>";
		echo "<input type='text' name='autID' value=''>\n";
		echo "<br/>autPhone<br/>";
		echo "<input type='text' name='autPhone' value=''>\n";
		echo "<br/>autEmail<br/>";
		echo "<input type='text' name='autEmail' value=''>\n";
		echo "<br/>autPName<br/>";
		echo "<input type='text' name='autPName' value=''>\n";
		echo "<br/><br><input type='submit' name='UpdateAuthor' value='UpdateAuthor'>\n";
		echo "<input type='reset'>";
		echo "</form>\n";
		echo "</div>\n\n";
	}

	function fFormDeleteAuthor(){
		echo "<div style=\" margin: auto; width: 172px;\">\n";
		echo "<form action='UpdateAuthor.php' method='post'>\n";
		echo "<br/>autID<br/>";
		echo "<input type='text' name='autID' value=''>\n";
		echo "<br/><br><input type='submit' name='DeleteAuthor' value='DeleteAuthor'>\n";
		echo "<input type='reset'>";
		echo "</form>\n";
		echo "</div>\n\n";
	}
	
	//--------------------------------------------------------------------------
	
	function fGetNextID(){
		global $serverName, $userName, $userPassword, $DBName;
		global $autID;
		
		// Connect to the database
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery = "SELECT MAX(autID) FROM tauthors;";
		$result = mysqli_query($conn, $myQuery);
		
		If (mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result);
			$autID = $row[0] + 1;
			echo $autID;
		}
		
		mysqli_close($conn);
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
			echo "This author was added $autID, $autFName, $autLName, $autPName, $autPhone, $autEmail, $autGender";
		} else {
			echo "Insert failed! " .mysqli_error($conn);
		
		}
		
		mysqli_close($conn);
		
	}

	//--------------------------------------------------------------------------
	
	function fUpdateAuthors(){
		global $serverName, $userName, $userPassword, $DBName;
		global $autID, $autPhone, $autEmail, $autPName;
		
		// Connect to the database
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$myQuery= "UPDATE tauthors
				   SET autEmail = \"$autEmail\", autPhone = \"$autPhone\", autPName = \"$autPName\"
				   WHERE autID = $autID;";
		$result = mysqli_query($conn, $myQuery);
		if ($result){
			echo "This author info was updated $autPhone, $autEmail, $autPName";
		} else {
			echo "Update failed! " .mysqli_error($conn);
		
		}		
		mysqli_close($conn);
		
	}

	function fDeleteAuthors(){
		global $serverName, $userName, $userPassword, $DBName;
		global $autID;
		
		// Connect to the database
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$myQuery= "DELETE FROM tauthors 
				   WHERE autID = $autID;";
		$result = mysqli_query($conn, $myQuery);
		if ($result){
			echo "This author info was deleted $autID";
		} else {
			echo "Update failed! " .mysqli_error($conn);
		
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