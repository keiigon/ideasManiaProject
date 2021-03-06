<?php include("shared/header.php") ?>
<?php include("shared/functions.php") ?>
<?php
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $ideaId = $_GET["id"];
        
        $idea = GetIdeaById($ideaId);
        
        $class = "";
        
        if(empty($idea->ideaId)){
            header("refresh:0;index.php");
        }
        else{
            $commentsList = GetIdeaComments($ideaId);
            if(isset($_SESSION["userId"])){
                $rating = CheckUserRating($ideaId, $_SESSION["userId"]);
                if(empty($rating)){
                    $rating = 0;
                    $disableRating = "";
                }
                else{
                    $disableRating = "disabled";
                }
            }
            else{
               $rating = 0;
               $disableRating = ""; 
            }

            if($rating == 1){
                $class = "liked";
            }
            else{
                $class = "disLiked";
            }  
        }
        
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title"><?php echo $idea->title ?></h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-9">
                        <h3>Posted at: <?php echo date("d-m-Y", strtotime($idea->postDate)) ?></h3>
                        <div style="height: 10px"></div>
                        <h3>By: <?php echo $idea->username ?></h3>
                        <div style="height: 10px"></div>
                        <h3>Category: <?php echo $idea->category ?></h3>
                    </div>
                    <div class="col-md-3">
                        <?php
                            if(isset($_SESSION["userId"])){
                        ?>
                            <div class="<?php echo $class; ?>" id="likeBtn">
                                <span id="likedNumberBox"></span>
                            </div>
                         <?php
                        }
                        ?>
                    </div>
                </div>
                <br />
                <div>
                    <?php echo $idea->content ?>
                </div>
                <div class="divider"></div>
                <?php
                    if(isset($_SESSION["userId"])){
                ?>
                <div>

                        
                </div>

                <div class="title">
                    <h2>Leave Comment</h2>
                </div>

                <div>
                    <div class="clearfix">
                        <div class="input">
                            <textarea tabindex="3" class="input-xlarge" id="comment" name="comment" rows="7" style="width:100%"></textarea>
                        </div>
                        <div style="text-align:right">
                            <button class="btn btn-success" onclick="addComment()">Comment</button>
                        </div>

                    </div>
                </div>
                <div class="divider"></div>
                <?php
                    }
                ?>
                
                <div class="title">
                    <?php
                        if(count($commentsList) > 0){
                            echo "<h2>Comments</h2>";
                        }
                    ?>
                </div>
                <?php
                    foreach($commentsList as $c){
                         $image = empty($c->photo) ? 'img/img_avatar1.png' : $c->photo;
                 ?>
                <div class="media">
                    <div class="media-left">
                        <img src="<?php echo $image ?>" class="media-object" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $c->username . " | " . date("d-m-Y", strtotime($idea->postDate)); ?></h4>
                        <p><?php echo $c->comment ?></p>
                    </div>
                </div>
                <div class="divider"></div>
                <?php
                    }
                ?>

            </div>
            <div class="col-md-4">
                <?php include("shared/side.php") ?>
            </div>
        </div>
        <!-- End Content -->
        <br />
        <?php include("shared/footer.php") ?>
    </div>
    <script>
        var id = window.location.search;
        id = id.split('=')[1];
        
        <?php echo 'var user = ' . json_encode($_SESSION["userId"]) . ';' ?>
            
        
        $(document).ready(function(){

            totalLikes(id);
            
             $("textarea#comment").focus(function(){
                $(this).removeClass("field-error");
             });
            
            $("#likeBtn").click(function(){
                
                var action = "AddRate";

                if($(this).hasClass("disLiked")){
                    //$(this).removeClass("disLiked").addClass("liked");

                    $.ajax({
                        type:"POST",
                        url:"shared/ajaxFunctions.php",
                        data:{
                            ideaId: id,
                            userId: user,
                            rate: 1,
                            action: action
                            },
                        success: function(msg){
                                //location.reload();
                                $("#likeBtn").removeClass("disLiked").addClass("liked");
                                totalLikes(id);
                            }
                    });
                }
                else{
                    //$(this).removeClass("liked").addClass("disLiked");
                    
                    $.ajax({
                        type:"POST",
                        url:"shared/ajaxFunctions.php",
                        data:{
                            ideaId: id,
                            userId: user,
                            rate: 0,
                            action: action
                            },
                        success: function(msg){
                                //location.reload();
                                $("#likeBtn").removeClass("liked").addClass("disLiked");
                                totalLikes(id);
                            }
                    });
                }
             });
            
            
        });
        
        function totalLikes(ideaId){
            var action = "GetTotalLikes";
            
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    ideaId: ideaId,
                    action: action
                },
                success: function(response){
                    var rating = response == "" ? 0 : response;
                    $("#likedNumberBox").text(rating);
                }
            });
        }
        
        function addComment(){
            var ideaId = id;
            var userId = user;
            var comment = $('#comment').val();
            var action = "AddComment";

            if(comment == ""){
                $("textarea#comment").addClass("field-error");
            }
            else{
                $("textarea#comment").removeClass("field-error");
                
                $.ajax({
                    type:"POST",
                    url:"shared/ajaxFunctions.php",
                    data:{
                        ideaId: ideaId,
                        userId: userId,
                        comment: comment,
                        action: action
                    },
                    success: function(msg){
                        location.reload();
                    }
                });
            }
            
            
        }
    </script>
</body>
</html>
