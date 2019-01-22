<?php
  if(isset($_SESSION))
  {
    if (isset($_SESSION['Username']))
      {
        if(isset($_SESSION['isAdmin']) && isset($_SESSION['idAdmin']) && $_SESSION['statutmembre'] == "admin")
        {
          include ('footerAdmin.php');   
        }
        else 
        {
          include ('footermembre.php');   
        }    
      }
      else
      {
        include ('footer.php');
      }
    }
    else
    {
      include ('footer.php');
    }