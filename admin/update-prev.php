<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 text-center mt-5">
            <h3>Update Previous Result</h3>
        </div>
        <div class="col-md-3 mt-5">
            <a href="view-prev.php" class="btn btn-block btn-warning">View Previous Result</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="table mt-4">
                    <tr>
                        <td><label for="text">Date</label></td>
                        <td><input type="text" name="date" id="date"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">F/R</label></td>
                        <td><input type="text" name="first_number" id="first_number"></td>
                    </tr>
                    <tr>
                        <td><label for="second_round">S/R</label></td>
                        <td><input type="text" name="second_number" id="second_number"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><button class="btn btn-secondary btn-block" name="update" type="submit">Update</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $ftime=$_POST['date'];
                    $fnumber=$_POST['first_number'];
                    $snumber=$_POST['second_number'];

                    if($ftime!=null && $fnumber!=null &&  $snumber!=null){
                        $query1="INSERT INTO prev_result(date,fr,sr,city) 
                                 VALUES('$ftime','$fnumber','$snumber','Shillong')";
                        $output=mysqli_query($con,$query1);
                        if($output){
                            echo"<div class='col-md-3 p-1 text-center bg-success text-light'>Result updated successfully!</div>";
                        }
                    }else{
                        echo"<div class='col-md-3 p-1 text-center bg-danger text-light'>Error!</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>