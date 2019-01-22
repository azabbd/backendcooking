<!DOCTYPE html>
<?php
include ('DbConnect.php');

if(isset($_POST['submitChangesAjout']))
{ 
    $same = 0;
    $emptyimg = 0;
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
        $idrecette = $_SESSION['idRecetteConsultee'];
        $stmtdeluser = $mysqli->query("SELECT * FROM membres WHERE idMembre = '$idMembre'");
        $stmtRecette = $mysqli->query("SELECT * FROM recettes WHERE idRecette = '$idrecette'");
        $stmtdeluser = $stmtdeluser->fetch_assoc();
        $stmtRecette = $stmtRecette->fetch_assoc();
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
                if($titre && preg_match("/^[a-zA-Z0-9 ]*$/",$titre) && $stmtRecette['titre'] != $titre)
                { 
                    $titreErr = "";
                    $insertRecette = $mysqli->query("UPDATE  recettes  SET titre='$titre' WHERE idRecette = '$idrecette' "); 
                }
                elseif($stmtRecette['titre'] == $titre)
                {
                    $titreErr = "";
                    $same ++;
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
                if($chapo && preg_match("/^[a-zA-Z0-9 ]*$/",$chapo) && $stmtRecette['chapo'] != $chapo)
                { 
                    $chapoErr = "";
                    $insertRecette = $mysqli->query("UPDATE  recettes  SET chapo='$chapo' WHERE idRecette = '$idrecette' "); 

                }
                elseif($stmtRecette['chapo'] == $chapo)
                {
                    $chapoErr = "";
                    $same ++;
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
                if($categorie && $stmtRecette['categorie'] != $categorie)
                { 
                    //var_dump($categorie);
                    $Searchtitle = $mysqli->query("SELECT * FROM categories WHERE idCategorie = '$categorie'"); //TRIM(
                    if($Searchtitle->num_rows == 1)
                    {
                        $categorieErr = "";
                        $insertRecette = $mysqli->query("UPDATE  recettes  SET categorie='$categorie' WHERE idRecette = '$idrecette' ");
                    }
                    else
                    {
                        $categorieErr = "veuillez selectionner votre categorie svp";
                    }
                }
                elseif($stmtRecette['categorie'] == $categorie)
                {
                    $categorieErr = "";
                    $same ++;
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
                if($tempsCuisson && preg_match("/^[a-zA-Z0-9 ]*$/",$tempsCuisson)  && $stmtRecette['tempsCuisson'] != $tempsCuisson)
                { 
                    //var_dump($categorie);
                        $tempsCuissonErr = "";
                        $insertRecette = $mysqli->query("UPDATE  recettes  SET tempsCuisson='$tempsCuisson' WHERE idRecette = '$idrecette' ");
                }
                elseif($stmtRecette['tempsCuisson'] == $tempsCuisson)
                {
                    $tempsCuissonErr = "";
                    $same ++;
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
                if($tempsPreparation && preg_match("/^[a-zA-Z0-9 ]*$/",$tempsPreparation) && $stmtRecette['tempsPreparation'] != $tempsPreparation)
                { 
                    //var_dump($categorie);
                        $tempsPreparationErr = "";
                        $insertRecette = $mysqli->query("UPDATE  recettes  SET tempsPreparation='$tempsPreparation' WHERE idRecette = '$idrecette' ");
                }
                elseif($stmtRecette['tempsPreparation'] == $tempsPreparation)
                {
                    $tempsPreparationErr = "";
                    $same ++;
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
                if($difficulteselect && $stmtRecette['difficulte'] != $difficulteselect)
                { 
                    //var_dump($categorie);
                    $difficulteselectErr = "";
                    $insertRecette = $mysqli->query("UPDATE  recettes  SET difficulte = '$difficulteselect' WHERE idRecette = '$idrecette' ");
                }
                elseif($stmtRecette['difficulte'] == $difficulteselect)
                {
                    $difficulteselectErr = "";
                    $same ++;
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
                if($prix && preg_match("/^[a-zA-Z0-9 ]*$/",$prix) && $stmtRecette['prix'] != $prix)
                { 
                    //var_dump($categorie);
                    $prixErr = "";
                    $insertRecette = $mysqli->query("UPDATE  recettes  SET prix='$prix' WHERE idRecette = '$idrecette' ");
                }
                elseif($stmtRecette['prix'] == $prix)
                {
                    $prixErr = "";
                    $same ++;
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
                if($couleur && $stmtRecette['couleur'] != $couleur)
                { 
                    //var_dump($categorie);
                    $couleurErr = "";
                    $insertRecette = $mysqli->query("UPDATE  recettes  SET couleur='$couleur' WHERE idRecette = '$idrecette' ");
                }
                elseif($stmtRecette['couleur'] == $couleur)
                {
                    $couleurErr = "";
                    $same ++;
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
             if(!empty($_POST['fileupload']))
            { 
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
                            $insertRecette = $mysqli->query("UPDATE  recettes  SET img='$gravatarName' WHERE idRecette = '$idrecette' ");
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
             }
             else
            {
                $imgErr = "";
                $emptyimg = 1;
            } 
            ////////////////////////////////ingredients///////////////////////////////////////////
              
                    $ingErr = "";
                     
            ////////////////////////////////preparation///////////////////////////////////////////
             //var_dump($_POST);
            //$filterprep = array("listinputprep" => array("filter"=>FILTER_CALLBACK,"flags"=>FILTER_FORCE_ARRAY,"options"=>"ucwords"));
            //$optionfinprep = filter_input_array(INPUT_POST, $filterprep);
            
            //$filterprep2 = array("listinputprep" => array('filter' => FILTER_SANITIZE_STRING,'flags'  => FILTER_REQUIRE_ARRAY,"options"=>"ucwords"));
            //$optionfinprep = filter_input_array(INPUT_POST,$filterprep2);
            //var_dump($optionfinprep);
            
                    $prepErr = "";
                     
    
            



    if($same == 8 && $emptyimg == 1 && $mdpErr == "" &&  $titreErr == "" && $chapoErr == "" && $categorieErr == "" && $tempsCuissonErr == "" && $tempsPreparationErr == "" && $difficulteselectErr == "" && $prixErr == "" && $couleurErr == "" && $imgErr == "" && $ingErr  == "" && $prepErr== "")
    { 
        ?>
        
        <script>
        $("document").ready(function(){
        $('#myModalerror2').modal('show');
        
            });
            </script>
        <?php

    }
    elseif($same < 8 || $emptyimg == 0 )
    {
        if($mdpErr == "" &&  $titreErr == "" && $chapoErr == "" && $categorieErr == "" && $tempsCuissonErr == "" && $tempsPreparationErr == "" && $difficulteselectErr == "" && $prixErr == "" && $couleurErr == "" && $imgErr == "" && $ingErr  == "" && $prepErr== "")
        {
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
                    La recette a été modifiée avec succès.
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn  butsearch" data-dismiss="modal" id="backproff">Revenir au profile </button>
                    <button type="button" class="btn  butsearch"  data-dismiss="modal" id="goprrecetter" onclick="maFonction(<?php echo $idrecette; ?>, <?php echo $idMembre; ?>)"><a href ="recettedetailsmembre.php?idRecette=<?php echo $idrecette; ?>&idMembre=<?php echo $idMembre; ?>&edit=ok"> Voir la recette </a></button>
                </div>

                </div>
            </div>
        </div>
            <script>
        $("document").ready(function(){
        $('#myModalSuccessfulindertreceipt').modal('show');
            });
            </script>
        <?php
        }
        else
        {
            ?>
            <script>
        $("document").ready(function(){
        $('#myModalerror2').modal('show');
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
                La recette n'a pas été modifiée: <br>
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
    $("document").ready(function(){
            $('#myModalerror2').modal('show');
    });
    </script>
    <?php
    }
     
    }
    else
    {
        $mdpErr = "  mdp error";
        ?>
        <script type="text/javascript">
        $("document").ready(function(){
                $('#myModalerror2').modal('show');
                alert("mdp error");
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
        $("document").ready(function(){
                $('#myModalerror2').modal('show');
                alert("veuillez renseigner votre mdp svp");
        });
        </script>
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
 
     
 
     function maFonction(idRecette, membre) {
         let urlrecette = "recettedetailsmembre.php?idRecette=" + idRecette + "&idMembre=" +  membre + "&edit=ok" ;
         //alert(urlrecette);
         window.location.href = urlrecette;
     }
 
 </script>

</html>