<?php 
include "meta.php";
$res_msg = '';
// Validate GET parameters
$previous_id = isset($_GET['p_id']) ? mysqli_real_escape_string($con, $_GET['p_id']) : null;
$selectedTimePeriod = isset($_GET['time_period']) ? mysqli_real_escape_string($con, $_GET['time_period']) : null;

// Fetch existing record based on ID and Time Period
if ($previous_id && $selectedTimePeriod) {
    $select_prev = "SELECT * FROM prev_result WHERE id = ? AND time_period = ?";
    $stmt = mysqli_prepare($con, $select_prev);
    mysqli_stmt_bind_param($stmt, 'ss', $previous_id, $selectedTimePeriod);
    mysqli_stmt_execute($stmt);
    $output_prev = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($output_prev) > 0) {
        $prev_res = mysqli_fetch_assoc($output_prev);
    } else {
        die("<div class='alert alert-danger text-center'>Invalid ID or Time Period!</div>");
    }
} else {
    die("<div class='alert alert-danger text-center'>Missing parameters!</div>");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $ftime = mysqli_real_escape_string($con, $_POST['date']);
    $fnumber = mysqli_real_escape_string($con, $_POST['first_number']);
    $snumber = mysqli_real_escape_string($con, $_POST['second_number']);
    $tnumber = isset($_POST['third_number']) ? mysqli_real_escape_string($con, $_POST['third_number']) : null;
    $fonumber = isset($_POST['fourth_number']) ? mysqli_real_escape_string($con, $_POST['fourth_number']) : null;
    $city = mysqli_real_escape_string($con, $_POST['city']);

    if (!empty($ftime) && !empty($fnumber) && !empty($snumber) && !empty($city)) {
        $query1 = "UPDATE prev_result 
                   SET date = ?, first_round = ?, second_round = ?, third_round = ?, fourth_round = ?, city = ? 
                   WHERE id = ? AND time_period = ?";
        $stmt = mysqli_prepare($con, $query1);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $ftime, $fnumber, $snumber, $tnumber, $fonumber, $city, $previous_id, $selectedTimePeriod);
        $output = mysqli_stmt_execute($stmt);

        if ($output) {
            $res_msg = "
                <div class='alert alert-success text-center mt-3'>Edit Successful!</div>
                <script>
                setTimeout(function() {
                    window.location.href = 'edit-prev.php?p_id=" . $previous_id . "&time_period=" . urlencode($selectedTimePeriod) . "';
                }, 1000);
                </script>
            ";
        } else {
            $res_msg = "<div class='alert alert-danger text-center mt-3'>Error updating result: " . mysqli_error($con) . "</div>";
        }
    } else {
        $res_msg = "<div class='alert alert-danger text-center mt-3'>All required fields must be filled!</div>";
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
                    <a href="view-prev.php?time_period=<?php echo urlencode($selectedTimePeriod); ?>"
                        class="btn btn-warning btn-block">View Previous Results</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-white shadow-sm rounded-3 p-4">
                    <form
                        action="edit-prev.php?p_id=<?php echo $previous_id; ?>&time_period=<?php echo urlencode($selectedTimePeriod); ?>"
                        method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><label for="date">Date</label></td>
                                    <td><input type="text" class="form-control" name="date"
                                            value="<?php echo htmlspecialchars($prev_res['date']); ?>" required
                                            readonly></td>
                                </tr>
                                <tr>
                                    <td><label for="first_round">First Round (F/R)</label></td>
                                    <td><input type="text" class="form-control" name="first_number"
                                            value="<?php echo htmlspecialchars($prev_res['first_round']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="second_round">Second Round (S/R)</label></td>
                                    <td><input type="text" class="form-control" name="second_number"
                                            value="<?php echo htmlspecialchars($prev_res['second_round']); ?>" required>
                                    </td>
                                </tr>
                                <?php if ($selectedTimePeriod === 'day') { ?>
                                <tr>
                                    <td><label for="third_round">Third Round (T/R)</label></td>
                                    <td><input type="text" class="form-control" name="third_number"
                                            value="<?php echo htmlspecialchars($prev_res['third_round']); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="fourth_round">Fourth Round (FO/R)</label></td>
                                    <td><input type="text" class="form-control" name="fourth_number"
                                            value="<?php echo htmlspecialchars($prev_res['fourth_round']); ?>">
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
                    <!-- Display response message below the table -->
                    <?php echo $res_msg; ?>
                </div>
            </div>
        </main>
    </div>
</div>

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