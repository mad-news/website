<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Upload Articles</title>

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

        .uploadarticle {
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

        #UploadParagraph {
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

        #UploadParagraph:hover {
            background-color: orange;
        }

        #UploadImage {
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

        #UploadImage:hover {
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

    $artID = "";
    $artTitle = "";
    $artAutID = "";
    $artDate = "";
    $artTyID = "";

    $autPName = "";
    $tyName = "";


    // Check Admin Mode
    if (!isset($_SESSION["Admin"])) {
        $_SESSION["Admin"] = 0;
    }

    // If upload button clicked, read the info and call relevant function
    if (isset($_REQUEST["CreateArticle"])) {
        fGetNextID();
        $artTitle = $_REQUEST["artTitle"];
        $autPName = $_REQUEST["artPName"];
        $artDate = $_REQUEST["artDate"];
        $tyName = $_REQUEST["artType"];
    }

    // ---- Main Prog
    if ($_SESSION["Admin"] != 0) {

        if (isset($_REQUEST["CreateArticle"])) {
            fGetAutID();
            fGetTyID();
            fAddArticles();
        }

        if (isset($_REQUEST["Logout"])) {
            header("Location: IndexAdmin.php");
        }

        if (isset($_REQUEST["UploadParagraph"])) {
            header("Location: upload_paragraph.php");
        }

        if (isset($_REQUEST["UploadImage"])) {
            header("Location: upload_image.php");
        }
    } else {
        header("Location: IndexAdmin.php");
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

    function fAddArticles()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $artID, $artTitle, $artAutID, $artDate, $artTyID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "INSERT INTO tarticles (artID, artTitle, artAutID, artDate, artTyID) 
				   VALUES ($artID, \"$artTitle\", $artAutID, \"$artDate\", $artTyID);";

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This article was added' . $artID . ',' . $artTitle . ','
                . $artAutID . "," . $artDate . "," . $artTyID . '")</script>';
        } else {
            echo "Insert failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    // Retreive the next article ID
    function fGetNextID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $artID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT MAX(artID) FROM tarticles;";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $artID = $row[0] + 1;
        }

        mysqli_close($conn);
    }

    ?>

    <header>
        <form action='upload_articles.php' method='post'>
            <input type='submit' id="Logout" name='Logout' value='Logout'>
        </form>
        <form action='upload_articles.php' method='post'>
            <input type='submit' id="UploadParagraph" name='UploadParagraph' value='Upload Paragraph'>
        </form>
        <form action='upload_articles.php' method='post'>
            <input type='submit' id="UploadImage" name='UploadImage' value='Upload Image'>
        </form>
        <h1 style="text-align: center; margin-top: 20px;">Upload Articles</h1>
    </header>

    <div class="col-md-3 uploadarticle" style="margin: auto; width: 300px">
        <form action='upload_articles.php' method='post'>
            <input type='text' id="artTitle" name='artTitle' value='' placeholder="Article Title">
            <input type='text' id="artPName" name='artPName' value='' placeholder="Author Pen Name">
            <input type='text' id="artDate" name='artDate' value='' placeholder="Date">
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
            <br /><br><input type='submit' id="CreateArticle" name='CreateArticle' value='CreateArticle'>
            <input id="reset" type='reset'>
        </form>
    </div>

    <script src=" js/jquery-2.1.4.min.js">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>