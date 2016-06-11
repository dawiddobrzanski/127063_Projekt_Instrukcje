<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
<div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "center">
             
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Pomoce</b></div>
            <table>
                    <tr>
                        <th>Właściciel |</th>
                        <th> Opis |</th>
                        <th> Link</th>
                        
                    </tr>
                    
            </table>  
				
            <div style = "margin:30px">
                
         
            
<?php 

    if (isset($_POST['usun']))
      if (!empty($_POST['id_pomocy']) ){
          $p_id = $_POST['id_pomocy'];
          $sql = "DELETE FROM pomoce WHERE id_pomocy = ".$p_id;
            $zwroc = $connect->query($sql); 
            if ($_POST['typ'] == 2)
              $path = "uploads/".$_POST['nazwa'];
              unlink($path);
            //var_dump($path); die();
      }

$sql = "SELECT id_pomocy, tytul, login, nazwa, typ FROM pomoce";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $licznik=0;
    while($row = $result->fetch_assoc()) {
        
        if($row["typ"]==1)
            echo " " . $row["login"]. " | " . $row["tytul"]. " | <a href =".$row["nazwa"]. ">link"."</a></br>"; 
       
        else
            echo " " . $row["login"]. " | " . $row["tytul"]. " | <a href ="." http://127.0.0.1/127063_Projekt_Instrukcje/uploads/". preg_replace('/\s+/', '%20',$row["nazwa"]). ">link"."</a></br>";
        if($typ==1){
            echo "<td><form method='POST' action=''> <input type='hidden' name='id_pomocy' value='"
                        .$row['id_pomocy']."'><input type='hidden' name='nazwa' value='"
                        .$row['nazwa']."'> <input type='hidden' name='typ' value='"
                        .$row['typ']."'> <input type='submit' name='usun' value='Usuń'> </form></td>\n";
        }
            
    }
} else {
    echo "0 results";
}
$connect->close();
?>            </div>
</div> 
         
    </body>
</html>

    
 