<?php include("shared/header.php") ?>
<?php include("shared/functions.php") ?>
<?php
    if(isset($_COOKIE["user"]) && !isset($_SESSION["userId"])){
        $user = $_COOKIE["user"];
        $userArray = explode(',', $user);
        $_SESSION["username"] = $userArray[1];
        $_SESSION["userId"] = $userArray[0];
        header("refresh:0;index.php");
    }
?>
    <!-- Banner -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class=" col-md-6">
                    <h1>
                        The time of your ideas to see the light is now
                    </h1>
                </div>
                <div class="col-md-6">
                    <img src="img/img1.png" />
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            <div class="col-md-8">
                
                
                <div class="title">
                    <h2>Last Posted Ideas</h2>
                </div>
                
                
                <?php 
                    $result = GetLastIdeas(5);
                    foreach($result as $row)
                    { 
                 ?>
                        <div class="idea-post">
                            <h2 class="idea-title"><a href='<?php echo "singleIdea.php?id=" . $row->ideaId ?>'><?php echo $row->title ?></a></h2>
                            <p class="idea-post-meta"><?php echo $row->postDate ?> by <?php echo $row->username ?></p>

                            <p>
                                <?php echo $row->description ?>
                            </p>
                        </div>
                        <div class="divider"></div>
                <?php } ?>

            </div>
            <div class="col-md-4">
                <?php include("shared/side.php") ?>
            </div>
        </div>
        <div class="post-idea">
            <div class="col-md-9">
                <p>
                    what great idea you are going to share today?
                </p>
            </div>
            <div class="col-md-3">
                <a href="addIdea.html" class="light-bulb"></a>
            </div>


        </div>
        <!-- End Content -->
    <br />
        <!-- End Footer -->
        <footer class="footer">
            <div class="footer-inner">
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2017 ideasmania.com</p>
            </div>

        </footer>
        <!-- End Footer -->
    </div>
    
</body>
</html>
