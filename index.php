<?php include "header.php"; ?>
<?php include "nav-bar.php"; ?>

    <div class="row mt-5">
        <div class="col-md-12 py-3 heading-1">
            <h1 class="text-center">Shillong Local Teer Night1</h1>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-8">
            <table class="table">
                <?php
                    $select="SELECT * FROM result_update ORDER BY `result_update`.`id` DESC";
                    $output=mysqli_query($con,$select);
                    if(mysqli_num_rows($output)>0){
                        $fetch_data=mysqli_fetch_assoc($output);
                ?>
                <tr class="round-fs">
                    <td colspan="2">
                        <?php
                        //  $today = date("d/m/Y");
                         echo"<h2>Today's Result (".$fetch_data['date'].")</h2>";
                        ?>
                    </td>
                </tr>
                <tr class="round-fs">
                    <td>F/R (<?php echo $fetch_data['f_time'] ?>)</td>
                    <td>S/R (<?php echo $fetch_data['s_time'] ?>)</td>
                </tr>
                <tr>
                    <td>
                        <?php 
                            if($fetch_data['f_number']<10){
                                echo $fetch_data['f_number'];
                            }else{
                                echo $fetch_data['f_number'];
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($fetch_data['s_number']<10){
                                echo $fetch_data['s_number'];
                            }else{
                                echo $fetch_data['s_number'];
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    }else{
                        echo"<tr>
                            <td>Result for today Will be Updated Soon.</td>
                        </tr>";
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
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php">
            <h5>DREAM NUMBER</h5>
        </a>
        <a class="bg-image-4 bg-pos teer-box disp-none" href="index.php">
            <h5>PREDICT TARGET</h5>
        </a>
        <a class="bg-image-6 bg-pos teer-box" href="index.php">
            <h5>DEALS</h5>
        </a>
        <a class="bg-image-7 bg-pos teer-box disp-none" href="index.php">
            <h5>ANALYTICS</h5>
        </a>
        <a class="bg-image-8 bg-pos teer-box disp-none" href="prev-result.php">
            <h5>CALENDAR</h5>
        </a>
        <a class="bg-image-9 bg-pos teer-box disp-none" href="index.php">
            <h5>TARGET APP</h5>
        </a>
    </div>
    <div class="row footer">
        <div class="col-md-12 bg-light text-dark py-2">
            designed & developed by <a href="https://surajaswal.dev">surajaswal.dev</a> 
        </div>
        <div class="col-md-12 bg-dark text-light py-2">
            &copy; shillonglocalteernight1.in
            &nbsp; &nbsp;
            <a href="//www.dmca.com/Protection/Status.aspx?ID=25b43f21-c9c2-4717-bf70-fece91a327bb" title="DMCA.com Protection Status" class="dmca-badge"> 
                <img src ="https://images.dmca.com/Badges/dmca_protected_sml_120l.png?ID=25b43f21-c9c2-4717-bf70-fece91a327bb"  alt="DMCA.com Protection Status" />
            </a>  
        </div>
        
        <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
    </div>
</div>
</body>
</html>