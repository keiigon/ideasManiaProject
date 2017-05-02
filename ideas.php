<?php include("shared/header.php") ?>
<?php include("shared/functions.php") ?>
<?php
    $categoryList = GetCategories();

    $catId = 0;

    if(isset($_GET["catId"]) && !empty($_GET["catId"])){
        $catId = $_GET["catId"];
    }

    $ideasList = GetIdeasByCategory($catId);
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
            <div class="col-md-8">
                <div>
                    <form method="get" action="ideas.php">

                        <fieldset>
                            <div class="clearfix">
                                <div class=" form-group">
                                    <div class="col-lg-2">
                                        <span>Category:</span>
                                    </div>
                                    <div class="col-lg-5">
                                        <select id="category" name="catId" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php
                                                foreach($categoryList as $c){
                                                    echo "<option value=". $c->id . ">" . $c->title . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <button tabindex="3" type="submit" class="btn btn-default">Filter Ideas</button>
                                    </div>
                                   
                                    
                                    
                                </div>
                            </div>

                            <div class="actions">
                               
                            </div>
                        </fieldset>

                    </form>
                </div>
                <br />
                <?php
                    foreach($ideasList as $idea){
                ?>
                <div class="idea-post">
                    <h2 class="idea-title"><a href="singleIdea.php?id=<?php echo $idea->ideaId ?>"><?php echo $idea->title ?></a></h2>
                    <p class="idea-post-meta">
                        <?php echo date("d-m-Y", strtotime($idea->postDate)) . " by " . $idea->username . " - " . $idea->category; ?>
                    </p>
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
</body>
</html>
