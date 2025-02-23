<?php 
// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
$date = date('Y-m-d');

// Get the current script name to determine the active page
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<nav id="sidebar" class="sidebar col-md-3 col-lg-2 bg-dark text-white vh-100 p-3">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="text-center">Admin Panel</h4>
        <button id="sidebarToggleClose" class="btn btn-outline-danger d-lg-none ms-2">
            ✖
        </button>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="dashboard.php?time_period=<?php echo $selectedTimePeriod; ?>"
                class="nav-link text-white <?php echo ($current_page == 'dashboard.php') ? 'active bg-secondary' : ''; ?>">
                <i class="zmdi zmdi-home"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="add-common.php?time_period=<?php echo $selectedTimePeriod; ?>"
                class="nav-link text-white <?php echo ($current_page == 'add-common.php') ? 'active bg-secondary' : ''; ?>">
                <i class="zmdi zmdi-edit"></i> Common Number
            </a>
        </li>
        <li class="nav-item">
            <a href="add-dream.php?time_period=<?php echo $selectedTimePeriod; ?>"
                class="nav-link text-white <?php echo ($current_page == 'add-dream.php') ? 'active bg-secondary' : ''; ?>">
                <i class="zmdi zmdi-book"></i> Dream Number
            </a>
        </li>
        <li class="nav-item">
            <a href="update-prev.php?time_period=<?php echo $selectedTimePeriod; ?>"
                class="nav-link text-white <?php echo ($current_page == 'update-prev.php') ? 'active bg-secondary' : ''; ?>">
                <i class="zmdi zmdi-refresh"></i> Previous Result
            </a>
        </li>
        <li class="nav-item">
            <a href="seo.php?time_period=<?php echo $selectedTimePeriod; ?>"
                class="nav-link text-white <?php echo ($current_page == 'seo.php') ? 'active bg-secondary' : ''; ?>">
                <i class="zmdi zmdi-trending-up"></i> SEO
            </a>
        </li>
        <li class="nav-item mt-auto">
            <a href="logout.php" class="nav-link text-danger">
                <i class="zmdi zmdi-power"></i> Logout
            </a>
        </li>
    </ul>
</nav>