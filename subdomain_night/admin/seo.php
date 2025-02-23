<?php 
include "meta.php";

// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = isset($_GET['time_period']) ? mysqli_real_escape_string($con, $_GET['time_period']) : 'day';

// Default values to avoid undefined variable warnings
$title = "Your Website Title Here";
$description = "Your website description goes here. It should be concise and informative.";
$keyword = "shillong, teer, local, result";
$site_url = "www.example.com"; // Change this to your real domain
$data2 = false;

// Fetch existing SEO data from the database
$sql2 = "SELECT * FROM `seo` WHERE `time_period` = '$selectedTimePeriod' LIMIT 1";
$result2 = mysqli_query($con, $sql2);

if ($result2 && mysqli_num_rows($result2) > 0) {
    $data2 = mysqli_fetch_assoc($result2);
    $title = $data2['title'] ?? $title;
    $description = $data2['description'] ?? $description;
    $keyword = $data2['keyword'] ?? $keyword;
}

$currentDate = date('Y-m-d');
?>

<div class="container-fluid dashboard-bg">
    <div class="row vh-100">
        <?php include "sidebar.php"; ?>

        <!-- Main Content -->
        <main id="main-dash" class="col-md-9 col-lg-10 p-4 overflow-auto h-100">
            <?php include "navbar.php"; ?>

            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h3>Update Title | Description | Keywords</h3>
                </div>
            </div>

            <!-- SEO Update Form -->
            <div class="row mt-3">
                <div class="col-md-12 bg-white rounded-3 p-3">
                    <form action="" method="post">
                        <div class="row">
                            <!-- Website Title -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="w_title" class="form-label fw-bold">Website Title</label>
                                <textarea id="w_title" class="form-control" name="w_title" rows="2"
                                    required><?php echo htmlspecialchars($title); ?></textarea>
                            </div>

                            <!-- Website Description -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="w_description" class="form-label fw-bold">Website Description</label>
                                <textarea id="w_description" class="form-control" name="w_description" rows="2"
                                    required><?php echo htmlspecialchars($description); ?></textarea>
                            </div>

                            <!-- Website Keywords -->
                            <div class="col-12 mb-3">
                                <label for="w_Keywords" class="form-label fw-bold">Website Keywords</label>
                                <textarea id="w_Keywords" class="form-control" name="w_Keywords" rows="2"
                                    required><?php echo htmlspecialchars($keyword); ?></textarea>
                                <small class="text-muted">Separate each keyword with a comma (e.g., shillong, teer,
                                    local, result).</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-center">
                                <button class="btn btn-secondary w-100 w-md-50" name="update" type="submit">
                                    <?php echo ($data2) ? "Update" : "Create"; ?>
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $title = mysqli_real_escape_string($con, $_POST['w_title']);
                        $description = mysqli_real_escape_string($con, $_POST['w_description']);
                        $keyword = mysqli_real_escape_string($con, $_POST['w_Keywords']);

                        if (!empty($title) && !empty($description) && !empty($keyword)) {
                            if ($data2) {
                                // Update existing SEO entry
                                $query1 = "UPDATE `seo` SET `title` = '$title', `description` = '$description', `keyword` = '$keyword' WHERE `time_period` = '$selectedTimePeriod'";
                            } else {
                                // Insert new SEO entry
                                $query1 = "INSERT INTO `seo` (`time_period`, `title`, `description`, `keyword`) VALUES ('$selectedTimePeriod', '$title', '$description', '$keyword')";
                            }

                            if (mysqli_query($con, $query1)) {
                                echo "<div id='success-message' class='alert alert-success text-center mt-3'>SEO " . ($data2 ? "updated" : "created") . " successfully!</div>";
                                echo "<script>
                                    setTimeout(function() {
                                        document.getElementById('success-message').style.display = 'none';
                                        window.location.href = '?time_period={$selectedTimePeriod}';
                                    }, 1000);
                                </script>";
                            } else {
                                echo "<div class='alert alert-danger text-center mt-3'>Operation failed! Please try again.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger text-center mt-3'>All fields are required!</div>";
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- Realistic Google Preview Section -->
            <div class="row mt-4">
                <?php
                $siteNames = [
                    'day' => 'shillongteeresult.in',
                    'morning' => 'morning.shillongteeresult.in',
                    'night' => 'night.shillongteeresult.in'
                ];

                // Get the corresponding site name or default to 'shillongteeresult.in'
                $site_url = $siteNames[$selectedTimePeriod] ?? 'shillongteeresult.in';
                ?>
                <div class="col-md-12 bg-light p-3 rounded-3">
                    <h5 class="fw-bold text-center">Live Google Search Preview</h5>
                    <hr>
                    <div class="google-preview">
                        <h2 id="preview-title"><?php echo htmlspecialchars($title); ?></h2>
                        <p id="preview-url"><?php echo htmlspecialchars($site_url); ?></p>
                        <p id="preview-description"><?php echo htmlspecialchars($description); ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let titleInput = document.getElementById("w_title");
    let descInput = document.getElementById("w_description");
    let previewTitle = document.getElementById("preview-title");
    let previewDesc = document.getElementById("preview-description");

    titleInput.addEventListener("input", function() {
        previewTitle.innerText = titleInput.value || "Your Website Title Here";
    });

    descInput.addEventListener("input", function() {
        let desc = descInput.value || "Your website description goes here.";
        if (desc.length > 160) {
            desc = desc.substring(0, 157) + "...";
        }
        previewDesc.innerText = desc;
    });
});
</script>

<style>
.google-preview {
    border: 1px solid #ddd;
    padding: 15px;
    background: white;
    max-width: 600px;
    margin: auto;
    border-radius: 5px;
    font-family: Arial, sans-serif;
}

.google-preview h2 {
    color: #1a0dab;
    font-size: 20px;
    margin-bottom: 5px;
}

.google-preview p {
    margin: 0;
    font-size: 14px;
}

#preview-url {
    color: #006621;
    font-size: 14px;
    margin-bottom: 3px;
}

#preview-description {
    color: #545454;
}
</style>

</body>

</html>