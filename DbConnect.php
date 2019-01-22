


<?php
$servername = "localhost";
 
$username = "root";//root
 
$password = "";//""
 
$db = "cooking";

$mysqli = new mysqli($servername, $username, $password, $db);
if (!$mysqli) {
 
    die("Connection failed ok: " . mysqli_connect_error());
  
 }
  
 //$mysqli->set_charset('utf8');
/*try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}*/

/*if (mysqli_connect_errno($mysqli)) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}*/

/*
mysqli_connect('.', $user_name, $password, $database_name, null, 'mysql'); 
 $mysqli = new mysqli($host, $user, $password, $dbname, $port, $socket);
 The config file itself is something like this:

[client]
user=user_u
password=user_password
host=dbhost
port=3306
database=the_database
default-character-set=utf8

The following code fragment (in OO mysql_i format)

$sqlconf='/var/private/my.cnf';
$sql = new mysqli;
$sql->init();
$sql->options(MYSQLI_READ_DEFAULT_FILE,$sqlconf);
$sql->real_connect();

********************
$mysqli = mysqli_connect($host,$user,$pass,$db).
    $mysqli->set_charset('utf8');
*/
?>