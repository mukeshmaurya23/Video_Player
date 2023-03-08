<?php
require_once("includes/config.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/User.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");
error_reporting(E_ERROR | E_PARSE);
$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
$video = new Video($con, null, $userLoggedInObj);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        Last_Vlog
    </title>

    <link rel="icon" href="img/logo.png">

    <link rel="stylesheet" href="styles/style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <!-- Breaking News Widget -->
                        <div class="breaking-news-area d-flex align-items-center">
                            <div class="news-title">
                                <p>New Vlog:</p>
                            </div>
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <?php echo $video->getNewVideo(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="top-meta-data d-flex align-items-center justify-content-end">
                            <!-- Top Social Info -->
                            <div class="top-social-info">
                                <!-- <a href="https://github.com/sushma78"><i class="fa fa-github-alt"></i> MyGitHub</a> -->


                                <?php
                                if (User::isLoggedIn()) {
                                    //make sure that if user not admin they cant access to upload page
                                    if ($userLoggedInObj->isAdmin()) {
                                        echo "<a href='upload'><i class='fa fa-upload'></i> Upload</a>";
                                        //echo admin button
                                        echo "<a href='admin'><i class='fa fa-user'></i> Admin</a>";
                                    } else {


                                        echo "<a href='profile?username=" . $userLoggedInObj->getUsername() . "' style='color:red;'><i class='fa fa-user'></i> Welcome " . $userLoggedInObj->getFirstName() . "</a>";
                                    }
                                }

                                ?>

                            </div>
                            <!-- Top Search Area -->
                            <div class="top-search-area">
                                <form action="search" method="GET">
                                    <input type="text" name="term" id="topSearch" placeholder="Search...">
                                    <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <!-- Login -->
                            <a href="signIn" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="vizew-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">

                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="vizewNav">

                        <!-- Nav brand -->
                        <a href="index" class="nav-brand"><img src="img/logo.png" alt="" style="background:beige
                        ;"></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index">Home</a></li>
                                    <li><a href="trending">Trending</a></li>
                                    <li><a href="subscriptions">Subscriptions</a></li>
                                    <?php
                                    if ($userLoggedInObj->getFirstName() == "") {
                                        echo "";
                                    } else {
                                        $username = $userLoggedInObj->getUsername();
                                        $name = $userLoggedInObj->getName();
                                        echo "<li><a href='likedVideos'>Liked Videos</a></li>
                                              <li><a href='profile?username=$username'>$name</a></li>
                                              <li><a href='settings'>Settings</a></li>
                                              <li><a href='logout'>Logout</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->