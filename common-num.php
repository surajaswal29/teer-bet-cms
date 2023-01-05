<?php include "header.php"; ?>
<?php include "nav-bar.php"; ?>

    <div class="row mt-3">
        <div class="col-md-12 py-3 heading-1">
            <h1 class="text-center">Shillong Local Teer Night | Common Number</h1>
        </div>
    </div>
    <div class="row center">
        <div class="col-md-8">
            <table class="table">
                <?php
                    $select="SELECT * FROM common_number ORDER BY `common_number`.`id` DESC";
                    $output=mysqli_query($con,$select);
                    if(mysqli_num_rows($output)>0){
                        $fetch_data=mysqli_fetch_assoc($output);
                ?>
                <tr class="round-fs">
                    <td colspan="3">
                        <?php
                        //  $today = date("d/m/Y");
                         echo"<h2>".$fetch_data['date']."</h2>";
                        ?>
                    </td>
                </tr>
                <tr class="round-fs">
                    <td colspan="3"><h2>Common Number</h2></td>
                </tr>
                <tr class="round-fs">
                    <td>Direct</td>
                    <td>House</td>
                    <td>Ending</td>
                </tr>
                <tr>
                    <td><?php echo $fetch_data['fdirect'] ?></td>
                    <td><?php echo $fetch_data['fhouse'] ?></td>
                    <td><?php echo $fetch_data['fending'] ?></td>
                </tr>
            </table>
            <hr id="hr">
            <table class="table">
                <tr class="round-fs">
                    <td>Direct</td>
                    <td>House</td>
                    <td>Ending</td>
                </tr>
                <tr>
                    <td><?php echo $fetch_data['sdirect']; ?></td>
                    <td><?php echo $fetch_data['shouse']; ?></td>
                    <td><?php echo $fetch_data['sending']; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class="col-md-10 mt-5">
            <p class="text-center"><b>Disclaimer :</b> Shillong Local Teer Night common numbers are purely based on certain calculations done using past results. There is no guarantee of the accuracy of these numbers.</p>
            <p class="text-center"><b>Note:</b> There is no making number in Teer</p>
        </div>
    </div>
    <div class="row p-4 center mt-4">
        <a class="bg-image-1 bg-pos teer-box" href="index.php">
            <h5>TEER RESULT</h5>
        </a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php">
            <h5>DREAM NUMBER</h5>
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