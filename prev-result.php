<?php include "header.php"; ?>
<?php include "nav-bar.php"; ?>

<div class="row mt-3">
        <div class="col-md-12 py-3 heading-1">
            <h1 class="text-center">Shillong Local Teer Night1 Previous Result</h1>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-10 tab-scroll">
            <table class="table tb-prev">
                <tr class="round-fs round-fs3">
                    <td>CITY</td>
                    <td>DATE</td>
                    <td>F/R</td>
                    <td>S/R</td>
                </tr>
                <?php

                $sql="SELECT * FROM prev_result ORDER BY `prev_result`.`id` DESC";
                $result=mysqli_query($con,$sql);
                if(mysqli_num_rows($result)>0){

                    while($fassoc=mysqli_fetch_assoc($result)){
                ?>
               <tr>
                   <td>Shillong</td>
                   <td><?php echo $fassoc['date']; ?></td>
                   <td><?php echo $fassoc['fr']; ?></td>
                   <td><?php echo $fassoc['sr']; ?></td>
               </tr>
               <?php
                    }
                }
               ?>
            </table>
        </div>
    </div>
    <div class="row p-4 center mt-4">
        <a class="bg-image-1 bg-pos teer-box" href="index.php">
            <h5>TEER RESULT</h5>
        </a>
        <a class="bg-image-2 bg-pos teer-box" href="common-num.php">
            <h5>COMMON NUMBER</h5>
        </a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php">
            <h5>DREAM NUMBER</h5>
        </a>
    </div>
    <div class="row footer">
        <div class="col-md-12 bg-dark text-light py-2">
            &copy; shillonglocalteernight1.in
        </div>
    </div>
</div>