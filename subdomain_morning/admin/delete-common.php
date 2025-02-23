<?php 
include "meta.php"; 

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$id = $_GET['id'];

// Fetch record to get the time_period before deleting
$query = "SELECT time_period FROM common_number WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $time_period);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$time_period) {
    die("Record not found!");
}

// Delete record
$deleteQuery = "DELETE FROM common_number WHERE id = ?";
$stmt = mysqli_prepare($con, $deleteQuery);
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        window.location.href = 'list-common.php?time_period={$time_period}';
    </script>";
} else {
    echo "<div class='alert alert-danger text-center'>Failed to delete record.</div>";
}

mysqli_stmt_close($stmt);
?>