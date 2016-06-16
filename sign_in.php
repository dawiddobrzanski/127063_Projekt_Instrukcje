<?php
   include("baza.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
      
      $myusername = mysqli_real_escape_string($connect,$_POST['username']);
      $mypassword = mysqli_real_escape_string($connect,$_POST['password']);
      $mypassword = crypt($mypassword, '$2a$11$o8xak4vbwevd9ylqbp2uvz61t$');
      $mypassword = substr($mypassword, 40);
      
      $sql = "SELECT id_uzytkownika FROM uzytkownik WHERE login = '$myusername' and haslo = '$mypassword'";
      //echo $sql;
      $result = mysqli_query($connect,$sql);
      if (!$result) {
          echo '<p>Niepoprawne hasło!</p>';
    
    exit();
        }

      $count = mysqli_num_rows($result);
      
      
	//Jeśli jest prawidłowo powinno zwrócić 1	
      if($count == 1) {
         $_SESSION['myusername']="login";
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
         echo '<p>Niepoprawne hasło lub login!</p>';
      }
   }
?>
<html>
   
   <head>
      <title>Strona Logowania</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
          }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
          }  
      </style>
      
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
       <div class="container">

      <form class="form-signin" method = "post">
        <h2 class="form-signin-heading">Logowanie</h2>
        
        <label for="login" class="sr-only">Login: </label>
        <input type="text" name = "username" class="form-control" placeholder="Podaj login" required>
        
        <label for="password" class="sr-only">Hasło: </label>
        <input type="password" name = "password" class="form-control" placeholder="Podaj hasło" required>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Zapamiętaj
            
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"> Zaloguj</button>
        
        <a class="btn btn-success btn-block" href="sign_up.php" role="button">Rejestracja</a>
      </form>

    </div>

   </body>
</html>