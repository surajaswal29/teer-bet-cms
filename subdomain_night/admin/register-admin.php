<?php 
include "meta.php";
?>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary mb-4">User Registration</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

                <!-- Confirm Password Input -->
                <div class="mb-3">
                    <label for="cpass" class="form-label">Confirm Password</label>
                    <input type="password" name="cpass" id="cpass" class="form-control" required>
                </div>

                <!-- Register Button -->
                <div class="d-grid">
                    <input type="submit" name="register" id="register" value="Register" class="btn btn-primary">
                </div>

                <!-- Message Display -->
                <div class="mt-3 text-center">
                    <?php
                    if (isset($_POST['register'])) {
                        // Database connection check
                        if (!isset($con)) {
                            die("<p class='text-danger'>Database connection failed!</p>");
                        }

                        $username = mysqli_real_escape_string($con, trim($_POST["uname"]));
                        $password = trim($_POST["pass"]);
                        $confirmPassword = trim($_POST["cpass"]);

                        if ($password !== $confirmPassword) {
                            echo "<p class='text-danger'>Passwords do not match!</p>";
                        } else {
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')";
                            if (mysqli_query($con, $query)) {
                                echo "<p class='text-success'>Registration successful!</p>";
                            } else {
                                echo "<p class='text-danger'>Error: " . mysqli_error($con) . "</p>";
                            }
                        }
                    }
                    ?>
                </div>
            </form>

            <!-- Login Admin Link -->
            <div class="text-center mt-3">
                <a href="index.php" class="text-decoration-none">Login</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>