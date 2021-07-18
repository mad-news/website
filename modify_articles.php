<?php ob_start();
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Modify Articles</title>

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>

    <style>
        body {
            margin: 0;
            background-color: #E2E5DE;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        }

        h1 {
            text-align: center;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        }

        .modifyarticle {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        }

        input {
            border: 0;
            outline: 0;
            border: 1px solid darkblue;
            width: 20rem;
            font-size: 17px;
            font-weight: 450;
            height: 2rem;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            border-radius: 4px;
            margin-top: 12px;
            margin-bottom: 12px;
            text-indent: 10px;
        }

        input:focus {
            font-weight: 500;
        }

        #CreateArticle,
        #reset {
            width: 20rem;
            height: 2.6rem;
            border-radius: 4px;
            background-color: #0070F3;
            color: white;
            border: 0;
            outline: 0;
            cursor: pointer;
            margin-top: 12px;
            margin-bottom: 12px;
            font-size: 16px;
        }

        #Logout {
            width: 4rem;
            font-size: 12px;
            text-align: center;
            text-indent: 0px;
            margin-top: 0;
            margin-bottom: 0;
        }

        #Logout:hover {
            background-color: orange;
        }

        header {
            position: relative;
        }

        #UploadArticle {
            width: 8rem;
            font-size: 12px;
            text-align: center;
            text-indent: 0px;
            margin-top: 0;
            margin-bottom: 0;
            position: absolute;
            top: 0;
            right: 140px;
        }

        #UploadArticle:hover {
            background-color: orange;
        }

        #DeleteArticle {
            width: 7rem;
            font-size: 12px;
            text-align: center;
            text-indent: 0px;
            margin-top: 0;
            margin-bottom: 0;
            position: absolute;
            top: 0;
            right: 10px;
        }

        #DeleteArticle:hover {
            background-color: orange;
        }
    </style>
</head>

<body>
    <?php

    // --- Declare Variable ---------------------------------------------------------------------------------------
    $serverName = "localhost";
    $DBName = "mad_news";
    $userName = "root";
    $userPassword = "";

    $changeTitle = "";
    $changeField = "";

    $artTitle = "";
    $artAutID = "";
    $artDate = "";
    $artTyID = "";

    $artTitleArray = array();

    $autPName = "";
    $tyName = "";


    // Check Admin Mode
    if (!isset($_SESSION["Admin"])) {
        $_SESSION["Admin"] = 0;
    }

    // If upload button clicked, read the info and call relevant function
    if (isset($_REQUEST["ModifyArticle"])) {
        $changeTitle = $_REQUEST["articlechange"];
        $changeField = $_REQUEST["fieldchange"];
        if ($changeField == "artTitle") {
            $artTitle = $_REQUEST["textchange"];
        } else if ($changeField == "artPName") {
            $autPName = $_REQUEST["textchange"];
        } else if ($changeField == "artDate") {
            $artDate = $_REQUEST["textchange"];
        } else {
            $tyName = $_REQUEST["artType"];
        }
    }

    // ---- Main Prog
    if ($_SESSION["Admin"] != 0) {
        fGetTitleArray();

        if (isset($_REQUEST["ModifyArticle"])) {
            fModifyArticles();
        }

        if (isset($_REQUEST["Logout"])) {
            header("Location: IndexAdmin.php");
        }

        if (isset($_REQUEST["UploadArticle"])) {
            header("Location: upload_articles.php");
        }

        if (isset($_REQUEST["DeleteArticle"])) {
            header("Location: delete_articles.php");
        }
    } else {
        header("Location: IndexAdmin.php");
    }

    function fGetTitleArray()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $artTitleArray;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT artTitle FROM tarticles";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($artTitleArray, $row["artTitle"]);
            }
        }

        mysqli_close($conn);
    }

    // Get AutID based on pen name
    function fGetAutID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $autPName, $artAutID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT autID FROM tauthors WHERE autPName = '" . $autPName . "'";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $artAutID = $row["autID"];
            }
        }

        mysqli_close($conn);
    }

    // Get the TyID based on name
    function fGetTyID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $tyName, $artTyID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT tyID FROM ttypes WHERE tyENGName = '" . $tyName . "'";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $artTyID = $row[0];
        }

        mysqli_close($conn);
    }

    function fModifyArticles()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $changeTitle, $changeField, $artTitle, $artAutID, $artDate, $artTyID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($changeField == "artAutID") {
            fGetAutID();
        } else if ($changeField == "artTyID") {
            fGetTyID();
        }

        $myQuery = "";
        if ($changeField == "artAutID") {
            $myQuery = "UPDATE tarticles SET artAutID = '" . $artAutID . "'WHERE artTitle = '" . $changeTitle . "'";
        } else if ($changeField == "artTitle") {
            $myQuery = "UPDATE tarticles SET artTitle = '" . $artTitle . "'WHERE artTitle = '" . $changeTitle . "'";
        } else if ($changeField == "artDate") {
            $myQuery = "UPDATE tarticles SET artDate = '" . $artDate . "'WHERE artTitle = '" . $changeTitle . "'";
        } else {
            $myQuery = "UPDATE tarticles SET artTyID = '" . $artTyID . "'WHERE artTitle = '" . $changeTitle . "'";
        }

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This article was modified successfully!")</script>';
        } else {
            echo "Update failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    ?>

    <header>
        <form action='modify_articles.php' method='post'>
            <input type='submit' id="Logout" name='Logout' value='Logout'>
        </form>
        <form action='modify_articles.php' method='post'>
            <input type='submit' id="UploadArticle" name='UploadArticle' value='Upload Article'>
        </form>
        <form action='modify_articles.php' method='post'>
            <input type='submit' id="DeleteArticle" name='DeleteArticle' value='Delete Article'>
        </form>
        <h1 style="text-align: center; margin-top: 20px;">Modify Articles</h1>
    </header>

    <div class="col-md-3 modifyarticle" style="margin: auto; width: 300px">
        <form action='modify_articles.php' method='post'>
            Article Title<br />
            <select id="articlechange" name="articlechange">
                <?php
                for ($i = 0; $i < count($artTitleArray); $i++) {
                    echo "<option>" . $artTitleArray[$i] . "</option>";
                }
                ?>
            </select>

            <div></div><br>Field Change<br />
            <select id="fieldchange" name="fieldchange">
                <option value="artTitle" selected>artTitle</option>
                <option value="artPName">artPName</option>
                <option value="artDate">artDate</option>
                <option value="artType">artType</option>
            </select>
            <input type='text' id="textchange" name='textchange' value='' placeholder="Change">
            <br />Article Type<br />
            <select id="artType" name="artType">
                <option value="Politics" selected>Politics</option>
                <option value="Business">Business</option>
                <option value="Society">Society</option>
                <option value="Tech">Tech</option>
                <option value="Recreation">Recreation</option>
                <option value="Commentary">Commentary</option>
                <option value="Pandemic">Pandemic</option>
            </select>
            <br /><br><input type='submit' id="ModifyArticle" name='ModifyArticle' value='ModifyArticle'>
            <input id="reset" type='reset'>
        </form>
    </div>

    <script src=" js/jquery-2.1.4.min.js">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>