<?php 
include "meta.php"; 

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$id = $_GET['id'];
$query = "SELECT * FROM common_number WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$record = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$record) {
    die("Record not found!");
}

// Handle form submission
if (isset($_POST['update'])) {
    $direct = $_POST['direct'];
    $house = $_POST['house'];
    $ending = $_POST['ending'];

    $updateQuery = "UPDATE common_number SET direct = ?, house = ?, ending = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sssi', $direct, $house, $ending, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            window.location.href = 'list-common.php?time_period={$record['time_period']}';
        </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Failed to update record.</div>";
    }
    mysqli_stmt_close($stmt);
}
?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>

        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>

            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h2 class="text-primary">Edit Common Number -
                        <?php echo ucfirst($selectedTimePeriod); ?></h2>
                </div>
            </div>

            <div class="row center">
                <div class="col-md-8 bg-white shadow-sm rounded-3 p-4">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Direct</label>
                            <input type="text" class="form-control" name="direct"
                                value="<?php echo htmlspecialchars($record['direct']); ?>" maxlength="10" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">House</label>
                            <input type="text" class="form-control" name="house"
                                value="<?php echo htmlspecialchars($record['house']); ?>" maxlength="10" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ending</label>
                            <input type="text" class="form-control" name="ending"
                                value="<?php echo htmlspecialchars($record['ending']); ?>" maxlength="10" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                        <a href="list-common.php?time_period=<?php echo $record['time_period']; ?>"
                            class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.table th,
.table td {
    padding: 12px !important;
    text-align: center;
}
</style>

</body>

</html>