<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h2>Update Dream Numbers</h2>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-8">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="table mt-4">
                    <tr>
                        <td><label for="first_round">Dream</label></td>
                        <td><input type="text" name="dream" id="first_number"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">Numbers</label></td>
                        <td><input type="text" name="numbers" id="second_number"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">House</label></td>
                        <td><input type="text" name="house" id="second_number"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">Ending</label></td>
                        <td><input type="text" name="ending" id="second_number"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn btn-secondary btn-block" name="update" type="submit">Update Dream Numbers</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $ftime=$_POST['dream'];
                    $fnumber=$_POST['numbers'];
                    $stime=$_POST['house'];
                    $snumber=$_POST['ending'];

                    $query1="INSERT INTO dream_number(dream,numbers,house,ending) 
                             VALUES('$ftime','$fnumber','$stime','$snumber')";
                    $output=mysqli_query($con,$query1);
                    if($output){
                        echo"<div class='col-md-3 p-1 text-center bg-success text-light'>Dream updated successfully!</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>