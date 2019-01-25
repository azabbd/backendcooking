<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
<body>
<div class="container page-container mt-3 ">
<?php 
include ('includemenu.php');
//select 3 random entries from DB
$resultRn = $mysqli->query("SELECT *FROM recettes ORDER BY RAND() LIMIT 3;");
$data_slide = $resultRn->fetch_all() ;
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
    {
        $active="active"; //first carousel item
    }
    else
    {
    $active=""; 
    }   
?> 
                <div class="carousel-item <?php echo $active ; ?>">
                    <a href="recettedetails.php?idRecette=<?php echo $data_slide[$i][0]; ?>"><img src="photos/recettes/<?php echo $data_slide[$i][3]; ?>" alt="<?php echo $data_slide[$i][1];?>"
class="img-thumbnail"></a>
                    <div class="carousel-caption">
                        <h3>
                            <a href="recettedetails.php?idRecette=<?php echo $data_slide[$i][0];?>" style="color: #9D0461;">
                            <?php echo $data_slide[$i][1];?> 
                            </a>
                        </h3><br>
                        <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" >
                            
                                <a href="recettedetails.php?idRecette=<?php echo $data_slide[$i][0];?>"><h4>Voir plus</h4>
                                </a>
                            
                        </button>
                    </div>
                </div> 
<?php
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
?>
            <a href="recettedetails.php?idRecette=<?php echo $DernRec['idRecette']?>">
                <img src=" photos/recettes/<?php echo $DernRec['img']?>" alt="<?php echo $DernRec['titre']?>" class=" mb-3 img-fluid img-thumbnail">
            </a>
<?php 
$CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[categorie];");
$cat=$CategorieDB->fetch_assoc();
// var_dump($cat);
?>
            <h5 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: 
            </h5> 
            <a href="<?php echo $cat['nom']?>.php?cat=<?php echo $cat['nom'];?>">
            <h5><?php echo $cat['nom']?>
            </h5></a> 
            <h4 style="  text-align: center;"> 
                <a href="recettedetails.php?idRecette=<?php echo $DernRec['idRecette'];?> " style="color: #9D0461;"><?php echo $DernRec['titre'];?>
                </a>
            </h4> 
            <h5 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le <?php echo date("d-m-Y", strtotime($DernRec['dateCrea']))  ?>
            </h5> 
            <p> 
<?php 
if (strlen($DernRec['chapo'])>200)
{
$pos=strrpos (substr($DernRec['chapo'],0,200)," ");
echo substr($DernRec['chapo'],0,$pos+1).'...'; 
}
else echo $DernRec['chapo'];
?>  
            </p> 
            <div class="mb-3">
                <button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch  mt-3  " type="submit" >
                    
                        <a href="recettedetails.php?idRecette=<?php echo $DernRec['idRecette'];?> "><h4>Voir plus</h4>
                        </a>
                    
                </button>
            </div> 
            <div class="shadow"  >
            </div>    
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
            </div>  
            <div class="shadow">
            </div>


            <div class="row mx-auto mt-3 mb-1 p-2"  style="background:#fff;">
                <div class="title"  style=' color:#9D0461;  margin-bottom:5px;'>
                    <h4>  Nous suivre sur les réseaux sociaux </h4>
                </div>
                <div class=" center-block text-center mx-auto" >
                    <a class="btn   btn-social btn-twitter btn-sm">
                        <span class="fa fa-twitter social"></span> 
                    </a>
                    <a class="btn   btn-social btn-facebook btn-sm">
                        <span class="fa fa-facebook social"></span> 
                    </a>
                    <a class="btn   btn-social btn-google-plus btn-sm">
                        <span class="fa fa-google-plus social"></span> 
                    </a>
                    <a class="btn   btn-social btn-youtube btn-sm">
                        <span class="fa fa-youtube social"></span> 
                    </a>
                </div>
            </div>  
            <div class="shadow">
            </div>
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
                <input type="text" class="form-control mb-3" placeholder="Recherche" aria-label="Recherche" name="RechercheGlobale" required >
                <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                    <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">Rechercher</button>
                </div>
            </form > 
        </div>
    </div>  
    <div class="shadow">
    </div>
    <div class="box col-12 mt-3 mb-3    ">
        <h2 style="color: #9D0461;">Les recettes du jour</h2> 
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
?>
        <div class="   pl-2 col-lg-3 col-md-6 col-sm-12   mb-5    text-center">
            <div class="box" >
                <a href="recettedetails.php?idRecette=<?php echo $DernRec[0] ?>">
                    <img src=" photos/recettes/<?php echo $DernRec[3]?>" alt="<?php echo $DernRec[1]?>" class=" mb-3 img-fluid img-thumbnail">
                </a>
            </div>
<?php 
//get categorie of the img
$CategorieDB=$mysqli->query("SELECT * FROM categories WHERE idCategorie=$DernRec[9];");
$cat=$CategorieDB->fetch_assoc();
// var_dump($cat);
?>
            <div class="box MyboxTitre" style="height:100px">
                <div class="box" >
                    <h6 style="color:rgb(194, 194, 194); text-align: center;"  > Catégorie: </h6>
                        <a href="<?php echo $cat['nom']?>.php?cat=<?php echo $cat['nom']?>">
                    <h6><?php echo $cat['nom']?>
                    </h6></a>
                </div>
                <div class="box" >
                    <h4 style="  text-align: center;"> 
                        <a href="recettedetails.php?idRecette=<?php echo $DernRec[0];?>" style="color: #9D0461;"><?php echo $DernRec[1];?>
                        </a>
                    </h4><br><br>
                </div>
            </div>
        <div class="box  ">
            <h6 style="color:rgb(194, 194, 194); text-align: center; "> Publiée le <?php echo date("d-m-Y", strtotime($DernRec[8])); ?>
            </h6>
        </div>
        <div class="box  MyboxText"  style="height:160px">
        <p>  
<?php  
if (strlen($DernRec[2])>200)
{
$pos=strrpos (substr($DernRec[2],0,200)," ");
echo substr($DernRec[2],0,$pos+1).'...'; 
}
else 
{
echo $DernRec[2];
}
$Membre=$mysqli->query("SELECT *FROM membres WHERE idMembre=$DernRec[6];");
$MembreDet=$Membre->fetch_assoc();?>
        </p> 
        </div>
        <div class="box" style="height:50px" >
            <button class="aclass btn btn-outline-success my-2 my-sm-0 butsearch   " type="submit" >
                    <a href="recettedetails.php?idRecette=<?php echo $DernRec[0];?>"><h4>Voir plus</h4>
                    </a>
            </button>
        </div>
        <hr>
        <div class="    col-12  pt-2  center-block text-center "  style="height:150px ">
            <div class="box" >
                <a href="membredetails.php?idMembre=<?php echo $DernRec[6];?> ">
                    <img src="photos/gravatars/<?php echo $MembreDet['gravatar'];?>" alt="<?php echo $MembreDet['gravatar'];?>" class="img-thumbnail img-fluid">
                </a>
            </div> 
            <div class="box mb-2" >
                <h6 style="color:rgb(194, 194, 194); text-align: center;"  > Proposée par 
                    <a href="membredetails.php?idMembre=<?php echo $DernRec[6];?>"><?php echo $MembreDet['prenom'];?>
                    </a>
                </h6>
            </div>    
        </div>   
        <hr>
    </div><!-- recette 1 --> 
<?php 
}
?>
<!-- newsletter -->
    <div class=" mb-3 pl-3 col-lg-3 col-md-6 col-sm-12  text-center thumbnail center well well-sm text-center">
        <div class="  pl-2 col-12 pb-3   center-block text-center  m  " style="background:#fff;" >
            <form method="post"  >
                <h4 style="color:#9D0461; text-align: center;"  > Vous avez une recette à partager?</h4> 
                <input type="button" id="goaddrecette" value="  par ici!" style="border-radius:1rem;width:70%" class="btn btn-outline-success my-2 my-sm-0 butsearch" />
            </form> 
        </div><!-- partage recette -->
        <div class="shadow">
        </div>
        <div id="newsletter" class="mt-2">
            <form method="post" action='welcome.php?go'>
                <div class="seal">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <div class="title">
                    <h4>  ABONNEZ-VOUS À NOTRE NEWSLETTER </h4>
                </div>
                Abonnez-vous à notre newsletter et recevez de nouvelles recettes dans votre
                boîte de réception.  
                <input type="text" placeholder="Nom" name= "nomNews" required />
                <input type="text" placeholder="Prénom"  name="prenomNew" required />
                <input type="text" placeholder="Email" name="EmailNews" required />
    <!--input type="submit" value="S'abonner" name ='SubmitNews' class="btn btn-outline-success my-2 my-sm-0 butsearch" /-->
                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitNews" >S'abonner</button>
            </form>
        </div>
        <div class="shadow">
        </div><!-- newsletter -->
    <!-- partage recette -->
    </div>
</div>


</div><!--.page-container-->
<script>
$('document').ready(function(){
$("#goaddrecette").click(function(){
window.location.href = 'ajouterRecette.php';
});
});


</script>
</body>
<?php
include ('sessionincludeFooter.php');
?>
</html>			



