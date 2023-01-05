<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>Update Today's Common Number (<?php echo date('d/m/Y'); ?>)</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="table mt-4">
                    <tr>
                        <td></td>
                        <td>Direct</td>
                        <td>House</td>
                        <td>Ending</td>
                    </tr>
                    <tr>
                        <td><label for="first_round">F/R</label></td>
                        <td><input type="text" name="first_direct" id="first_number"></td>
                        <td><input type="text" name="first_house" id="first_number"></td>
                        <td><input type="text" name="first_ending" id="first_number"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">S/R</label></td>
                        <td><input type="text" name="second_direct" id="first_number"></td>
                        <td><input type="text" name="second_house" id="first_number"></td>
                        <td><input type="text" name="second_ending" id="second_number"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><button class="btn btn-secondary btn-block" name="update" type="submit">Update</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $fdirect=$_POST['first_direct'];
                    $fhouse=$_POST['first_house'];
                    $fending=$_POST['first_ending'];
                    $sdirect=$_POST['second_direct'];
                    $shouse=$_POST['second_house'];
                    $sending=$_POST['second_ending'];
                    $date=date('d/m/Y');
                    if($fdirect!=null && $fhouse!=null && $shouse!=null && $sending!=null){
                        $query2="UPDATE `common_number` SET `fdirect` = '$fdirect', `fhouse` = '$fhouse', `fending` = '$fending', `sdirect` = '$sdirect', `shouse` = '$shouse', `sending` = '$sending', `date` = '$date'";
                        $output1=mysqli_query($con,$query2);
                        if($output1){
                            echo"<div class='col-md-3 p-1 text-center bg-success text-light'>Common Numbers updated successfully!</div>";
                            redirect('add-common.php');
                        }
                    }else{
                        echo"<div class='col-md-3 p-1 text-center bg-danger text-light'>Error!</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>