   
 <?php
 
include ('DbConnect.php');
if(isset($_POST['submitNewImage']))
{
  if($_FILES["fileupload"]["tmp_name"])
  {
    //image handling
    $target_dir = "C:/wamp64/www/CookingWebsite/photos/gravatars/";
    //var_dump($_FILES);
    $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
    $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileupload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  //}
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) 
  {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else 
  {
    if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) 
    {
      $gravatarName=basename( $_FILES["fileupload"]["name"]);
      //echo "The file ".$gravatarName . " has been uploaded.";
      
      $Membreid = $_SESSION['idMembre'];
      $result=$mysqli->query("UPDATE  membres SET gravatar = '$gravatarName' WHERE idMembre = '$Membreid'");
      ?>
      <script language="javascript">
      alert("your image was updated") 
      window.location.href="profildetails.php"; 
      </script>
      <?php
    } 
    else 
    {
      //echo "Sorry, there was an error uploading your file.";
      ?>
      <script language="javascript">
      alert("Sorry, there was an error uploading your file") 
      window.location.href="profildetails.php";  
      </script>
      <?php
    }
  }
  //image handling
  }
  else
  {
    ?>
  <script type="text/javascript">
      alert("no image");
  </script>
    <?php
  }
}
/*else{
    echo '<br><br><br><br>0<br><br><br><br><br>';
    var_dump($_POST);
    echo '<script type="text/javascript">
     console.log("not ok");
</script>';
}*/
?>