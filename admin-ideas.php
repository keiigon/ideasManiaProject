<?php include("shared/admin-header.php") ?>
<?php include("shared/admin-functions.php") ?>
<?php
    if(!isset($_SESSION["adminId"])){
        header("refresh:0;admin-login.php");
        $ideasList = array();
    }
    else{
        $ideasList = GetAllIdeas();
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Ideas</h1>

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
                            <th>Title</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Likes</th>
                            <th>Comments</th>
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
                                <td><?php echo $idea->rating; ?></td>
                                <td><a href="admin-comments.php?id=<?php echo $idea->ideaId ?>">View Comments</a></td>
                                <td><a class="btn_delete" title="<?php echo $idea->ideaId ?>">Delete</a></td>
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
