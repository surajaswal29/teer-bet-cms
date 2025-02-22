<?php
// Simplified version using ?? (Null Coalescing Operator)
$selectedTimePeriod = $_GET['time_period'] ?? 'day';
?>


<!-- Navbar -->
<div id="content" class="border border-light overflow-hidden rounded-3">
    <div class="row">
        <div class="col-12 bg-white w-100">
            <div class="d-flex align-items-center justify-content-between">
                <button id="sidebarToggle" class="btn text-dark d-lg-none">
                    ☰
                </button>
                <div class="d-flex d-md-none align-items-center nav-link">
                    <i class="zmdi zmdi-account-circle zmdi-hc-2x me-2 text-primary"></i>
                    <div class="d-flex flex-column">
                        <span class="fw-bold"><?php echo $_SESSION['uname']; ?></span>
                        <span class="text-muted small">Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid d-flex align-items-center">
            <!-- Website Selection Dropdown (Left Side) -->
            <select id="timePeriodSelect" class="form-select w-auto me-3" aria-label="Website Selection">
                <option value="day" <?php echo ($selectedTimePeriod == 'day') ? 'selected' : ''; ?>>shillongteeresult.in
                </option>
                <option value="morning" <?php echo ($selectedTimePeriod == 'morning') ? 'selected' : ''; ?>>
                    morning.shillongteeresult.in</option>
                <option value="night" <?php echo ($selectedTimePeriod == 'night') ? 'selected' : ''; ?>>
                    night.shillongteeresult.in</option>
            </select>

            <div class="d-none d-md-flex align-items-center nav-link">
                <i class="zmdi zmdi-account-circle zmdi-hc-2x me-2 text-primary"></i>
                <div class="d-flex flex-column">
                    <span class="fw-bold"><?php echo $_SESSION['uname']; ?></span>
                    <span class="text-muted small">Admin</span>
                </div>
            </div>
        </div>
    </nav>
</div>

<script>
document.getElementById("timePeriodSelect").addEventListener("change", function() {
    let selectedValue = this.value;
    window.location.href = "dashboard.php?time_period=" + selectedValue;
});
</script>