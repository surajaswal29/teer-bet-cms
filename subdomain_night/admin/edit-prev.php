<?php 
include "meta.php";

// Get `p_id` and `time_period` from GET request
$previous_id = $_GET['p_id'] ?? null;
$time_period = $_GET['time_period'] ?? null; // New addition

// Fetch the existing record based on ID and Time Period
if ($previous_id && $time_period) {
    $select_prev = "SELECT * FROM prev_result WHERE id = ? AND time_period = ?";
    $stmt = mysqli_prepare($con, $select_prev);
    mysqli_stmt_bind_param($stmt, 'is', $previous_id, $time_period);
    mysqli_stmt_execute($stmt);
    $output_prev = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($output_prev) > 0) {
        $prev_res = mysqli_fetch_assoc($output_prev);
    } else {
        die("Invalid ID or Time Period!");
    }
} else {
    die("Missing parameters!");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $ftime = $_POST['date'];
    $fnumber = $_POST['first_number'];
    $snumber = $_POST['second_number'];
    $tnumber = $_POST['third_number'] ?? null;
    $fonumber = $_POST['fourth_number'] ?? null;
    $city = $_POST['city'];

    if (!empty($ftime) && !empty($fnumber) && !empty($snumber) && !empty($city)) {
        $query1 = "UPDATE `prev_result` SET `date` = ?, `first_round` = ?, `second_round` = ?, `third_round` = ?, `fourth_round` = ?, `city` = ? WHERE id = ? AND time_period = ?";
        $stmt = mysqli_prepare($con, $query1);
        mysqli_stmt_bind_param($stmt, 'siiissis', $ftime, $fnumber, $snumber, $tnumber, $fonumber, $city, $previous_id, $time_period);
        $output = mysqli_stmt_execute($stmt);

        if ($output) {
            echo "<div class='alert alert-success text-center'>Edit Successful!</div>";
            header("Location: edit-prev.php?p_id=" . $previous_id . "&time_period=" . urlencode($time_period));
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Error updating result!</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>All required fields must be filled!</div>";
    }
}
?>


<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>

        <!-- Main Content -->
        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>
            <div class="row">
                <div class="col-md-9 text-center mt-5">
                    <h3>Edit Previous Result for Date: <?php echo htmlspecialchars($prev_res['date']); ?></h3>
                </div>
                <div class="col-md-3 mt-5">
                    <a href="view-prev.php?time_period=<?php echo $selectedTimePeriod; ?>"
                        class="btn btn-warning btn-block">View Previous Results</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-white shadow-sm rounded-3 p-4">
                    <form
                        action="edit-prev.php?time_period=<?php echo urlencode($selectedTimePeriod); ?>&p_id=<?php echo $previous_id; ?>"
                        method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><label for="text">Date</label></td>
                                    <td><input type="date" class="form-control" name="date"
                                            value="<?php echo htmlspecialchars($prev_res['date']); ?>" required
                                            readonly></td>
                                </tr>
                                <tr>
                                    <td><label for="first_round">First Round (F/R)</label></td>
                                    <td><input type="number" class="form-control" name="first_number"
                                            value="<?php echo htmlspecialchars($prev_res['first_round']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="second_round">Second Round (S/R)</label></td>
                                    <td><input type="number" class="form-control" name="second_number"
                                            value="<?php echo htmlspecialchars($prev_res['second_round']); ?>" required>
                                    </td>
                                </tr>
                                <?php if ($selectedTimePeriod === 'day') { ?>
                                <tr>
                                    <td><label for="third_round">Third Round (T/R)</label></td>
                                    <td><input type="number" class="form-control" name="third_number"
                                            value="<?php echo htmlspecialchars($prev_res['third_round'] ?? ''); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="fourth_round">Fourth Round (FO/R)</label></td>
                                    <td><input type="number" class="form-control" name="fourth_number"
                                            value="<?php echo htmlspecialchars($prev_res['fourth_round'] ?? ''); ?>">
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><label for="city">City</label></td>
                                    <td><input type="text" class="form-control" name="city"
                                            value="<?php echo htmlspecialchars($prev_res['city']); ?>" required></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button class="btn btn-primary btn-block" name="update"
                                            type="submit">Save</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Optional Custom Styling -->
<style>
.table th,
.table td {
    vertical-align: middle;
}

.btn-block {
    width: 100%;
}
</style>

</body>

</html>