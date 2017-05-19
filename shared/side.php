
<?php
    $likedIdeas = GetMostLikedIdeas();
?>
<?php
    if(!isset($_SESSION["userId"])){
 ?>
<div>
                    <a style="width:100%" href="login.php" class="btn btn-success btn-lg">Login</a>
                </div>
                <br />
                <div>
                    <a style="width:100%" href="register.php" class="btn btn-success btn-lg">Register</a>
                </div>
                <br />
<?php } ?>


                <div>
                    <div class="title">
                        <h2>Most liked ideas</h2>
                    </div>
                    <br />
                    <?php foreach($likedIdeas as $l){ ?>
                        <div class="likedIdeas">
                            <h3><a href="singleIdea.php?id=<?php echo $l->ideaId ?>" ><?php echo $l->title ?></a> (<?php echo $l->rating ?>) <img src="img/likeColored.png" width="25px" /></h3>
                        </div>
                        <div class="green-separator"></div>
                    <?php } ?>
                   
                </div>