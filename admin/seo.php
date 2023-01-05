<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>Update Title | Description | Keywords</h3>
            <?php //echo date('d/m/Y'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="table mt-4">
                    <?php
                    $sql2='SELECT * FROM `seo`';
                    $result2=mysqli_query($con,$sql2);
                    if(mysqli_num_rows($result2)>0){
                        $data2=mysqli_fetch_assoc($result2);
                        
                    ?>
                    <tr>
                        <td>Website Title</td>
                        <td><textarea name="w_title" id="w_title" class="form-input"><?php echo $data2['title']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">Website Description</label></td>
                        <td>
                           <textarea name="w_description" id="w_description"><?php echo $data2['description']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="first_round">Website Keywords</label></td>
                        <td>
                            <textarea name="w_Keywords" id="w_Keywords"><?php echo $data2['keyword']; ?></textarea>
                            <span class="note-k">Note: Separate each keyword with comma (,) For eg: shillong, teer, local, result</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><button class="btn btn-secondary btn-block" name="update" type="submit">Update</button></td>
                    </tr>
                </table>
                <?php
            }
                    ?>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $title=$_POST['w_title'];
                    $description=$_POST['w_description'];
                    $keyword=$_POST['w_Keywords'];

                    if($title!=null && $description!=null && $keyword !=null){
                        $query1="UPDATE `seo` SET `title` = '$title', `description` = '$description', `keyword` = '$keyword'";
                        $output=mysqli_query($con,$query1);
                        if($output){
                            echo"<div class='col-md-3 p-1 text-center bg-success text-light'>SEO updated successfully!</div>";
                            redirect('teer.php');
                        }
                    }else{
                        echo"<div class='col-md-3 p-1 text-center bg-danger text-light'>Error!</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>