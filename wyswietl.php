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
$sql = "SELECT tytul, login, nazwa, typ FROM pomoce";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["typ"]==1)
            echo " " . $row["login"]. " | " . $row["tytul"]. " | <a href =".$row["nazwa"]. ">link"."</a></br>";
        
        else
            echo " " . $row["login"]. " | " . $row["tytul"]. " | <a href ="." http://127.0.0.1/127063_Projekt_Instrukcje/uploads/". preg_replace('/\s+/', '%20',$row["nazwa"]). ">link"."</a></br>";
           
    }
} else {
    echo "0 results";
}
$connect->close();
?>            </div>
</div> 
         
    </body>
</html>

    
 