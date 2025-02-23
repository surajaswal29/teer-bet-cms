<?php 
include "meta.php"; 
include "db_connection.php"; // Include database connection file

// Initialize message variable
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {

    // Retrieve form inputs
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Check if both passwords match
    if ($new_password === $confirm_password) {

        // Hash the new password for security
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password securely using prepared statements
        $query = "UPDATE admin SET password = ? WHERE id = 1"; // Update for the admin user
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $hashed_password);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = "<p class='text-success'>Password updated successfully!</p>";
        } else {
            $message = "<p class='text-danger'>Error updating password. Please try again.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "<p class='text-danger'>Passwords do not match!</p>";
    }
}

?>

<div class="container-fluid vh-100 bg">
    <div class="row">
        <div class="col-md-12 py-5 text-center text-white main-login-page">
            <h1>Shillong Teer Result Day | Password Reset&nbsp;<i class="zmdi zmdi-arrow-forward"></i></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 py-4">
            <div class="form-wrap-1">
                <div class="wavefire-form shadow">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <input type="submit" name="change" value="Change"
                                    class="btn btn-block bg-primary text-light font-weight-bold">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="text-warning" id="show-message">
                                    <?php echo $message; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>