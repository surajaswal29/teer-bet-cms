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
                    <a href="view-prev.php?time_period=<?php echo $selectedTimePeriod; ?>"
                        class="btn btn-block btn-warning">View Previous Result</a>
                </div>
            </div>
            <div class="row center">
                <div class="col-md-10 bg-white shadow-sm rounded-3">
                    <form action="update-prev.php?time_period=<?php echo urlencode($selectedTimePeriod); ?>"
                        method="post">
                        <input type="hidden" name="time_period"
                            value="<?php echo htmlspecialchars($selectedTimePeriod); ?>">

                        <table class="table mt-4">
                            <tr>
                                <td><label for="date">Date</label></td>
                                <td><input type="date" class="form-control" name="date" id="date" required></td>
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
                            <!-- Show third & fourth round only when time_period is 'day' -->
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
                        $resultDate = $_POST['date'];
                        $firstRound = $_POST['first_round'];
                        $secondRound = $_POST['second_round'];
                        $timePeriod = $_POST['time_period'];

                        // Handle third and fourth round only if time_period is 'day'
                        $thirdRound = ($timePeriod === 'day' && !empty($_POST['third_round'])) ? $_POST['third_round'] : NULL;
                        $fourthRound = ($timePeriod === 'day' && !empty($_POST['fourth_round'])) ? $_POST['fourth_round'] : NULL;

                        // Insert data into prev_result table
                        $query = "INSERT INTO prev_result (date, first_round, second_round, third_round, fourth_round, city, time_period) 
                                  VALUES ('$resultDate', '$firstRound', '$secondRound', 
                                          ".($thirdRound ? "'$thirdRound'" : "NULL").", 
                                          ".($fourthRound ? "'$fourthRound'" : "NULL").", 
                                          'Shillong', '$timePeriod')";

                        $output = mysqli_query($con, $query);
                        
                        if ($output) {
                            echo "<div id='success-message' class='alert alert-success text-center mt-3'>Previous result updated successfully!</div>";
                            echo "<script>
                                setTimeout(function() {
                                    document.getElementById('success-message').style.display = 'none';
                                    window.location.href = 'update-prev.php?time_period={$selectedTimePeriod}';
                                }, 1000);
                            </script>";
                        } else {
                            echo "<div class='col-md-3 p-1 text-center bg-danger text-light'>Error updating result!</div>";
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