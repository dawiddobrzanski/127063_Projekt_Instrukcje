<!DOCTYPE html>
<html>
  <body bgcolor = "#FFFFFF">
      
      <?php include('logged.php');?>
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Wgraj plik:</b></div>
				
            <div style = "margin:30px">

  <form action="upload.php" method="post" enctype="multipart/form-data">
      
      Wskaż plik:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <p> Krótki opis pliku: <input type="text" name="tytul" /></p>
      <input type="submit" onclick="myFunction()" value="Prześlij" name="submit">
  </form>
            </div>
				
        </div>
      </div>		
      
  <?php
  
  require_once 'baza.php';
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
  
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
            
            echo $login_session;
            
            $sql = "INSERT INTO pomoce ". "(zatwierdzenie,tytul, nazwa, typ, login) ". "VALUES('2','$tytul','$nazwa', '2', '$login_session')";
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