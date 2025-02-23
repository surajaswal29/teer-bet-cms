<div class="row center d-flex d-md-none" style="margin-top: 2.5rem">
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