<!DOCTYPE html>
<html>
    <head></head>
  <body>
      
      
      <?php include('logged.php');
      if($typ!=1){
      header("Location: index.php");}
      

    if (isset($_POST['usun']))
      if (!empty($_POST['id_uzytkownika']) ){
          $u_id = $_POST['id_uzytkownika'];
          $sql = "DELETE FROM uzytkownik WHERE id_uzytkownika = ".$u_id;
            $zwroc = $connect->query($sql); 
      }
          ?>
      
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "center">
             
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Pomoce</b></div>
            <table>
                <tr>
                    <th>Użytkownik |</th>
                    <th> Akcja |</th>
                </tr>
                <?php
                $sql = "SELECT id_uzytkownika, imie, nazwisko, mail, login FROM uzytkownik";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>\n";
                        echo "<td>".$row['login']."</td>\n";
                        echo "<td><form method='POST' action=''> <input type='hidden' name='id_uzytkownika' value='"
                        .$row['id_uzytkownika']."'> <input type='submit' name='usun' value='Usuń'> </form></td>\n";
                        echo "</tr>";
                    }
                }
                ?>
			
            <div style = "margin:30px">

  </div>
</div>     
      </table> 
      </body>
</html>
          
