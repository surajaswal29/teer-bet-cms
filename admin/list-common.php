<?php 
include "meta.php"; 

// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$date = date('Y-m-d');

// Fetch common numbers based on selected time_period and current date
$query = "SELECT * FROM common_number WHERE time_period = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 's', $selectedTimePeriod);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$common_numbers = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
?>

<div class="container-fluid dashboard-bg min-vh-100">
    <div class="row">
        <?php include "sidebar.php"; ?>

        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto">
            <?php include "navbar.php"; ?>

            <div class="row">
                <div class="col-md-12 text-center my-4">
                    <h2 class="fw-bold">
                        Today's Common Numbers (<?php echo date('d/m/Y'); ?>) -
                        <?php echo ucfirst($selectedTimePeriod); ?>
                    </h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 bg-white shadow-sm rounded-3 p-4">

                    <?php if (!empty($common_numbers)) { ?>
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-2">Direct</th>
                                    <th class="py-2">House</th>
                                    <th class="py-2">Ending</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($common_numbers as $row) { ?>
                                <tr>
                                    <td class="fw-bold"><?php echo htmlspecialchars($row['direct']); ?></td>
                                    <td><?php echo htmlspecialchars($row['house']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ending']); ?></td>
                                    <td>
                                        <a href="edit-common.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>
                                        <a href="delete-common.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this record?');">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                    <p class="text-center text-danger mt-3 fs-5">No common numbers available for today.</p>
                    <?php } ?>

                    <!-- Button to Add Common Numbers -->
                    <div class="text-center mt-4">
                        <a href="add-common.php?time_period=<?php echo urlencode($selectedTimePeriod); ?>"
                            class="btn btn-primary px-4 py-2">
                            <i class="bi bi-plus-circle"></i> Add Common Numbers
                        </a>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<style>
.table th,
.table td {
    padding: 14px !important;
    text-align: center;
}
</style>

</body>

</html>