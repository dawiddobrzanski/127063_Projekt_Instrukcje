<?php
   include('baza.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($connect,"select login from uzytkownik where login = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['login'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:sign_in.php");
   }
?>