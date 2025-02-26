<?php 
// Include meta file for configurations
include "meta.php";

// Get selected time period from URL, default to 'day'
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$date = date('Y-m-d');

// Function to fetch latest result for the selected time period
function fetchLatestResult($con, $selectedTimePeriod) {
    $query = "SELECT * FROM result_update WHERE time_period = ? ORDER BY id DESC LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $selectedTimePeriod);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result) ?? [];
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $selectedTimePeriod = $_POST['time_period'] ?? 'day';

    if (!isset($con)) die("Database connection error!");

    // Retrieve form inputs
    $timePeriods = ['first', 'second', 'third', 'fourth'];
    $inputData = [];

    foreach ($timePeriods as $key) {
        $inputData["{$key}_time"] = $_POST["{$key}_time"] ?? '';
        $inputData["{$key}_number"] = $_POST["{$key}_number"] ?? '';
    }

    // Remove extra inputs if not 'day' period
    if ($selectedTimePeriod !== 'day') {
        unset($inputData['third_time'], $inputData['third_number'], $inputData['fourth_time'], $inputData['fourth_number']);
    }

    // Default values for missing fields (Fix for mysqli_stmt_bind_param error)
    $first_time = $inputData['first_time'] ?? '';
    $first_number = $inputData['first_number'] ?? '';
    $second_time = $inputData['second_time'] ?? '';
    $second_number = $inputData['second_number'] ?? '';
    $third_time = $inputData['third_time'] ?? '';
    $third_number = $inputData['third_number'] ?? '';
    $fourth_time = $inputData['fourth_time'] ?? '';
    $fourth_number = $inputData['fourth_number'] ?? '';

    // Check if required inputs are provided
    if (!empty($first_time) && !empty($first_number) && !empty($second_time) && !empty($second_number)) {
        // Check if a record already exists for the selected time period
        $checkQuery = "SELECT COUNT(*) as total FROM result_update WHERE time_period = ?";
        $stmt = mysqli_prepare($con, $checkQuery);
        mysqli_stmt_bind_param($stmt, 's', $selectedTimePeriod);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        // Prepare SQL query
        if ($row['total'] == 0) {
            // Insert new record
            $query = "INSERT INTO result_update 
                      (first_time, first_number, second_time, second_number, third_time, third_number, fourth_time, fourth_number, time_period) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            // Update existing record
            $query = "UPDATE result_update SET 
                      first_time = ?, first_number = ?, 
                      second_time = ?, second_number = ?, 
                      third_time = ?, third_number = ?, 
                      fourth_time = ?, fourth_number = ? 
                      WHERE time_period = ?";
        }

        // Prepare and execute statement
        $stmt = mysqli_prepare($con, $query);
        if (!$stmt) exit("SQL Error: " . mysqli_error($con));

        mysqli_stmt_bind_param($stmt, 'sssssssss', 
            $first_time, $first_number, 
            $second_time, $second_number, 
            $third_time, $third_number, 
            $fourth_time, $fourth_number, 
            $selectedTimePeriod
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

// Fetch latest result
$fetch_data = fetchLatestResult($con, $selectedTimePeriod);

// Define site names
$siteNames = [
    'day' => 'shillongteeresult.in',
    'morning' => 'morning.shillongteeresult.in',
    'night' => 'night.shillongteeresult.in'
];
$siteName = $siteNames[$selectedTimePeriod] ?? 'shillongteeresult.in';

?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>
        <main id="main-dash" class="col-12 col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>

            <h2 class="text-center text-primary mt-3">Dashboard - <?php echo $siteName; ?>
                (<?php echo $selectedTimePeriod; ?>)</h2>

            <div class="col-md-12 bg-white shadow-sm rounded-3 p-3 mt-3">
                <h4 class="mt-3">Update Today's Result (<?php echo date('d/m/Y'); ?>)</h4>
                <hr>
                <p>Last updated:
                    <?php echo isset($fetch_data['date']) ? date('d/m/Y', strtotime($fetch_data['date'])) : 'N/A'; ?>
                </p>

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
                            <?php
                                $rounds = [
                                    'first' => 'F/R', 
                                    'second' => 'S/R', 
                                    'third' => '3rd/R', 
                                    'fourth' => '4th/R'
                                ];

                                foreach ($rounds as $key => $label) {
                                    if ($selectedTimePeriod !== 'day' && ($key === 'third' || $key === 'fourth')) {
                                        continue;
                                    }
                                    ?>
                            <tr>
                                <td><?php echo $label; ?></td>
                                <td>
                                    <input type="text" name="<?php echo "{$key}_time"; ?>" class="form-control"
                                        value="<?php echo $fetch_data["{$key}_time"] ?? ''; ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="<?php echo "{$key}_number"; ?>" class="form-control"
                                        value="<?php echo htmlspecialchars($fetch_data["{$key}_number"] ?? ''); ?>"
                                        required>
                                </td>
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