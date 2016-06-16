<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodaj plik</title>
        <style>
        body {
            padding-top: 0px;
            padding-bottom: 40px;
            
          }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
          }  
      </style>
        
    </head>
        
  <body >
      
      <?php include('logged.php');?>
      
      <div class="container">

      <form action="upload.php" method="post" enctype="multipart/form-data" class="form-signin" accept-charset="UTF-8">
        <h2 class="form-signin-heading">Wgraj plik:</h2>
        
        <label for="plik" class="sr-only">Wskaż plik: </label>
        <input type="file" name = "fileToUpload" class="form-control" id="fileToUpload" required>
        
        <label for="opis" class="sr-only">Krótki opis pliku:  </label>
        <input type="text" name = "tytul" class="form-control" placeholder="Podaj krótki opis pliku">
        
        <button class="btn btn-lg btn-success btn-block" onclick="myFunction()" type="submit" value="Prześlij" name="submit">Prześlij</button>
        
      </form>

    </div>
      
  <?php
  
  require_once 'baza.php';
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
  
    
    $plik_nazwa_nowa = basename($_FILES["fileToUpload"]["name"]);
    $ogonki=array('ą','ć','ę','ł','ń','ó','ś','ź','ż','Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż');
    $bez_ogonkow=array('a','c','e','l','n','o','s','z','z','A','C','E','L','N','O','S','Z','Z');
    
    $plik_nazwa_nowa = str_replace($ogonki, $bez_ogonkow, $plik_nazwa_nowa);
    $target_file = $target_dir . $plik_nazwa_nowa;
  
  if(isset($_POST["submit"])) {
      
      //Brak pliku
      if ($target_file == null) {
        echo "Brak pliku!. <br>";
        $uploadOk = 0;
    }
      

    // Sprawdź czy plik istnieje
    if (file_exists($target_file)) {
        echo "Brak wybranego pliku lub dany plik jest już w bazie!. <br>";
        $uploadOk = 0;
    }
    // Ogranieeczenie rozmiaru
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Niestety, dany plik jest za duży. <br>";
        $uploadOk = 0;
    }
    // finalne sprawdzenie czy wszystko jest ok
    if ($uploadOk == 0) {
        echo "Niestety operacja wgrania nie przebiegła pomyślnie. <br>";
    // upload pliku
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
           
            echo "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został dodany. <br>";
            $tytul = trim($_POST["tytul"]);
            $nazwa = basename( $_FILES["fileToUpload"]["name"]);
            
            echo $nazwa;
            
            $sql = "INSERT INTO pomoce ". "(zatwierdzenie,tytul, nazwa, typ, login) ". "VALUES('2','$tytul','$plik_nazwa_nowa', '2', '$login_session')";
            if (mysqli_query($connect, $sql)) {
            
            
            } 
            else {echo "Error: " . $sql . "<br>" . mysqli_error($connect);} 
            mysqli_close($connect);
		
            header("Location: index.php");
        } else {
            echo "Wystąpił błąd podzczas wgrywania pliku. <br>";
        }
    }
  }
  
  ?>
<script>
function myFunction() {
    
    alert("Wykonano!");
}
</script>
  </body>
</html>