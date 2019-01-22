<!DOCTYPE html>
<?php
 include('header.php');
 session_start(); 
 $mysqli= new mysqli("localhost","root","","cooking");
 if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", mysqli_connect_error());
    exit();
}
 ?>

<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">
<?php
 
             include ('menu.php');

$CountCategorieInDB=$mysqli->query("SELECT Count(nom) AS NbCategorie FROM categories ;");
$CountCategorieInDB=$CountCategorieInDB->fetch_assoc();
//var_dump($CountCategorieInDB);
//echo $CountCategorieInDB['NbCategorie'];
 $countEmptycat=0; 

 //cat is empty??
for($idCategorieGet=1; $idCategorieGet<=$CountCategorieInDB['NbCategorie'];$idCategorieGet++)
{
//select   from DB upon categorie
$stmt = $mysqli->prepare("SELECT *FROM recettes where categorie= ? ORDER BY dateCrea ;");
$stmt->bind_param('i', $idCategorieGet);  // Bind "$idRecetteGet" to ?.
$stmt->execute();    
$Recetteresult = $stmt->get_result();
$RecetteDet=$Recetteresult->fetch_all();
if ($Recetteresult->num_rows==0) 
   {
      $countEmptycat++; //cat is empty
       
    }
 }


 if($countEmptycat!=$CountCategorieInDB) //DB empty
{
   echo' <div class="title mt-3">
        <h3 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes  </h3>
        </div>
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
     ';
}


 $countcat=0;
  for($idCategorieGet=1; $idCategorieGet<=$CountCategorieInDB['NbCategorie'];$idCategorieGet++)
  {
  /*  $CurrentCategorieInDB=$mysqli->query("SELECT *   FROM categories where idCategorie=$idCategorieGet;");
    $CurrentCategorie=$CurrentCategorieInDB->fetch_assoc();*/

  //select     entries from DB upon categorie
  $stmt = $mysqli->prepare("SELECT *FROM recettes where categorie= ? ORDER BY dateCrea ;");
  $stmt->bind_param('i', $idCategorieGet);  // Bind "$idRecetteGet" to ?.
  $stmt->execute();    
  $Recetteresult = $stmt->get_result();
  $RecetteDet=$Recetteresult->fetch_all();

$Lacategorie=$mysqli->query("SELECT * FROM categories where idCategorie=$idCategorieGet ;");
$LacategorieNomId=$Lacategorie->fetch_assoc();

  if ($Recetteresult->num_rows==0) 
     {
        $countcat++; // this cat is empty
         
        //var_dump($LacategorieNomId);
       /* echo '<div class="row mb-3     mx-auto">
        <div class="title  my-2     ">
        <a href="'.$LacategorieNomId["nom"].'.php?cat='.$LacategorieNomId["nom"].'"> <h2 style="color:#9D0461;  "   >'.$LacategorieNomId["nom"].'  </h2></a>
        </div> ';
        echo '
        <div class="row mb-3     mx-auto">
                    <div class="col-lg-9 col-md-12 col-sm-12     my-3  "  >
                    <div class="row  mx-auto pb-2 pt-2 pr-1  my-4  "> 
                    <h4 style="  text-align: center;">  Aucune recette  dans la BDD pour la catégorie '.$LacategorieNomId["nom"].' </h4></div> </div>  </div></div>';*/
    }
    
   else // this cat is not empty echo  receipts
    {
         //<div class="row mb-3     mx-auto">
        echo '
                <div class="title  my-2     ">
                <a href="'.$LacategorieNomId["nom"].'.php?cat='.$LacategorieNomId["nom"].'"> <h2 style="color:#9D0461;  "   >'.$LacategorieNomId["nom"].'  </h2></a>
                </div> 

                <div class="row mb-3     mx-auto">
                    <div class="col-lg-9 col-md-12 col-sm-12     my-3  "  >
                        <div class="row  mx-auto pb-2 pt-2 pr-1  my-4  ">';
for($iRecette=0;$iRecette<(sizeof($RecetteDet)); $iRecette++ )
{
        echo '              <div class="col-lg-4 col-md-4 col-sm-4 "    >
                                <a href="recettedetails.php?idRecette='.$RecetteDet[$iRecette][0].'"> <img src="photos/recettes/'.$RecetteDet[$iRecette][3].'" alt="'.$RecetteDet[$iRecette][1].'" class="  img-thumbnail img-fluid"></a>
                                <h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette='.$RecetteDet[$iRecette][0].'" style="color: #9D0461;">'.$RecetteDet[$iRecette][1].'</a></h4> 
                            </div>';
               

}
                echo  ' </div>  ';//col row  mx-auto

                



    echo '<button class="  aclass btn btn-outline-success my-2 my-sm-0 butsearch btn-sm  " type="submit" ><h4>
    <a href="'.$LacategorieNomId["nom"].'.php?cat='.$LacategorieNomId["nom"].'">Voir plus de recettes dans cette catégorie</a></h4></button> ';  
    echo  ' </div>';//col-lg-9
    if ($idCategorieGet==1)
{
    $pointerConnex=1;
echo  '<div class="col-lg-3 col-md-8 col-sm-12  mx-auto     "  >';

echo '<!--se connecter-->
     
              <div class="login-form" >
                  <form action="
                  " method="post">
                      <div class="title">
                          <h4 style="color:#9D0461; text-align: left;"   >Connexion  </h4>
                      </div>      
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Username" required="required">
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" placeholder="Password" required="required">
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-outline-success my-2 my-sm-0 butsearch">Se connecter</button>
                      </div>
                      <div class="clearfix custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                          <label class="custom-control-label" for="defaultUnchecked">Se souvenir de moi</label>
                          <a href="#" class="pull-right">Mdp oublié?</a>
                      </div>
                      </form>
                  <p></p>
                  <p class="text-center"><a href="#">Créer un compte</a></p>
              </div>
        <!--se connecter-->';
    
        echo  ' </div>';//col lg3
        echo  ' </div>';//col row

    }
    if ($idCategorieGet==2)
{
    $pointerNews=1;
 

echo ' <div class="  col-lg-3 col-md-8 col-sm-12  text-center thumbnail my-4  ">
<!-- newsletter -->
<div class="row mx-auto "> 
    <div id="newsletter">
        <form action="">
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
                <input type="text" placeholder="Nom" />
                </label>
                <input type="text" placeholder="Prénom" />
                </label>
                <input type="text" placeholder="Email" />
                <input type="submit" value="S\'abonner" class="btn btn-outline-success my-2 my-sm-0 butsearch" />
            </form>
    </div>

</div><!-- newsletter -->';
    
        echo  ' </div>';//col lg3
        echo  ' </div>';//col row

    }
    






   
}

}
    
 
 ?>
 
    
 

 </div><!--.page-container-->
</body>
<?php
 include('footer.php');
 ?>
</html>			
 
