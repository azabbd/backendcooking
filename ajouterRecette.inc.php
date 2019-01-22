<!DOCTYPE html>
<?php
include ('DbConnect.php');

if(isset($_POST['submitChangesAjout']))
{ 
    /*?>
    <script>
    $('coument').ready(function(){
    alert("ohh");});
    </script>
    <?php*/
    //check all fields and password match
    //var_dump($_POST);
    $MdpAjout = filter_input(INPUT_POST,'MdpAjout',FILTER_SANITIZE_STRING);
    if($MdpAjout)//!empty($_POST['MdpAjout']))
    { 
       /* ?>
        <script>
        $('coument').ready(function(){
        alert("ohh2");});
        </script>
        <?php*/
        $idMembre = $_SESSION['idMembre'];
        $stmtdeluser = $mysqli->query("SELECT * FROM membres WHERE idMembre = '$idMembre'");
        $stmtdeluser = $stmtdeluser->fetch_assoc();
        //var_dump($stmtdeluser);
        //var_dump($mdpsupp);
        if(password_verify($MdpAjout, $stmtdeluser['password']))
        {
            $mdpErr = "";
            /*?>
            <script>
            $('coument').ready(function(){
            alert("ohh3");});
            </script>
            <?php*/
            if(!empty($_POST['titre']))
            {
                $titre = filter_input (INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
                // var_dump($titre);
                //echo'<br> <br> <br> <br>';
                ////////////////////////////////TITRE///////////////////////////////////////////
                if($titre && preg_match("/^[a-zA-Z0-9 ]*$/",$titre))
                { 
                    $Searchtitle = $mysqli->query("SELECT * FROM recettes WHERE titre = '$titre'"); //TRIM(
                    if($Searchtitle->num_rows == 0)
                    {
                        $titreErr = "";
                    }
                    else
                    {
                        $titreErr = "veuillez modifier votre titre svp";
                    }
                }
                else
                {
                    $titreErr = "veuillez saisir un bon titre svp";
                }
            }
            else
                {
                    $titreErr = "veuillez saisir un titre svp";
                }
            ////////////////////////////////Chapo///////////////////////////////////////////
            if(!empty($_POST['chapo']))
            {
                $chapo = filter_input (INPUT_POST, 'chapo', FILTER_SANITIZE_STRING);
                //var_dump($chapo);
                //echo'<br> <br> <br> <br>';
                if($chapo && preg_match("/^[a-zA-Z0-9 ]*$/",$chapo))
                { 
                    $Searchtitle = $mysqli->query("SELECT * FROM recettes WHERE chapo = '$chapo'"); //TRIM(
                    if($Searchtitle->num_rows == 0)
                    {
                        $chapoErr = "";
                    }
                    else
                    {
                        $chapoErr = "veuillez modifier votre chapo svp";
                    }
                }
                else
                {
                    $chapoErr = "veuillez saisir un bon chapo svp";
                }
            }
            else
            {
                $chapoErr = "veuillez saisir un chapoErr svp";
            }
            ////////////////////////////////categorie///////////////////////////////////////////
            if(!empty($_POST['categorie']))
            {
                $categorie = filter_input (INPUT_POST, 'categorie', FILTER_SANITIZE_NUMBER_INT);
                //var_dump($titre);
                //echo'<br> <br> <br> <br>';
                if($categorie)
                { 
                    //var_dump($categorie);
                    $Searchtitle = $mysqli->query("SELECT * FROM categories WHERE idCategorie = '$categorie'"); //TRIM(
                    if($Searchtitle->num_rows == 1)
                    {
                        $categorieErr = "";
                    }
                    else
                    {
                        $categorieErr = "veuillez selectionner votre categorie svp";
                    }
                }
                else
                {
                    $categorieErr = "veuillez modifier votre categorie svp";
                }
            }
            else
            {
                $categorieErr = "veuillez saisir une categorie svp";
            }
            ////////////////////////////////tempsCuisson///////////////////////////////////////////
            if(!empty($_POST['tempsCuisson']))
            {
                $tempsCuisson = filter_input (INPUT_POST, 'tempsCuisson', FILTER_SANITIZE_NUMBER_INT);
                // var_dump($tempsCuisson);
                //echo'<br> <br> <br> <br>';
                if($tempsCuisson && preg_match("/^[a-zA-Z0-9 ]*$/",$tempsCuisson))
                { 
                    //var_dump($categorie);
                        $tempsCuissonErr = "";
                }
                else
                {
                    $tempsCuissonErr = "veuillez modifier votre temps Cuisson svp";
                }
            }
            else
            {
                $tempsCuissonErr = "veuillez saisir un temps Cuisson svp";
            }
            ////////////////////////////////tempsPreparation///////////////////////////////////////////
            if(!empty($_POST['tempsPreparation']))
            {
                $tempsPreparation = filter_input (INPUT_POST, 'tempsPreparation', FILTER_SANITIZE_NUMBER_INT);
                // var_dump($tempsPreparation);
                //echo'<br> <br> <br> <br>';
                if($tempsPreparation && preg_match("/^[a-zA-Z0-9 ]*$/",$tempsPreparation))
                { 
                    //var_dump($categorie);
                        $tempsPreparationErr = "";
                }
                else
                {
                    $tempsPreparationErr = "veuillez modifier votre  temps Preparation svp";
                }
            }
            else
            {
                $tempsPreparationErr = "veuillez saisir un temps Preparation svp";
            }
            ////////////////////////////////difficulte///////////////////////////////////////////
            /*$difficulte = filter_input (INPUT_POST, 'difficulte', FILTER_SANITIZE_STRING);
             var_dump($difficulte);
            //echo'<br> <br> <br> <br>';
            if($difficulte)
            { 
                //var_dump($categorie);
                $difficulteErr = "";
            }
            else
            {
                $difficulteErr = "veuillez selectionner une difficulte svp";
            }*/
            ////////////////////////////////difficulteSelect///////////////////////////////////////////
            if(!empty($_POST['difficulteselect']))
            {
                $difficulteselect = filter_input (INPUT_POST, 'difficulteselect', FILTER_SANITIZE_STRING);
                // var_dump($difficulteselect);
                //echo'<br> <br> <br> <br>';
                if($difficulteselect)
                { 
                    //var_dump($categorie);
                    $difficulteselectErr = "";
                }
                else
                {
                    $difficulteselectErr = "veuillez selectionner une difficulte svp";
                }
            }
            else
            {
                $difficulteselectErr = "veuillez saisir une difficulte svp";
            }
            ////////////////////////////////prix///////////////////////////////////////////
            if(!empty($_POST['prix']))
            {
                $prix = filter_input (INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_INT);
                // var_dump($prix);
                //echo'<br> <br> <br> <br>';
                if($prix && preg_match("/^[a-zA-Z0-9 ]*$/",$prix))
                { 
                    //var_dump($categorie);
                    $prixErr = "";
                }
                else
                {
                    $prixErr = "veuillez renseigner un prix svp";
                }
            }
            else
            {
                $prixErr = "veuillez saisir un  prix  svp";
            }
            ////////////////////////////////couleur///////////////////////////////////////////
            if(!empty($_POST['couleur']))
            {
                $couleur = filter_input (INPUT_POST, 'couleur', FILTER_SANITIZE_STRING);
                //var_dump($couleur);
                if($couleur)
                { 
                    //var_dump($categorie);
                    $couleurErr = "";
                }
                else
                {
                    $couleurErr = "veuillez selectionner une couleur pour votre recette svp";
                }
            }
            else
            {
                $couleurErr = "veuillez saisir une  couleur  svp";
            }
            ////////////////////////////////image///////////////////////////////////////////
            /*if(!empty($_POST['fileupload']))
            {*/
                $target_dir = "C:/wamp64/www/CookingWebsite/photos/recettes/";
                //var_dump($_FILES);
                $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(!empty($_FILES["fileupload"]["tmp_name"]))
                {
                    $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
                    if($check !== false) 
                    {
                        //$imgErr = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                        
                    } 
                    else 
                    {
                        $imgErr = "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                    $imgErr = "Sorry, file already exists.";
                    $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["fileupload"]["size"] > 500000) 
                    {
                    $imgErr = "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) 
                    {
                    $imgErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }
                    //}
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                        $imgErr = "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } 
                    else 
                    {
                        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) 
                        {
                            $gravatarName = basename( $_FILES["fileupload"]["name"]);
                            $imgErr = "";
                        }
                        else
                        {
                            $imgErr = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                else 
                {
                    $imgErr = "Sorry no image";
                }
            /*}
             else
            {
                $imgErr = "veuillez saisir une  image  svp";
            }*/
            ////////////////////////////////ingredients///////////////////////////////////////////
             //var_dump($_POST);
            //$filter = array("listinputing" => array("filter"=>FILTER_CALLBACK,"flags"=>FILTER_FORCE_ARRAY,"options"=>"ucwords"));
            
            //$filter = array("listinputing" => array('filter' => FILTER_SANITIZE_STRING,'flags'  => FILTER_REQUIRE_ARRAY,"options"=>"ucwords"));
            //$optionfin = filter_input_array(INPUT_POST, $filter);
            //var_dump($optionfin);
            if(!empty($_POST['listinputing']))
            {
                $optionfin = filter_var_array($_POST['listinputing'],FILTER_SANITIZE_STRING);
            // var_dump($optionfin);
                //$option = array_filter($optionfin['option']);
                if($optionfin)
                { 
                    //var_dump($categorie);
                    $ingErr = "";
                    //var_dump(count($optionfin));
                    //var_dump(count($_POST['listinputing']));
                    $i=0;
                    $listIngredients = "";
                    $listIngredients .= "<ul>";
                    while($i < count($optionfin))
                    {
                        $listIngredients .= "<li>" . $optionfin[$i] . "</li>";
                        $i++;
                    }
                    $listIngredients .= "</ul>";
                // var_dump($listIngredients);
                // echo $listIngredients;
                }
                else
                {
                    $ingErr = "veuillez renseigner les ingredients svp";
                }
            }
            else
            {
                $ingErr = "veuillez saisir les ingredients  svp";
            }
            ////////////////////////////////preparation///////////////////////////////////////////
             //var_dump($_POST);
            //$filterprep = array("listinputprep" => array("filter"=>FILTER_CALLBACK,"flags"=>FILTER_FORCE_ARRAY,"options"=>"ucwords"));
            //$optionfinprep = filter_input_array(INPUT_POST, $filterprep);
            
            //$filterprep2 = array("listinputprep" => array('filter' => FILTER_SANITIZE_STRING,'flags'  => FILTER_REQUIRE_ARRAY,"options"=>"ucwords"));
            //$optionfinprep = filter_input_array(INPUT_POST,$filterprep2);
            //var_dump($optionfinprep);
            if(!empty($_POST['listinputprep']))
            {
                $optionfinprep = filter_var_array($_POST['listinputprep'],FILTER_SANITIZE_STRING);
                //var_dump($optionfinprep);
                //$option = array_filter($optionfin['option']);
                if($optionfinprep)
                { 
                    //var_dump($categorie);
                    $prepErr = "";
                    //var_dump(count($_POST['listinputprep']));
                    $i=0;
                    $listPreparation = "";
                    $listPreparation .= "<ol>";
                    while($i < count($optionfinprep))
                    {
                        $listPreparation .= "<li>" . $optionfinprep[$i] . "</li>";
                        $i++;
                    }
                    $listPreparation .= "</ol>";
                // var_dump($listPreparation);
                    //echo $listPreparation;
                }
                else
                {
                    $prepErr = "veuillez renseigner les Preparations svp";
                }
            }
            else
            {
                $prepErr = "veuillez saisir les Preparations  svp";
            }
    
            



    if($mdpErr == "" &&  $titreErr == "" && $chapoErr == "" && $categorieErr == "" && $tempsCuissonErr == "" && $tempsPreparationErr == "" && $difficulteselectErr == "" && $prixErr == "" && $couleurErr == "" && $imgErr == "" && $ingErr  == "" && $prepErr== "")
    {
        $date = date('Y-m-d H:i:s');
        $insertRecette = $mysqli->query("INSERT INTO recettes (membre,titre,chapo,couleur,categorie,tempsCuisson,tempsPreparation,difficulte,prix,preparation,ingredient,img,dateCrea)  VALUES ('$idMembre','$titre','$chapo','$couleur','$categorie','$tempsCuisson','$tempsPreparation','$difficulteselect','$prix','$listPreparation','$listIngredients','$gravatarName','$date')"); 
        //var_dump($insertRecette);
        if($insertRecette)
        {
            $insertRecetteId = $mysqli->query("SELECT * FROM recettes where membre = '$idMembre' AND titre ='$titre'  AND categorie ='$categorie' ");
            $insertRecetteId = $insertRecetteId->fetch_assoc();
            ?>
            <div class="modal" id="myModalSuccessfulindertreceipt">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Opération réussite</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        La recette a été ajoutée avec succès.
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn  butsearch" data-dismiss="modal" id="backproff">Revenir au profile </button>
                        <button type="button" class="btn  butsearch" onClick="maFonction(<?php echo $insertRecetteId['idRecette']; ?>, <?php echo $insertRecetteId['membre']; ?>)" data-dismiss="modal" id="goprrecette">Voir la recette </button>
                    </div>

                    </div>
                </div>
            </div>
            
            <?php

        }
        else
        {
            if($imgErr=="")
            {
            $imgsrc = 'photos/recettes/' . $gravatarName;
            unlink($imgsrc);
            }
            ?>
            <div class="modal" id="myModalerror1">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Enregistrement échouée</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        La recette n'a pas été ajoutée: 
                        
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn  butsearch" data-dismiss="modal" id="backback">Réessayer </button>
                     </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            $('document').ready(function(){
                    $('#myModalerror1').modal('show');
            });
            </script>
            <?php
        }

    }
    else
    {
        
        ?>
        <div class="modal" id="myModalerror2">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enregistrement échouée</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    La recette n'a pas été ajoutée: <br>
                    <?php
                            if($mdpErr != "")  echo $mdpErr . '<br>';
                            if($titreErr != "") echo $titreErr . '<br>';
                            if($chapoErr != "") echo $chapoErr . '<br>';
                            if($categorieErr != "")  echo $categorieErr . '<br>';
                            if($tempsCuissonErr != "")  echo $tempsCuissonErr . '<br>';
                            if($tempsPreparationErr != "")  echo $tempsPreparationErr . '<br>';
                            if($difficulteselectErr != "")  echo $difficulteselectErr . '<br>';
                            if($prixErr != "")  echo $prixErr . '<br>';
                            if($couleurErr != "")  echo $couleurErr . '<br>';
                            if($imgErr != "")  echo $imgErr . '<br>';
                            if($ingErr != "")  echo $ingErr . '<br>';
                            if($prepErr != "") echo $prepErr . '<br>';
                        ?>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn  butsearch" data-dismiss="modal" id="backback1">Réessayer </button>
                 </div>

                </div>
            </div>
        </div>
        <script type="text/javascript">
        $('document').ready(function(){
                $('#myModalerror2').modal('show');
        });
        </script>
        <?php
    }




        }
        else
        {
            $mdpErr = "veuillez renseigner votre mdp svp";
            ?>
            <script type="text/javascript">
        $('document').ready(function(){
                $('#myModalerror2').modal('show');
        });
        </script>
        <?php
        }
    }
    else
    {
        $mdpErr = "veuillez renseigner votre mdp svp";
        ?>
        <script>
     $('document').ready(function(){
        alert('veuillez renseigner votre mdp svp');
     });</script>
     <?php
    }

}
?>

<script>
     
     $('document').ready(function(){
         $('#backproff').click(function(){
             window.location.href = "profildetails.php";
         });
     });
 
     $("document").ready(function(){
         $('#myModalSuccessfulindertreceipt').modal('show');
     });
 
     function maFonction(idRecette, membre) {
         let urlrecette = "recettedetailsmembre.php?idRecette=" + idRecette + "&idMembre=" +  membre + "&edit=ok" ;
         //alert(urlrecette);
         window.location.href = urlrecette;
     }
 
 </script>

</html>