<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

    <div class="row mt-3">
        <div class="col-md-12 py-3 heading-1">
            <h5 class="text-center">Shillong Local Teer Night1 Previous Result</h5>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-10 tab-scroll">
            <table class="table tb-prev">
                <tr class="round-fs round-fs3 bg-primary">
                    <td>CITY</td>
                    <td>DATE</td>
                    <td>F/R</td>
                    <td>S/R</td>
                    <td>Action</td>
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
                   <td>
                       <a href="edit-prev.php?p_id=<?php echo $fassoc['id']; ?>" class="badge badge-success">Edit</a> 
                       <a href="delete-prev.php?p_id=<?php echo $fassoc['id']; ?>" class="badge badge-danger">Delete</a>
                    </td>
               </tr>
               <?php
                    }
                }
               ?>
            </table>
        </div>
    </div>
</div>