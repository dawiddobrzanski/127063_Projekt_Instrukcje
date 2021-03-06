<?php 
if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8" />
	<title>Rejestracja</title>
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
	<body>
            	
<?php
//Jeśli sesja nie jest ustawiona i został wysłany formularz rejestracji:
if(!isset($_SESSION["login_user"]) && (isset($_POST["Rejestracja"]) && $_POST["Rejestracja"]!= null)){


//Pobranie danych wysłanych przez formularz
        $imie = trim($_POST["imie"]);
        $nazwisko = trim($_POST["nazwisko"]);
	$login = trim($_POST["login"]);
	$password = trim($_POST["haslo"]);
	$email = trim($_POST["email"]);
	
	if($login != null && $password != null && $email != null && $imie != null && $nazwisko != null){
		$correct = true;
		require_once 'baza.php';
		
		// LOGIN
		if(ctype_alnum($login) && strlen($login) > 4 && strlen($login)<20){
			$login = mysqli_real_escape_string($connect,$_POST['login']);
			$sql = "SELECT id_uzytkownika FROM uzytkownik WHERE login = '$login'";
                        //echo $sql;
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        
                        $count = mysqli_num_rows($result);

                        

                        if($count >0) {
                                echo '<p>Login już istnieje!</p>';
				$correct = false;
			}
		}else{
			echo '<p>Niepoprawny login!</p>';
				$correct = false;
		}
		
			// hasło
		if(strlen($password) > 3 && strlen($password)<20){
			$password = crypt($password, '$2a$11$o8xak4vbwevd9ylqbp2uvz61t$');
			$password = substr($password, 40);
		}else{
			echo '<p>Niepoprawne hasło!</p>';
			$correct = false;
		}
		
				//EMAIL
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$email = mysqli_real_escape_string($connect,$_POST['email']);
			$sql = "SELECT id_uzytkownika FROM uzytkownik WHERE mail = '$email'";
                        
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];

                        $count = mysqli_num_rows($result);
                        
                        //Jeśli coś znajdzie jest błąd

                        if($count >0) {
				echo '<p>Email już istnieje!</p>';
				$correct = false;
                                    }
                        }
                        
                        else{
                                echo '<p>Niepoprawny email!</p>';
                                $correct = false;
                        }
                        //echo $correct;
                        //Jeśli jest wszystko ok:
                        if($correct == true){
			
			
                        //$password = mysqli_real_escape_string($connect,$_POST['haslo']);
		
			$sql = "INSERT INTO uzytkownik ". "(imie,nazwisko, mail, login, haslo, id_typu) ". "VALUES('$imie','$nazwisko','$email', '$login', '$password', '2')";
                        //echo $sql;
                        
                        if (mysqli_query($connect, $sql)) {
                        echo "New record created successfully";
                        header("Location: sign_in.php");
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                        }

                                            mysqli_close($connect);
		}
	}else{
		$message = "Wypełnij popranwie wymagane pola!";
		echo '<div style="background-color: #B1C9DF; margin: 20%;  line-height: 50px; text-align: center"><span>'.$message.'</span></div>';
	}
}
?>
	  
    <div class="container">

      <form id="rejestracja" action="sign_up.php" class="form-signin" method = "post">
        <h2 class="form-signin-heading">Rejestracja</h2>
        
        <label for="login" class="sr-only">Imię: </label>
        <input type="text" name = "imie" class="form-control" placeholder="Podaj Imię" required>
        
        <label for="login" class="sr-only">Nazwisko: </label>
        <input type="text" name = "nazwisko" class="form-control" placeholder="Podaj Nazwisko" required>
        
        <label for="login" class="sr-only">Login: </label>
        <input type="text" name = "login" class="form-control" placeholder="Podaj Login" required>
        
        <label for="login" class="sr-only">Email: </label>
        <input type="text" name = "email" class="form-control" placeholder="Podaj Email" required>
        
        <label for="password" class="sr-only">Hasło</label>
        <input type="password" name = "haslo" class="form-control" placeholder="Podaj Hasło" required>
       
        <button class="btn btn-lg btn-success btn-block" type="submit" value="Rejestracja" name="Rejestracja">Zarejestruj się</button>
        <a class="btn btn-primary btn-block" href="sign_in.php" role="button">Przejdź do logowania</a>
      </form>

    </div>
            
            
	</body>
</html>

