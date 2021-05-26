<!DOCTYPE HTML >
<html>
<head>
 <title>Admin Login</title>
 <meta name="description" content="Type a Short Description Here" />
 <meta name="keywords" content="type, keywords, here" />
 <meta name="author" content="Zhiwei Song" />
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
 <link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
<div style="position:absolute;z-index:-1;width:100%;height:100%;">
    	<img src="mountain.jpg" width="100%" height="100%" />
</div>
<embed name="Shape of you" src="Ed Sheeran - Shape of You [Official Video].mp3" loop="True" hidden="true" autostart="true">

<?php

	session_start();

	// --- Declare Variable ---------------------------------------------------------------------------------------
	$serverName = "localhost";
	$DBName = "mad_news";
	$userName = "root";
	$userPassword = "";
	
	$UserName = "";
	$Password = "";
	$ClientID = 0;
	$Step="";

	If(!ISSET($_SESSION["ClientID"])){$_SESSION["ClientID"] = 0;}
	If(!ISSET($_SESSION["Admin"])){$_SESSION["Admin"] = 0;}

	// ---- Get the values passed through the REQUEST
	if (ISSET($_REQUEST["submit"])){
		$UserName=$_REQUEST["UserName"];
		$Password=$_REQUEST["Password"];
		$Step=$_REQUEST["Step"];
	}

	// ---- Main Prog
	Echo "<h1 style= 'color: yellow; text-align:center;'>Admin Login</h1>";
	Echo "<br/><br/>";
	fForm();
	Echo "<br/><br/>";
	Echo "<p style = 'text-align: center'>Please enter your username(Last name) and password(Phone Number).</p><br/>";


	if($Step == "LI"){
		fSearchUser();
	}

	// ---- Functions -----------------------------------------------------------

	function fForm(){
		echo "<div style=\" margin: auto; width: 172px;\">\n\n";
		
		echo "<form action='IndexAdmin.php' method='post'>\n";
		echo "UserName<br/>\n";
		echo "<input type='text' name='UserName' value=''>\n";
		echo "<br/>Password<br/>\n";
		echo "<input type='password' name='Password' value=''>\n";
		echo "<br/><br/><input type='submit' name='submit' value='Log In'><br/>\n";
		echo "<input type='hidden' name='Step' value='LI'>\n";
		echo "</form>\n\n";
		
		echo "</div>\n";

	}
	
	//--------------------------------------------------------------------------------

	function fSearchUser(){
		global $serverName, $userName, $userPassword, $DBName;
		global $UserName, $Password;
		// Connect to the database
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery="SELECT * From tauthors WHERE autLName = '$UserName' && autPhone = '$Password' ;";
		$result = mysqli_query($conn, $myQuery);
		
		If (mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result);
			$_SESSION["ClientID"]=$row["autID"];	
					
			If (!$row["autID"] == '0'){
				$_SESSION["Admin"]= 1;
				header( "Location: UpdateAuthor.php" );
			}
		
		}else{
			echo "<br/><br/><p style = 'text-align: center'>Either the user name or the password is wrong. If you don't have an account, please create one first. Plz Contact Zhiwei Song if you have more question.</p>";
			//...report an error (nothing found)
		}
		mysqli_close($conn);
	}

	//-------------------------------------------------------------------------------------
?>

</body>
</html>