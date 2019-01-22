<!DOCTYPE html>
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
      include ('menuHaut.php');

  }
  else
      include ('menuHaut.php');
?>
 

<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">

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
$mysqli= new mysqli("localhost","root","","cooking");

 ?>


<div class="row">
<h2 style="color:#9D0461;"> En cours de construction..</h2>
     </div> 
     </div>
	</body>
	
<?php
  if(isset($_SESSION))
  {
    if (isset($_SESSION['Username']))
      {
        include ('footermembre.php');
              
      }
      else
        include ('footer.php');

    }
    else
        include ('footer.php');
 
  ?>
 		

   </html>