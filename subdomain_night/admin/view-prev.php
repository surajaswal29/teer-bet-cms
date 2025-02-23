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
            <div class="row mt-3">
                <div class="col-md-12 py-3 text-center">
                    <h5 class="fw-bold text-primary">Shillong Teer Result <?php echo ucfirst($selectedTimePeriod); ?>
                        Previous Result</h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 bg-white shadow-sm rounded-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>DATE</th>
                                    <th>First Round</th>
                                    <th>Second Round</th>
                                    <?php if ($selectedTimePeriod === 'day') { ?>
                                    <th>Third Round</th>
                                    <th>Fourth Round</th>
                                    <th>CITY</th>
                                    <?php } ?>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch results for the selected time_period
                                $sql = "SELECT id, date, first_round, second_round, third_round, fourth_round, city 
                                        FROM prev_result 
                                        WHERE time_period = ? 
                                        ORDER BY date DESC, id DESC";
                                $stmt = mysqli_prepare($con, $sql);
                                mysqli_stmt_bind_param($stmt, 's', $selectedTimePeriod);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr class="text-center">

                                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['first_round']); ?></td>
                                    <td><?php echo htmlspecialchars($row['second_round']); ?></td>
                                    <?php if ($selectedTimePeriod === 'day') { ?>
                                    <td><?php echo htmlspecialchars($row['third_round'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fourth_round'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                                    <?php } ?>
                                    <td>
                                        <a href="edit-prev.php?time_period=<?php echo $selectedTimePeriod; ?>&p_id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <a href="delete-prev.php?time_period=<?php echo $selectedTimePeriod; ?>&p_id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>No results found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

.btn-sm {
    margin-right: 5px;
}
</style>

</body>

</html>