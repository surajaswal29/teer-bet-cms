<?php 
include "meta.php";

// Form Submission Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if (!isset($con)) {
        $message = "<div class='alert alert-danger'>Database connection failed!</div>";
    } else {
        // Sanitize user input
        $username = mysqli_real_escape_string(mysql: $con, string: trim(string: $_POST["uname"]));
        $password = trim(string: $_POST["pass"]);

        // Check if user exists
        $query = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query(mysql: $con, query: $query);

        if ($result && mysqli_num_rows(result: $result) > 0) {
            $row = mysqli_fetch_assoc(result: $result);

            // Verify password
            if (password_verify(password: $password, hash: $row['password'])) {
                $_SESSION['uname'] = $row['username'];
                header(header: "Location: dashboard.php?time_period=day");
                exit();
            } else {
                $message = "<div class='alert alert-danger'>Incorrect Username or Password!</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Incorrect Username or Password!</div>";
        }
    }
}
?>

<div class="container-full vh-100 d-flex justify-content-center align-items-center admin-form-pattern">
    <div class="col-md-4">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary mb-4">Admin Panel</h2>

            <!-- Display Message -->
            <?php if (isset($message)) echo $message; ?>

            <!-- Form -->
            <form action="" method="post">

                <!-- Username Input -->
                <div class="mb-3">
                    <label for="uname" class="form-label">Username</label>
                    <input type="text" name="uname" id="uname" class="form-control" required>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" name="pass" id="pass" class="form-control" required>
                </div>



                <!-- Login Button & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <a href="forgot-password.php" class="text-decoration-none">Forgot password?</a>
                </div>
            </form>

            <!-- Register Admin Link -->
            <!-- <div class="text-center mt-3">
                <a href="register-admin.php" class="text-decoration-none">Register Admin</a>
            </div> -->
        </div>
    </div>
</div>

</body>

</html>