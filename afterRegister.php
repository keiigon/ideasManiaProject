<?php include("shared/header.php"); ?>
<?php include("shared/functions.php"); ?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Registeration</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>



    <div class="container marketing">
        
        <?php
            if(!isset($_POST["firstName"]) || !isset($_POST["username"]) || !isset($_POST["password"]) ||
                empty($_POST["firstName"]) || empty($_POST["username"]) || empty($_POST["password"])){
                header("refresh:0;register.php");
            }
            else{
                
                $result = CheckUser($_POST["email"], $_POST["username"]);
                
                if(empty($result)){
                    $file = "";

                    if(!empty($_FILES["profilePhoto"]["name"])){
                        $dir = "uploads/";
                        
                        $fileNameExtension = explode('.', $_FILES["profilePhoto"]["name"]);
                        
                        $fileName = $fileNameExtension[0];
                        
                        $fileExtension = $fileNameExtension[sizeof($fileNameExtension) - 1];
                        
                        $file = $dir . $fileName . date("dmYhis") . "." . $fileExtension;

                        move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $file);
                    }

                    $result = Register($_POST["firstName"], $_POST["lastName"], $_POST["username"], $_POST["password"],
                                       $_POST["email"], $_POST["gender"], $_POST["country"], $file);

                    if($result == 1){
                        echo "<h1 style='color:green; text-align: center;'>you Registered Sucessfully, welcome to ideas mania</h1>";
                        $result = Login($_POST["username"], $_POST["password"]);
                        $_SESSION["username"] = $result->username;
                        $_SESSION["userId"] = $result->userId;
                        header("refresh:2;index.php");
                    }
                    else{
                        echo "<h1 style='color:red; text-align: center;'>Some error has occured, try register again</h1>";
                         header("refresh:3;register.php");
                    }
                }
                else{
                    echo "<div style='text-align:center'>";
                    echo "<h1 style='color:red; text-align: center;'>This email/username is already registered</h1>";
                    echo "<h3><a href='login.php'>Login</a> | <a href='register.php'>Register</a></h3>";
                    echo "</div>";
                }
            }

        ?>
        
        
        
        <br />
    </div>
</body>
</html>
