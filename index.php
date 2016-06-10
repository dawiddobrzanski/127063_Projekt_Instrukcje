<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
       include('logged.php');
        
        ?>
        <h1>Welcome <?php echo $login_session; ?></h1>
        <h2><a href = "sign_out.php">Sign Out</a></h2> 
    </body>
</html>
