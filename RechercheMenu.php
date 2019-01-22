
<!DOCTYPE html>
<?php
 include ('sessioninclude.php');
 ?>

<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">
<?php
 
 include ('includemenu.php');
             
   
 
if(!empty($_POST['RechercheGlobale'] ))
    { 
//$data   = filter_input(INPUT_POST, 'SubmitGlobale', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
//$SearchGlob =  htmlspecialchars(filter_input(INPUT_POST, 'RechercheGlobale', FILTER_SANITIZE_STRING));
 
        if(isset($_GET['go']))
        { 
        if(preg_match("/^[A-Z\d]+$/i", $_POST['RechercheGlobale'])) //   ^/[A-Za-z]+/    
            { 
                $SearchGlob =  htmlspecialchars(filter_input(INPUT_POST, 'RechercheGlobale', FILTER_SANITIZE_STRING));
            
                $SearchGlob = $mysqli->real_escape_string($SearchGlob);
 
    //recherche dans rec
                $stmtR = $mysqli->prepare("SELECT * FROM recettes   where titre LIKE ? OR chapo LIKE ?  OR difficulte LIKE ? OR prix LIKE ?  OR preparation LIKE ?  OR ingredient LIKE ? ORDER BY titre");
                
                $likeSearchGlobR = "%" . $SearchGlob . "%";
                
                $stmtR->bind_param('ssssss',$likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR, $likeSearchGlobR);  // Bind "$idRecetteGet" to ?. //<input type=button onClick="location.href='index.html'" value='click here'>
            
                $stmtR->execute();  
                $result = $stmtR->get_result();
                if ($result->num_rows > 0) 
                {
                //$fetchRec=$result->fetch_assoc()["idCategorie"];
                //$stmtRecettesCat= $mysqli->query("SELECT * FROM recettes where categorie=$fetchRec  ;");
                // if ($stmtRecettesCat->num_rows > 0) 
                    //{
                    echo ' <div class="row  mx-auto py-2  my-2  ">';
                    echo ' <div class="title  my-2     " style="color:#9D0461; text-align: left; width:100%!important">
                            <h4>  Recherche "'.$SearchGlob.'" suivant une recette  </h4><br>
                            </div>';
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
                else{

                    echo '  <div class="row">
                                <div class="title my-3" >
                                <h3 style="color:#9D0461; text-align: left;"   >Nous sommes désolés. Votre recherche n\'a pas aboutit.. Des fruits ou légumes ? ;)</h3>
                                </div>
                                <img src="photos/fruits-legumes/legumes-fruits.jpg" class="   img-thumbnail img-fluid"   >
                            </div>';
                }

                echo'   <div class="row mx-auto my-5">
                        <div class="col-sm-12 col-lg-6   col-md-6 p-2'; 
                    /*if($countrecNews==1) 
                    echo ' offset-4';
                    elseif ($countrecNews==0) 
                    echo ' offset-8';*/
                    echo '   " style="background-color:white ; border:1px dotted grey; max-height:200px!important " > 
                                <div class="row  mx-auto"  style=" color:#9D0461;  margin-bottom:5px;">
                                    <h4 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes  </h4>
                                </div>
                                <p> </p>

                                <div class=" row center-block  mx-auto form-group  has-search" style="max-width:50%!important">
                            
                                    <form method="post" action="rechercheGlobale.php?go&idRecherche=RechercheGlob" > <!--rechercheGlobale.php?go&idRecherche=RechercheGlob-->
                                            
                                                <span class="fa fa-search form-control-feedback"></span>
                                                <input type="text" class="form-control" placeholder="Recherche" aria-label="Recherche" name="RechercheGlobale" required="true">
                                        
                                            
                                                <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                                                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">Rechercher</button>
                                                </div>
                                    </form > 
                            
                                </div><div class="shadow"></div>
                            </div>
                            <div class="col-sm-12 col-lg-6   col-md-6    text-center   ">
                            <div id="newsletter">
                                <form method="post" action="welcome.php?go">
                                    <div class="seal">
                                    <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="title">
                                            <h4>  ABONNEZ-VOUS À NOTRE NEWSLETTER </h4>
                                    </div>
                                    <label for="email">                    
                                        Abonnez-vous à notre newsletter et recevez de nouvelles recettes dans votre
                                            boîte de réception. 
                                        </label>
                                        <input type="text" placeholder="Nom" name= "nomNews"required="true"/>
                                        </label>
                                        <input type="text" placeholder="Prénom" name="prenomNew"required="true"/>
                                        </label>
                                        <input type="text" placeholder="Email" name="EmailNews"required="true"/>
                                        <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitNews">S\'abonner</button>
                                </form>
                            </div>
                            <div class="shadow"></div><!-- newsletter -->
                        </div>  
                        </div>  
                             
                             ';
            }
        } 
        else
        { 
            echo '<script language="javascript">
             alert("Please enter a search query, redirecting to homepage on click");
            window.location.href="index.php";</script>';
            
        }
    } 
    else
    {  
        echo "<script>
        alert('empty search, click to redirect to home page');
        window.location.href='index.php';  
        </script>";
    }

    ?>


</div><!--.page-container-->
</body>
<?php
 include('footer.php');
 ?>
</html>	