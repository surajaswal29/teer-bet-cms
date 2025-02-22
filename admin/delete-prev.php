<?php 
include "meta.php";

// Get `p_id` and `time_period` from GET request
$previous_id = $_GET['p_id'] ?? null;
$time_period = $_GET['time_period'] ?? null; // Preserve time period in redirection

if ($previous_id && $time_period) {
    // Prepare the delete statement with both id and time_period
    $drop = "DELETE FROM `prev_result` WHERE `id` = ? AND `time_period` = ?";
    $stmt = mysqli_prepare($con, $drop);
    mysqli_stmt_bind_param($stmt, 'is', $previous_id, $time_period); // 'i' for id, 's' for time_period
    $success = mysqli_stmt_execute($stmt);

    if ($success) {
        // Redirect to view-prev.php with the preserved time_period
        header("Location: view-prev.php?time_period=" . urlencode($time_period));
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting record!</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Invalid request!</div>";
}
?>