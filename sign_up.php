<?php 
if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8" />
	<title>Rejestracja</title>
	</head>
	<body>
            <p>Możesz się zalogować <a href="sign_in.php">tutaj</a></p>	
<?php
//Jeśli sesja nie jest ustawiona i został wysłany formularz rejestracji:
if(!isset($_SESSION["login_user"]) && (isset($_POST["Rejestracja"]) && $_POST["Rejestracja"]!= null)){


//Pobranie danych wysłanych przez formularz
	$login = trim($_POST["login"]);
	$password = trim($_POST["haslo"]);
	$email = trim($_POST["email"]);
	
	if($login != null && $password != null && $email != null){
		$correct = true;
		require_once 'baza.php';
		
		// LOGIN
		if(ctype_alnum($login) && strlen($login) > 4 && strlen($login)<20){
			$login = mysqli_real_escape_string($connect,$_POST['login']);
			$sql = "SELECT id_uzytkownika FROM uzytkownik WHERE login = '$login'";
                        //echo $sql;
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];

                        $count = mysqli_num_rows($result);

                        // If result matched $myusername and $mypassword, table row must be 1 row

                        if($count >0) {
                                echo '<p>Login już istnieje!</p>';
				$correct = false;
			}
		}else{
			echo '<p>Niepoprawny login!</p>';
				$correct = false;
		}
		
			// PASSWORD
		if(strlen($password) > 3 && strlen($password)<20){
			$password = crypt($password, '$2a$11$o8xak4vbwevd9ylqbp2uvz61t$');
			$password = substr($password, 40);
		}else{
			echo '<p>Niepoprawne hasło!</p>';
			$correct = false;
		}
		
				//EMAIL
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			//$connect = new DB_connect();
			//$connect -> set_charset("utf8");
			$email = mysqli_real_escape_string($connect,$_POST['email']);
		
			$sql = "SELECT id_uzytkownika FROM uzytkownik WHERE mail = '$email'";
                        //echo $sql;
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];

                        $count = mysqli_num_rows($result);

                        // If result matched $myusername and $mypassword, table row must be 1 row

                        if($count >0) {
				echo '<p>Email już istnieje!</p>';
				$correct = false;
			}
		}else{
			echo '<p>Niepoprawny email!</p>';
			$correct = false;
		}
		echo $correct;
		//Jeśli jest wszystko ok:
		if($correct == true){
			//$connect = new DB_connect();
			//$connect->set_charset("utf8");
			
                        $password = mysqli_real_escape_string($connect,$_POST['haslo']);
		
			$sql = "INSERT INTO uzytkownik ". "(imie,nazwisko, mail, login, haslo, id_typu) ". "VALUES('Przemek','Ostry','$email', '$login', '$password', '2')";
                        //echo $sql;
                        
                        if (mysqli_query($connect, $sql)) {
                        echo "New record created successfully";
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
	<div id="zarejestruj">
			<form id="rejestracja" action="sign_up.php" method="post">
				<p> Login: <input type="text" name="login" /></p>
				<p>Hasło: <input type="password" name="haslo" /></p>
				<p>Email: <input type="text" name="email" /></p>
				<p><input type="submit" value="Rejestracja" name="Rejestracja" /></p>
			</form>
			</div>	
		</div>
	</body>
</html>

