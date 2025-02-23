<?php include "header.php"; ?>

<div class="container-fluid vh-100" style="overflow-y: scroll; overflow-x: hidden;">
    <?php include "nav-bar.php"; ?>

    <div class="row mt-3">
        <div class="col-md-12 py-3 heading-1">
            <h1 class="text-center">Dream Numbers</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead>
                        <tr class="dream-bg">
                            <td>Dream</td>
                            <td>Numbers</td>
                            <td>House</td>
                            <td>Ending</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dream_number WHERE time_period = 'night'";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($fassoc = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fassoc['dream']); ?></td>
                            <td><?php echo htmlspecialchars($fassoc['numbers']); ?></td>
                            <td><?php echo htmlspecialchars($fassoc['house']); ?></td>
                            <td><?php echo htmlspecialchars($fassoc['ending']); ?></td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-danger fw-bold py-3'>No dream numbers available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="row d-none d-md-flex p-4 center mt-4">
        <a class="bg-image-1 bg-pos teer-box" href="common-num.php">
        </a>
        <a class="bg-image-2 bg-pos teer-box" href="index.php">
        </a>
        <a class="bg-image-6 bg-pos teer-box" href="prev-result.php">
        </a>
    </div>

<?php include "down-section.php"; ?>
</div>

<!-- Footer -->
<?php include "footer.php"; ?>