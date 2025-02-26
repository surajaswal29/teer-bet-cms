<?php
// Define site names based on time period
$siteNames = [
    'day' => 'shillongteeresult.in',
    'morning' => 'morning.shillongteeresult.in',
    'night' => 'night.shillongteeresult.in'
];

// Get site name based on selected time period, default to 'shillongteeresult.in'
$siteName = $siteNames[$timePeriod] ?? 'shillongteeresult.in';
?>

<div class="w-100 gap-3 d-flex justify-content-center align-items-center mt-3 bg-dark text-light py-2">
    &copy; <?php echo htmlspecialchars($siteName); ?> &nbsp; &nbsp;
    <a href="//www.dmca.com/Protection/Status.aspx?ID=bf444ec9-1ace-45c6-a75c-ade0c31afca5"
        title="DMCA.com Protection Status" class="dmca-badge ms-3">
        <img src="https://images.dmca.com/Badges/dmca_protected_sml_120n.png?ID=bf444ec9-1ace-45c6-a75c-ade0c31afca5"
            alt="DMCA.com Protection Status" />
    </a>
</div>