<?php
   include('baza.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($connect,"select login from uzytkownik where login = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['login'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:sign_in.php");
   }
  
   ?>
  <html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <h1>Witaj <?php echo $login_session; ?></h1><a href = "sign_out.php">Wyloguj się</a>
        <h2 align = "center"> ||<a href = "index.php">Strona Główna</a> || <a href = "upload.php">Wgraj plik</a> || <a href = "link.php">Wgraj link</a>||</h2>
        
    </body>
</html>
