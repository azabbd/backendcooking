<!DOCTYPE html>
<?php
 include ('sessioninclude.php');
 ?>

<body>
<div class="container page-container mt-3 "  style="padding-top: 60px;">
<?php
 
 if(isset($_SESSION))
 {
   if (isset($_SESSION['Username']))
     {
       include ('menumembre.php');
 
     }
     else
       include ('menu.php');
 
   }
   else
       include ('menu.php');
                        
if (isset($_POST['SubmitGlobale'] ) )
{ 
    if( !empty($_POST['RechercheGlobale'] ))
        { 
//$data   = filter_input(INPUT_POST, 'SubmitGlobale', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
//$SearchGlob =  htmlspecialchars(filter_input(INPUT_POST, 'RechercheGlobale', FILTER_SANITIZE_STRING));
 
    if(isset($_GET['idMembre']))
    { 
    if(preg_match("/^[A-Z\d]+$/i", $_POST['RechercheGlobale'])) //   ^/[A-Za-z]+/    
        { 
            $SearchGlob =  htmlspecialchars(filter_input(INPUT_POST, 'RechercheGlobale', FILTER_SANITIZE_STRING));
        //echo 'pregmatch ok <br>  <br>';
            $SearchGlob = $mysqli->real_escape_string($SearchGlob);

            $SearchMemb =  htmlspecialchars(filter_input(INPUT_GET, 'idMembre', FILTER_SANITIZE_NUMBER_INT));
            //echo 'pregmatch ok <br>  <br>';
                $SearchMemb = $mysqli->real_escape_string($SearchMemb);
                


            


//recherche dans rec
            $stmtR = $mysqli->prepare("SELECT * FROM recettes   WHERE titre LIKE ? OR chapo LIKE ?  OR difficulte LIKE ? OR prix LIKE ? and membre='$SearchMemb'");
            
            
            $likeSearchGlobR = "%" . $SearchGlob . "%";
            //echo  $likeSearchGlob .'<br>';
            $stmtR->bind_param('ssss',$likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR);  // Bind "$idRecetteGet" to ?. //<input type=button onClick="location.href='index.html'" value='click here'>
             
            $stmtR->execute();  
            
             
            
            
            $result = $stmtR->get_result();
             if ($result->num_rows > 0) 
            {
            //$fetchRec=$result->fetch_assoc()["idCategorie"]; '.$membrepren.'
            //$stmtRecettesCat= $mysqli->query("SELECT * FROM recettes where categorie=$fetchRec  ;");
            // if ($stmtRecettesCat->num_rows > 0) 
                //{
                echo ' <div class="row  mx-auto py-2  my-2  ">';
                echo '<div class="title  my-2     " style="color:#9D0461; text-align: left;"><h4>  Recherche "'.$SearchGlob.'" des recettes pour le membre </h4><br></div>';
                while($row = $result->fetch_assoc()) 
                    {
                        // var_dump($row);
                        echo '<div class="col-lg-4 col-md-6 col-sm-4        "  >
                        <a href="recettedetails.php?idRecette='.$row['idRecette'].'"> <img src="photos/recettes/'.$row['img'].'" alt="'.$row['titre'].'" class="  img-thumbnail img-fluid"></a>
                        <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette='.$row['idRecette'].'" style="color: #9D0461;">'.$row['titre'].'</a></h4> 
                        </div>';
                    }
                echo' </div>';


                //}
            }//recherche

            else
            {
                echo '  <div class="row">
                                <div class="title my-3" >
                                <h3 style="color:#9D0461; text-align: left;"   >Nous sommes désolés. Votre recherche n\'a pas aboutit.. Des fruits ou légumes ? ;)</h3>
                                </div>
                                <img src="photos/fruits-legumes/legumes-fruits.jpg" class="   img-thumbnail img-fluid"   >
                            </div>';
            }

        }
    } 
    else
    { 
        echo '<script language="javascript">';
        
        echo 'alert("Please enter a search query, redirecting to homepage on click")';
        echo 'window.location.href="index.php"';
        echo '</script>';
        /*echo  "<p>Please enter a search query</p>"; 
        echo '<br>  <br>';*/
    }
} 
else
{ 
    /*echo  "<p> empty search</p>"; 
    echo '<br>  <br>';*/
    echo "<script>
    alert('empty search, click to redirect to home page');
    window.location.href='index.php';  
    </script>";
}
}

?>


</div><!--.page-container-->
</body>
<?php
   if(isset($_SESSION))
   {
     if (isset($_SESSION['Username']))
       {
         include ('footermembre.php');
               
       }
       else
         include ('footer.php');
 
     }
     else
         include ('footer.php');
 ?>
</html>	