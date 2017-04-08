<?php
    if(!isset($_SESSION["userId"])){
 ?>
<div>
                    <a style="width:100%" href="login.php" class="btn btn-success btn-lg">Login</a>
                </div>
                <br />
                <div>
                    <a style="width:100%" href="register.php" class="btn btn-success btn-lg">Register</a>
                </div>
                <br />
<?php } ?>


                <div>
                    <div class="title">
                        <h2>Idea of the month</h2>
                    </div>
                    <div class="progress-box">
                        <h4><a href="singleIdea.html">Idea 1 (70 %)</a></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-box">
                        <h4><a href="singleIdea.html">Idea 2 (50 %)</a></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:50%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-box">
                        <h4><a href="singleIdea.html">Idea 3 (30 %)</a></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:30%">
                            </div>
                        </div>
                    </div>
                    <div class="progress-box">
                        <h4><a href="singleIdea.html">Idea 4 (10 %)</a></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                 aria-valuemin="0" aria-valuemax="100" style="width:10%">
                            </div>
                        </div>
                    </div>
                   
                </div>