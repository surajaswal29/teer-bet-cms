<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<?php
   $previous_id=$_GET['p_id'];

   $select_prev="SELECT * FROM prev_result WHERE id='$previous_id'";
   $output_prev=mysqli_query($con,$select_prev);
   if(mysqli_num_rows($output_prev)>0){
       $prev_res=mysqli_fetch_assoc($output_prev);
?>

<div class="container">
    <div class="row">
        <div class="col-md-9 text-center mt-5">
            <h3>Edit Previous Result for Date: <?php echo $prev_res['date']; ?></h3>
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
                        <td><input type="text" name="date" value="<?php echo $prev_res['date']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">F/R</label></td>
                        <td><input type="text" name="first_number" value="<?php echo $prev_res['fr']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="second_round">S/R</label></td>
                        <td><input type="text" name="second_number" value="<?php echo $prev_res['sr']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><button class="btn btn-secondary btn-block" name="update" type="submit">Save Edit</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $ftime=$_POST['date'];
                    $fnumber=$_POST['first_number'];
                    $snumber=$_POST['second_number'];

                    if($ftime!=null && $fnumber!=null &&  $snumber!=null){
                        $query1="UPDATE `prev_result` SET `date` = '$ftime', `fr` = '$fnumber', `sr` = '$snumber' WHERE id='$previous_id'";
                        $output=mysqli_query($con,$query1);
                        if($output){
                            echo"<div class='col-md-3 p-1 text-center bg-success text-light'>Edit Done!</div>";
                            redirect('edit-prev.php?p_id='.$prev_res['id']);
                        }
                    }else{
                        echo"<div class='col-md-3 p-1 text-center bg-danger text-light'>Error!</div>";
                    }
                }
   }
            ?>
        </div>
    </div>
</div>