<?php include("shared/header.php"); ?>
<?php include("shared/functions.php"); ?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Login</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>



    <div class="container marketing">
        
        <?php
            session_unset();
            session_destroy();
            
            if(isset($_COOKIE["user"])){
                setcookie("user", "", time() - 3600, "/");
            }
        
            echo "<h1 style='color:green; text-align: center;'>you logged out Sucessfully</a></h1>";
        
            header("refresh:1;index.php");
        ?>
        
        
        
        <br />
        
    </div>
</body>
</html>
