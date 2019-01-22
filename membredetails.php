<!DOCTYPE html>
<?php
include ('sessioninclude.php');
?>


<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">

<?php
 include ('includemenu.php'); 
if (isset($_GET['idMembre'])) 
   { 
    
    $mysqli= new mysqli("localhost","root","","cooking");
    if (mysqli_connect_errno()) 
    {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }
    
    $stmt = $mysqli->prepare("SELECT * FROM membres where idMembre = ?");
    $idMembreGet=filter_input(INPUT_GET,"idMembre", FILTER_SANITIZE_NUMBER_INT);
    if ($idMembreGet) 
    {
        $stmt->bind_param('i', $idMembreGet);   
        $stmt->execute();    
        $Membreresult = $stmt->get_result();
        $MembreDet=$Membreresult->fetch_assoc();
       // var_dump($MembreDet);
        //echo  $Membreresult->num_rows.'<br>';
        if($Membreresult->num_rows==0)
        {
            //printf("Membre n'existe pas");
            echo'<script language="javascript">
            alert("Merci pour votre intéret mais vous n\'etes pas un membre, redirection à l\'acceuil") 
             window.location.href="index.php" 
             </script>';
            exit();
        }
        $stmtr = $mysqli->prepare("SELECT * FROM recettes where membre = ?");
        $stmtr->bind_param('i', $idMembreGet);   
        $stmtr->execute();    
        $Recetteresult = $stmtr->get_result();
        $RecetteDet=$Recetteresult->fetch_all();
        $countRecettes=$Recetteresult->num_rows;
    }   
    
    }

?>

<div class="title mt-5 mb-2">
        <h2 style="color:#9D0461; text-align: left;"   > Qui suis-je?  </h2>
</div> 

<div class="row mx-auto  mt-3 mb-5">
<!-- A propos du membre -->
    <div class="  col-lg-8 col-md-12 col-sm-12  text-center mx-auto  d-block  "style="border:1px dashed grey; " >
            
        <div class="row mx-auto " >
            <div class="col-lg-6 col-md-6 col-sm-6    "      >
                <a href="#"><img src="photos/gravatars/<?php echo $MembreDet['gravatar'];?>" alt="<?php echo $MembreDet['gravatar'];?>" class="mt-3 mb-3 img-thumbnail img-fluid"></a>
            </div>   
            <div class="col-lg-6 col-md-6 col-sm-6  mt-3  "  >
                <span><h6 style="color: #9D0461;; text-align: center;"  >Je m'appelle <?php echo $MembreDet['prenom'];?></h6></span>   
                <span><h6 style="color: #9D0461;; text-align: center;"  >Je suis un <?php echo $MembreDet['statut'];?> depuis le <?php echo date("d-m-Y", strtotime($MembreDet['dateCrea']));?> </h6></span>
                <span><h6 style="color: #9D0461;; text-align: center;"  >Nombre de recettes ajoutées : <?php echo $countRecettes;?> </h6></span>
            </div>
            </div> 
            <div class="row  max-auto mb-3 pl-3">
            <span><p style="color: #9D0461; "  >A propos de moi: </p></span><br><p  >
                <?php echo $MembreDet['About'];?> </p>
            </div>  
              
                     
                    
    </div> <!-- A propos du membre -->
<!-- me suivre --> 
    
<div class="col-lg-3 offset-lg-1 col-md-12 col-sm-12  mb-5 d-block   mt-2   "  style="background-color:#fff "    >
            <div class="title mt-3">
                    <h3 style="color: #9D0461;" class="  mx-auto"  > Me suivre sur les réseaux sociaux  </h3>
            </div>
            <div class="row mx-auto  mt-2 " >
                <p>&nbsp;</p>   
            
                <a href= "#" class="btn   btn-social btn-twitter btn-sm">
                        <span class="fa fa-twitter social"></span> </a>
                <a  href= "#"  class="btn   btn-social btn-facebook btn-sm">
                <span class="fa fa-facebook social"></span> </a>
            </div>          
    <!-- me suivre -->
    </div> 
       
</div>
<?php
if ($countRecettes>1) 
{  ?>
 <div class="title">
        <h3 style="color:#9D0461; text-align: left;"   >Mes dernières contributions  </h3>
</div>
 <!-- carrousel --> 
 <div class="box mx-auto mt-3 mb-5">  
 
  <div id="myCarousel" class="carousel slide  " data-ride="carousel">
       <!-- Indicators -->
   <ol class="carousel-indicators">
     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
     <li data-target="#myCarousel" data-slide-to="1"></li> 
     <?php  
     if ($countRecettes>2)
     {
         ?>
       <li data-target="#myCarousel" data-slide-to="2"></li> 
       <?php
       }
        ?>
      </ol>
      
       <!--Wrapper for slides--> 
   <div class="carousel-inner"> 
   <?php  
   if ($countRecettes>2)
   {
       $c=3;
   }
   else 
   {
       $c=2;//only 2 receipt for this user
   }

   for($i=0; $i<$c;$i++)
   { 
      if($i==0)
       $active="active"; //first carousel item
      else
       $active="";
       
       
            
       echo '
           <div class="carousel-item '. $active .  '">
           <a href="recettedetails.php?idRecette=' . $RecetteDet[$i][0].'"><img src=" ';
           //get image source from DB
       echo 'photos/recettes/'.$RecetteDet[$i][3] .'" alt="';
       echo $RecetteDet[$i][1];
       echo ' " class="img-thumbnail"></a>
               <div class="carousel-caption">
                 <h3><a href="';
                 //create site for receipt
       echo 'recettedetails.php?idRecette=' . $RecetteDet[$i][0];
       echo '"style="color: #9D0461;">';
       //get receipt title from DB
       echo $RecetteDet[$i][1];
       echo '</a></h3><br>
                 <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" ><h4>
                     <a href="';
   //  site for receipt
       echo 'recettedetails.php?idRecette=' . $RecetteDet[$i][0];
       echo '">Voir plus</a></h4></button>
               </div>
               </div> ';
   
   }
   echo '</div>
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
 ';
}
elseif ($countRecettes==0) 
  {
      echo '<div class="row">
      <div class="title my-3" >
        <h3 style="color:#9D0461; text-align: left;"   >Aucune recette à montrer pour ce membre.. Des fruits ou légumes ? ;)</h3>
        </div>
      <img src="photos/fruits-legumes/legumes-fruits.jpg" class="   img-thumbnail img-fluid">
       
         
        </div>';}
    else  //$countRecettes=1
    {
        echo '<div class="title">
                <h3 style="color:#9D0461; text-align: left;"   >Ma dernière contribution  </h3>
        </div>
         <!-- carrousel -->';
         echo '<div class="box mx-auto mt-3 mb-5"> ';
         
         echo '<div id="myCarousel" class="carousel slide  " data-ride="carousel">
               <!-- Indicators -->
           <ol class="carousel-indicators">
             <li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
             echo '</ol> ';
         echo '<div class="carousel-inner">';
          
       $j=0; 
  
             echo '
                 <div class="carousel-item active ">
                 <a href="recettedetails.php?idRecette=' . $RecetteDet[$j][0].'"><img src=" ';
                 //get image source from DB
             echo 'photos/recettes/'.$RecetteDet[$j][3] .'" alt="';
             echo $RecetteDet[$j][1];
             echo ' " class="img-thumbnail"></a>
                     <div class="carousel-caption">
                       <h3><a href="';
                       //create site for receipt
             echo 'recettedetails.php?idRecette=' . $RecetteDet[$j][0];
             echo '"style="color: #9D0461;">';
             //get receipt title from DB
             echo $RecetteDet[$j][1];
             echo '</a></h3><br>
                       <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" ><h4>
                           <a href="';
         //  site for receipt
             echo 'recettedetails.php?idRecette=' . $RecetteDet[$j][0];
             echo '">Voir plus</a></h4></button>
                     </div>
                     </div> ';
         
         
         echo '</div>
         
       </div>
       </div><!-- carrousel -->
       ';
      }



if ($countRecettes>1) 
{//"rechercheLocale.php?go&idRecherche=RechercheLoc&idMembre='.$idMembreGet.'"
    echo '<div class="box mx-auto my-3 p-2" style="background:#fff; border:1px dashed grey; " > 
    <div class="row  mx-auto"  style=" color:#9D0461;  margin-bottom:5px;">
        <h4 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes   </h4>
    </div>
    <p> </p>

    <div class=" row center-block  mx-auto form-group  has-search" style="max-width:50%!important">
         
       <form method="post" action="rechercheGlobale.php?go&idRecherche=RechercheGlob" >  
            
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control"style="border-radius:1rem;" placeholder="Recherche" aria-label="Recherche" name="RechercheGlobale" required="true">
           
             
                <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">Rechercher</button>
    
                </div>
        </form > 
         
    </div>
</div>';
}
/*<a href="rechercheLocale.php?go&idRecherche=RechercheLoc&idMembre='.$idMembreGet.'"><button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">dans mes recettes</button></a>
                <a href="rechercheGlobale.php?go&idRecherche=RechercheGlob"><button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">dans les recettes</button></a>
                */
else 
{
    echo '<div class="box mx-auto my-3 p-2" style="background:#fff; border:1px dotted grey; " > 
    <div class="row  mx-auto"  style=" color:#9D0461;  margin-bottom:5px;">
        <h4 style="color:#9D0461; text-align: left;"   >Rechercher dans les recettes </h4>
    </div>
    <p> </p>

    <div class=" row center-block  mx-auto form-group  has-search" style="max-width:50%!important">
         
       <form method="post" action="rechercheGlobale.php?go&idRecherche=RechercheGlob" > <!--rechercheGlobale.php?go&idRecherche=RechercheGlob-->
            
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" placeholder="Recherche" style="border-radius:1rem;"aria-label="Recherche" name="RechercheGlobale" required="true">
           
             
                <div class="  col-lg-6    col-md-4    col-sm-4   form-group has-search   "   >
                <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale">Rechercher</button>
    
                </div>
        </form > 
         
    </div>
</div>
';
}

if($countRecettes>1)
{    
     echo '<div class="title">
        <h3 style="color:#9D0461; text-align: left;"   >Portofilio  </h3>
            </div>
    <div class="row mx-auto   mt-3 p-2 mb-5"  > ';
 
    echo '<div class="col-md-8 col-sm-12 col-lg-8 mx-auto     mt-3 p-2 mb-5"  > ';
    for($countRecMembre=0;$countRecMembre<$countRecettes;$countRecMembre++)
    { 
        if(((($countRecMembre%3 )==0)   && ($countRecMembre>3)) || ($countRecMembre==0))
        {
            echo '<div class="row mx-auto" > ';
            
        for($Newrow=0;$Newrow<2;$Newrow++)
        {
        
            echo '<div class="col-3     ">';
            echo '<a href="recettedetails.php?idRecette='.$RecetteDet[$countRecMembre][0].'"><img src="photos/recettes/'.$RecetteDet[$countRecMembre][3].'" alt="'.$RecetteDet[$countRecMembre][0].'" class="   img-thumbnail img-fluid"></a>';
            echo '</div>';
            $countRecMembre++;
            
            
        }
        echo '</div>';
        }

        if ($countRecMembre>9)
        $countRecMembre=$countRecettes;

    }
    echo '</div><hr>';
    }
    elseif ($countRecettes==1)  
        { echo '<div class="title">
                 <h3 style="color:#9D0461; text-align: left;"   >Portofilio  </h3>
                </div>

                <div class="row mx-auto   mt-3 p-2 mb-5"  > ';
            echo '<div class="col-md-8 col-sm-12 mx-auto  col-lg-8   mt-3 p-2 mb-5"  > ';
            echo '<div class="col-3     ">';
            echo '<a href="recettedetails.php?idRecette='.$RecetteDet[0][0].'"><img src="photos/recettes/'.$RecetteDet[0][3].'" alt="'.$RecetteDet[0][0].'" class="   img-thumbnail img-fluid"></a>';
            echo '</div>';
            echo '</div><hr>';
            
        }
    else
        { echo '<hr class="mt-2 mb-5">';
            if(isset($_SESSION))
            {
              if (isset($_SESSION['Username']))
                {
                   echo ' <div class="row mx-auto   mt-5 p-2 mb-5"  >';
                }
            }
        
        }
 

        
if(isset($_SESSION))
 {
   if (!isset($_SESSION['Username']))
     {      
        echo' <!--se connecter-->
        <div class="row mx-auto   mt-5 p-2 mb-5"  > 
  <div class="col-sm-12 col-md-5  col-lg-4  text-center';
   if ($countRecettes>=1)  echo 'offset-lg-1';
   echo '  mt-3 p-2 mb-5" >
            <div class="login-form" >
                <form action="" method="post">
                    <div class="title">
                        <h4 style="color:#9D0461; text-align: left;"   >Connexion  </h4>
                </div>      
                    <div class="form-group">
                        <input type="text" class="form-control"style="border-radius:1rem;width:60%" name="Username" placeholder="login" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"style="border-radius:1rem;width:60%" name="Password" placeholder="mdp" required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success my-2 my-sm-0 butsearch" name="Seconnecter">Se connecter</button>
                    </div>
                    <div class="clearfix custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                        <label class="custom-control-label" for="defaultUnchecked" name="Sesouvenir">Se souvenir de moi</label>
                        <a href="#" data-target="#pwdModal3" data-toggle="modal" class="pull-right">Mdp oublié?</a>
                        </div>
                    </form>
                <p></p>
                <p class="text-center"><a href="inscription.php">Créer un compte</a></p>
            </div>
    </div>   <!--se connecter-->';
    }
}
else{
    echo' <!--se connecter-->
    <div class="row mx-auto   mt-5 p-2 mb-5"  > 
<div class="col-sm-12 col-md-5  col-lg-4  text-center';
if ($countRecettes>=1)  echo 'offset-lg-1';
echo '  mt-3 p-2 mb-5" >
        <div class="login-form" >
            <form action="" method="post">
                <div class="title">
                    <h4 style="color:#9D0461; text-align: left;"   >Connexion  </h4>
            </div>      
                <div class="form-group">
                    <input type="text" class="form-control"style="border-radius:1rem;width:60%" name="Username" placeholder="login" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"style="border-radius:1rem;width:60%" name="Password" placeholder="mdp" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0 butsearch" name="Seconnecter">Se connecter</button>
                </div>
                <div class="clearfix custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                    <label class="custom-control-label" for="defaultUnchecked" name="Sesouvenir">Se souvenir de moi</label>
                    <a href="#" data-target="#pwdModal3" data-toggle="modal" class="pull-right">Mdp oublié?</a>
                </div>
                </form>
            <p></p>
            <p class="text-center"><a href="inscription.php">Créer un compte</a></p>
        </div>
</div>   <!--se connecter-->';
}    

    ?>
    <div class="col-sm-12 col-lg-6   col-md-6 offset-md-1  text-center mt-5 ">
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
                    <input type="text" placeholder="Nom"style="border-radius:1rem;width:60%" name= "nomNews"required="true"/>
                    </label>
                    <input type="text" placeholder="Prénom"style="border-radius:1rem;;width:60%" name="prenomNew"required="true"/>
                    </label>
                    <input type="text" placeholder="Email"style="border-radius:1rem;;width:90%" name="EmailNews"required="true"/>
                    <button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitNews">S'abonner</button>
            </form>
        </div>
        <div class="shadow"></div><!-- newsletter -->
    </div>
</div>     


</div > <!--container -->
<!--modal-->
<div id="pwdModal3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header  ">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <!--h3 class="text-center">Reinitialiser votre mdp</h3-->
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          
                          <p>Merci de renseigner votre adresse mail</p>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="emailmdp" type="email">
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block butsearch py-2" value="Reinitialiser" type="submit" name="validermdp">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div> 
</body>


<?php

include ('sessionincludeFooter.php');
 require('connect.inc.php');
 require('requestpassModal.php'); 

 ?>
</html>	
