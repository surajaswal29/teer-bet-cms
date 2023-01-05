<?php include "header-file.php"; ?>

<div class="container-fluid vh-100 bg">
    <div class="row">
        <div class="col-md-12 py-5 text-center text-white main-login-page">
            <h1>Shillong Local Teer Night 1 | Admin Panel&nbsp;<i class="zmdi zmdi-arrow-forward"></i></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 py-4">
            <div class="form-wrap-1">
                <!-- <div class="form-img">
                    <img src="images/218.jpg" alt="logo">
                </div> -->
                <div class="wavefire-form shadow">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="uname" id="uname" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="email">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" name="pass" id="pass" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <input type="submit" name="login" id="login" value="Login" class="btn btn-block bg-primary text-light font-weight-bold">
                            </div>
                            <div class="col-md-6">
                                <a href="fg-password.php" class="fg-pass">Forgot password?</a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class='text-warning' id='show-message'>
                                    <?php
                                if(isset($_POST['login'])){

                                    $username=$_POST["uname"];
                                    $password=$_POST["pass"];

                                    $l_query="SELECT * FROM admin WHERE username='$username' and password='$password'";
                                    $l_result=mysqli_query($con,$l_query);

                                    if(mysqli_num_rows($l_result)>0){
                                            $l_row=mysqli_fetch_assoc($l_result);
                                            $_SESSION['uname']=$l_row['username'];
                                            redirect("teer.php");
                                        }else{
                                            echo"<p class='text-danger ghgh'>Username or Password is not correct!</p>";
                                            }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <h1 class="watermark">@Suraj_Aswal</h1>
        </div>
    </div> -->
</div>
</body>
</html>