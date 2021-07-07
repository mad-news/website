<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title></title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/logo.jpg">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">

    <!-- Responsive CSS -->
    <link href="../css/responsive.css" rel="stylesheet">

</head>

<body>
    <?php
	session_start();
	// --- Declare Variable ---------------------------------------------------------------------------------------
	$serverName = "localhost";
	$DBName = "mad_news";
	$userName = "root";
	$userPassword = "";

	$post_ID = "100";
	$post_title = "";
	$post_authorName = "";
	$post_date = "";
	$post_typeCHIName = "";
	$post_typeENGName = "";
	$post_cons = array(array(), array());
	$post_ims = array(array(), array(), array());
	
	$type = array(array(), array());

	function fgetInfo(){
		global $serverName, $userName, $userPassword, $DBName;
		global $post_ID, $post_title, $post_authorName, $post_date, $post_typeCHIName, $post_typeENGName;

		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery = "SELECT artTitle FROM tarticles WHERE artID = ". $post_ID ."";
		$result = mysqli_query($conn, $myQuery);
		
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$post_title = $row["artTitle"];  
                echo "<script>document.title=\"".$post_title."\"</script>";
			}
		}
		
		$myQuery2 = "SELECT autPName FROM tauthors WHERE autID = (SELECT artAutID FROM tarticles WHERE artID = ". $post_ID .")";
		$result2 = mysqli_query($conn, $myQuery2);
		
		if (mysqli_num_rows($result2) > 0){
			while($row = mysqli_fetch_assoc($result2)){
				$post_authorName = $row["autPName"];
			}
		}
			
		$myQuery3 = "SELECT artDate FROM tarticles WHERE artID = ". $post_ID ."";
		$result3 = mysqli_query($conn, $myQuery3);
		
		if (mysqli_num_rows($result3) > 0){
			while($row = mysqli_fetch_assoc($result3)){
				$post_date = $row["artDate"];
			}
		}
			
		$myQuery4 = "SELECT tyCHIName, tyENGName FROM ttypes WHERE tyID = (SELECT artTyID FROM tarticles WHERE artID = ". $post_ID .")";
		$result4 = mysqli_query($conn, $myQuery4);
		
		if (mysqli_num_rows($result4) > 0){
			while($row = mysqli_fetch_assoc($result4)){
				$post_typeCHIName = $row["tyCHIName"];
				$post_typeENGName = $row["tyENGName"];
			}
		}
		
		mysqli_close($conn);
	}
	
	function fgetCons(){
		global $serverName, $userName, $userPassword, $DBName;
		global $post_ID, $post_cons;
		
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery = "SELECT tcontents.conTitle, tcontents.conPara, tpostcons.posconPriority FROM tcontents INNER JOIN 
			tpostcons ON tcontents.conID = tpostcons.posconConID WHERE tpostcons.posconArtID = ". $post_ID ."";
		$result = mysqli_query($conn, $myQuery);

		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$post_cons[0][$row["posconPriority"]] = $row["conTitle"];
				$post_cons[1][$row["posconPriority"]] = $row["conPara"];
			}
		}
		
		mysqli_close($conn);
	}
	
	function fgetIms(){
		global $serverName, $userName, $userPassword, $DBName;
		global $post_ID, $post_ims;
		
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery = "SELECT timages.imRef, timages.imAltText, timages.imNote, tpostims.posimPriority FROM timages INNER JOIN 
			tpostims ON timages.imID = tpostims.posimImID WHERE tpostims.posimArtID = ". $post_ID ."";
		$result = mysqli_query($conn, $myQuery);
		
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$post_ims[0][$row["posimPriority"]] = $row["imRef"];
				$post_ims[1][$row["posimPriority"]] = $row["imAltText"];
				$post_ims[2][$row["posimPriority"]] = $row["imNote"];
			}
		}
			
		mysqli_close($conn);
	}
	
	function fgetTypes(){
		global $serverName, $userName, $userPassword, $DBName;
		global $type;
		
		$conn = mysqli_connect($serverName, $userName, $userPassword, $DBName);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$myQuery = "SELECT tyCHIName, tyENGName FROM ttypes";
		$result = mysqli_query($conn, $myQuery);
		
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($type[0], $row["tyCHIName"]);
				array_push($type[1], $row["tyENGName"]);
			}
		}
		
		mysqli_close($conn);
	}

	fgetInfo();
	fgetCons();
	fgetIms();
	fgetTypes();
?>

    <!-- Header Area Start -->
    <header class="header-area">
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Breaking News Area -->
                    <div class="col-12 col-md-6">
                        <div class="breaking-news-area">
                            <h5 class="breaking-news-title">Breaking news</h5>
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a href="#">Brexit breakthrough in Brussels comes after week of drama</a></li>
                                    <li><a href="#">Brexit breakthrough in Brussels</a></li>
                                    <li><a href="#">Brexit breakthrough in Brussels comes after week of drama</a></li>
                                    <li><a href="#">Brex comes after week of drama</a></li>
                                    <li><a href="#">Brexit breakthrough in Bweek of drama</a></li>
                                    <li><a href="#">Brexit bssels comes after week of drama</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Stock News Area -->
                    <div class="col-12 col-md-6">
                        <div class="stock-news-area">
                            <div id="stockNewsTicker" class="ticker">
                                <ul>
                                    <li>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>eur/usd</span>
                                                <span>1.1862</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>0.18</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>BTC/usd</span>
                                                <span>15.674.99</span>
                                            </div>
                                            <div class="stock-index plus-index">
                                                <h4>8.60</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>ETH/usd</span>
                                                <span>674.99</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>13.60</h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>eur/usd</span>
                                                <span>1.1862</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>0.18</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>BTC/usd</span>
                                                <span>15.674.99</span>
                                            </div>
                                            <div class="stock-index plus-index">
                                                <h4>8.60</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>ETH/usd</span>
                                                <span>674.99</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>13.60</h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>eur/usd</span>
                                                <span>1.1862</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>3.95</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>BTC/usd</span>
                                                <span>15.674.99</span>
                                            </div>
                                            <div class="stock-index plus-index">
                                                <h4>4.78</h4>
                                            </div>
                                        </div>
                                        <div class="single-stock-report">
                                            <div class="stock-values">
                                                <span>ETH/usd</span>
                                                <span>674.99</span>
                                            </div>
                                            <div class="stock-index minus-index">
                                                <h4>11.37</h4>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Middle Header Area -->
        <div class="middle-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Logo Area -->
                    <div class="col-12 col-md-4">
                        <div class="logo-area">
                            <a href="../index.html"><img src="../img/core-img/logo_madnews.png" alt="logo"></a>
                        </div>
                    </div>
                    <!-- Header Advert Area -->
                    <div class="col-12 col-md-8">
                        <div class="header-advert-area">
                            <a href="#"><img src="../img/bg-img/top-advert.png" alt="header-add"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Header Area -->
        <div class="bottom-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="main-menu">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#gazetteMenu" aria-controls="gazetteMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>
                                <div class="collapse navbar-collapse" id="gazetteMenu">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">目录 Pages</a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="../index.html">首页 Home</a>
                                                <a class="dropdown-item" href="../catagory.html">分类 Category</a>
                                                <a class="dropdown-item" href="../about-us.html">介绍 About</a>
                                                <a class="dropdown-item" href="../contact.html">平台 Platform</a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][0] . " " . $type[1][0]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][1] . " " . $type[1][1]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][2] . " " . $type[1][2]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][3] . " " . $type[1][3]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][4] . " " . $type[1][4]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][5] . " " . $type[1][5]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][6] . " " . $type[1][6]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][7] . " " . $type[1][7]; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><?php echo $type[0][8] . " " . $type[1][8]; ?></a>
                                        </li>
                                    </ul>
                                    <!-- Search Form -->
                                    <div class="header-search-form mr-auto">
                                        <form action="#">
                                            <input type="search" placeholder="Input your keyword then press enter..." id="search" name="search">
                                            <input class="d-none" type="submit" value="submit">
                                        </form>
                                    </div>
                                    <!-- Search btn -->
                                    <div id="searchbtn">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <section class="single-post-area">
        <!-- Single Post Title -->
        <div class="single-post-title bg-img background-overlay" style="background-image: url(../img/bg-img/politics_bg.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-end">
                    <div class="col-12">
                        <div class="single-post-title-content">
                            <!-- Post Tag -->
                            <div class="gazette-post-tag">
                                <a href="#"><?php echo $post_typeENGName; ?></a>
                            </div>
                            <h2 class='font-pt'><?php echo $post_title; ?></h2>;
                            <p><?php echo $post_date; ?></p>
                            <p><?php echo "作者：" . $post_authorName; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-post-contents">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <p><?php echo $post_cons[0]["1"]; ?></p>
                            <p><?php echo $post_cons[1]["1"]; ?></p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="single-post-thumb">
                            <center>
                                <img src=<?php echo $post_ims[0]["1"]; ?> alt=<?php echo $post_ims[1]["1"]; ?>>
                                <p><?php echo $post_ims[2]["1"]; ?></p>
                            </center>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <p><?php echo $post_cons[0]["2"]; ?></p>
                            <p><?php echo $post_cons[1]["2"]; ?></p>
                            <p><?php echo $post_cons[1]["3"]; ?></p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="single-post-thumb">
                            <center>
                                <img src=<?php echo $post_ims[0]["2"]; ?> alt=<?php echo $post_ims[1]["2"]; ?>>
                                <p><?php echo $post_ims[2]["2"]; ?></p>
                            </center>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <p><?php echo $post_cons[0]["4"]; ?></p>
                            <p><?php echo $post_cons[1]["4"]; ?></p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="single-post-thumb">
                            <center>
                                <img src=<?php echo $post_ims[0]["3"]; ?> alt=<?php echo $post_ims[1]["3"]; ?>>
                                <p><?php echo $post_ims[2]["3"]; ?></p>
                            </center>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <p><?php echo $post_cons[0]["5"]; ?></p>
                            <p><?php echo $post_cons[1]["5"]; ?></p>
                            <p><?php echo $post_cons[1]["6"]; ?></p>
                            <p><?php echo $post_cons[1]["7"]; ?></p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="single-post-thumb">
                            <center>
                                <img src=<?php echo $post_ims[0]["4"]; ?> alt=<?php echo $post_ims[1]["4"]; ?>>
                            </center>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="gazette-post-discussion-area section_padding_100 bg-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <!-- Comment Area Start -->
                    <div class="comment_area section_padding_50 clearfix">
                        <div class="gazette-heading">
                            <h4 class="font-bold">Discussion</h4>
                        </div>

                        <ol>
                            <!-- Single Comment Area -->
                            <li class="single_comment_area">
                                <div class="comment-wrapper d-md-flex align-items-start">
                                    <!-- Comment Meta -->
                                    <div class="comment-author">
                                        <img src="../img/blog-img/25.jpg" alt="">
                                    </div>
                                    <!-- Comment Content -->
                                    <div class="comment-content">
                                        <h5>John Doe</h5>
                                        <span class="comment-date font-pt">December 18, 2017</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum nunc libero, vitae rutrum nunc porta id. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam arcu augue, semper at elementum nec, cursus nec ante.</p>
                                        <a class="reply-btn" href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <ol class="children">
                                    <li class="single_comment_area">
                                        <div class="comment-wrapper d-md-flex align-items-start">
                                            <!-- Comment Meta -->
                                            <div class="comment-author">
                                                <img src="img/blog-img/25.jpg" alt="">
                                            </div>
                                            <!-- Comment Content -->
                                            <div class="comment-content">
                                                <h5>John Doe</h5>
                                                <span class="comment-date text-muted">December 18, 2017</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum nunc libero, vitae rutrum nunc porta id. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam arcu augue, semper at elementum nec, cursus nec ante.</p>
                                                <a class="reply-btn" href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <!-- Leave A Comment -->
                    <div class="leave-comment-area clearfix">
                        <div class="comment-form">
                            <div class="gazette-heading">
                                <h4 class="font-bold">leave a comment</h4>
                            </div>
                            <!-- Comment Form -->
                            <form action="#" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact-name" placeholder="Enter Your Full Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="contact-email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn leave-comment-btn">SUBMIT <i class="fa fa-angle-right ml-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Area Start -->
    <footer class="footer-area bg-img background-overlay" style="background-image: url(../img/bg-img/6.jpg);">
        <!-- Top Footer Area -->
        <div class="top-footer-area section_padding_100_70">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Regions</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">U.S.</a></li>
                                <li><a href="#">Africa</a></li>
                                <li><a href="#">Americas</a></li>
                                <li><a href="#">Asia</a></li>
                                <li><a href="#">China</a></li>
                                <li><a href="#">Europe</a></li>
                                <li><a href="#">Middle</a></li>
                                <li><a href="#">East</a></li>
                                <li><a href="#">Opinion</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Fashion</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Election 2016</a></li>
                                <li><a href="#">Nation</a></li>
                                <li><a href="#">World</a></li>
                                <li><a href="#">Our Team</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Politics</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Markets</a></li>
                                <li><a href="#">Tech</a></li>
                                <li><a href="#">Luxury</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">Featured</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Football</a></li>
                                <li><a href="#">Golf</a></li>
                                <li><a href="#">Tennis</a></li>
                                <li><a href="#">Motorsport</a></li>
                                <li><a href="#">Horseracing</a></li>
                                <li><a href="#">Equestrian</a></li>
                                <li><a href="#">Sailing</a></li>
                                <li><a href="#">Skiing</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">FAQ</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Aviation</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Traveller</a></li>
                                <li><a href="#">Destinations</a></li>
                                <li><a href="#">Features</a></li>
                                <li><a href="#">Food/Drink</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Partner Hotels</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="single-footer-widget">
                            <div class="footer-widget-title">
                                <h4 class="font-pt">+More</h4>
                            </div>
                            <ul class="footer-widget-menu">
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Architecture</a></li>
                                <li><a href="#">Arts</a></li>
                                <li><a href="#">Autos</a></li>
                                <li><a href="#">Luxury</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="copywrite-text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../js/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>

</body>

</html>