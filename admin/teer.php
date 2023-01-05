<?php include "header-file.php"; ?>
<?php include "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>Update Today's Result (<?php echo date('d/m/Y'); ?>)</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="table mt-4">
                    <tr>
                        <td></td>
                        <td>Time</td>
                        <td>Number</td>
                    </tr>
                    <tr>
                        <td><label for="first_round">F/R</label></td>
                        <td>
                            <select name="first_time_hr" id="first_time_hr">
                                <option value="xx">xx</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            :
                            <select name="first_time_min" id="first_time_min">
                                <option value="xx">xx</option>
                                <?php
                                for($i=0; $i<60; $i++){
                                    if($i<10){
                                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                                    }else{
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            :
                            <select name="first_time_pm" id="first_time_pm">
                                <option value="xx">xx</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </td>
                        <td><input type="text" name="first_number" id="first_number"></td>
                    </tr>
                    <tr>
                        <td><label for="first_round">S/R</label></td>
                        <td>
                            <select name="second_time_hr" id="second_time_hr">
                                <option value="xx">xx</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            :
                            <select name="second_time_min" id="second_time_min">
                                <option value="xx">xx</option>
                                <?php
                                    for($i=0; $i<60; $i++){
                                        if($i<10){
                                            echo '<option value="0'.$i.'">0'.$i.'</option>';
                                        }else{
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            :
                            <select name="second_time_pm" id="second_time_pm">
                                <option value="xx">xx</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </td>
                        <td><input type="text" name="second_number" id="second_number"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><button class="btn btn-secondary btn-block" name="update" type="submit">Update</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])){
                    $ftime=$_POST['first_time_hr'].':'.$_POST['first_time_min'].' '.$_POST['first_time_pm'];
                    $fnumber=$_POST['first_number'];
                    $stime=$_POST['second_time_hr'].':'.$_POST['second_time_min'].' '.$_POST['second_time_pm'];
                    $snumber=$_POST['second_number'];
                    $date=date('d/m/Y');

                    if($ftime!=null && $fnumber!=null && $stime !=null && $snumber!=null){
                        $query1="UPDATE `result_update` SET `f_time` = '$ftime', `f_number` = '$fnumber', `s_time` = '$stime', `s_number` = '$snumber', `date` = '$date'";
                        $output=mysqli_query($con,$query1);
                        if($output){
                            echo"<div class='col-md-3 p-1 text-center bg-success text-light'>Result updated successfully!</div>";
                            redirect('teer.php');
                        }
                    }else{
                        echo"<div class='col-md-3 p-1 text-center bg-danger text-light'>Error!</div>";
                    }
                }
            ?>
        </div>
    </div>
    <div class="row center mt-5 mb-5">
        <div class="col-md-8">
            <table class="table">
                <?php
                    $select="SELECT * FROM result_update ORDER BY `result_update`.`id` DESC";
                    $output=mysqli_query($con,$select);
                    if(mysqli_num_rows($output)>0){
                        $fetch_data=mysqli_fetch_assoc($output);
                ?>
                <tr class="round-fs">
                    <td colspan="2">
                        <?php
                        //  $today = date("d/m/Y");
                         echo"<h2>Today's Result (".$fetch_data['date'].")</h2>";
                        ?>
                    </td>
                </tr>
                <tr class="round-fs">
                    <td>F/R (<?php echo $fetch_data['f_time'] ?>)</td>
                    <td>S/R (<?php echo $fetch_data['s_time'] ?>)</td>
                </tr>
                <tr>
                    <td>
                        <?php 
                            if($fetch_data['f_number']<10){
                                echo $fetch_data['f_number'];
                            }else if($fetch_data['f_number']>10){
                                echo $fetch_data['f_number'];
                            }else{
                                echo $fetch_data['f_number'];   
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($fetch_data['s_number']<10){
                                echo $fetch_data['s_number'];
                            }else if($fetch_data['f_number']>10){
                                echo $fetch_data['f_number'];
                            }else{
                                echo $fetch_data['s_number'];
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    }else{
                        echo"<tr>
                            <td>Result for today Will be Updated Soon.</td>
                        </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>