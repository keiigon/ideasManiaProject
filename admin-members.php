<?php include("shared/admin-header.php") ?>
<?php include("shared/admin-functions.php") ?>
<?php
    if(!isset($_SESSION["adminId"])){
        header("refresh:0;admin-login.php");
        $membersList = array();
    }
    else{
        $membersList = GetAllMembers();
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Members</h1>

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
                            <th></th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Join Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($membersList as $m){
                                $image = empty($m->photo) ? 'img/img_avatar1.png' : $m->photo;
                                $gender = $m->gender == 1 ? "Male" : "Female";
                        ?>
                            <tr>
                                <td>
                                    <img alt="User Pic" src="<?php echo $image ?>" width="50" class="img-circle img-responsive center-block">
                                </td>
                                <td>
                                    <?php echo $m->name ?>
                                </td>
                                <td>
                                    <?php echo $m->username ?>
                                </td>
                                <td>
                                    <?php echo $m->email ?>
                                </td>
                                <td>
                                    <?php echo $gender ?>
                                </td>
                                <td>
                                    <?php echo $m->country ?>
                                </td>
                                <td><?php echo date("d-m-Y", strtotime($m->joinedDate)); ?></td>
                                <td><a class="btn_delete" title="<?php echo $m->id ?>">Delete</a></td>
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
                            .html('<div><h2>Are you shure you want to delete this member?</h2></div>')
                            .dialog({
                                modal: true,
                                title: 'Confirmation Message',
                                zIndex: 10000000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
                                buttons: {
                                    Yes: function () {
                                        deleteMember(id);
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
        

        function deleteMember(id) {
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    memberId: id,
                    action: "DeleteMember"
                    },
                success: function(msg){
                        location.reload();
                    }
                });
        }

    </script>
</body>
</html>
