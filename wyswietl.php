<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pomoce</title>
        <style>
        body {
            padding-top: 0px;
            padding-bottom: 40px;
            background-color: #eee;
          }

        .container {
            max-width: 540px;
            padding: 15px;
            margin: 0 auto;
          }  
      </style>
        
    </head>
    <body>
        
 <div class="container">

     
        <h2 class="form-signin-heading">Pomoce</h2>
        
        <table class="table">
                    <tr>
                        <th class="table-bordered">Właściciel</th>
                        <th class="table-bordered">Opis</th>
                        <th class="table-bordered">Link</th>
                        <?php if($typ==1){?><th class="table-bordered">Akcja</th> <?php }?>
                    </tr>
                    <?php
                    
                            if (isset($_POST['usun']))
                  if (!empty($_POST['id_pomocy']) ){
                      $p_id = $_POST['id_pomocy'];
                      $sql = "DELETE FROM pomoce WHERE id_pomocy = ".$p_id;
                        $zwroc = $connect->query($sql); 
                        if ($_POST['typ'] == 2)
                          $path = "uploads/".$_POST['nazwa'];
                          unlink($path);

                  }
                $sql = "SELECT id_pomocy, tytul, login, nazwa, typ FROM pomoce";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>\n";
                        echo "<td>".$row['login']."</td>\n";
                        echo "<td>".$row['tytul']."</td>\n";
                        if($row["typ"]==1){echo "<td>"."<a href =".$row["nazwa"]. ">link"."</a></td>";} 
                        else {echo "<td>"."<a href ="." http://127.0.0.1/127063_Projekt_Instrukcje/uploads/". preg_replace('/\s+/', '%20',$row["nazwa"]). ">link"."</a></td>";}
                        
                        
                        if($typ==1){
                        echo "<td><form method='POST' action=''> <input type='hidden' name='id_pomocy' value='"
                        .$row['id_pomocy']."'><input type='hidden' name='nazwa' value='"
                        .$row['nazwa']."'> <input type='hidden' name='typ' value='"
                        .$row['typ']."'> <button class='btn btn-danger' type='submit' value='Usuń' name='usun'>Usuń</button> </form></td>\n";
                        }
                        
                        echo "</tr>";
                    }
                }
                ?>
                    
            </table>  

    </div>       
  
	
    </body>
</html>

    
 