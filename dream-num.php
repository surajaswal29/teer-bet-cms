<?php include "header.php"; ?>
<?php include "nav-bar.php"; ?>

<div class="row mt-3">
        <div class="col-md-12 py-3 heading-1">
            <h1 class="text-center">Teer Dream numbers</h1>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-10 tab-scroll">
            <table class="table">
                <tr class="round-fs round-fs3">
                    <td>Dream</td>
                    <td>Numbers</td>
                    <td>House</td>
                    <td>Ending</td>
                </tr>
                <?php

                $sql="SELECT * FROM dream_number";
                $result=mysqli_query($con,$sql);
                if(mysqli_num_rows($result)>0){

                    while($fassoc=mysqli_fetch_assoc($result)){
                ?>
               <tr>
                   <td><?php echo $fassoc['dream']; ?></td>
                   <td><?php echo $fassoc['numbers']; ?></td>
                   <td><?php echo $fassoc['house']; ?></td>
                   <td><?php echo $fassoc['ending']; ?></td>
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
        <a class="bg-image-5 bg-pos teer-box" href="prev-result.php">
            <h5>PREVIOUS RESULT</h5>
        </a>
</div>
    <div class="row footer">
        <div class="col-md-12 bg-dark text-light py-2">
            &copy; shillonglocalteernight1.in
        </div>
    </div>
</div>