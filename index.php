<?php include "header.php"; ?>

<div class="container-fluid vh-100">
    <?php include "nav-bar.php"; ?>

    <div class="row center">
        <div class="col-md-8" style="margin-top: 2rem;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                    // Database query
                    $fetchResultsQuery = "SELECT * FROM result_update WHERE time_period = '$timePeriod' ORDER BY id DESC LIMIT 1";
                    $queryResult = mysqli_query($con, $fetchResultsQuery);

                    if ($queryResult && mysqli_num_rows($queryResult) > 0) {
                        $latestTeerResult = mysqli_fetch_assoc($queryResult);
                        echo "<h6 class='mb-0'>" . date("d/m/Y", strtotime($latestTeerResult['date'])) . "</h6>"; // Display the fetched result date
                    }
                    ?>
                </div>
            </div>
            <div class="table-responsive" style="margin-top: 0.5rem;">
                <table class="table table-bordered m-0">
                    <?php if (!empty($latestTeerResult)) { 
                        $heading = "SHILLONG";
                        if ($timePeriod === 'morning') {
                            $heading = "SHILLONG MORNING";
                        } elseif ($timePeriod === 'night') {
                            $heading = "SHILLONG NIGHT";
                        }
                    ?>

                    <thead class="bg-shillong-txt text-dark">
                        <tr>
                            <th colspan="2" class="text-center"><?php echo $heading; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center teer-bg-green">
                            <td>F/R (<?php echo date("h:i A", strtotime($latestTeerResult['first_time'])); ?>)</td>
                            <td>S/R (<?php echo date("h:i A", strtotime($latestTeerResult['second_time'])); ?>)</td>
                        </tr>
                        <tr class="text-center">
                            <td><?php echo $latestTeerResult['first_number'] ?? "xx"; ?></td>
                            <td><?php echo $latestTeerResult['second_number'] ?? "xx"; ?></td>
                        </tr>
                        <tr class="text-center teer-bg-green">
                            <td>T/R
                                (<?php echo isset($latestTeerResult['third_time']) ? date("h:i A", strtotime($latestTeerResult['third_time'])) : 'N/A'; ?>)
                            </td>
                            <td>FT/R
                                (<?php echo isset($latestTeerResult['fourth_time']) ? date("h:i A", strtotime($latestTeerResult['fourth_time'])) : 'N/A'; ?>)
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td><?php echo $latestTeerResult['third_number'] ?? "xx"; ?></td>
                            <td><?php echo $latestTeerResult['fourth_number'] ?? "xx"; ?></td>
                        </tr>
                    </tbody>
                    <?php } else { ?>
                    <tr>
                        <td colspan="2" class="text-center">Result for today will be updated soon.</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row center" style="margin-top: 2.5rem">
        <?php 
        $menuItems = [
            ['title' => 'COMMON NUMBER', 'link' => 'common-num.php', 'class' => 'bg-image-1'],
            ['title' => 'DEALS', 'link' => 'index.php', 'class' => 'bg-image-2'],
            ['title' => 'DREAM NUMBER', 'link' => 'dream-num.php', 'class' => 'bg-image-3'],
            ['title' => 'ANALYTICS', 'link' => 'index.php', 'class' => 'bg-image-4 disp-none'],
            ['title' => 'PREDICT TARGET', 'link' => 'index.php', 'class' => 'bg-image-5 disp-none'],
            ['title' => 'PREVIOUS RESULT', 'link' => 'prev-result.php', 'class' => 'bg-image-6'],
            ['title' => 'CALENDAR', 'link' => 'prev-result.php', 'class' => 'bg-image-7 disp-none'],
            ['title' => 'Reputed Counter', 'link' => 'index.php', 'class' => 'bg-image-8 disp-none'],
            ['title' => 'TARGET APP', 'link' => 'index.php', 'class' => 'bg-image-9 disp-none']
        ];
        
        foreach ($menuItems as $menuItem) {
            echo "<a class='bg-pos border teer-box {$menuItem['class']}' href='{$menuItem['link']}'></a>";
        }
        ?>
    </div>
</div>
<!-- Footer -->
<?php include "footer.php"; ?>

<script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
</body>

</html>