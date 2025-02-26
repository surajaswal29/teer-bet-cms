<?php 
include "meta.php";

// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$date = date('Y-m-d');

?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>

        <!-- Main Content -->
        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>
            <div class="row">
                <div class="col-md-9 text-center mt-5">
                    <h2 class="text-center text-primary">Update Previous Result</h2>
                </div>
                <div class="col-md-3 mt-5">
                    <a href="view-prev.php?time_period=<?php echo htmlspecialchars($selectedTimePeriod); ?>"
                        class="btn btn-block btn-warning">View Previous Result</a>
                </div>
            </div>
            <div class="row center">
                <div class="col-md-10 bg-white shadow-sm rounded-3">
                    <form action="" method="post">
                        <input type="hidden" name="time_period"
                            value="<?php echo htmlspecialchars($selectedTimePeriod); ?>">

                        <table class="table mt-4">
                            <tr>
                                <td><label for="date">Date</label></td>
                                <td><input type="text" class="form-control" name="date" id="date" required></td>
                            </tr>
                            <tr>
                                <td><label for="first_round">First Round</label></td>
                                <td><input type="text" class="form-control" name="first_round" id="first_round"
                                        required></td>
                            </tr>
                            <tr>
                                <td><label for="second_round">Second Round</label></td>
                                <td><input type="text" class="form-control" name="second_round" id="second_round"
                                        required></td>
                            </tr>

                            <?php if ($selectedTimePeriod === 'day') : ?>
                            <tr>
                                <td><label for="third_round">Third Round</label></td>
                                <td><input type="text" class="form-control" name="third_round" id="third_round"></td>
                            </tr>
                            <tr>
                                <td><label for="fourth_round">Fourth Round</label></td>
                                <td><input type="text" class="form-control" name="fourth_round" id="fourth_round"></td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <td colspan="3">
                                    <button class="btn btn-primary w-100" name="update" type="submit">Update</button>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $resultDate = mysqli_real_escape_string($con, $_POST['date']);
                        $firstRound = mysqli_real_escape_string($con, $_POST['first_round']);
                        $secondRound = mysqli_real_escape_string($con, $_POST['second_round']);
                        $timePeriod = mysqli_real_escape_string($con, $_POST['time_period']);
                        $thirdRound = isset($_POST['third_round']) ? mysqli_real_escape_string($con, $_POST['third_round']) : null;
                        $fourthRound = isset($_POST['fourth_round']) ? mysqli_real_escape_string($con, $_POST['fourth_round']) : null;

                        // Allow 0, 00, xx as valid inputs, but NULL should be stored for empty fields
                        $thirdRound = ($thirdRound !== '' && $thirdRound !== null) ? "'$thirdRound'" : "NULL";
                        $fourthRound = ($fourthRound !== '' && $fourthRound !== null) ? "'$fourthRound'" : "NULL";

                        // Insert data into prev_result table
                        $query = "INSERT INTO prev_result (date, first_round, second_round, third_round, fourth_round, city, time_period) 
                                  VALUES ('$resultDate', '$firstRound', '$secondRound', $thirdRound, $fourthRound, 'Shillong', '$timePeriod')";

                        $output = mysqli_query($con, $query);
                        
                        if ($output) {
                            echo "<div id='success-message' class='alert alert-success text-center mt-3'>Previous result updated successfully!</div>";
                            echo "<script>
                                setTimeout(function() {
                                    document.getElementById('success-message').style.display = 'none';
                                    window.location.href = 'update-prev.php?time_period=' + encodeURIComponent('$selectedTimePeriod');
                                }, 1000);
                            </script>";
                        } else {
                            echo "<div class='alert alert-danger text-center mt-3'>Error updating result! " . mysqli_error($con) . "</div>";
                        }
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