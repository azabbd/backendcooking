<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">

<?php
include ('includemenu.php');
$idRecetteGet =filter_input(INPUT_GET,"idRecette", FILTER_SANITIZE_NUMBER_INT);
    
if ($idRecetteGet) //valid integer
{

//  prepared query.
    $stmt = $mysqli->prepare("SELECT * FROM recettes where idRecette = ?");
    // sanitize input
    // Execute the prepared query.
    $stmt->bind_param('i', $idRecetteGet);  // Bind "$idRecetteGet" to ?.
    $_SESSION['idRecetteConsultee']=$idRecetteGet;
    $stmt->execute();    
    $Recetteresult = $stmt->get_result();
    $RecetteDet=$Recetteresult->fetch_assoc();
    if ($Recetteresult->num_rows==0)
    {
        
        echo 'Aucun article trouvé. <a href="index.php?">Retour à l\'accueil</a>';
        //include('footer.php');
        echo'</html>';	
        echo'<script language="javascript">
            alert("Aucune recette qui correspond dans la BDD, \n redirection vers l\'acceuil") 
            window.location.href="index.php" 
            </script>';   
        // echo 'Aucune recette qui correspond dans la BDD ';
        exit();
    }
//var_dump($RecetteDet);


//fetch the corresponding member
    $stmtM = $mysqli->prepare("SELECT * FROM membres where idMembre = ?");
    $stmtM->bind_param('i', $RecetteDet['membre']);  // Bind "$idRecetteGet" to ?.
    $stmtM->execute();    
    $Membereresult = $stmtM->get_result();
    $MembreDet=$Membereresult->fetch_assoc();
    // var_dump($MembreDet);

    $stmtC=$mysqli->prepare("SELECT * FROM categories WHERE idCategorie= ?;");
    $stmtC->bind_param('i', $RecetteDet['categorie']);  // Bind "$idRecetteGet" to ?.
    $stmtC->execute();    
    $CategorieDB = $stmtC->get_result();
    $cat=$CategorieDB->fetch_assoc();
    // var_dump($cat);
}   

?>
    <div class="title  mt-3 ">
        <h2 style="color:#9D0461; text-align: left;"  > <?php echo $RecetteDet['titre'];?>  </h2>
    </div>
        
    <div class="row    mx-auto" >
        <!-- A propos de la recette -->
        <div class="  col-lg-9 col-md-9 col-sm-12       text-center " > 
        <hr>
            <img src="photos/recettes/<?php echo $RecetteDet['img'];?> " alt="<?php echo $RecetteDet['titre'];?>" class=" mb-3 img-fluid img-thumbnail"> 
            <span><p>  <?php echo $RecetteDet['chapo'];?></p></span>
        </div> <!-- A propos de la recette -->

    <!-- A propos du membre -->
        <div class="  col-lg-3 col-md-3 col-sm-12  text-center   d-block   mb-3  " >
            <div class="row pt-3 ml-1 mb-1   center-block text-center   d-block"     >
                <a href="membredetails.php?idMembre=<?php echo $MembreDet['idMembre'];?>"><img src="photos/gravatars/<?php echo $MembreDet['gravatar'];?>" alt="<?php echo $MembreDet['gravatar'];?>" class="mt-3 mb-3 img-thumbnail img-fluid"></a>
                <hr>
                <span><h5 style="color:rgb(194, 194, 194); text-align: center;"  >Recette proposée par <a href="membredetails.php?idMembre=<?php echo $MembreDet['idMembre'];?>"> <?php echo $MembreDet['prenom'];?></a></h5></span>   
                <span><h5 style="color:rgb(194, 194, 194); text-align: center;"  >Membre depuis le <?php echo date("d-m-Y", strtotime($MembreDet['dateCrea']));?> </h5></span>
                <hr>
                <p class="mt-3 mb-3"> 
                <?php  
                if (strlen($MembreDet['About'])>100)
                 {
                    $pos=strrpos (substr($MembreDet['About'],0,100)," ");
                    echo substr($MembreDet['About'],0,$pos+1).'...'; 
                }
                else echo $MembreDet['About'];
                if($MembreDet['About']!="")
                    echo '<hr>';
                ?>  
                </p>
                
                <button class="  aclass btn btn-outline-success my-2 my-sm-0 butsearch btn-sm  " type="submit" ><h4>
                    <a href="membredetails.php?idMembre=<?php echo $MembreDet['idMembre'];?>">Voir plus</a></h4></button>
                    <p></p>
                    <!-- me suivre -->
                    <?php 
                    if($MembreDet['twitter'])
                    {
                        ?>   
                    <a href="<?php echo $MembreDet['twitter'];?>" class="btn   btn-social btn-twitter btn-sm">
                            <span class="fa fa-twitter social"></span> </a>
                            <?php
                    }
                    ?>
                    <?php 
                    if($MembreDet['facebook'])
                    {
                        ?>
                    <a href="<?php echo $MembreDet['facebook'];?>" class="btn   btn-social btn-facebook btn-sm">
                            <span class="fa fa-facebook social"></span> </a>
                            <?php
                    }
                    ?>
                    <?php 
                    if($MembreDet['instagram'])
                    {
                        ?>
                    <a href="<?php echo $MembreDet['instagram'];?>" class="btn   btn-social btn-instagram btn-sm">
                            <span class="fa fa-instagram social"></span> </a>
                            <?php
                    }
                    ?>
                    <?php 
                    if($MembreDet['youtube'])
                    {
                        ?>
                    <a href="<?php echo $MembreDet['youtube'];?>" class="btn   btn-social btn-youtube btn-sm">
                            <span class="fa fa-youtube social"></span> </a>
                            <?php
                    }
                    ?>
                                
                    <!-- me suivre -->
            </div> 
        </div><!-- A propos du membre -->
         
    </div><div class="shadow"  ></div>
        
    
    
    <div class="title  ">
             <h2 style="color: #9D0461;">Ça vous tente de l'essayer? </h2> 
            
    </div>


    <div class="row mx-auto  mb-2">
<!-- recette  detaillée -->
        <div class="    col-lg-9 col-md-8 col-sm-12 center-block d-block text-center">
            <!-- tete  -->  
            <hr>
            <div class="row mb-2 mx-auto   ">
                
                <div class="  title  mb-3  "style="text-align:left">
                    <h4 style="color: #4e049d;"> <?php echo $RecetteDet['titre'];?> </h4>
                    <p style="color:rgb(194, 194, 194); text-align: left; "> Ajoutée le <?php echo date("d-m-Y", strtotime($RecetteDet['dateCrea']));?> | Catégorie <a href="<?php echo $cat['nom'];?>.php?cat=<?php echo $cat['nom'];?>"> <?php echo $cat['nom'];?>  </a></p> 
                </div>
                <div class="row mb-2 mx-auto   ">
                    <div class=" col-lg-9  col-md-12 col-sm-12    mb-3   "> 
                        
                            <table class="  tableRecette">
                                <tr>
                                    <th class=" "> Temps préparation</th>
                                    <th class=" ">Temps cuisson</th>
                                    <th class=" ">Difficulté</th>
                                    <th class=" ">Prix</th>
                                    
                                </tr>
                                <tr>
                                    <td class=" "> <?php echo $RecetteDet['tempsPreparation'];?></td>
                                    <td class=" "> <?php echo $RecetteDet['tempsCuisson'];?></td>
                                    <td class=" "> <?php echo $RecetteDet['difficulte'];?></td>
                                    <td class=" "> <?php echo $RecetteDet['prix'];?></td>
                                    
                                </tr>
                            </table>
                        
                    </div>
                    <div class="  col-lg-3  col-md-12 col-sm-12  mb-3   ">
                        <img src="photos/recettes/<?php echo $RecetteDet['img'];?>" alt="<?php echo $RecetteDet['titre'];?>" class=" mb-3  img-thumbnail img-fluid">
                        <button class="   btn btn-outline-success hidden-print butsearch" onclick=" window.print();">
                        <span  class="glyphicon glyphicon-print"  ></span > Imprimer</button>
                    </div>
                </div>
            </div><!-- tete  -->

            <!-- corps recette  -->
            <hr>
            <div class="row mx-auto"> 
                 <div class="col-12">
                    <h4 style="  text-align: left;color: #4e049d;">  Ingrédients </h4> 
                    <p></p>  
                    <table  class="ingredients w" style='border=0 ;   '>
                        <tr style="width:100%!important">
                            <td >
                            
                                <?php 
                                //substr_replace($RecetteDet['ingredient'][]
                                $arr1 = str_split($RecetteDet['ingredient']);
                                $arr1[3]= " id='ingredients'> ";
                                echo implode($arr1);
                                //var_dump(implode($arr1));
                                /*var_dump(implode($arr1));
                                var_dump($arr1);*/
                                
                                ?>
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
           
                <div class="col-12">
                    <h4 style="  text-align: left;color: #4e049d;">  Preparation </h4> 
                    <p></p>  

                    <table   class="underlined  w" style='border=0 ;  '>
                        <tr>
                            <td>
                            <?php 
                            //add id=preparation to the list
                            $arr1 = str_split($RecetteDet['preparation']);//convert to an array
                            $arr1[3]= " id='Preparation'> ";
                            $ListNoErrors= EnhanceList($arr1);
                            //var_dump($arr1);
                            echo $ListNoErrors;
                            
                            ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
        </div><!-- recette   -->
         <!-- widget -->
         <div class="  col-lg-3 col-md-4 col-sm-12 text-center center-block d-block  ">
            
            <!-- partage recette -->
            <div class="  row mx-auto mt-3 pb-2  text-center d-block center-block " style="background:#fff; "  >
                <div class="title text-center p-1 ">
                        <h4 style="   color: #9D0461;">  Partage  </h4>
                </div>
                <div class="share-button sharer  " style="display: block;">
                    
                    <div class="social top center networks-4 ">
                        <!-- Facebook Share Button -->
                        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=url"><i class="fa fa-facebook"></i></a> 
                        
                        <!-- Google Plus Share Button -->
                        <a class="fbtn share gplus" href="https://plus.google.com/share?url=url"><i class="fa fa-google-plus"></i></a> 
                        
                        <!-- Twitter Share Button -->
                        <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url=url&amp;via=creativedevs"><i class="fa fa-twitter"></i></a> 
                    
                        <!-- Pinterest Share Button -->
                        <a class="fbtn share pinterest" href="http://pinterest.com/pin/create/button/?url=url&amp;description=data&amp;media=image"><i class="fa fa-pinterest"></i></a>
                        
                        
                    </div>
                </div>
            </div>
            <div class="shadow"></div>
<!-- newsletter -->
<div class="row mx-auto pt-3  text-center"> 
                <div id="newsletter">
                    <form method="post" action='welcome.php?go'>
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
                            <input type="text"style="border-radius:1rem;" placeholder="Nom" name= "nomNews"required="true"/>
                            </label>
                            <input type="text" style="border-radius:1rem;"placeholder="Prénom" name="prenomNew"required="true"/>
                            </label>
                            <input type="text"style="border-radius:1rem;" placeholder="Email" name="EmailNews"required="true"/>
                            <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitNews"> <h5>S'abonner</h5></button>
                    </form>
                </div>
            </div><!-- newsletter -->
            <div class="shadow"  ></div>
            <div class=" row mx-auto text-center   mt-3" style="background:#fff;  " >
                <div class="title mt-2  p-1">
                    <h4 style="color:#9D0461;  " > Vous l'aviez préparé?   </h4>
                </div>
                
                <div class="    mx-auto form-group has-search text-center   mt-2 pb-2" style=" margin: 0 auto">
                    <button class="btn btn-outline-success my-2 my-sm-0 butsearch"   type="submit" ><h5>La telecharger!</h5></button>
                </div>
            </div>
            <div class="shadow"></div> <!-- partage recette -->
            <div class="row mx-auto  center-block text-center   d-block  p-2 mt-3" style="background:#fff; ">
                <div class="title">
                    <h4 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes  </h4>
                </div> 
                <div class="   row mx-auto   form-group has-search   "   >
                    <form method="post" action="rechercheGlobale.php?go&idRecherche=RechercheGlob" > <!--rechercheGlobale.php?go&idRecherche=RechercheGlob-->
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control mb-3" style="border-radius:1rem;"placeholder="Recherche" aria-label="Recherche" name="RechercheGlobale" required="true">
                            <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale"><h5>Rechercher</h5></button>
                            </div>
                    </form > 
                </div> 
            </div>
            <div class="shadow"></div>
        </div>
    </div> <!-- widget -->
    <div class=" row mx-auto   my-3   "   >
     
            <div class="title      ">
                <h2 style="color:#9D0461;  " > Ils l'ont essayé   </h2>
               
                 
            </div> <hr>
            <div class="row mx-auto my-5   ">
                <div class="col-4    pl-1 pb-1 "> 
                        <a href="#"><img src="photos/gravatars/annie.png" alt="quiche-legume-printemps" class="rounded-circle  img-thumbnail img-fluid"></a>
                        <a href="#"><img src="photos/gravatars/annie.png" alt="quiche-legume-printemps" class="rounded-circle    img-thumbnail img-fluid"></a>
                </div>
                <div class="col-4   pl-1 pb-1 ">
                    <a href="#"><img src="photos/gravatars/annie.png" alt="quiche-legume-printemps" class="rounded-circle  img-thumbnail img-fluid"></a>
                    <a href="#"><img src="photos/gravatars/annie.png" alt="quiche-legume-printemps" class="rounded-circle  img-thumbnail img-fluid"></a>
                </div>  
            </div><!-- partage recette -->
        </div> <hr>
        <div class="row mb-3     mx-auto">
            <div class="title  my-2     ">
                <h2 style="color:#9D0461;  "   >Vous aimerez aussi:  </h2>
            </div>   
            <div class="row mb-3     mx-auto"> <hr>
        <!--propositions-->
        <div class="col      mb-2  "  >
            <div class="row  mx-auto pb-2 pt-2 pr-1  ">
                <div class="col-lg-4 col-md-4 col-sm-4 "    >
                <?php
$categ=$RecetteDet['categorie'];
$mmbre=$RecetteDet['membre'];
$result=$mysqli->query("SELECT * from recettes where categorie= $categ or membre=$mmbre LIMIT 2");
/*echo '<br>' . $result->num_rows . '<br>';
var_dump($result->num_rows);*/
if ($result->num_rows<3)
    {
        $resteRC=3-$result->num_rows;
        //echo '<br>' . $resteRC . '<br>';
        $resultss=$mysqli->query("SELECT * from recettes where categorie= $categ or membre=$mmbre  union  SELECT *FROM recettes ORDER BY RAND() LIMIT 3 ");
        $RecetProp=$resultss->fetch_all();
        //echo 'less';
    }
    else 
    $RecetProp=$result->fetch_all();
    //var_dump($RecetProp);
?>
                     <a href="recettedetails.php?idRecette=<?php echo $RecetProp[0][0]  ?>"> <img src="photos/recettes/<?php echo $RecetProp[0][3];?>" alt="<?php echo $RecetProp[0][1];?>" class="  img-thumbnail img-fluid"></a>
                     <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=<?php echo $RecetProp[0][0]  ?>" style="color: #9D0461;"><?php echo $RecetProp[0][1]  ?></a></h4> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4        "  >
                    <a href="recettedetails.php?idRecette=<?php echo $RecetProp[1][0]  ?>"> <img src="photos/recettes/<?php echo $RecetProp[1][3];?>" alt="<?php echo $RecetProp[1][1];?>" class="  img-thumbnail img-fluid"></a>
                    <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=<?php echo $RecetProp[1][0]  ?>" style="color: #9D0461;"><?php echo $RecetProp[1][1]  ?></a></h4> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4        "   >
                    <a href="recettedetails.php?idRecette=<?php echo $RecetProp[2][0]  ?>"> <img src="photos/recettes/<?php echo $RecetProp[2][3];?>" alt="<?php echo $RecetProp[2][1];?>" class="  img-thumbnail img-fluid"></a>
                    <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=<?php echo $RecetProp[2][0]  ?>" style="color: #9D0461;"><?php echo $RecetProp[2][1]  ?></a></h4> 
                </div>
            </div>       
        </div>
        <div class="  col-lg-3 col-md-10 col-sm-12  ol  mb-2 form-group has-search  text-center "   >
            
        </div>
    </div> 
    </div> <hr>


        
 
</div > <!--container --> 
</body>




<?php
function EnhanceList($arr1)
{
                    $impPrep=implode($arr1);//convert back to a string
                    //replace at the end of the list <ol> with </ol>
                    $impPrep = str_split($impPrep);
                    $sizePre=sizeof($impPrep);
                    $impPrep[$sizePre-3]= "/o";
                    $impPrep=implode($impPrep); 
                    // remove the extra numbers of list items and extra </li> 
                    $needle='<li>';
                    //$error2='<li></li>'; 
                    $lastPos = 0; 
                    $positions = array(); 
                    while (($lastPos = strpos($impPrep, $needle, $lastPos))!== false) {
                        $positions[] = $lastPos;
                        $lastPos = $lastPos + strlen($needle);
                    }
                     
                    
                    //$arr2 = str_split(htmlentities($RecetteDetFuntion));
                    
                    $impPrep=str_replace('<li></li>','</li><li>', html_entity_decode($impPrep),$p);
                    $impPrep=htmlentities($impPrep);
                    $impPrep= str_replace(array("\r", "\n", "\r\n", "\v", "\t", "\0","\x"), " ", $impPrep);
                    $lastPosli=0;
                    $positionsli = array();
                    $impPrep=html_entity_decode($impPrep);
                    $impPrep = preg_replace('!\s+!', ' ', $impPrep); //remove multiple spaces
                    $impPrep = str_split($impPrep);//to array
                    $impPrep=implode($impPrep);
                 
                while (($lastPosli = strpos($impPrep, $needle, $lastPosli))!== false) {
                    $positionsli[] = $lastPosli;
                    $lastPosli = $lastPosli + strlen($needle);
                } 
                //var_dump(sizeof($positionsli));
                $countLi=0;
                foreach ($positionsli as $value) 
                {
                     //if($countLi<9) //less than 10 list items
                   // {
                        $posnb=$value+4;
                        $posnb2=$value+5;
                        $posnb3=$value+6;
                        if( preg_match('~[0-9]+~', $impPrep[$posnb]))
                        {
                        // echo  $arr4[$posnb].'<br>';
                            $impPrep[$posnb]=" ";  
                            //echo $posnb."<br>";
                            if( preg_match('~[0-9]+~', $impPrep[$posnb2]) && $countLi>9 )
                            $impPrep[$posnb2]=" ";
                        }
                        elseif ($impPrep[$posnb]==" " && preg_match('~[0-9]+~', $impPrep[$posnb2]) )
                        {
                        // echo  $arr4[$posnb2].'<br>';
                            $impPrep[$posnb2]=" ";  
                            //echo $posnb."<br>";  
                            if( preg_match('~[0-9]+~', $impPrep[$posnb3]) )
                            $impPrep[$posnb3]=" "; 

                        }
                    //}
                         
                $countLi++;

                     
               
                    
                        
                } 
               // var_dump(str_split($impPrep));
return $impPrep;
} 

include ('sessionincludeFooter.php');
require('connexion.check.php'); 
 ?>
</html>	




