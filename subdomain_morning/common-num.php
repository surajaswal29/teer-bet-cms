<?php include "header.php"; ?>

<div class="container-fluid vh-100">
    <?php include "nav-bar.php"; ?>

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                        // Fetch all records for the given time period
                        $query = "SELECT date, direct, house, ending FROM common_number WHERE time_period = '$timePeriod'";
                        $result = mysqli_query($con, $query);

                        // Check if data is available
                        if ($result && mysqli_num_rows($result) > 0) {
                            $firstRow = mysqli_fetch_assoc($result); // Get the first record
                            echo "<strong class='mb-0'>" . date("d/m/Y", strtotime($firstRow['date'])) . "</strong>";
                        }
                    ?>
                </div>
            </div>

            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center mx-auto">
                    <thead class="bg-shillong-txt text-dark">
                        <?php 
                            $heading = "SHILLONG";
                            if ($timePeriod === 'morning') {
                                $heading = "SHILLONG MORNING";
                            } elseif ($timePeriod === 'night') {
                                $heading = "SHILLONG NIGHT";
                            }
                        ?>
                        <tr>
                            <th colspan="3" class="text-center"><?php echo $heading; ?></th>
                        </tr>
                        <tr class="teer-bg-green">
                            <td>Direct</td>
                            <td>House</td>
                            <td>Ending</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($firstRow['direct']); ?></td>
                            <td><?php echo htmlspecialchars($firstRow['house']); ?></td>
                            <td><?php echo htmlspecialchars($firstRow['ending']); ?></td>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['direct']); ?></td>
                            <td><?php echo htmlspecialchars($row['house']); ?></td>
                            <td><?php echo htmlspecialchars($row['ending']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>
            <p class="text-center py-3 text-danger">No common numbers available.</p>
            <?php } ?>
        </div>

        <div class="col-md-10 mt-5 text-center">
            <p class="text-muted"><b>Disclaimer:</b> These common numbers are purely based on past results'
                calculations. There is no guarantee of accuracy.</p>
        </div>
    </div>

    <div class="row d-none d-md-flex p-4 center mt-4">
        <a class="bg-image-tr bg-pos teer-box" href="index.php"></a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php"></a>
        <a class="bg-image-6 bg-pos teer-box" href="prev-result.php"></a>
    </div>

    <?php include "down-section.php"; ?>

</div>
<!-- Footer -->
<?php include "footer.php"; ?>