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
    //printf("Error: %s\n", mysqli_error($connect));
    exit();
}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
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
      <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
      
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Logowanie</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Login  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Hasło  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Zaloguj "/><br />
                  <h2><a href = "sign_up.php">Rejestracja</a></h2> 
               </form>
               
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>