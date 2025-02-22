<?php include "meta.php"; ?>

<div class="container-fluid vh-100 bg">
    <div class="row">
        <div class="col-md-12 py-5 text-center text-white main-login-page">
            <h1>Shillong Teer Result Day | Password Reset&nbsp;<i class="zmdi zmdi-arrow-forward"></i></h1>
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
                            <div class="col-md-12">
                                <label for="username">New Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="n_pass" id="n_pass" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="email">Confirm Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="c_pass" id="c_pass" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <input type="submit" name="change" id="change" value="Change"
                                    class="btn btn-block bg-primary text-light font-weight-bold">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class='text-warning' id='show-message'>
                                    <?php
                                if(isset($_POST['change'])){

                                    $npass=$_POST["n_pass"];
                                    $cpass=$_POST["c_pass"];

                                    
                                    if($npass === $cpass){

                                        $l_query="UPDATE admin SET password='$npass'";
                                        $l_result=mysqli_query($con,$l_query);
    
                                            if($l_result){
                                              echo "<p class='text-success ghgh'>Password Updated!</p>";
                                            }else{
                                                echo"<p class='text-danger ghgh'>error!</p>";
                                            }
                                        }else{
                                            echo"<p class='text-danger ghgh'>Passwords does not match!</p>";
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