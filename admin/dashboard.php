<?php 
include "meta.php";

$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$date = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $selectedTimePeriod = $_POST['time_period'] ?? 'day';

    if (!isset($con)) die("Database connection error!");

    $ftime = $_POST['first_time'] ?? '';
    $fnumber = $_POST['first_number'] ?? '';
    $stime = $_POST['second_time'] ?? '';
    $snumber = $_POST['second_number'] ?? '';
    $ttime = $tnumber = $ltime = $lnumber = null;

    if ($selectedTimePeriod === 'day') {
        $ttime = $_POST['third_time'] ?? '';
        $tnumber = $_POST['third_number'] ?? '';
        $ltime = $_POST['last_time'] ?? '';
        $lnumber = $_POST['last_number'] ?? '';
    }

    if (!empty($ftime) && !empty($fnumber) && !empty($stime) && !empty($snumber)) {
        $checkQuery = "SELECT COUNT(*) as total FROM result_update WHERE date = ? AND time_period = ?";
        $stmt = mysqli_prepare($con, $checkQuery);
        mysqli_stmt_bind_param($stmt, 'ss', $date, $selectedTimePeriod);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($row['total'] == 0) {
            $query = "INSERT INTO result_update (first_time, first_number, second_time, second_number, third_time, third_number, fourth_time, fourth_number, time_period, date) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            $query = "UPDATE result_update SET 
                      first_time = ?, first_number = ?, 
                      second_time = ?, second_number = ?, 
                      third_time = ?, third_number = ?, 
                      fourth_time = ?, fourth_number = ? 
                      WHERE time_period = ? AND date = ?";
        }

        $stmt = mysqli_prepare($con, $query);
        if (!$stmt) {
            exit("SQL Error: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, 'ssssssssss', 
            $ftime, $fnumber, $stime, $snumber, 
            $ttime, $tnumber, $ltime, $lnumber, 
            $selectedTimePeriod, $date
        );

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "<div class='alert alert-success'>Result updated successfully!</div>";
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Error updating result!</div>";
        }
        mysqli_stmt_close($stmt);

        header("Location: dashboard.php?time_period=" . urlencode($selectedTimePeriod));
        exit();
    }
}

$select = "SELECT * FROM result_update WHERE date = ? AND time_period = ? ORDER BY id DESC LIMIT 1";
$stmt = mysqli_prepare($con, $select);
mysqli_stmt_bind_param($stmt, 'ss', $date, $selectedTimePeriod);
mysqli_stmt_execute($stmt);
$fetch_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);
?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>
        <main id="main-dash" class="col-12 col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php 
                include "navbar.php";
                // Define site names based on time period
                $siteNames = [
                    'day' => 'shillongteeresult.in',
                    'morning' => 'morning.shillongteeresult.in',
                    'night' => 'night.shillongteeresult.in'
                ];

                // Get the corresponding site name or default to 'shillongteeresult.in'
                $siteName = $siteNames[$selectedTimePeriod] ?? 'shillongteeresult.in';
            ?>

            <h2 class="text-center text-primary mt-3">Dashboard - <?php echo $siteName; ?>
                (<?php echo $selectedTimePeriod  ?>)</h2>

            <div class="col-md-12 bg-white shadow-sm rounded-3 p-3 mt-3">
                <h4 class="mt-3">Update Today's Result</h4>
                <form action="" method="post">
                    <input type="hidden" name="time_period"
                        value="<?php echo htmlspecialchars($selectedTimePeriod); ?>">
                    <table class="table mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Round</th>
                                <th>Time</th>
                                <th>Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>F/R</td>
                                <td><input type="time" name="first_time" class="form-control"
                                        value="<?php echo $fetch_data['first_time'] ?? ''; ?>" required></td>
                                <td><input type="text" name="first_number" class="form-control"
                                        value="<?php echo $fetch_data['first_number'] ?? ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td>S/R</td>
                                <td><input type="time" name="second_time" class="form-control"
                                        value="<?php echo $fetch_data['second_time'] ?? ''; ?>" required></td>
                                <td><input type="text" name="second_number" class="form-control"
                                        value="<?php echo $fetch_data['second_number'] ?? ''; ?>" required></td>
                            </tr>
                            <?php if ($selectedTimePeriod === 'day') { ?>
                            <tr>
                                <td>3rd/R</td>
                                <td><input type="time" name="third_time" class="form-control"
                                        value="<?php echo $fetch_data['third_time'] ?? ''; ?>" required></td>
                                <td><input type="text" name="third_number" class="form-control"
                                        value="<?php echo $fetch_data['third_number'] ?? ''; ?>" required></td>
                            </tr>
                            <tr>
                                <td>4th/R</td>
                                <td><input type="time" name="last_time" class="form-control"
                                        value="<?php echo $fetch_data['fourth_time'] ?? ''; ?>" required></td>
                                <td><input type="text" name="last_number" class="form-control"
                                        value="<?php echo $fetch_data['fourth_number'] ?? ''; ?>" required></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>
                        <button class="btn btn-primary" name="update" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>