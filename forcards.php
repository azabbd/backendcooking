<div class="row mx-auto   ">
        <div class=" mb-3  col-lg-9 col-md-12 col-sm-12  text-center thumbnail center well well-sm text-center">
             

            <?php
            $Dernieres3Rec=$mysqli->query("SELECT *FROM recettes ORDER BY dateCrea LIMIT 3;");
            $Dern3Rec=$Dernieres3Rec->fetch_all();
            for ($j=0;$j<3;$j++)
            {
                $DernRec=$Dern3Rec[$j];

            echo '<div class="col-md-6 col-lg-4 col-xl-4">';
            echo '<div class="card">';
             
                    echo '<a href="recettedetails.php?idRecette='.$DernRec[0] .'">';
                    echo '<img class="card-img-top" src="photos/recettes/'. $DernRec[3]. '" alt="' . $DernRec[1] . ' " class=" mb-3 img-fluid img-thumbnail"></a>';
                
                
                    echo'<div class="card-body">';
                        echo' <div class="card-title"> ';
                            //get categorie of the img
                            $CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
                            $cat=$CategorieDB->fetch_assoc(); 

                            echo '<h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom']. '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h6>';
                            
                            echo ' <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=';
                            echo $DernRec[0];
                            echo '" style="color: #9D0461;">';
                            echo $DernRec[1];
                            echo '</a></h4> 
                            <h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le ';
                            echo date("d-m-Y", strtotime($DernRec[8])); 
                            echo '</h6> ';
                        echo '</div>';


                echo '<p class="card-text">';
                if (strlen($DernRec[2])>100)
                    {
                        $pos=strrpos (substr($DernRec[2],0,100)," ");
                        echo substr($DernRec[2],0,$pos+1).'...'; 
                    }
                    else 
                    echo $DernRec[2];
                        echo '</p>
                        </div>
                        <div class="card-body"><button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch mt-5  " type="submit" ><h4>
                                    <a href="recettedetails.php?idRecette=';
                    echo $DernRec[0];
                    echo ' ">Voir plus</a></h4></button>
                    </div>';
                         

                echo '<div class="card-footer">
                <small class="">
                <a href="membredetails.php?idMembre=';
                                //get member  
                    echo $DernRec[6];
                    $Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
                    $MembreDet=$Membre->fetch_assoc();
                    echo '"><img src="photos/gravatars/';
                    echo    $MembreDet['gravatar'];
                    echo '" alt="';
                    echo    $MembreDet['gravatar'];
                    echo '" class="img-thumbnail img-fluid"></a>';
                    echo '   <h6 style="color:rgb(194, 194, 194); text-align: center;"  >
                    Proposée par <a href="membredetails.php?idMembre=';
                    echo $DernRec[6];
                    echo ' "> ';
                    echo    $MembreDet['prenom'];
                    echo '</a></h6>    
                        
                
                </small>
                </div> </div>
            </div>';
            
            
            }
            ?>
        </div>
 











 <div class="row mx-auto   ">
        <div class=" mb-3  col-lg-9 col-md-12 col-sm-12  text-center thumbnail center well well-sm text-center">
            <div class="card-deck "style="display: flex;">

            <?php
            $Dernieres3Rec=$mysqli->query("SELECT *FROM recettes ORDER BY dateCrea LIMIT 3;");
            $Dern3Rec=$Dernieres3Rec->fetch_all();
            for ($j=0;$j<3;$j++)
            {
                $DernRec=$Dern3Rec[$j];


            echo '<div class="card">';
                    echo '<a href="recettedetails.php?idRecette='.$DernRec[0] .'">';
                    echo '<img class="card-img-top" src="photos/recettes/'. $DernRec[3]. '" alt="' . $DernRec[1] . ' " class=" mb-3 img-fluid img-thumbnail"></a>';
                
                
                    echo'<div class="card-body">';
                        echo' <div class="card-title"> ';
                            //get categorie of the img
                            $CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
                            $cat=$CategorieDB->fetch_assoc(); 

                            echo '<h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom']. '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h6>';
                            
                            echo ' <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=';
                            echo $DernRec[0];
                            echo '" style="color: #9D0461;">';
                            echo $DernRec[1];
                            echo '</a></h4> 
                            <h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le ';
                            echo date("d-m-Y", strtotime($DernRec[8])); 
                            echo '</h6> ';
                        echo '</div>';


                echo '<p class="card-text">';
                if (strlen($DernRec[2])>100)
                    {
                        $pos=strrpos (substr($DernRec[2],0,100)," ");
                        echo substr($DernRec[2],0,$pos+1).'...'; 
                    }
                    else 
                    echo $DernRec[2];
                        echo '</p></div><div class="card-body"><button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch mt-5  " type="submit" ><h4>
                                    <a href="recettedetails.php?idRecette=';
                    echo $DernRec[0];
                    echo ' ">Voir plus</a></h4></button></div>';
                         

                echo '<div class="card-footer">
                <small class="">
                <a href="membredetails.php?idMembre=';
                                //get member  
                    echo $DernRec[6];
                    $Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
                    $MembreDet=$Membre->fetch_assoc();
                    echo '"><img src="photos/gravatars/';
                    echo    $MembreDet['gravatar'];
                    echo '" alt="';
                    echo    $MembreDet['gravatar'];
                    echo '" class="img-thumbnail img-fluid"></a>';
                    echo '   <h6 style="color:rgb(194, 194, 194); text-align: center;"  >
                    Proposée par <a href="membredetails.php?idMembre=';
                    echo $DernRec[6];
                    echo ' "> ';
                    echo    $MembreDet['prenom'];
                    echo '</a></h6>    
                        
                
                </small>
                </div>
            </div>';
            
            
            }
            ?>
        </div>
    </div>








    <div class="row mx-auto   ">
        <div class=" mb-3  col-lg-9 col-md-12 col-sm-12  text-center thumbnail center well well-sm text-center">
             

            <?php
            $Dernieres3Rec=$mysqli->query("SELECT *FROM recettes ORDER BY dateCrea LIMIT 3;");
            $Dern3Rec=$Dernieres3Rec->fetch_all();
            for ($j=0;$j<3;$j++)
            {
                $DernRec=$Dern3Rec[$j];

            echo '<div class="col-md-6 col-lg-4 col-xl-4">';
            echo '<div class="card">';
             
                    echo '<a href="recettedetails.php?idRecette='.$DernRec[0] .'">';
                    echo '<img class="card-img-top" src="photos/recettes/'. $DernRec[3]. '" alt="' . $DernRec[1] . ' " class=" mb-3 img-fluid img-thumbnail"></a>';
                
                
                    echo'<div class="card-body">';
                        echo' <div class="card-title"> ';
                            //get categorie of the img
                            $CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
                            $cat=$CategorieDB->fetch_assoc(); 

                            echo '<h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom']. '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h6>';
                            
                            echo ' <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=';
                            echo $DernRec[0];
                            echo '" style="color: #9D0461;">';
                            echo $DernRec[1];
                            echo '</a></h4> 
                            <h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le ';
                            echo date("d-m-Y", strtotime($DernRec[8])); 
                            echo '</h6> ';
                        echo '</div>';


                echo '<p class="card-text">';
                if (strlen($DernRec[2])>100)
                    {
                        $pos=strrpos (substr($DernRec[2],0,100)," ");
                        echo substr($DernRec[2],0,$pos+1).'...'; 
                    }
                    else 
                    echo $DernRec[2];
                        echo '</p>
                        </div>
                        <div class="card-body"><button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch mt-5  " type="submit" ><h4>
                                    <a href="recettedetails.php?idRecette=';
                    echo $DernRec[0];
                    echo ' ">Voir plus</a></h4></button>
                    </div>';
                         

                echo '<div class="card-footer">
                <small class="">
                <a href="membredetails.php?idMembre=';
                                //get member  
                    echo $DernRec[6];
                    $Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
                    $MembreDet=$Membre->fetch_assoc();
                    echo '"><img src="photos/gravatars/';
                    echo    $MembreDet['gravatar'];
                    echo '" alt="';
                    echo    $MembreDet['gravatar'];
                    echo '" class="img-thumbnail img-fluid"></a>';
                    echo '   <h6 style="color:rgb(194, 194, 194); text-align: center;"  >
                    Proposée par <a href="membredetails.php?idMembre=';
                    echo $DernRec[6];
                    echo ' "> ';
                    echo    $MembreDet['prenom'];
                    echo '</a></h6>    
                        
                
                </small>
                </div> </div>
            </div>';
            
            
            }
            ?>
        </div>
 











 <div class="row mx-auto   ">
        <div class=" mb-3  col-lg-9 col-md-12 col-sm-12  text-center thumbnail center well well-sm text-center">
            <div class="card-deck "style="display: flex;">

            <?php
            $Dernieres3Rec=$mysqli->query("SELECT *FROM recettes ORDER BY dateCrea LIMIT 3;");
            $Dern3Rec=$Dernieres3Rec->fetch_all();
            for ($j=0;$j<3;$j++)
            {
                $DernRec=$Dern3Rec[$j];


            echo '<div class="card">';
                    echo '<a href="recettedetails.php?idRecette='.$DernRec[0] .'">';
                    echo '<img class="card-img-top" src="photos/recettes/'. $DernRec[3]. '" alt="' . $DernRec[1] . ' " class=" mb-3 img-fluid img-thumbnail"></a>';
                
                
                    echo'<div class="card-body">';
                        echo' <div class="card-title"> ';
                            //get categorie of the img
                            $CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
                            $cat=$CategorieDB->fetch_assoc(); 

                            echo '<h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom']. '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h6>';
                            
                            echo ' <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=';
                            echo $DernRec[0];
                            echo '" style="color: #9D0461;">';
                            echo $DernRec[1];
                            echo '</a></h4> 
                            <h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le ';
                            echo date("d-m-Y", strtotime($DernRec[8])); 
                            echo '</h6> ';
                        echo '</div>';


                echo '<p class="card-text">';
                if (strlen($DernRec[2])>100)
                    {
                        $pos=strrpos (substr($DernRec[2],0,100)," ");
                        echo substr($DernRec[2],0,$pos+1).'...'; 
                    }
                    else 
                    echo $DernRec[2];
                        echo '</p></div><div class="card-body"><button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch mt-5  " type="submit" ><h4>
                                    <a href="recettedetails.php?idRecette=';
                    echo $DernRec[0];
                    echo ' ">Voir plus</a></h4></button></div>';
                         

                echo '<div class="card-footer">
                <small class="">
                <a href="membredetails.php?idMembre=';
                                //get member  
                    echo $DernRec[6];
                    $Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
                    $MembreDet=$Membre->fetch_assoc();
                    echo '"><img src="photos/gravatars/';
                    echo    $MembreDet['gravatar'];
                    echo '" alt="';
                    echo    $MembreDet['gravatar'];
                    echo '" class="img-thumbnail img-fluid"></a>';
                    echo '   <h6 style="color:rgb(194, 194, 194); text-align: center;"  >
                    Proposée par <a href="membredetails.php?idMembre=';
                    echo $DernRec[6];
                    echo ' "> ';
                    echo    $MembreDet['prenom'];
                    echo '</a></h6>    
                        
                
                </small>
                </div>
            </div>';
            
            
            }
            ?>
        </div>
    </div>