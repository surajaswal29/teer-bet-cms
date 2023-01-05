<?php
    
    include "function.inc.php";
    
    $to="shillonglocalteer01011990@gmail.com";
    $sub="Password Reset";
    $msg="
    <html>
        <head>
        </head>
        <body>
            <h4>Click on this link to reset your admin password</h4>
            <a href='https://shillonglocalteernight1.in/admin/localpassshillong.php'>Click Here</a>
        </body>
    </html>";
     
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: teeradmin@shillonglocalteernight1.in' . "\r\n";
    
    if(mail($to,$sub,$msg,$headers)){
        redirect('index.php');
    }else{
        echo"error!";
    }
?>