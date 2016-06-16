<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <style>
        body {
            padding-top: 0px;
            padding-bottom: 40px;
            background-color: #eee;
          }

        .container {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
          }  
      </style>
    </head>
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
      
      <div class="container">

     
        <h2 class="form-signin-heading">Usuń użytkownika</h2>
        
        <table class="table">
                    <tr>
                        <th class="table-bordered">Użytkownik</th>
                        <th class="table-bordered">Akcja</th>
                        
                    </tr>
      
      
                <?php
                $sql = "SELECT id_uzytkownika, imie, nazwisko, mail, login FROM uzytkownik";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>\n";
                        echo "<td>".$row['login']."</td>\n";
                        echo "<td><form method='POST' action=''> <input type='hidden' name='id_uzytkownika' value='"
                        .$row['id_uzytkownika']."'>"?> <input type='submit' name='usun' class="btn btn-danger" value='Usuń'> <?php "  </form></td>\n";
                        echo "</tr>";
                    }
                }
                ?>
		
                        
            

     
      </table> 
      </body>
</html>
          
