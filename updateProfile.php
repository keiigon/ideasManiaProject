<?php include("shared/header.php"); ?>
<?php include("shared/functions.php"); ?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Update Profile</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>



    <div class="container marketing">
        
        <?php
            if(!isset($_POST["firstName"]) || !isset($_POST["username"]) ||
                empty($_POST["firstName"]) || empty($_POST["username"])){
                header("refresh:0;register.php");
            }
            else{
                
                $result = CheckUser($_POST["email"], $_POST["username"], $_SESSION["userId"]);
                
                if(empty($result)){
                    $file = $_POST["oldPhoto"];

                    if(!empty($_FILES["profilePhoto"]["name"])){
                        $dir = "uploads/";
                        
                        $fileNameExtension = explode('.', $_FILES["profilePhoto"]["name"]);
                        
                        $fileName = $fileNameExtension[0];
                        
                        $fileExtension = $fileNameExtension[sizeof($fileNameExtension) - 1];
                        
                        $file = $dir . $fileName . date("dmYhis") . "." . $fileExtension;

                        move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $file);
                    }
                    
                    $savedPassword = empty($_POST["password"]) ? $_POST["oldPassword"] : $_POST["password"];

                    $result = UpdateUserProfile($_POST["firstName"], $_POST["lastName"], $_POST["username"], $savedPassword,
                                       $_POST["email"], $_POST["gender"], $_POST["country"], $file, $_SESSION["userId"]);

                    if($result == 1){
                        echo "<h1 style='color:green; text-align: center;'>your profile updated Sucessfully</h1>";
                        header("refresh:2;profile.php");
                    }
                    else{
                        echo "<h1 style='color:red; text-align: center;'>Some error has occured, try again</h1>";
                         header("refresh:3;register.php");
                    }
                }
                else{
                    echo "<div style='text-align:center'>";
                    echo "<h1 style='color:red; text-align: center;'>This email/username is already registered</h1>";
                    echo "</div>";
                }
            }

        ?>
        
        
        
        <br />
    </div>
</body>
</html>
