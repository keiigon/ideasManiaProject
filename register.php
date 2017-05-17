<?php include("shared/header.php") ?>
<?php include("shared/functions.php"); ?>
<?php
    if(isset($_SESSION["userId"])){
        $user = GetUserProfile($_SESSION["userId"]);
        $action = "updateProfile.php";
    }else{
        $user = (object)array();
        $user->firstname = "";
        $user->password = "";
        $user->lastname = "";
        $user->username = "";
        $user->email = "";
        $user->gender = "";
        $user->countryId = "";
        $user->photo = "";
        $action = "afterRegister.php";
    }
?>
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
        <!-- Content -->
        <div class="row">
            <div class="col-md-8">
                <div>
                    <form onsubmit="return validateForm()" class="form-horizontal" role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="firstName" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                
                                <input type="text" class="form-control" id="firstName" name="firstName" 
                                       value="<?php echo $user->firstname; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastName" name="lastName" 
                                       value="<?php echo $user->lastname; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email"
                                       value="<?php echo $user->email; ?>">
                                <div id="notValidEmail" style="color:red">Not valid email format</div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-9">
                                <select id="country" name="country" class="form-control">
                                    <option value="">Select Country</option>
                                    <?php
                                        $countries = GetCountries();
                                    
                                        foreach($countries as $c){
                                            $selected = "";
                                            if($c->id == $user->countryId) {
                                                $selected = " selected='selected'";
                                            }
                                            echo "<option value=" . $c->id . $selected . ">" . $c->title . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-9">
                                <?php
                                    $male = "checked";
                                    $female = "";
                                    if($user->gender == "Female"){
                                        $male = "";
                                        $female = "checked";
                                    }
                                ?>
                                
                                <input type="radio" id="male" name="gender" value="1" <?php echo $male; ?> >Male
                                <input type="radio" id="female" name="gender" value="2" <?php echo $female; ?> >Female
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username"
                                       value="<?php echo $user->username; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                                <input type="hidden" name="oldPassword" id="oldPassword" value="<?php echo $user->password; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profilePhoto" class="col-sm-3 control-label">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="profilePhoto" name="profilePhoto">
                                <input type="hidden" id="oldPhoto" name="oldPhoto" value="<?php echo $user->photo; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" onclick="resetForm()">Clear</button>
                                
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
    <script>
        $(document).ready(function(){
            
            $("#notValidEmail").hide();
            
            $("input#firstName").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
            });
            
            $("input#email").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
                else{
                    if(!validateEmailFormat()){
                        $("#notValidEmail").show();
                        $(this).addClass("field-error");
                    }
                    else{
                        $("#notValidEmail").hide();
                        $(this).removeClass("field-error");
                    }
                }
            });
            
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
            
            $("select#country").focus(function(){
                $(this).removeClass("field-error");
            })
            .blur(function(){
                if($(this).val() == ""){
                    $(this).addClass("field-error");
                }
            });
        });
        
        function validateEmailFormat(){
            var emailRegx = /^([A-Za-z0-9_\-\.])+\@(([A_Za-z0-9\-])+\.)+([A-Za-z0-9]{2,4})$/;
            
            var email = $("input#email").val();
            
            return emailRegx.test(email);
        }
        
        function validateForm(){
            var firstName = $("input#firstName").val();
            var email = $("input#email").val();
            var username = $("input#username").val();
            var password = $("input#password").val();
            var oldPassword = $("input#oldPassword").val();
            var country = $("select#country").val();
            
            
            
            if(firstName == "" || email == "" || username == "" || country == "" ||
               (password == "" && oldPassword == "")){
                
                if(firstName == ""){
                    $("input#firstName").addClass("field-error");
                }
                
                if(email == ""){
                    $("input#email").addClass("field-error");
                }
                
                if(username == ""){
                    $("input#username").addClass("field-error");
                }
                
                if(password == "" && oldPassword == ""){
                    $("input#password").addClass("field-error");
                }
             
                if(country == ""){
                    $("select#country").addClass("field-error");
                }   
                
                return false;
            }
            
            if(!validateEmailFormat()){
                return false;
            }
            
        }
        
        function resetForm(){
            $("input#firstName").val("");
            $("input#firstName").removeClass("field-error");
            
            $("input#lastName").val("");
            
            $("input#email").val("");
            $("input#email").removeClass("field-error");
            $("#notValidEmail").hide();
            
            $("select#country").val("");
            $("select#country").removeClass("field-error");
            
            $("input:radio[name=gender]")[0].checked = true;
            
            $("input#username").val("");
            $("input#username").removeClass("field-error");
            
            $("input#password").val("");
            $("input#password").removeClass("field-error");
            
            $("input#oldPassword").val("");
            
            $("input#profilePhoto").val("");
            
            $("input#oldPhoto").val("");
        }
    </script>
</body>
</html>
