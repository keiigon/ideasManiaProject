<?php include("shared/header.php"); ?>
<?php include("shared/functions.php"); ?>
<?php 
    if(isset($_SESSION["userId"])){
        header("Location: index.php");
    }
?>
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
    
            $form = '<form onsubmit="return validateForm()" class="form-signin" method="post" action="login.php">
                     <h2 class="form-signin-heading">Login</h2>
                     <br />
                     <label for="inputEmail" class="sr-only">Email address</label>
                     <input type="text" id="username" name="username" class="form-control" autofocus="">
                     <br />
                     <label for="inputPassword" class="sr-only">Password</label>
                     <input type="password" name="password" id="inputPassword" class="form-control">
                     <div class="checkbox">
                     <label>
                     <input type="checkbox" name="rememberMe" value="remember"> Remember me
                     </label>
                     </div>
                     <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                     <br/>
                     <h4>You do not have an account <a href="register.php">Register</a></h4>
                     </form>';

            if(isset($_POST["username"])){
                $email = $_POST["username"];
                $password = $_POST["password"];
                if(empty($email) || empty($password)){
                    $message = "Please fill all required data.";
                    
                    echo $form;
                    echo "<h3 style='color:red; text-align: center;'>$message</h3>";
                }
                else{
                    $result = Login($email, $password);

                    if(empty($result->userId)){
                        $message = "Wrong username or password.";
                        echo $form;
                        echo "<h3 style='color:red; text-align: center;'>$message</h3>";
                    }
                    else{
                        $message = "Loged Sucessfully";
                        echo "<h1 style='color:green; text-align: center;'>$message</h1>";
                        
                        $_SESSION["username"] = $result->username;
                        $_SESSION["userId"] = $result->userId;
                        
                        if(isset($_POST["rememberMe"]) && $_POST["rememberMe"] == "remember"){
                            $data = $result->userId . "," . $result->username;
                            setcookie("user", $data, time() + (86400 * 7), "/");
                        }

                        header("refresh:1;index.php");
                    }
                }
            }
            else{
                echo $form;
            } 
        ?>
        
        <br />
        
    </div>

<script>
        $(document).ready(function(){

            $("input#username").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
            });
            
            $("input#inputPassword").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
            });
            
        });
    
    function validateForm(){
            var username = $("input#username").val();
            var inputPassword = $("input#inputPassword").val();    
            
            if(username == "" || inputPassword == ""){
                
                if(username == ""){
                    $("input#username").addClass("field-error");
                }
                
                if(username == ""){
                    $("input#inputPassword").addClass("field-error");
                }
                
                return false;
            }
    }
</script>
</body>
</html>
