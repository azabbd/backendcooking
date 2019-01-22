<!DOCTYPE html>
<?php
 include('header.php');
 include('menu.php');
 //filter_input(INPUT_GET,'id');
 //FILTER_SANITIZE_STRING
 //is_numeric''id')
  $mysqli= new mysqli("localhost","root","","cooking");
 /*$txtSQL = "SELECT * FROM membres WHERE idMembre = @0";
 db.Execute(txtSQL,'id');*/


 $stmt = $mysqli->prepare("SELECT * FROM recettes where idRecette = ?");
 /*filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);*/
  $stmt->bind_param('s', $_GET['id']);  // Bind "$user_id" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
      //  var_dump($stmt->num_rows);
     /* if (isset($_GET["email"])) {
        if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL) === false) {
            echo("Email is valid");
        } else {
            echo("Email is not valid");
        }
    }*/
    $idRecetteGet=filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT)   ;//removes all illegal  characters from it
    //var_dump($idRecetteGet);
    if (filter_var($idRecetteGet, FILTER_VALIDATE_INT)) //checks if it's an integer
    {
        //echo("Variable is an integer");  
        $idRecettetoload= filter_var($idRecetteGet, FILTER_VALIDATE_INT);
    } else {
        echo("Not a valid receipt");
    }
    //filter_var($_GET['idRecette'], FILTER_VALIDATE_INT);
    //var_dump(filter_var($_GET['idRecette'], FILTER_VALIDATE_INT));
/*$stmt = $dbh->prepare("INSERT INTO Customers (CustomerName,Address,City) 
VALUES (:nam, :add, :cit)");
$stmt->bindParam(':nam', $txtNam);
$stmt->bindParam(':add', $txtAdd);
$stmt->bindParam(':cit', $txtCit);
$stmt->execute();*/
//$stmt->store_result();
        /*$stmt->bind_result();
        $stmt->fetch();*/
        $_COOKIE['idRecette']= $RecetteDet['idRecette'];
        $cookie_name = 'cookieRecette';
        $cookie_value = $RecetteDet['idRecette'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        echo $_COOKIE['idRecette'];
 ?>


<body>



</body>








<?php
 include('footer.php');
 ?>
</html>	


$needle='<li>';
                    $error2='<li></li>';
                    $lastPos = 0;
                    $lastPos2 = 0;
                    $positions = array();
                    $positionsNb = array();
                    while (($lastPos = strpos($impPrep, $needle, $lastPos))!== false) {
                        $positions[] = $lastPos;
                        $lastPos = $lastPos + strlen($needle);
                    }
                    while (($lastPos2 = strpos($impPrep, $error2, $lastPos2))!== false) {
                        $positionsNb[] = $lastPos2;
                        $lastPos2 = $lastPos2 + strlen($error2);
                    }
                    //print_r( $positions) ;
                   //print_r($positionsNb) ;
                   
                    foreach ($positions as $value) {
                        //echo $value ."<br />";
                        /*echo $impPrep[$value]."<br />";
                        echo $impPrep[$value+4]."<br />";*/
                        //echo $value ."<br>";
                        $posnb=$value+4;
                        $posnb2=$value+5;
                        if(is_numeric($impPrep[$posnb]))
                        {
                            $impPrep[$posnb]=" ";  
                            echo $posnb."<br>";
                        }
                        elseif (strstr($impPrep[$posnb2], "\n"))
                        {
                            echo 'eol';
                            $impPrep[$posnb]=" ";  
                            $impPrep[$posnb2]=" ";  
                            echo $posnb2."<br>";
                        }
                        /*echo   $posnb."<br>";
                        echo  $impPrep[$posnb]."<br>";*/

                       // echo $impPrep[$value]."<br>";
                        //echo $impPrep[$posnb]."<br>";
                        // $impPrep[$posnb]=" ";
                        /*echo $impPrep[$value+4]."<br />";
                        echo $impPrep[$value+5]."<br />";*/

                        
                            
                    }


                    //else //more than 10 list items
                   // {
                        /*$posnb=$value+4;
                        $posnb2=$value+5;
                        $posnb3=$value+6;*/
                        if( preg_match('~[0-9]+~', $impPrep[$posnb])&&preg_match('~[0-9]+~', $impPrep[$posnb2]))
                        {
                        // echo  $arr4[$posnb].'<br>';
                            $impPrep[$posnb]=" "; 
                            $impPrep[$posnb2]=" "; 
                            //echo $posnb."<br>";
                        
                        }
                        elseif ($impPrep[$posnb]==" " && preg_match('~[0-9]+~', $impPrep[$posnb2]) && preg_match('~[0-9]+~', $impPrep[$posnb3]))
                        {
                        // echo  $arr4[$posnb2].'<br>';
                            $impPrep[$posnb2]=" ";  
                            $impPrep[$posnb3]=" ";
                            //echo $posnb."<br>";  
                        }