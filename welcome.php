<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>


<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">
 
</div><!--.page-container-->
</body>
 


<?php
 
 

if (isset($_POST['SubmitNews'] ) && isset($_GET['go']))
 {
    if ( !empty($_POST['nomNews'] ) && !empty($_POST['prenomNew'] )&& !empty($_POST['EmailNews'] ) )
    {

        $name = filter_var($_POST['prenomNew'], FILTER_SANITIZE_STRING);
        //var_dump($name);
        $surname = filter_var($_POST['nomNews'], FILTER_SANITIZE_STRING);
        //var_dump($surname);
        $email = filter_var($_POST['EmailNews'], FILTER_SANITIZE_EMAIL);
        //var_dump($email);
       // $myinputs = filter_input_array(INPUT_POST, $args);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) ) 
        {
            //echo '<h2>email good </h2><br><br><br><br>';
            //var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
            if($name && !(1 === preg_match('~[0-9]~', $name)))
            {
                
                //echo '<h2>nom good </h2><br><br><br><br>';
                if($surname && !(1 === preg_match('~[0-9]~', $surname)))
                {
                //echo '<h2>all is good </h2><br><br><br><br>';

                //$stmt = $mysqli->prepare("SELECT * FROM newsletter WHERE  (nom=? AND prenom=? AND email=?)  ;");
                $stmt = $mysqli->prepare("SELECT * FROM newsletter WHERE  email=?  ;");
                //$AllNews= $mysqli->prepare("SELECT * FROM newsletter WHERE  (nom='$surname' AND prenom='$name' AND email='$email')  ;");
                $stmt->bind_param('s',$email);  // Bind "$idRecetteGet" to ?.
                $stmt->execute();    
                $AllNews = $stmt->get_result();
                $AllNews=$AllNews->fetch_assoc();
//var_dump($AllNews);
                if ($AllNews) //check if already subscribed
                    {
                     echo '<script language="javascript"> 
                     alert("Merci pour votre intéret mais Vous êtes déjà abonné à notre   Newsletter,\n redirecting to homepage on click") 
                      window.location.href="index.php" 
                     </script>'; 
                     
                     
                // echo'<br><br><br><br>';
                    }
                    else //not subscribed check if a member
                    {
                       // $AllMmbrs= $mysqli->query("SELECT idMembre FROM membres WHERE  nom='$surname' AND prenom='$name'  ;");


                        $stmte = $mysqli->prepare("SELECT idMembre FROM membres WHERE  nom=? AND prenom=?  ;");
                        //$AllNews= $mysqli->prepare("SELECT * FROM newsletter WHERE  (nom='$surname' AND prenom='$name' AND email='$email')  ;");
                        $stmte->bind_param('ss', $surname,$name);  // Bind "$idRecetteGet" to ?.
                        $stmte->execute();    
                        $AllMmbrs = $stmte->get_result();
                        $AllMmbrs=$AllMmbrs->fetch_assoc();



                        //var_dump($AllMmbrs);
                        if ($AllMmbrs) //is a member
                        //subscribe him and use his id
                         { //var_dump($AllMmbrs);
                            $AllMmbrs=$AllMmbrs->fetch_assoc();
                            $isid=$AllMmbrs['idMembre'];

                            $AddMbrNews= $mysqli->query(" INSERT INTO newsletter (nom, prenom, email,id_mbre) VALUES ('$surname', '$name', '$email','$isid' );");
                            
                            $expediteur="azaryabboud@gmail.com";
                            $headerss  = 'MIME-Version: 1.0' . "\n";
                            $headerss .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
                            $headerss .= 'Reply-To: ' . $expediteur . "\n";
                            $headerss .= "From: azary php\n";
                            $headerss .= 'Delivered-to: ' .$email . "\n";
                            $sujetemail="newsletter";
                            $messagemail="you are now subscribed";
                            //echo '<h2>Vous êtes abonné à notre newsletter avec succès</h2>';
                            echo '<script language="javascript"> 
                            alert("Vous êtes abonné à notre newsletter avec succès ") 
                            window.location.href="index.php" 
                            </script>'; 
                            if (mail($email,  $sujetemail, $messagemail, $headerss)) {
                                echo "Un email a bien été envoyé,vous etes inscrits à notre newsletter !";
                            } else {
                                echo "Une erreur est  dans l'envoi du mail !";
                            }

                        }
                        else //not a member, subscribe him
                        { 
                          
                            
                           
                                $AddNews= $mysqli->query(" INSERT INTO newsletter (nom, prenom, email) VALUES ('$surname', '$name', '$email' );");
                                
                                 
                                $expediteur="azaryabboud@gmail.com";
                                $headerss  = 'MIME-Version: 1.0' . "\n";
                                $headerss .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
                                $headerss .= 'Reply-To: ' . $expediteur . "\n";
                                $headerss .= "From: azary php\n";
                                $headerss .= 'Delivered-to: ' . $email. "\n";
                                $sujetemail="newsletter";
                                $messagemail="you are now subscribed";
                                echo '<script language="javascript"> 
                                    alert("Vous êtes abonné à notre newsletter avec succès ") 
                                    window.location.href="index.php" 
                                    </script>';
                                if (mail($email,  $sujetemail, $messagemail, $headerss)) {
                                    echo "Un email a bien été envoyé, vous etes inscrits à notre newsletter !";
                                } else {
                                    echo "Une erreur est  dans l'envoi du mail !";
                                }

    
                                 

                        }
                    
                    }

                }
                else 
                {
                    echo '<script language="javascript">
                    alert("Please enter a valid surname, redirecting to homepage on click") 
                     window.location.href="index.php" 
                     </script>';
                }
            }
            else 
            {
                echo '<script language="javascript">
                alert("Please enter a valid name, redirecting to homepage on click") 
                 window.location.href="index.php" 
                 </script>';
            }
            
        } 
        else 
        {//var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
            echo '<script language="javascript">
            alert("Please enter a valid mail, redirecting to homepage on click") 
             window.location.href="index.php" 
             </script>';
        }

    }
    else
    {
        echo '<script language="javascript">
            alert("Please enter all required fields, redirecting to homepage on click") 
             window.location.href="index.php" 
             </script>';
    } 

}
 
include ('sessionincludeFooter.php');
?>
</html>	