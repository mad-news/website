<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Upload Paragraphs</title>

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

        .uploadparagraph {
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

        #CreateParagraph,
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

        textarea {
            width: 320px;
            height: 150px;
            margin-top: 12px;
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

    $conID = "";
    $conTitle = "";
    $conPara = "";
    $conTitleSize = 30;
    $conParaSize = 30;

    $posconID = "";
    $posconArtID = "";
    $posconPriority = "";

    $artTitle = "";

    // Check Admin Mode
    if (!isset($_SESSION["Admin"])) {
        $_SESSION["Admin"] = 0;
    }

    if (isset($_REQUEST["CreateParagraph"])) {
        fGetNextConID();
        $conTitle = $_REQUEST["conTitle"];
        $conPara = $_REQUEST["conPara"];
        fGetNextPostConID();
        $posconPriority = $_REQUEST["posconPriority"];
        $artTitle = $_REQUEST["artTitle"];
    }

    // Main Prog
    if ($_SESSION["Admin"] != 0) {
        if (isset($_REQUEST["CreateParagraph"])) {
            fGetArtID();
            fAddPara();
            fAddPostCon();
        }

        if (isset($_REQUEST["Logout"])) {
            header("Location: IndexAdmin.php");
        }

        if (isset($_REQUEST["UploadArticle"])) {
            header("Location: upload_articles.php");
        }

        if (isset($_REQUEST["UploadImage"])) {
            header("Location: upload_image.php");
        }
    } else {
        header("Location: IndexAdmin.php");
    }

    function fGetArtID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posconArtID, $artTitle;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT artID FROM tarticles WHERE artTitle = '" . $artTitle . "'";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $posconArtID = $row["artID"];
            }
        }

        mysqli_close($conn);
    }

    function fAddPara()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $conID, $conTitle, $conPara, $conTitleSize, $conParaSize;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "INSERT INTO tcontents (conID, conTitle, conPara, conTitleSize, conParaSize) 
				   VALUES ($conID, \"$conTitle\", \"$conPara\", $conTitleSize, $conParaSize);";

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This paragraph was added' . $conID . ',' . $conTitle . ','
                . $conPara . "," . $conTitleSize . "," . $conParaSize . '")</script>';
        } else {
            echo "Insert failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    function fAddPostCon()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posconID, $posconArtID, $conID, $posconPriority;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "INSERT INTO tpostcons (posconID, posconArtID, posconConID, posconPriority) 
				   VALUES ($posconID, $posconArtID, $conID, $posconPriority);";

        $result = mysqli_query($conn, $myQuery);
        //If there is a result...
        if ($result) {
            echo '<script>alert("This postcon was added' . $posconID . ',' . $posconArtID . ','
                . $conID . "," . $posconPriority . '")</script>';
        } else {
            echo "Insert failed! " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    // Retreive the next content ID
    function fGetNextConID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $conID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT MAX(conID) FROM tcontents;";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $conID = $row[0] + 1;
        }

        mysqli_close($conn);
    }

    function fGetNextPostConID()
    {
        global $serverName, $userName, $userPassword, $DBName;
        global $posconID;

        // Connect to the database
        $conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $myQuery = "SELECT MAX(posconID) FROM tpostcons;";
        $result = mysqli_query($conn, $myQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $posconID = $row[0] + 1;
        }

        mysqli_close($conn);
    }

    ?>


    <header>
        <form action='upload_paragraph.php' method='post'>
            <input type='submit' id="Logout" name='Logout' value='Logout'>
        </form>
        <form action='upload_paragraph.php' method='post'>
            <input type='submit' id="UploadArticle" name='UploadArticle' value='Upload Article'>
        </form>
        <form action='upload_paragraph.php' method='post'>
            <input type='submit' id="UploadImage" name='UploadImage' value='Upload Image'>
        </form>
        <h1 style="text-align: center; margin-top: 20px;">Upload Paragraphes</h1>
    </header>

    <div class="col-md-3 uploadparagraph" style="margin: auto; width: 300px">
        <form action='upload_paragraph.php' method='post'>
            <input type='text' id="artTitle" name='artTitle' value='' placeholder="Article Title">
            <input type='text' id="conTitle" name='conTitle' value='' placeholder="Paragraph Title">
            <textarea id="conPara" name='conPara' value='' placeholder="Paragraph"></textarea>
            <input type='number' id="posconPriority" name='posconPriority' value='1'>
            <br><input type='submit' id="CreateParagraph" name='CreateParagraph' value='CreateParagraph'>
            <input id="reset" type='reset'>
        </form>
    </div>


    <script src=" js/jquery-2.1.4.min.js">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>