<!DOCTYPE html>
<html>
  <body>
      
      
      <?php include('logged.php');?>
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Wgraj link:</b></div>
				
            <div style = "margin:30px">
      <form action = "link.php" method = "post">
                  Podaj link:
      <input type="link" name="link" id="link">
      <p> Krótki opis linku: <input type="text" name="tytul" /></p>
      <input type="submit" onclick="myFunction()" value="Prześlij" name="submit">
               </form>

            </div>
				
        </div>
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