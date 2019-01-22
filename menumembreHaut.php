<header role="banner">
 
 
 <!-- menu fixed-top-->
     <div class="row main-navigation  p-1"style="background-color: #f9def6!important">
         <div class="col-md-8 col-lg-8 col-sm-8 p-1">
 
             <nav class="nav nav-pills  pull-left ">
                 <a class="nav-item nav-link  "   href="index.php"><i class="fa fa-home" aria-hidden="true"></i> </a>
                 <!--a class="nav-item nav-link  "  href="contact.php">Contact</a-->
                 <a class="nav-item nav-link  "  href="profildetails.php">Mon Profil</a>
                <?php
                if(isset($_SESSION['isAdmin']) && isset($_SESSION['idAdmin']) && $_SESSION['statutmembre'] == "admin")
                {
                    ?>
                    <a class="nav-item nav-link  "  href="gestionMembres.php">Membres</a>
                    <a class="nav-item nav-link  "  href="gestionRecettes.php">Recettes</a>
                    <?php
                }   
                else
                {
                ?>
                 <a class="nav-item nav-link  "  href="ajouterRecette.php">Ajouter une recette</a>
                <?php
                }
                ?>
                 <a class="nav-item nav-link   "  href="deconnexion.php">Déconnexion</a></nav>
         </div > 
         <div class="col-sm-4 col-md-4 col-lg-4  ">
             <form class="form-inline  my-lg-0"method="post" action="RechercheMenu.php?go">
             <input class="form-control mr-sm-2" type="search" placeholder="Recherche" name="RechercheGlobale" aria-label="Search"style="border-radius:1rem;color: #d775d8!important;max-width:60%!important">
             <button type="submit"style="border-radius:1rem; background-color=#d775d8!important; " class="btn btn-outline-success my-2 my-sm-0 butsearch"><i class="fa fa-search"></i></button>
             <!--button class="btn btn-outline-success my-2 my-sm-0 butsearch" type="submit" name="SubmitGlobale" >Rechercher</button-->
 
             </form>
         </div >  
             
  
         </div>
     </div><!--.main-navigation-->
         
   </header>