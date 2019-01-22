
<!DOCTYPE html>
<?php
 
include ('DbConnect.php');

if (isset($_POST['submitChanges'] ) && isset($_SESSION['idMembre']))
{

    $Membreid = $_SESSION['idMembre'];
    $stmt = $mysqli->query("SELECT * FROM membres WHERE idMembre = '$Membreid'");
    $MembreDet = $stmt->fetch_assoc();
    /*var_dump($MembreDet);
    var_dump($_POST);*/
    $Password = filter_input(INPUT_POST,"AncienMdp", FILTER_SANITIZE_STRING);
    if(password_verify($Password, $MembreDet['password']))
    {
        $namerr=$lastnameerr=$mdperr=$mailerr=$fberr=$instaerr=$twiterr=$youterr=$loginerr=$descerr=$nouveaumdperr="";
        $login = filter_input(INPUT_POST,"pseudo", FILTER_SANITIZE_STRING);
        if($login)//login good
        {
            if ($login != $MembreDet['login'])//lodin was changed
            {
                if (preg_match("/^[a-zA-Z0-9]*$/",$login)) //new login valid format
                {
                    $CheckLogin = $mysqli->query("SELECT login FROM membres WHERE login = '$login'");
                    if($CheckLogin->num_rows == 0)//login not reserved
                    {
                        $UpdateLogin = $mysqli->query("UPDATE  membres SET login = '$login' WHERE idMembre = '$Membreid'");
                        $_SESSION['Username'] = $login;
                        //echo 'updated login';
                    }
                    else //reserved
                    {
                        $loginerr = "not a valid login 1";
                        echo'<script language="javascript">
                        alert("not a valid login, modify it and retry please") 
                        //window.history.go(-1); 
                        </script>';
                    }
                }
                else //format invalid
                {
                    $loginerr = "not a valid login 2";
                    echo'<script language="javascript">
                    alert("not a valid login, modify it and retry please") 
                    //window.history.go(-1); 
                    </script>';
                    
                }
            }
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        //$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING);
        if($email && ($email != $MembreDet['email']))//email changed
        {
            $Checkemail = $mysqli->query("SELECT email FROM membres WHERE email = '$email'");
            if($Checkemail->num_rows == 0)//email not reserved
            {                    
                $Updateemail = $mysqli->query("UPDATE  membres SET email = '$email' WHERE idMembre = '$Membreid'");
                //echo 'updated email';
            }
            else
            {
                $mailerr = "error with mail";
                echo'<script language="javascript">
                alert("not a valid email, modify it and retry please") 
                //window.history.go(-1); 
                </script>';
            }
        
        }
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING);
        //var_dump($name);
        if($name && ($name != $MembreDet['prenom']) && (preg_match("/^[a-zA-Z0-9 ]*$/",$name)))//login changed
        {
            $Updatename = $mysqli->query("UPDATE  membres SET prenom = '$name' WHERE idMembre = '$Membreid'");
            //echo 'updated name';
        }
        elseif ($name && ($name != $MembreDet['prenom']))
        {
            $namerr = "error with prenom";
            echo'<script language="javascript">
            alert("not a valid prenom, modify it and retry please") 
            //window.history.go(-1); 
            </script>';
        }
        
        $lastname = filter_input(INPUT_POST,"lastname", FILTER_SANITIZE_STRING);
        if($lastname && ($lastname != $MembreDet['nom']) && (preg_match("/^[a-zA-Z0-9 ]*$/",$lastname)))//login changed
        {
            $Updatelastname = $mysqli->query("UPDATE  membres SET nom = '$lastname' WHERE idMembre = '$Membreid'");
        }
        elseif($lastname && ($lastname != $MembreDet['nom']))
        {
            $lastnameerr = "error with nom";
            echo'<script language="javascript">
            alert("not a valid nom, modify it and retry please") 
           // window.history.go(-1); 
            </script>';
        }
        $facebook = filter_input(INPUT_POST,"facebook", FILTER_SANITIZE_STRING);
        if (strlen(trim($facebook)) > 0)   
        {
            if (socialMediaCheck($facebook) == 2)
            {
                $fberr= " fb error";
                echo'<script language="javascript">
                alert("not a valid facebook url, modify it and retry please") 
                //window.history.go(-1); 
                </script>';
            }
        }
        $instagram = filter_input(INPUT_POST,"instagram", FILTER_SANITIZE_STRING);
        if (strlen(trim($instagram)) > 0)   
        {
            if (socialMediaCheck($instagram) == 2)
            {
                $instaerr= "insta error";
                echo'<script language="javascript">
                alert("not a valid instagram url, modify it and retry please") 
                //window.history.go(-1); 
                </script>';
            }
        }
        $twitter = filter_input(INPUT_POST,"twitter", FILTER_SANITIZE_STRING);
        if (strlen(trim($twitter)) > 0)   
        {
            if (socialMediaCheck($twitter) == 2)
            {
                $twiterr= "twitter error";
                echo'<script language="javascript">
                alert("not a valid twitter url, modify it and retry please") 
                //window.history.go(-1); 
                </script>';
            }
        }
        $youtube = filter_input(INPUT_POST,"youtube", FILTER_SANITIZE_STRING);
        if (strlen(trim($youtube)) > 0)   
        {
            if (socialMediaCheck($youtube) == 2)
            {
                $youterr= "youtube error";
                echo'<script language="javascript">
                alert("not a valid youtube url, modify it and retry please") 
                //window.history.go(-1); 
                </script>';
            }
        }
        $NouveauMdp = filter_input(INPUT_POST,"NouveauMdp", FILTER_SANITIZE_STRING);
        if (strlen(trim($NouveauMdp)) > 0)   
        {
            if (strlen($NouveauMdp)<3|| strlen($NouveauMdp)>20) //too short too long
            {
            $nouveaumdperr = "longueur mdp entre 3  et 20"; 
            //echo $mdpErr .'<br>';
            }
            else   
            {
                if(preg_match("/^[a-zA-Z0-9]*$/",$NouveauMdp))  
                {
                    $NouveauMdp = password_hash($NouveauMdp, PASSWORD_DEFAULT);
                    $Updatelastname = $mysqli->query("UPDATE  membres SET password = '$NouveauMdp' WHERE idMembre = '$Membreid'");
                    $nouveaumdperr ="";
                }
                else
                {
                    $nouveaumdperr ="only letters and numbers";
                }
            }
            if ($nouveaumdperr!= "")
            {
                echo'<script language="javascript">
                alert("enter your password and  retry please") 
                //window.history.go(-1); 
                </script>';
            }
        }
        
        $description = filter_input(INPUT_POST,"description", FILTER_SANITIZE_STRING);
        /*var_dump($description);
        var_dump(strlen(trim($MembreDet['About'])));
        var_dump(strlen(trim($description)));*/
        if(strlen(trim($MembreDet['About'])) == 0)
        {
            $Updatedescription = $mysqli->query("UPDATE  membres SET About = '' WHERE idMembre = '$Membreid'");
            $MembreDetAbout='';
        }
        else
        {
            $MembreDetAbout=$MembreDet['About'];
        }
        /*var_dump($MembreDetAbout);
        var_dump($description);*/

        if($description === NULL)
        {  $descerr = "descrption error";
            echo $descerr;
            echo'<script language="javascript">
            alert("not a valid description, modify it and retry please") 
           //window.history.go(-1); 
            </script>';
           
        }
        else 
        {
            if($description != $MembreDetAbout)
            {
            //if(strlen(trim($description)) > 0 )//login changed
            //{
                $Updatedescription = $mysqli->query("UPDATE  membres SET About = '$description' WHERE idMembre = '$Membreid'");
                
            }
        }
        //if($namerr == ""  && $lastnameerr == ""  && $mdperr == ""  && $mailerr == ""  && $fberr == ""  && $instaerr == ""  && $twiterr == ""  && $youterr == ""  && $loginerr == ""  && $descerr == ""  && $nouveaumdperr == "")
//{
    echo '<script type="text/javascript">
    $(document).ready(function(){
         
        window.history.go(-1); 
         
    });
</script>';
//}
        
         
    }
    else
    {
        echo'<script language="javascript">
        alert("enter your password and  retry please") 
       // window.history.go(-1); 
        </script>';
    }
}


function socialMediaCheck($facebook)
{
    $facebook = filter_var($facebook, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED);
    if ($facebook)
    {
        if ($facebook != $MembreDet['facebook'])
        {
            $Updatfacebook = $mysqli->query("UPDATE  membres SET facebook = '$facebook' WHERE idMembre = '$Membreid'");
            return 0; //valid entry and modified
        }
        else
        {
           return 1; //not modified
        } 
    }
    else
    {
        return 2; //not valid
    }
}
?>
 