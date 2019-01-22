<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>

<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">
  <div class="box mx-auto my-5 p-3" style="background:#fff; border:1px dashed grey; " > 
    <div class="row  mx-auto"  style=" color:#9D0461;  margin-bottom:5px;">
        <h4 style="color:#9D0461; text-align: left;"   > 
        Afin de pouvoir reinitialiser votre mot de passe, merci de fournir votre adresse mail  </h4>
    </div>
    <p> </p>
    <div class=" row center-block  mx-auto form-group  has-search" style="max-width:50%!important">
      <form method="post" action="" >  
        <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control" placeholder="email" aria-label="email" name="emailmdp" required="true">
        <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
        <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="validermdp">valider</button>
        </div>
      </form > 
    </div>
  </div>
</div>


	   <?php
 

/*INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `telephone`, `ville`, `codepostale`, `adresse`, `descirption`) VALUES ('2', 'sallyabbd', '1234', 'aa', 'sally', 'azaryabboud@hotmail.com', '0649574891', 'azerty', '78220', 'azertyu', 'azertgh');
*/



   
if (isset($_POST['validermdp'] ))
{
  $EmailRequestMdp=$email = filter_var($_POST['emailmdp'], FILTER_SANITIZE_EMAIL);
  $stmt = $mysqli->prepare("SELECT * FROM membres where email = ?");
  $stmt->bind_param('s', $EmailRequestMdp);   
  $stmt->execute();    
  $Membreresult = $stmt->get_result();
  $MembreDet=$Membreresult->fetch_assoc();
  if($Membreresult->num_rows==0)
  {
    ?>
    <h3 style="margin-top:-600px; margin-left:490px ;color: #6c09bc"> Votre requete n\'a pas pu aboutir <br> 
    <?php
  }
  else
  {
    //echo '<h5 style=" margin-top:-150px;  margin-left:390px;color: #6c09bc"> Un emailvient de vous etre envoyé pour changer votre mdp </h5><br>';
    
    $expediteur="azaryabboud@gmail.com";
    $headerss  = 'MIME-Version: 1.0' . "\n";
    $headerss .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
    $headerss .= 'Reply-To: ' . $expediteur . "\n";
    $headerss .= "From: Cooking\n";
    $headerss .= 'Delivered-to: ' . $MembreDet['email'] . "\n";
    $headerss .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $sujetemail="mdp";
    $urlmdp="<a href='localhost/cookingwebsite/ChangerMdp.php?go&idMembre=".$MembreDet['idMembre']."&email=".$MembreDet['email']."'> Cliquez ici</a>";
     
    $messagemail="pour changer votre mdp lerci de cliquer sur le lien suivant".$urlmdp;
     
    echo '<script>
          alert("Opération réussite, merci de vérifier votre messagerie \n redirection page d\'acceuil");
            </script>';
    if (mail($EmailRequestMdp,$sujetemail,$messagemail,$headerss)) 
    {
      echo '<script>
            alert("Un email a bien été envoyé");
            window.location.href = "index.php"</script>';
    } 
    else 
    {
      echo '<script>
            alert("Une erreur est  dans l\'envoi du mail !");
            window.location.href = "index.php"</script>';
    }  
  }
}

 
 
?>
 

</body>
<?php
include ('sessionincludeFooter.php');

 ?> 
   </html>



  