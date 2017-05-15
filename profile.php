<?php include("shared/header.php") ?>
<?php include("shared/functions.php") ?>
<?php
    if(!isset($_SESSION["userId"])){
        header("refresh:0;index.php");
    }
    else{
        
        $user = GetUserProfile($_SESSION["userId"]);
        
        $ideasList = GetUserIdeas($_SESSION["userId"]);
        
        $image = empty($user->photo) ? 'img/img_avatar1.png' : $user->photo;
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title"><?php echo $user->name ?> Profile</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            
            <div class="col-md-8">
                <div class="title">
                    <h2>My Ideas</h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($ideasList as $idea){
                        ?>
                            <tr>
                                <td>
                                    <p class="idea-title">
                                        <a href="singleIdea.php?id=<?php echo $idea->ideaId ?>"><?php echo $idea->title; ?></a>
                                    </p>
                                </td>
                                <td><?php echo date("d-m-Y", strtotime($idea->postDate)); ?></td>
                                <td><?php echo $idea->category; ?></td>
                                <td></td>
                                <td><a href="addIdea.php?id=<?php echo $idea->ideaId ?>">Edit</a></td>
                                <td><a class="btn_delete" title="<?php echo $idea->ideaId ?>">Delete</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>


            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12  toppad  pull-right">
                        <a href="register.php">Edit Profile</a>
                        |
                        <a href="logout.php">Logout</a>
                        <br>
                        <p class=" text-info"><?php echo date("M d, Y   h:i a") ?></p>
                    </div>

                    <div class="col-xs-12 toppad">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3><?php echo $user->name ?></h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">

                                    <div class=" col-md-12 col-lg-12">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>

                                                    <td colspan="2">
                                                        <img alt="User Pic" src="<?php echo $image ?>" width="120" class="img-circle img-responsive center-block">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td><?php echo $user->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td><?php echo $user->email ?></td>
                                                </tr>

                                                <tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td><?php echo $user->gender ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Country:</td>
                                                    <td><?php echo $user->country ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Joined:</td>
                                                    <td><?php echo date("d-m-Y", strtotime($user->joinedDate)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
        <br />
        <?php include("shared/footer.php") ?>
    </div>
    <script>
        
        $(".btn_delete").click(function(){
            var id = $(this).attr("title");
            $('<div></div>').appendTo('body')
                            .html('<div><h2>Are you shure you want to delete this idea?</h2></div>')
                            .dialog({
                                modal: true,
                                title: 'Confirmation Message',
                                zIndex: 10000000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
                                buttons: {
                                    Yes: function () {
                                        deleteIdea(id);
                                        $(this).dialog("close");
                                    },
                                    No: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                }
                            });
        });
        

        function deleteIdea(id) {
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    ideaId: id,
                    action: "DeleteIdea"
                    },
                success: function(msg){
                        location.reload();
                    }
                });
        }

    </script>
</body>
</html>
