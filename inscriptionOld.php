<!DOCTYPE html>
<html>
 
  
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>

  <body  >
  <div class="container page-container mt-3 "  >
  <?php
  include ('includemenu.php');
if(isset($_SESSION))
{
  if (isset($_SESSION['Username']))
  {
    //include ('menumembre.php');
    $url= 'Location: membredetails.php?idMmembre='.$_SESSION['idMembre'].'&idconnexion=istablished';
    header($url);
  }
}
      

$pseudoErr = $emailErr = $mdpErr = $websiteErr =$desErr=$adrErr=$nomErr=$prenomErr=$villeErr=$cpErr=$telErr= "";
$name = $email = $gender = $comment = $website = "";


 if (ISSET($_POST["submitForm"]))//$_SERVER["REQUEST_METHOD"] == "POST") 
 {
  $pseudoErr = $emailErr = $mdpErr = $websiteErr =$desErr=$adrErr=$nomErr=$prenomErr=$villeErr=$cpErr=$telErr= "";
  $name = $email = $website = "";
  $urpseudo=filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
  //$uremail=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $uremail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  if (empty($_POST["urdesc"]))
  {
    $urdesc=" ";
  }
  else
  {
    $urdesc=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  }
  $urnom=filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
  $urmdp=filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
  $urprenom=filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
  if($urpseudo && $uremail && $urdesc && $urnom && $urmdp && $urprenom)
  {
    if (empty($_POST["pseudo"])) 
    {
      $pseudoErr = "login is required";
    } 
    else 
    {//pseudo not empty
      $name = test_input($urpseudo);
      // check if name only contains letters, nbrs and 
        if (!preg_match("/^[a-zA-Z0-9]*$/",$name)) 
          {
            $pseudoErr = "Only letters, numbers  space allowed"; 
          }
        else//good format
          {
          //$urpseudo=$_POST["pseudo"];
          //var_dump($urpseudo);
          $resultlog = $mysqli->query("SELECT *  FROM  membres WHERE login = '$urpseudo'");
          //var_dump($result);
            if ($resultlog->num_rows > 0) //pseudo is reserved to another user
            {
              $pseudoErr = "login is reserved to another user";        
            }
            else //pseudo free
              {
                $pseudoErr= "";
                //$urpseudo=$_POST["pseudo"];                
              }
          }
        } //end pseudo check

 
 
  if (empty($_POST["mdp"])) 
  {
    $mdpErr = "mdp is required";
  } 
  else //not empty
  {
    //$urmdp=$_POST["mdp"];
    if (strlen($urmdp)<3 || strlen($urmdp)>20) //too short too long
    {
      $mdpErr = "longueur mdp entre 3  et 20"; 
      //echo $mdpErr .'<br>';
    }
    else   
    {
      if(preg_match("/^[a-zA-Z0-9]*$/",$urmdp))  
      {
        $urmdp = password_hash($urmdp, PASSWORD_DEFAULT);
        $mdpErr ="";
      }
      else
      {
        $mdpErr ="only letters and numbers";
      }
    }
  }
  

  if (empty($uremail)) 
  {
    $emailErr = "";
  } 
  else //not empty 
  {
    $email = test_input($uremail);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
    }//elseif($uremail.checkValidity())
    else
    {
    //$uremail=$_POST["email"];
        //var_dump($urpseudo);
      $resultsssss=$mysqli->query("SELECT *  FROM  membres WHERE email='$uremail'");
        //var_dump($result);
      if ($resultsssss->num_rows>0) //email is reserved to another user
      {
        $emailErr = "email is reserved to another user";        
      } //good format
      else
      {
        $emailErr ="";
        //$uremail=$_POST["email"];
        //echo " email good <br>";
      }
    }
  }



if (empty($_POST["nom"]))
{
$nomErr = "nom is required";
} 
else 
{
  $name = test_input($urnom);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
  {
    $nomErr = "Only letters and white space allowed"; 
  }
  else
  {
    $nomErr="";
    // $urnom=$_POST["nom"];
    //echo " nom good <br>";
  }
}




if (empty($_POST["prenom"])) 
{
  $prenomErr = "prenom is required";
} 
else {
  $name = test_input($urprenom);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
  {
    $prenomErr = "Only letters and white space allowed"; 
  }
  else //good format
  {
    $prenomErr ="";
    //$urprenom=$_POST["prenom"];
    // echo " pre good <br>";
  }
}

 
if (empty($_POST["description"])) 
{
  $desErr = "";
} 
else
{
  $desErr ="";
  // $urdesc=$_POST["description"];
  // echo " des good <br>";
}

//if (!empty($_FILES["fileupload"]["name"])) 
//{
  

     
 

if($desErr==""  && $nomErr=="" && $prenomErr=="" && $pseudoErr=="" && $emailErr=="" && $mdpErr=="")
{
  /*  $reId=$mysqli->query("SELECT MAX(idMembre) from membres");
    $reId=$reId->fetch_assoc();
    $reId++;
    */
    $date = date('Y-m-d H:i:s');
   // $reId=(int)$reId;

   //image handling
  $target_dir = "C:/wamp64/www/CookingWebsite/photos/gravatars/";
  $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
   
  $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
  if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
     // echo "File is not an image.";
      ?>
      <script language="javascript"> 
        alert("File is not an image.");
    </script>
    <?php
      $uploadOk = 0;
  }
 // Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  ?>
    <script language="javascript"> 
      alert("Sorry, file already exists.");
  </script>
  <?php
  $uploadOk = 0;
}
// Check file size
if ($_FILES["fileupload"]["size"] > 500000) {
  //echo "Sorry, your file is too large.";
  ?>
    <script language="javascript"> 
      alert("Sorry, your file is too large.");
  </script>
  <?php
  $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  ?>
    <script language="javascript"> 
      alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  </script>
  <?php
  $uploadOk = 0;
}
//}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
 // echo "Sorry, your file was not uploaded.";
  ?>
    <script language="javascript"> 
      alert("Sorry, your file was not uploaded.");
  </script>
  <?php 
// if everything is ok, try to upload file
} 
else 
{
  if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) 
  {
    $gravatarName = basename($_FILES["fileupload"]["name"]);
   // echo "The file ".$gravatarName . " has been uploaded.";
  }
  else 
  {
    ?>
    <script language="javascript"> 
      alert("Sorry, there was an error uploading your file.");
  </script>
  <?php 
    //echo "Sorry, there was an error uploading your file.";
  }
}
//image handling

    $result=$mysqli->query("INSERT INTO membres (gravatar,login,password,statut,prenom,nom,dateCrea,About,email ) VALUES ('$gravatarName','$urpseudo','$urmdp','membre','$urprenom','$urnom','$date','$urdesc','$uremail' )");
    //var_dump($result);
    if($result)
    {
      ?>
    
    <script> 
    // alert("Bienvenue, votre inscrition validée.\n Veuillez vous connecter");
    //window.location.href="connexion.php";
    $(document).ready(function(){
      $('#inscModal2').modal('show');
    //$('#myModal').on('shown.bs.modal');
    //console.log('ok');
    });
    </script>

    <?php
    
  }
  else
  { 
    ?>
    <script language="javascript"> 
        alert("Erreur d\'enregistrement 101 ");
        </script> 
        <?php
  } 
  
}
else
{
   ?>
  <script language="javascript"> 
      alert("Erreur d\'inscription 404");
  </script> 
      <?php  
      /*echo $desErr .'<br>';
      var_dump($resultlog);
      echo $nomErr .'<br>';
      echo $prenomErr .'<br>';
      echo $pseudoErr .'<br>';
      echo $urpseudo .'<br>';
      echo $emailErr .'<br>';
      echo $mdpErr .'<br>';*/
    }

}
else 
{
  ?>

  <script language="javascript"> 
alert("Erreur filter format ");

</script> 
<?php
 }
}

 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
 

    <div class ="row mx-auto my-5">
      <div  class= "col-10 offset-md-1 offset-lg-1 offset-sm-1 offset-xs-1 offset-xl-1 p-2" style=" color:#9D0461; border-style: dashed;border-color: black;	border-width: 2px; text-align: center " class="my-5">
        <h5  style="color: #6c09bc">  Afin de pouvoir vous inscrire, merci de remplir le formulaire suivant </h5> 
      </div>
    </div>
    <div class ="row mx-auto my-5">
      <div class= "col-10 offset-md-1 offset-lg-1 offset-sm-1 offset-xs-1 offset-xl-1" style=" border-style: dashed;border-color: black;	border-width: 2px;background-image: url('photos/fruits-legumes/citron.jpeg');" > 
        <div class=" form pt-3"   >
          <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="pseudo">Login *</label><br>
              <input type="text" name="pseudo" placeholder="login"style="border-radius:1rem " id="pseudo"minlength=3 ><span class="error">  
              <?php// echo $emailErr;?>
                <?php
                  if($pseudoErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $pseudoErr;?>
                  </div>
                  </span> 
            
                 <?php
                   }
                   ?>
             
              </div>
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="mdp">Password *</label><br>
              <input type="password" name="mdp" placeholder="password"style="border-radius:1rem " id="mdp" minlength=3 ><span class="error">   
                <?php
                  if($mdpErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $mdpErr;?>
                  </div>
                  </span><br><br>
            
                 <?php
                   }
                   ?>
              </span><br><br>
            </div>
            <div class="form-group form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="nom"> Nom *</label><br>
              <input type="text" name="nom" placeholder="nom" id="nom"style="border-radius:1rem "  ><span class="error">  
                 
              <?php
                  if($nomErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $nomErr;?>
                  </div>
                  </span><br><br>
            
                 <?php
                   }
                   ?>
                   </span><br><br>
            </div>
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="prenom">Prenom *</label><br>
              <input type="text" name="prenom" placeholder="prenom" style="border-radius:1rem; "id="prenom"  > 
               
               <?php
                  if($prenomErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $prenomErr;?>
                  </div>
                  </span><br><br>
            
                 <?php
                   }
                   ?>
                   </span><br><br>
            </div>
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="email">Email *</label><br>
              <input type="text" name="email" placeholder="email"style="border-radius:1rem; " id="email">
              <span class="error ">  
                <?php// echo $emailErr;?>
                <?php
                  if($emailErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $emailErr;?>
                  </div>
                  </span> 
            
                 <?php
                   }
                   ?>
                   </span> 
            </div>
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-2">
              <label for="description">Description </label><br>
              <input type="textarea" name="description" placeholder="Description"style="border-radius:1rem;  height:100px" id="description" rows="4" cols="20">
                <?php
                  if($desErr!="")
                  {
                  ?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $desErr;?>
                  </div>
                  </span><br><br>
            
                 <?php
                   }
                   ?>
                   </span><br><br>
            </div>
            <div class="form-group col-lg-4 offset-lg-4 col-md-8 offset-md-3 offset-lg-3">
             
              <label for="fileupload"> Select a file to upload</label> 
              <input type="file" name="fileupload" value="fileupload" id="fileupload"> 
              <input type="submit" class="btn btn-outline-success my-2 py-2 my-sm-0 butsearch mb-4" name ="submitForm" value="Enregistrement"> 
            </div>
          </form>
        </div>
      </div>
	  </div>
 
   </div><!--.page-container-->

<div id="inscModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header  ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <!--h3 class="text-center">Reinitialiser votre mdp</h3-->
    </div>
    <div class="modal-body">
      <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                      <p>inscription réussite, veuillez vous connectez</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="col-md-12">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="modalinscredirect">redirection</button>
		  </div>	
      </div>
  </div>
</div>
</div>

</body>
<?php 
 
 
include ('sessionincludeFooter.php');
 ?>
     <script> 
    // alert("Bienvenue, votre inscrition validée.\n Veuillez vous connecter");
    //window.location.href="connexion.php";
    $(document).ready(function(){
      $('#modalinscredirect').click(function(){ 
        window.location.href="connexion.php";});
    });
    </script>
<script>
      //$( function() {
      //$( "#dialog" ).dialog();
      //} );
      </script>
           
</html>