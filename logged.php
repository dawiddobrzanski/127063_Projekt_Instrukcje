<?php
   include('baza.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($connect,"select login, id_typu from uzytkownik where login = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['login'];
   $typ = $row['id_typu'];
   
   
   if(!isset($_SESSION['login_user'])){
      header("location:sign_in.php");
   }
  
   ?>
  <html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                
                background-color: #eee;
            }
            .container2 {
            
            float: none;
            text-align: center;
            }
           .navbar-nav {
            display: inline-block;
            float: none;
            
            
          }

        
        </style>
        
    </head>
    <body>
        
        <h2>Witaj  <span class="label label-default"><?php echo $login_session; ?></span>  <a class="btn btn-danger" href = "sign_out.php" role="button">Wyloguj się</a><?php   if($typ==1)  {?> <a class="btn btn-warning" href="admin.php" role="button">Panel Admina</a> <?php   }?></h2>
            
            <nav class="navbar navbar-inverse"  >
                <div class="container2" >
                    <ul class="nav navbar-nav" >
                      <li><a class="navbar-brand" href="index.php">Strona Główna</a></li>
                      <li><a class="navbar-brand" href="upload.php">Wgraj plik</a></li>
                      <li><a class="navbar-brand" href="link.php">Wgraj link</a></li>
                        
                    </ul>
            </div></nav>
        
        
    </body>
</html>
