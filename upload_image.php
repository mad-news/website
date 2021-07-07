<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Upload Images</title>

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

        .uploadimage {
            text-align: center;
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

        #CreateImage,
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
            right: 160px;
        }

        #UploadArticle:hover {
            background-color: orange;
        }

        #UploadParagraph {
            width: 9rem;
            font-size: 12px;
            text-align: center;
            text-indent: 0px;
            margin-top: 0;
            margin-bottom: 0;
            position: absolute;
            top: 0;
            right: 10px;
        }

        #UploadParagraph:hover {
            background-color: orange;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    // --- Declare Variable ---------------------------------------------------------------------------------------
    $serverName = "localhost";
    $DBName = "mad_news";
    $userName = "root";
    $userPassword = "";

    $imID = "";
    $imRef = "";
    $imAltText = "";
    $imNote = "";
    $imFolder = "";

    $posimID = "";
    $posimArtID = "";
    $posimPriority = "";

    $artTitle = "";

    // Check Admin Mode
    if (!isset($_SESSION["Admin"])) {
        $_SESSION["Admin"] = 0;
    }

    if (isset($_REQUEST["CreateImage"])) {
        fGetNextImID();
        $imRef = $_REQUEST["imRef"];
        $imAltText = $_REQUEST["imAltText"];
        $imNote = $_REQUEST["imNote"];
        $imFolder = $_REQUEST["imFolder"];
        fGetNextPostImID();
        $posimPriority = $_REQUEST["posimPriority"];
        $artTitle = $_REQUEST["artTitle"];
    }

    // Main Prog
    if ($_SESSION["Admin"] != 0) {
        if (isset($_REQUEST["CreateImage"])) {
            fGetArtID();
            fAddImages();
            fAddPostIm();
        }

        if (isset($_REQUEST["Logout"])) {
            header("Location: IndexAdmin.php");
        }

        if (isset($_REQUEST["UploadArticle"])) {
            header("Location: upload_articles.php");
        }

        if (isset($_REQUEST["UploadParagraph"])) {
            header("Location: upload_paragraph.php");
        }
    } else {
        header("Location: IndexAdmin.php");
    }

    function fGetArtID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posimArtID, $artTitle;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT artID FROM tarticles WHERE artTitle = '" . $artTitle . "'";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $posimArtID = $row["artID"];
            }
        }

        mysqli_close($conn);
    }

    function fAddImages()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $imID, $imRef, $imAltText, $imNote, $imFolder;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "INSERT INTO timages (imID, imRef, imAltText, imNote, imFolder) 
				   VALUES ($imID, \"$imRef\", \"$imAltText\", \"$imNote\", \"$imFolder\");";

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This paragraph was added' . $imID . ',' . $imRef . ','
                . $imAltText . "," . $imNote . "," . $imFolder . '")</script>';
        } else {
            echo "Insert failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    function fAddPostIm()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posimID, $posimArtID, $imID, $posimPriority;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "INSERT INTO tpostims (posimID, posimArtID, posimImID, posimPriority) 
				   VALUES ($posimID, $posimArtID, $imID, $posimPriority);";

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This postcon was added' . $posimID . ',' . $posimArtID . ','
                . $imID . "," . $posimPriority . '")</script>';
        } else {
            echo "Insert failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    // Retreive the next content ID
    function fGetNextImID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $imID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT MAX(imID) FROM timages;";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $imID = $row[0] + 1;
        }

        mysqli_close($conn);
    }

    function fGetNextPostImID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posimID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT MAX(posimID) FROM tpostims;";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $posimID = $row[0] + 1;
        }

        mysqli_close($conn);
    }

    ?>


    <header>
        <form action='upload_image.php' method='post'>
            <input type='submit' id="Logout" name='Logout' value='Logout'>
        </form>
        <form action='upload_image.php' method='post'>
            <input type='submit' id="UploadArticle" name='UploadArticle' value='Upload Article'>
        </form>
        <form action='upload_image.php' method='post'>
            <input type='submit' id="UploadParagraph" name='UploadParagraph' value='Upload Paragraph'>
        </form>
        <h1 style="text-align: center; margin-top: 20px;">Upload Images</h1>
    </header>

    <div class="col-md-3 uploadimage" style="margin: auto; width: 300px">
        <form action='upload_image.php' method='post'>
            <input type='text' id="artTitle" name='artTitle' value='' placeholder="Article Title">
            <input type='text' id="imRef" name='imRef' value='' placeholder="Image Reference">
            <input type='text' id="imAltText" name='imAltText' value='' placeholder="Image Alternative Text">
            <input type='text' id="imNote" name='imNote' value='' placeholder="Image Note">
            <input type='text' id="imFolder" name='imFolder' value='' placeholder="Image Folder">
            <input type='number' id="posimPriority" name='posimPriority' value='1'>
            <br><input type='submit' id="CreateImage" name='CreateImage' value='CreateImage'>
            <input id="reset" type='reset'>
        </form>
    </div>


    <script src=" js/jquery-2.1.4.min.js">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>