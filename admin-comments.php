<?php include("shared/admin-header.php") ?>
<?php include("shared/admin-functions.php") ?>
<?php
    if(!isset($_SESSION["adminId"])){
        header("refresh:0;admin-login.php");
        $commentsList = array();
    }
    else{
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $commentsList = GetIdeaComments($_GET["id"]);
            $IdeaTitle = GetIdeaTitle($_GET["id"]);
        }
        else{
            header("refresh:0;admin-ideas.php");
        }
        
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Comments of idea: <?php echo $IdeaTitle ?></h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($commentsList as $c){
                        ?>
                            <tr>
                                <td><?php echo date("d-m-Y", strtotime($c->postedDate)); ?></td>
                                <td><?php echo $c->comment; ?></td>
                                <td><?php echo $c->username; ?></td>
                                <td><a class="btn_delete" title="<?php echo $c->id ?>">Delete</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>


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
                            .html('<div><h2>Are you shure you want to delete this comment?</h2></div>')
                            .dialog({
                                modal: true,
                                title: 'Confirmation Message',
                                zIndex: 10000000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
                                buttons: {
                                    Yes: function () {
                                        deleteComment(id);
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
        

        function deleteComment(id) {
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    commentId: id,
                    action: "DeleteComment"
                    },
                success: function(msg){
                        location.reload();
                    }
                });
        }

    </script>
</body>
</html>
