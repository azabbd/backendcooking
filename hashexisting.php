<!DOCTYPE html>
<html>
 
  
<?php
include ('sessioninclude.php');
include ('DbConnect.php');

$result=$mysqli->query("SELECT *  FROM  membres WHERE idMembre<20");
var_dump($result);
while($resultsArray = $result->fetch_assoc())
{
    $pass=$resultsArray['password'];
    $hash=password_hash($pass, PASSWORD_DEFAULT);
    $idMm=$resultsArray['idMembre'];
    /*echo $idMm.'<br>';
    echo $pass.'<br>';
    echo $hash.'<br>'.'<br>';*/
    $resulthash=$mysqli->query("UPDATE membres SET oldpass = '$pass', password = '$hash'  WHERE idMembre=$idMm");

}

?>
</html>