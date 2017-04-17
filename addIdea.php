<?php include("shared/header.php") ?>
<?php include("shared/functions.php") ?>
<?php
    if(!isset($_SESSION["userId"])){
        header("refresh:0;index.php");
    }

    $categoryList = GetCategories();
?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Add New Idea</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            <div class="col-md-8">
                <div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" rows="5" cols="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-9">
                                <select id="category" name="category" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                        foreach($categoryList as $c){
                                            echo "<option value=". $c->id . ">" . $c->title . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-3 control-label">Content</label>
                            <div class="col-sm-9">
                                <div id="summernote"><p>Hello Summernote</p></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="col-md-4">
                <?php include("shared/side.php") ?>
            </div>
        </div>
        <!-- End Content -->
        <br />
        <?php include("shared/footer.php") ?>
    </div>
    <script src="plugins/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote(
                {
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                });

            var markupStr = $('#summernote').summernote('code');

            var markupStr = 'hello world';
            $('#summernote').summernote('code', markupStr);
        });
    </script>
</body>
</html>
