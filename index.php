<?php include "header.php"; ?>

<div class="container-fluid vh-100">
    <?php include "nav-bar.php"; ?>

    <div class="row center">
        <div class="col-md-8" style="margin-top: 2rem;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="mb-0 text-center"><?php echo date("d/m/Y"); ?></h6>
                </div>
            </div>
            <div class="table-responsive" style="margin-top: 0.5rem;">
                <table class="table table-bordered m-0">
                    <?php
                    // Database query
                    $todayDate = date("Y-m-d"); // Get today's date in YYYY-MM-DD format
                    $fetchResultsQuery = "SELECT * FROM result_update WHERE time_period = 'day' AND date = '$todayDate' ORDER BY id DESC LIMIT 1";

                    $queryResult = mysqli_query($con, $fetchResultsQuery);

                    if ($queryResult && mysqli_num_rows($queryResult) > 0) {
                        $latestTeerResult = mysqli_fetch_assoc($queryResult);
                    ?>
                    <thead class="bg-shillong-txt text-dark">
                        <tr>
                            <th colspan="2" class="text-center">SHILLONG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center teer-bg-green">
                            <td>F/R
                                (<?php echo date("h:i A", strtotime($latestTeerResult['first_time'])); ?>)
                            </td>
                            <td>S/R
                                (<?php echo date("h:i A", strtotime($latestTeerResult['second_time'])); ?>)
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td><?php echo htmlspecialchars($latestTeerResult['first_number']); ?></td>
                            <td><?php echo htmlspecialchars($latestTeerResult['second_number']); ?></td>
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
                            <td><?php echo isset($latestTeerResult['third_number']) ? htmlspecialchars($latestTeerResult['third_number']) : 'N/A'; ?>
                            </td>
                            <td><?php echo isset($latestTeerResult['fourth_number']) ? htmlspecialchars($latestTeerResult['fourth_number']) : 'N/A'; ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>Result for today will be updated soon.</td></tr>";
                    }
                    ?>
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