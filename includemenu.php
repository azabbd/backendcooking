<?php
 
 if(isset($_SESSION))
 {
   if (isset($_SESSION['Username']))
     {
       include ('menumembre.php');
     }
     else
       include ('menu.php');
 
   }
   else
       include ('menu.php');
  ?>