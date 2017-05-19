
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

    <title>Ideas Mania - Administration</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="plugins/dist/summernote.css" rel="stylesheet" />
    <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="plugins/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" />
    <link href="plugins/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" />
    
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>
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
                            <?php if(isset($_SESSION["adminId"])) { ?>
                                <li><a href="admin-ideas.php">Ideas</a></li>
                                <li><a href="admin-category.php">Categories</a></li>
                                <li><a href="admin-members.php">Members</a></li>
                                <?php if($_SESSION["isSuperAdmin"] == 1) { ?>
                                    <li><a href="admin-users.php">Users</a></li>
                                <?php } ?>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["adminUsername"]; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin-logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <!-- End Navigation and Logo -->