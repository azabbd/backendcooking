<?php


$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password_gen = substr( str_shuffle( $chars ), 0, 8 );
$resultup=$mysqli->query("UPDATE    membre set  mdp='$password_gen' WHERE id_membre='$result_id'");
echo '<h5 style="  margin-left:390px;color: #6c09bc">'. $result_fetch['pseudo'].', your password was modified </h5>';
$_SESSION['mdp']=$password_gen;
if($resultup)
{
    $expediteur="azaryabboud@gmail.com";
    $headerss  = 'MIME-Version: 1.0' . "\n";
    $headerss .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
    $headerss .= 'Reply-To: ' . $expediteur . "\n";
    $headerss .= "From: azary php\n";
    $headerss .= 'Delivered-to: ' . $_SESSION['email'] . "\n";
    $sujetemail="mdp";
    $messagemail="you pass was modified into " . $password_gen;
    if (mail($_SESSION['email'],  $sujetemail, $messagemail, $headerss)) 
    {
        echo "Un email a bien été envoyé !";
    } 
    else 
    {
        echo "Une erreur est  dans l'envoi du mail !";
    }


        ?>