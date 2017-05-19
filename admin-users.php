<?php include("shared/admin-header.php") ?>
<?php include("shared/admin-functions.php") ?>
<?php
    if(!isset($_SESSION["adminId"])){
        header("refresh:0;admin-login.php");
        $usersList = array();
    }
    else{
        if($_SESSION["isSuperAdmin"] == 0){
            header("refresh:0;admin-ideas.php");
        }
        $usersList = GetAllUsers();
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Users</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>

    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            
            <div class="col-md-12">
                <div class="title">
                    <h2>Add/Edit User</h2>
                </div>
                <br />
                <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="userId" name="userId" value=""/>
                                <input type="text" class="form-control" id="username" name="username"
                                       value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="oldPassword" name="oldPassword" value=""/>
                                <input type="text" class="form-control" id="password" name="password"
                                       value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Super Admin</label>
                            <div class="col-sm-10" style="text-align:center">
                                <input type="checkbox" style="width:3%" class="form-control" id="isSuperAdmin" name="isSuperAdmin" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-success" onclick="save()">Save</button>
                                <button type="button" class="btn btn-default" onclick="resetContent()">Clear</button>
                            </div>
                        </div>
                </form>
                <div class="green-separator"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Is Super Admin</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($usersList as $u){
                        ?>
                            <tr>
                                <td>
                                    <p class="idea-title">
                                        <?php echo $u->username; ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                        if($u->isSuperAdmin == 1){
                                            $checked = "checked";
                                        }
                                        else{
                                            $checked = "";
                                        }
                                    ?>
                                    <input type="checkbox" <?php echo $checked ?> />
                                </td>
                                <td><a class="btn_edit" title="<?php echo $u->id ?>" >Edit</a></td>
                                <?php if($u->id != 1){ ?>
                                <td><a class="btn_delete" title="<?php echo $u->id ?>">Delete</a></td>
                                <?php } ?>
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
        
        $(document).ready(function () {
            
            $("input#username").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                  }
            });
            
            $("input#password").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == "" && $("input#oldPassword").val() == ""){
                    $(this).addClass("field-error");
                  }
            });
            
            $(".btn_edit").click(function(){
                var id = $(this).attr("title");
                
                $.ajax({
                    type:"POST",
                    url:"shared/ajaxFunctions.php",
                    data:{
                        adminId: id,
                        action: "GetUser"
                    },
                    success: function(msg){
                        var user = JSON.parse(msg);
                        $("input#userId").val(user.id);
                        $("input#username").val(user.username);
                        $("input#oldPassword").val(user.password);
                        if(user.isSuperAdmin == 1){
                            $("input#isSuperAdmin").prop("checked", true);
                        }
                        else{
                            $("input#isSuperAdmin").prop("checked", false);
                        }
                    }
                });
                
                
            });
            
            $(".btn_delete").click(function(){
                var id = $(this).attr("title");
                $('<div></div>').appendTo('body')
                                .html('<div><h2>Are you shure you want to delete this user?</h2></div>')
                                .dialog({
                                    modal: true,
                                    title: 'Confirmation Message',
                                    zIndex: 10000000,
                                    autoOpen: true,
                                    width: 'auto',
                                    resizable: false,
                                    buttons: {
                                        Yes: function () {
                                            deleteUser(id);
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
});
        
        function save(){
            if(validateForm()){
                
                var id = $("input#userId").val();
                var username = $("input#username").val();
                var password = $("input#password").val();
                var oldPassword = $("input#oldPassword").val();
                var isSuperAdmin = ($("input#isSuperAdmin").prop("checked") == true) ? 1 : 0;
                
                
                if(id == ""){
                    $.ajax({
                        type:"POST",
                        url:"shared/ajaxFunctions.php",
                        data:{
                            username: username,
                            password: password,
                            isSuperAdmin: isSuperAdmin,
                            action: "AddNewUser"
                            },
                        success: function(msg){
                                location.reload();
                            }
                    });
                }
                else{
                    $.ajax({
                        type:"POST",
                        url:"shared/ajaxFunctions.php",
                        data:{
                            username: username,
                            password: password == "" ? oldPassword : password,
                            isSuperAdmin: isSuperAdmin,
                            adminId: id,
                            action: "UpdateUser"
                            },
                        success: function(msg){
                                location.reload();
                            }
                    });
                }
                
            }
        }
        
        function validateForm(){
            var username = $("input#username").val();
            var password = $("input#password").val();
            var oldPassword = $("input#oldPassword").val();

            if(username == "" || (password == "" && oldPassword == "")){
                
                if(username == ""){
                    $("input#username").addClass("field-error");
                }
                
                if(password == "" && oldPassword == ""){
                    $("input#password").addClass("field-error");
                }
                
                return false;
            }
            else{
                return true;
            }
        }
        
        function resetContent(){
            $("input#username").val("");
            $("input#username").removeClass("field-error");
            
            $("input#password").val("");
            $("input#password").removeClass("field-error");
            
            $("input#isSuperAdmin").prop("checked", "");
        }   

        function deleteUser(id) {
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    adminId: id,
                    action: "DeleteUser"
                    },
                success: function(msg){
                        location.reload();
                    }
                });
        }

    </script>
</body>
</html>