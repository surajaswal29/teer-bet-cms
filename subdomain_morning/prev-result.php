<?php include "header.php";
 ?>

<div class="container-fluid vh-100" style="overflow-y: scroll; overflow-x: hidden;">
    <?php include "nav-bar.php"; ?>

    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="w-100">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="bg-light">
                            <td colspan="<?php echo ($timePeriod === 'day') ? '6' : '4'; ?>">RESULTS</td>
                        </tr>
                        <tr class="teer-bg-green text-black">
                            <td>CITY</td>
                            <td>DATE</td>
                            <td>F/R</td>
                            <td>S/R</td>
                            <?php if ($timePeriod === 'day') { ?>
                            <td>T/R</td>
                            <td>FT/R</td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch results only for '$timePeriod' time period
                        $sql = "SELECT city, date, first_round, second_round, third_round, fourth_round 
                                FROM prev_result 
                                WHERE time_period = '$timePeriod' 
                                ORDER BY date DESC";
                        $result = mysqli_query($con, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_round']); ?></td>
                            <td><?php echo htmlspecialchars($row['second_round']); ?></td>
                            <?php if ($timePeriod === 'day') { ?>
                            <td><?php echo htmlspecialchars($row['third_round']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['fourth_round']); ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='".(($timePeriod === 'day') ? '6' : '4')."' class='text-center text-danger'>No results available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="row p-4 d-none d-md-flex center mt-4">
        <a class="bg-image-1 bg-pos teer-box" href="common-num.php"></a>
        <a class="bg-image-tr bg-pos teer-box" href="index.php"></a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php"></a>
    </div>

    <?php include "down-section.php"; ?>
</div>

<!-- Footer -->
<?php include "footer.php"; ?>