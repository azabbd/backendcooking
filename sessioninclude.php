<?php
 session_start(); 
 
 include('header.php');
if(isset($_SESSION))
{
  if (isset($_SESSION['Username']))
  {
    include ('menumembreHaut.php');
  }
  else
  {
    include ('menuHaut.php');
  }
}
else
{
  include ('menuHaut.php');
}



 $mysqli= new mysqli("localhost","root","","cooking");
 if (mysqli_connect_errno()) 
 {
     printf("Échec de la connexion : %s\n", mysqli_connect_error());
     exit();
 }
 ?>