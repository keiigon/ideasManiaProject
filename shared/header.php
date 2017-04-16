
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/logo-icon.png">

    <title>Ideas Mania - Home</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/star-rating.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="plugins/dist/summernote.css" rel="stylesheet" />
    
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <!-- Navigation and Logo -->
    <div class="navbar-wrapper">
        <div class="container">

            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">
                            <img src="img/ideas-mania-logo.png" width="230" title="ideas-mania-logo" />
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="ideas.php">Ideas</a></li>
                            <li><a href="addIdea.php">Add Idea</a></li>
                            <li><a href="about.php">About</a></li>
                            <?php
                                if(isset($_SESSION["userId"])){
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["username"]; $username = $_SESSION["userId"]; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href='<?php echo "profile.php?id=$username" ?>'>My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <script>
        var pageName = location.pathname.split('/')[2];
        $('a[href="' + pageName + '"]').parent().addClass("active");
    </script>
    <!-- End Navigation and Logo -->