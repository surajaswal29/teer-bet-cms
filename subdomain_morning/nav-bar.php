<?php 
    $currentPage = basename($_SERVER['PHP_SELF']); // Get current page filename
?>

<nav class="row navbar navbar-expand-md top-teer-nav shadow-sm p-1">
    <a class="navbar-brand teer-logo" href="index.php">
        <img src="images/morning-logo.png" alt="Shillong Teer morning" class="img-fluid" style="max-height: 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav fw-medium d-flex gap-3" style="
        gap: 10px;
        ">
            <li class="nav-item">
                <a class="btn <?php echo ($currentPage == 'index.php') ? 'btn-primary' : 'btn-secondary'; ?>"
                    href="index.php">
                    <i class="zmdi zmdi-home me-1"></i> Today Result
                </a>
            </li>
            <li class="nav-item">
                <a class="btn <?php echo ($currentPage == 'common-num.php') ? 'btn-primary' : 'btn-secondary'; ?>"
                    href="common-num.php">
                    <i class="zmdi zmdi-account-box me-1"></i> Common Number
                </a>
            </li>
            <li class="nav-item">
                <a class="btn <?php echo ($currentPage == 'dream-num.php') ? 'btn-primary' : 'btn-secondary'; ?>"
                    href="dream-num.php">
                    <i class="zmdi zmdi-image me-1"></i> Dream Number
                </a>
            </li>
            <li class="nav-item">
                <a class="btn <?php echo ($currentPage == 'prev-result.php') ? 'btn-primary' : 'btn-secondary'; ?>"
                    href="prev-result.php">
                    <i class="zmdi zmdi-account me-1"></i> Previous Results
                </a>
            </li>
        </ul>
    </div>
</nav>