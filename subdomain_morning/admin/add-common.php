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
                    <h2 class="text-center text-primary">
                        Update Today's Common Number (<?php echo date('d/m/Y'); ?>)
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 bg-white shadow-sm rounded-3 p-4">
                    <form action="add-common.php?time_period=<?php echo urlencode($selectedTimePeriod); ?>"
                        method="post">
                        <input type="hidden" name="time_period"
                            value="<?php echo htmlspecialchars($selectedTimePeriod); ?>">

                        <table class="table mt-4">
                            <thead class="bg-secondary text-light">
                                <tr>
                                    <th>Direct</th>
                                    <th>House</th>
                                    <th>Ending</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="direct" maxlength="100" required>
                                    </td>
                                    <td><input type="text" class="form-control" name="house" maxlength="10" required>
                                    </td>
                                    <td><input type="text" class="form-control" name="ending" maxlength="10" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <button class="btn btn-primary w-100" name="update"
                                            type="submit">Update</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $direct = $_POST['direct'] ?? NULL;
                        $house = $_POST['house'] ?? NULL;
                        $ending = $_POST['ending'] ?? NULL;
                        $time_period = $_POST['time_period'];

                        if ($direct !== NULL && $house !== NULL && $ending !== NULL) {
                            // Delete old entries where the date is older than today
                            $deleteQuery = "DELETE FROM common_number WHERE date < ?";
                            $deleteStmt = mysqli_prepare($con, $deleteQuery);
                            mysqli_stmt_bind_param($deleteStmt, 's', $currentDate);
                            mysqli_stmt_execute($deleteStmt);
                            mysqli_stmt_close($deleteStmt);

                            // Insert new record
                            $insertQuery = "INSERT INTO common_number (time_period, direct, house, ending) VALUES (?, ?, ?, ?)";
                            $insertStmt = mysqli_prepare($con, $insertQuery);
                            mysqli_stmt_bind_param($insertStmt, 'ssss', $time_period, $direct, $house, $ending);
                            mysqli_stmt_execute($insertStmt);
                            mysqli_stmt_close($insertStmt);

                            echo "<div id='success-message' class='alert alert-success text-center mt-3'>
                                    Common Numbers updated successfully!
                                  </div>";
                            echo "<script>
                                    setTimeout(function() {
                                        document.getElementById('success-message').style.display = 'none';
                                        window.location.href = 'add-common.php?time_period={$selectedTimePeriod}';
                                    }, 1000);
                                  </script>";
                        } else {
                            echo "<div class='alert alert-danger text-center mt-3'>All fields are required.</div>";
                        }
                    }
                    ?>

                    <!-- Button to View List Page -->
                    <div class="text-center mt-4">
                        <a href="list-common.php?time_period=<?php echo $selectedTimePeriod; ?>"
                            class="btn btn-success">View All Common Numbers</a>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<!-- Custom Styling -->
<style>
.table th,
.table td {
    padding: 12px !important;
    text-align: center;
}
</style>

</body>

</html>