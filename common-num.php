<?php include "header.php"; ?>

<div class="container-fluid vh-100">
    <?php include "nav-bar.php"; ?>

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <strong class="mb-0"><?php echo date("d/m/Y"); ?></strong>
                </div>
            </div>

            <?php
                // Fetch all common numbers for today's date and 'day' time_period
                $query = "SELECT direct, house, ending 
                          FROM common_number 
                          WHERE time_period = 'day' 
                          AND date = CURRENT_DATE()";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center mx-auto">
                    <thead class="bg-shillong-txt text-dark">
                        <tr>
                            <th colspan="3" class="text-center">SHILLONG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="teer-bg-green">
                            <td>Direct</td>
                            <td>House</td>
                            <td>Ending</td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($row['direct']); ?></td>
                            <td><?php echo htmlspecialchars($row['house']); ?></td>
                            <td><?php echo htmlspecialchars($row['ending']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php 
                } else { 
                    echo "<p class='text-center py-3 text-danger'>No common numbers available for today.</p>";
                } 
            ?>
        </div>

        <div class="col-md-10 mt-5 text-center">
            <p class="text-muted"><b>Disclaimer:</b> These common numbers are purely based on past results'
                calculations. There is no guarantee of accuracy.</p>
        </div>
    </div>

    <div class="row p-4 center mt-4">
        <a class="bg-image-5 bg-pos teer-box" href="index.php"></a>
        <a class="bg-image-3 bg-pos teer-box" href="dream-num.php"></a>
        <a class="bg-image-6 bg-pos teer-box" href="prev-result.php"></a>
    </div>

    <div class="mt-3"></div>

    <?php include "footer.php"; ?>
</div>