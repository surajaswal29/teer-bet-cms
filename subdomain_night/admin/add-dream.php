<?php 
include "meta.php";

// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$currentDate = date('Y-m-d');
?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>

        <!-- Main Content -->
        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h2 class="text-primary">Update Dream Numbers</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 bg-white shadow-sm rounded-3 p-4">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <input type="hidden" name="time_period"
                            value="<?php echo htmlspecialchars($selectedTimePeriod); ?>">

                        <div class="mb-3">
                            <label for="dream" class="form-label">Dream</label>
                            <input type="text" name="dream" id="dream" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="numbers" class="form-label">Numbers</label>
                            <input type="text" name="numbers" id="numbers" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="house" class="form-label">House</label>
                            <input type="text" name="house" id="house" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="ending" class="form-label">Ending</label>
                            <input type="text" name="ending" id="ending" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100" name="update" type="submit">Update</button>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $dream = $_POST['dream'];
                        $numbers = $_POST['numbers'];
                        $house = $_POST['house'];
                        $ending = $_POST['ending'];
                        $timePeriod = $_POST['time_period'] ?? 'day';

                        $insertQuery = "INSERT INTO dream_number (dream, numbers, house, ending, time_period) 
                                        VALUES (?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($con, $insertQuery);
                        mysqli_stmt_bind_param($stmt, 'sssss', $dream, $numbers, $house, $ending, $timePeriod);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<div class='alert alert-success mt-3'>Dream numbers updated successfully!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Error updating dream numbers. Please try again.</div>";
                        }
                        mysqli_stmt_close($stmt);
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.table th,
.table td {
    padding: 12px !important;
    text-align: left;
}
</style>

</body>

</html>