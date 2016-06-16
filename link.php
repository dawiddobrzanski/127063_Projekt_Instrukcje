<!DOCTYPE html>
<html>
    <head>
        <title>Dodaj link</title>
      
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
  <body>
      <?php include('logged.php');?>
      
      <div class="container">

      <form action = "link.php" class="form-signin" method = "post">
        <h2 class="form-signin-heading">Wgraj link:</h2>
        
        <label for="link" class="sr-only">Podaj link: </label>
        <input type="link" name = "link" class="form-control" id="link" placeholder="Podaj Link" required>
        
        <label for="opis" class="sr-only">Krótki opis linku:  </label>
        <input type="text" name = "tytul" class="form-control" placeholder="Podaj krótki opis linku">
        
        <button class="btn btn-lg btn-success btn-block" onclick="myFunction()" type="submit" value="Prześlij" name="submit">Prześlij</button>
        
      </form>

    </div>
      
      

<?php
 if(isset($_POST["submit"])) {
        $link = trim($_POST["link"]);
        $tytul = trim($_POST["tytul"]);
	$correct=true;
        
        //sprawdzamy linka
        
        if (filter_var($link, FILTER_VALIDATE_URL) === FALSE && $link != null) {
        echo "Link nie jest poprawny. <br>";
        $correct=false;
        }
        else
        {
            $link = mysqli_real_escape_string($connect,$_POST['link']);
			$sql = "SELECT id_pomocy FROM pomoce WHERE nazwa = '$link'";
                        //echo $sql;
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];

                        $count = mysqli_num_rows($result);

                        

                        if($count >0) {
                                echo '<p>Link już istnieje!</p>';
                                $correct=false;
				
			}
                        else $correct=true;
                        if($correct==true){
                        $sql = "INSERT INTO pomoce ". "(zatwierdzenie,tytul, nazwa, typ, login) ". "VALUES('2','$tytul','$link', '1', '$login_session')";
                        if (mysqli_query($connect, $sql)) {


                        } 
                        else {echo "Error: " . $sql . "<br>" . mysqli_error($connect);} 
                        mysqli_close($connect);

                        header("Location: index.php");
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