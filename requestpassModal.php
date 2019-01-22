<!DOCTYPE html>
<?php
 
include ('DbConnect.php');
/*error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");*/
?>
<?php
if (isset($_POST['validermdp']))
{
    var_dump($_POST);
    $EmailRequestMdp = filter_var($_POST['emailmdp'], FILTER_SANITIZE_EMAIL);
    if (filter_var($EmailRequestMdp, FILTER_VALIDATE_EMAIL)) 
    {
        $stmt = $mysqli->prepare("SELECT * FROM membres where email = ?");
        $stmt->bind_param('s', $EmailRequestMdp);   
        $stmt->execute();    
        $Membreresult = $stmt->get_result();
        $MembreDet = $Membreresult->fetch_assoc();
        if($Membreresult->num_rows == 0)
        {
            $errors .= 'not a user.<br/><br/>';
            //<!--h3 style="margin-top:-600px; margin-left:490px ;color: #6c09bc"> Votre requete n'a pas pu aboutir <br--> 
             
        }
        
    /*else
    {
        ?>
        <h3 style="margin-top:-600px; margin-left:490px ;color: #6c09bc"> Votre requete n\'a pas pu aboutir <br> 
        <?php
    }*/
    }
    else
    {
        $errors .= 'Please enter a valid email.<br/><br/>';
    }
    if (!$errors) 
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
            $urlmdp = "<a href='localhost/cookingwebsite/ChangerMdp.php?go&idMembre=" . $MembreDet['idMembre'] . "&email=".$MembreDet['email']."'> Cliquez ici</a>";
            
            $messagemail="pour changer votre mdp lerci de cliquer sur le lien suivant" . $urlmdp;
            /*var_dump($messagemail);
            var_dump($headerss); 
            var_dump($sujetemail);
            var_dump($expediteur);
            echo '<br>';*/
            // echo '<script>
                //   alert("Opération réussite, merci de vérifier votre messagerie \n redirection page d\'acceuil");
                //    </script>';
                mail($EmailRequestMdp,$sujetemail,$messagemail) ;

            /*if (mail($EmailRequestMdp,$sujetemail,$messagemail,$headerss)) 
            {
                echo 'ok';
                echo '<script>
                    alert("Un email a bien été envoyé");
                    window.location.href = "index.php"</script>'; 
        } */ 
            /*else 
            {
                echo 'not ok';
            echo '<script>
                    alert("Une erreur est  dans l\'envoi du mail !");
                    window.location.href = "index.php"</script>'; 
            } */  
         
    }
    else
    {
        echo $errors . '<br>';
    }
}
?>
</html>	