<?php include("shared/header.php"); ?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Logout</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>



    <div class="container marketing">
        
        <?php
            unset($_SESSION["userId"]);
            
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
