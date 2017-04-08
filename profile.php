<?php include("shared/header.php") ?>
    <div class="page-title">

        <div class="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h1 class="page-header-title">Tarek Iraqi Profile</h1>

            </div>
            <!-- end: Container  -->

        </div>

    </div>
    <div class="container marketing">
        <!-- Content -->
        <div class="row">
            
            <div class="col-md-8">
                <div class="title">
                    <h2>My Ideas</h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><p class="idea-title"><a href="singleIdea.html"> the great idea of All Time</a></p></td>
                            <td>22/3/2017</td>
                            <td>Art</td>
                            <td></td>
                            <td><a href="singleIdea.html">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td><p class="idea-title"><a href="singleIdea.html"> the great idea of All Time</a></p></td>
                            <td>22/3/2017</td>
                            <td>Art</td>
                            <td></td>
                            <td><a href="singleIdea.html">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td><p class="idea-title"><a href="singleIdea.html"> the great idea of All Time</a></p></td>
                            <td>22/3/2017</td>
                            <td>Art</td>
                            <td></td>
                            <td><a href="singleIdea.html">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td><p class="idea-title"><a href="singleIdea.html"> the great idea of All Time</a></p></td>
                            <td>22/3/2017</td>
                            <td>Art</td>
                            <td></td>
                            <td><a href="singleIdea.html">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td><p class="idea-title"><a href="singleIdea.html"> the great idea of All Time</a></p></td>
                            <td>22/3/2017</td>
                            <td>Art</td>
                            <td></td>
                            <td><a href="singleIdea.html">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                    </tbody>
                </table>


            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12  toppad  pull-right">
                        <a href="register.html">Edit Profile</a>
                        |
                        <a href="register.html">Logout</a>
                        <br>
                        <p class=" text-info">May 05,2014,03:00 pm </p>
                    </div>

                    <div class="col-xs-12 toppad">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3>Tarek Iraqi</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>

                                                    <td colspan="2">
                                                        <img alt="User Pic" src="img/img_avatar1.png" width="120" class="img-circle img-responsive center-block">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>Tarek Iraqi</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>tarek.iraqi@gmail.com</td>
                                                </tr>

                                                <tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>Country:</td>
                                                    <td>Egypt</td>
                                                </tr>
                                                <tr>
                                                    <td>Joined:</td>
                                                    <td>21/3/2017</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
        <br />
        <!-- End Footer -->
        <footer class="footer">
            <div class="footer-inner">
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2017 ideasmania.com</p>
            </div>

        </footer>
        <!-- End Footer -->
    </div>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
