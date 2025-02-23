<?php include "header.php"; ?>

<div class="container-fluid vh-100" style="overflow-y: scroll; overflow-x: hidden;">
    <?php include "nav-bar.php"; ?>

    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 25px;">
            <div class="w-100">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="bg-light">
                            <td colspan="6">RESULTS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="teer-bg-green text-black">
                            <td>CITY</td>
                            <td>DATE</td>
                            <td>F/R</td>
                            <td>S/R</td>
                            <td>T/R</td>
                            <td>FT/R</td>
                        </tr>
                        <?php
                // Fetch results only for 'day' time period
                $sql = "SELECT * FROM prev_result WHERE time_period = 'day' ORDER BY `date` DESC";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($row['date'])); ?></td>
                            <td><?php echo htmlspecialchars($row['first_round']); ?></td>
                            <td><?php echo htmlspecialchars($row['second_round']); ?></td>
                            <td><?php echo isset($row['third_round']) ? htmlspecialchars($row['third_round']) : '-'; ?>
                            </td>
                            <td><?php echo isset($row['fourth_round']) ? htmlspecialchars($row['fourth_round']) : '-'; ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-danger'>No results available</td></tr>";
                }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row p-4 d-none d-md-flex center mt-4">
        <a class="bg-image-1 bg-pos teer-box" href="common-num.php">

        </a>
        <a class="bg-image-2 bg-pos teer-box" href="index.php">
        </a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php">

        </a>
    </div>
<?php include "down-section.php"; ?>
</div>
<!-- Footer -->
<?php include "footer.php"; ?>