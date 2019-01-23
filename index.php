<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">

<?php 
include ('includemenu.php');
  //select 3 random entries from DB
$resultRn=$mysqli->query("SELECT *FROM recettes ORDER BY RAND() LIMIT 3;");
$data_slide=$resultRn->fetch_all() ;
?>
  <div class="box mt-5 mb-5" id="carouselJS">
 <div id="myCarousel" class="carousel slide  " data-ride="carousel">
       <!-- Indicators -->
   <ol class="carousel-indicators">
     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
     <li data-target="#myCarousel" data-slide-to="1"></li>
     <li data-target="#myCarousel" data-slide-to="2"></li>
   </ol>     
   <!--Wrapper for slides-->
   <div class="carousel-inner"> 
   <?php 
for($i=0; $i<3;$i++)
{ 
   if($i==0)
    $active="active"; //first carousel item
   else
    $active="";    
    echo '
        <div class="carousel-item '. $active .  '">
        <a href="recettedetails.php?idRecette=' . $data_slide[$i][0].'"><img src=" ';
        //get image source from DB
    echo 'photos/recettes/'.$data_slide[$i][3] .'" alt="';
    echo $data_slide[$i][1];
    echo ' " class="img-thumbnail"></a>
            <div class="carousel-caption">
              <h3><a href="';
              //create site for receipt
    echo 'recettedetails.php?idRecette=' . $data_slide[$i][0];
    echo '"style="color: #9D0461;">';
    //get receipt title from DB
    echo $data_slide[$i][1];
    echo '</a></h3><br>
              <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" ><h4>
                  <a href="';
//  site for receipt
    echo 'recettedetails.php?idRecette=' . $data_slide[$i][0];
    echo '">Voir plus</a></h4></button>
            </div>
            </div> ';

}
?>
 </div>
<!-- Left and right controls -->
            
<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon"  aria-hidden="true" ></span>
  <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
  <span class="carousel-control-next-icon"  aria-hidden="true" ></span>
  <span class="sr-only">Next</span>
</a>
</div>
</div><!-- carrousel -->
 
 

<!-- Dernière Recette ajouttée -->
<div class="box col-12 mt-3 mb-3  mt-5">
     <h2 style="color: #9D0461;">Dernière Recette ajouttée</h2> 
  </div>

  <div class="row mb-3  mx-auto" >
      <div class="  col-lg-9 col-md-12 col-sm-12   mb-5    text-center mb-3" >
      
<?php
$DerniereRecette=$mysqli->query("SELECT * FROM recettes WHERE dateCrea= (select max(dateCrea) from recettes);");
//var_dump($DerniereRecette->fetch_assoc());
$DernRec=$DerniereRecette->fetch_assoc(); 
//var_dump($DernRec);
    echo '<a href="recettedetails.php?idRecette='.$DernRec['idRecette'] .'">';
    echo '<img src=" photos/recettes/' . $DernRec['img']. '" alt="' . $DernRec['titre'] . ' " class=" mb-3 img-fluid img-thumbnail"></a>';
    
//get categorie of the img
$CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[categorie];");
$cat=$CategorieDB->fetch_assoc();
// var_dump($cat);
echo '<span><h5 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom'] . '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h5></span>';
?>

<span><h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=<?php echo $DernRec['idRecette'];?> " style="color: #9D0461;">
<?php echo $DernRec['titre'];?></a></h4></span>
      <span><h5 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le <?php echo date("d-m-Y", strtotime($DernRec['dateCrea']))  ?></h5></span>
      <span><p> 
          <?php 
      if (strlen($DernRec['chapo'])>200)
      {
          $pos=strrpos (substr($DernRec['chapo'],0,200)," ");
            echo substr($DernRec['chapo'],0,$pos+1).'...'; 
      }
      else echo $DernRec['chapo'];
       ?>  </p></span>
       <div class="mb-3">
             <button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch  mt-3  " type="submit" ><h4>
                    <a href="recettedetails.php?idRecette=<?php echo $DernRec['idRecette'];?> ">Voir plus</a></h4></button>
    </div> <div class="shadow"  ></div>    
    </div> <!--derniere rec aj--> 
     <!-- A propos de nous -->
    <div class="  col-lg-3 col-md-12 col-sm-12  text-center   d-block my-3 " >
        <div class="row mx-auto p-2    center-block text-center"   style="background:#fff;"  >
           <h4  class="text-center" style="color: #9D0461;" >A propos de nous</h4> 
          <p>Depuis 8 ans maintenant, l’entreprise Cooking  lorum ispum lorum ispum lorum ispum
           lorum ispum lorum ispum lorum ispum lorum ispum lorum ispum
          lorum ispum  lorum ispum  lorum ispum  lorum ispum  lorum ispum  lorum ispum  lorum 
          ispum  lorum ispum  lorum ispum  lorum ispum  lorum ispum 
          lorum ispum  lorum ispum  lorum ispum  lorum ispum  lorum ispum  lorum ispum </p>

<!-- Nous suivre -->
        </div>  <div class="shadow"></div>
            
             
        <div class="row mx-auto mt-3 mb-1 p-2"  style="background:#fff;">
            <div class="title"  style=' color:#9D0461;  margin-bottom:5px;'>
                    <h4>  Nous suivre sur les réseaux sociaux </h4>
            </div>
            <div class=" center-block text-center mx-auto" >
                <a class="btn   btn-social btn-twitter btn-sm">
                        <span class="fa fa-twitter social"></span> </a>
                <a class="btn   btn-social btn-facebook btn-sm">
                        <span class="fa fa-facebook social"></span> </a>
                <a class="btn   btn-social btn-google-plus btn-sm">
                        <span class="fa fa-google-plus social"></span> </a>
                <a class="btn   btn-social btn-youtube btn-sm">
                        <span class="fa fa-youtube social"></span> </a>
                </div>
        </div>  <div class="shadow"></div>


            
        

 
    </div>
</div>


<div class="box mx-auto mt-3  " style="background:#fff; border:1px dashed grey; " > 
    <div class="row  mx-auto p-3"  style=' color:#9D0461;  margin-bottom:5px;'>
        <h2 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes  </h2>
    </div>
    <p> </p>

    <div class=" row center-block  mx-auto form-group  has-search" style="max-width:50%!important">
         
       <form method="post" action="rechercheGlobale.php?go&idRecherche=RechercheGlob" > <!--rechercheGlobale.php?go&idRecherche=RechercheGlob-->
            
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control mb-3" placeholder="Recherche" 
                aria-label="Recherche" name="RechercheGlobale" required="true">
           
             
                <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" 
                name="SubmitGlobale">Rechercher</button>
    
                </div>
        </form > 
         
    </div>
</div>  <div class="shadow"></div>


   <div class="box col-12 mt-3 mb-3    ">
        <span><h2 style="color: #9D0461;">Les recettes du jour</h2></span>
    </div>
<div class="row mb-3 ">
<!-- recettes du jour -->
<?php
$Dernieres3Rec=$mysqli->query("SELECT *FROM recettes ORDER BY dateCrea LIMIT 3;");
$Dern3Rec=$Dernieres3Rec->fetch_all();
for ($j=0;$j<3;$j++)
{
    $DernRec=$Dern3Rec[$j];

 //var_dump($DernRec);
echo '<div class="   pl-2 col-lg-3 col-md-6 col-sm-12   mb-5    text-center">';
echo '<div class="box" ><a href="recettedetails.php?idRecette='.$DernRec[0] .'">';
echo '<img src=" photos/recettes/' . $DernRec[3]. '" alt="' . $DernRec[1] .' " class=" mb-3 img-fluid img-thumbnail"></a></div>';

//get categorie of the img
$CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
$cat=$CategorieDB->fetch_assoc();
// var_dump($cat);
 
echo '<div class="box MyboxTitre" style="height:100px"><div class="box" ><h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: <a href="'.$cat['nom']. '.php?cat='. $cat['nom'].'">'. $cat['nom'].'</h6></div>';


echo '<div class="box" ><h4 style="  text-align: center;"> <a href="recettedetails.php?idRecette=';
echo $DernRec[0];
echo '" style="color: #9D0461;">';
echo $DernRec[1];
echo '</a></h4></div></div>
<div class="box  "><h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le ';
echo date("d-m-Y", strtotime($DernRec[8])); 
echo '</h6></div>
<div class="box  MyboxText"  style="height:160px"><p > ';
    
if (strlen($DernRec[2])>200)
{
    $pos=strrpos (substr($DernRec[2],0,200)," ");
    echo substr($DernRec[2],0,$pos+1).'...'; 
}
else 
echo $DernRec[2];
echo ' </p> </div>
<div class="box"style="height:50px" >
         <button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch   " type="submit" ><h4>
                <a href="recettedetails.php?idRecette=';
echo $DernRec[0];
echo ' ">Voir plus</a></h4></button></div>
           ';



echo '<hr>
          <div class="    col-12  pt-2  center-block text-center "  style="height:150px ">
          <div class="box" ><a href="membredetails.php?idMembre=';
                    //get member  
echo $DernRec[6];
$Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
$MembreDet=$Membre->fetch_assoc();
echo '"><img src="photos/gravatars/';
echo    $MembreDet['gravatar'];
echo '" alt="';
echo    $MembreDet['gravatar'];
echo '" class="img-thumbnail img-fluid"></a></div>';
echo '  <div class="box mb-2" ><h6 style="color:rgb(194, 194, 194); text-align: center;"  > Proposée par <a href="membredetails.php?idMembre=';
echo $DernRec[6];
echo ' "> ';
echo    $MembreDet['prenom'];
echo '</a></h6></div>    
          </div>   
          <hr>
  </div><!-- recette 1 -->';
}
?>
<!-- newsletter -->
<div class=" mb-3 pl-3 col-lg-3 col-md-6 col-sm-12  text-center thumbnail center well well-sm text-center">
<div class="  pl-2 col-12 pb-3   center-block text-center  m  " style="background:#fff;" >
                <form action="" method="post" role="form">
                    <span><h4 style="color:#9D0461; text-align: center;"  > Vous avez une recette à partager?</h4></span>
                    <input type="button" id="goaddrecette" value="  par ici!" style="border-radius:1rem;width:70%" class="btn btn-outline-success my-2 my-sm-0 butsearch" />

                </form> 
                
        </div><!-- partage recette -->
        <div class="shadow"></div>
        <div id="newsletter" class="mt-2">
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
                    <input type="text" placeholder="Nom" name= "nomNews" required="true"/>
                    </label>
                    <input type="text" placeholder="Prénom"  name="prenomNew" required="true"/>
                    </label>
                    <input type="text" placeholder="Email" name="EmailNews" required="true"/>
                    <!--input type="submit" value="S'abonner" name ='SubmitNews' class="btn btn-outline-success my-2 my-sm-0 butsearch" /-->
                    <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitNews" >S'abonner</button>
            </form>
        </div>
        <div class="shadow"></div><!-- newsletter -->
<!-- partage recette -->
        
    </div>
</div>


 </div><!--.page-container-->
</body>
<?php
include ('sessionincludeFooter.php');
?>
</html>			
 
<script>
    $('document').ready(function(){
    $("#goaddrecette").click(function(){
        window.location.href = 'ajouterRecette.php';
    });
    });
        
 
</script>

       