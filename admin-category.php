<?php include("shared/admin-header.php") ?>
<?php include("shared/admin-functions.php") ?>
<?php
    if(!isset($_SESSION["adminId"])){
        header("refresh:0;admin-login.php");
        $categoryList = array();
    }
    else{
        $categoryList = GetCategories();
    }
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Categories</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>

    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            
            <div class="col-md-12">
                <div class="title">
                    <h2>Add/Edit Category</h2>
                </div>
                <br />
                <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="title" class="col-sm-1 control-label">Title</label>
                            <div class="col-sm-11">
                                <input type="hidden" id="categoryId" name="categoryId" value=""/>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-11">
                                <button type="button" class="btn btn-success" onclick="save()">Save</button>
                                <button type="button" class="btn btn-default" onclick="resetContent()">Clear</button>
                            </div>
                        </div>
                </form>
                <div class="green-separator"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($categoryList as $c){
                        ?>
                            <tr>
                                <td>
                                    <p class="idea-title">
                                        <?php echo $c->title; ?>
                                    </p>
                                </td>
                                <td><a class="btn_edit" title="<?php echo $c->id . "," . $c->title ?>" >Edit</a></td>
                                <?php if($c->id != 3) { ?>
                                <td><a class="btn_delete" title="<?php echo $c->id ?>">Delete</a></td>
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
            
            $("input#title").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
            });
            
            $(".btn_edit").click(function(){
                var string = $(this).attr("title");
                var id = string.split(',')[0];
                var title = string.split(',')[1];
                
                $("#categoryId").val(id);
                $("#title").val(title);
                
            });
            
            $(".btn_delete").click(function(){
                var id = $(this).attr("title");
                $('<div></div>').appendTo('body')
                                .html('<div><h2>Are you shure you want to delete this category?</h2></div>')
                                .dialog({
                                    modal: true,
                                    title: 'Confirmation Message',
                                    zIndex: 10000000,
                                    autoOpen: true,
                                    width: 'auto',
                                    resizable: false,
                                    buttons: {
                                        Yes: function () {
                                            deleteCategory(id);
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
                
                var id = $("input#categoryId").val();
                var title = $("input#title").val();
                
                if(id == ""){
                    $.ajax({
                        type:"POST",
                        url:"shared/ajaxFunctions.php",
                        data:{
                            title: title,
                            action: "AddNewCategory"
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
                            title: title,
                            categoryId: id,
                            action: "UpdateCategory"
                            },
                        success: function(msg){
                                location.reload();
                            }
                    });
                }
                
            }
        }
        
        function validateForm(){
            var title = $("input#title").val();

            if(title == ""){
                $("input#title").addClass("field-error");
                
                return false;
            }
            else{
                return true;
            }
        }
        
        function resetContent(){
            $("input#title").val("");
            $("input#title").removeClass("field-error");
        }   

        function deleteCategory(id) {
            $.ajax({
                type:"POST",
                url:"shared/ajaxFunctions.php",
                data:{
                    categoryId: id,
                    action: "DeleteCategory"
                    },
                success: function(msg){
                        location.reload();
                    }
                });
        }

    </script>
</body>
</html>