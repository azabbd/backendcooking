
<!DOCTYPE html>
<html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
<body >  
<div class="container page-container mt-3  "  style="padding-top: 60px;">
<?php include ('includemenu.php'); ?>
    <div class="row contact-form m-5" style=" border-style: dashed;border-color: grey;	border-width: 1px;">
        <form method="post">
            <h3 class="p-5"style="color: #6c09bc">Pour nous contacter, merci de remplir le formulaire suivant:</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="fullname" class="form-control" placeholder="Nom *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="  Email *" value="" />
                    </div>
                        
                    <div class="form-group mt-3 pl-5 ml-5">
                        <input type="submit" name="Envoi" class="  butsearch" value="Envoi" style=" width: 50%;"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="Message" class="form-control" placeholder="  Message *" style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
            </div><div class="shadow"  ></div>  
            </form><div class="shadow"  ></div>  
        </div>
          
       <?php
$adminemail= 'azaryabboud@gmail.com';
if (isset($_POST['Envoi']))
	{
         /*echo $uremail=$_POST['email'];
       echo  $to = $adminemail;
       echo  $subject = $_POST['Sujet']. ' from ' . $_POST['email'];
       echo  $message =  $_POST['Message'];*/
		$uremail=$_POST['email'];
        $to = $adminemail;
        $subject = $_POST['Sujet']. ' from ' . $_POST['email'];
        $message =  $_POST['Message'];
           //if(mail($to, $subject, $message ))
          //{ 
              ?>
         <h5 style="  margin-left:390px;color: #6c09bc"> your email was sent to website admin. </h5>
         <?php 
         // }
 		   }

?>
 
</div>



  <?php  
include ('sessionincludeFooter.php');
  ?>
</body>
   </html>