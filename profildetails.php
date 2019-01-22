<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
/*error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");*/
?>


<body>

<div class="container page-container mt-3 "   >

<?php
 include ('includemenu.php'); 
if ((isset($_GET['idMembre']) || isset($_SESSION['idMembre'])) && isset($_SESSION['Connected']))
{
    $stmt = $mysqli->prepare("SELECT * FROM membres WHERE idMembre = ?");
    if (isset($_GET['idMembre']))
    {
        $idMembreGet=filter_input(INPUT_GET,"idMembre", FILTER_SANITIZE_NUMBER_INT);
        if($idMembreGet != $_SESSION['idMembre'])
        {
            echo'<script language="javascript">
             alert("Vous n\'avez pas le droit d\'accéder à cette page, redirection à l\'acceuil. \n Ce n\'est pas votre profil") 
             window.location.href="index.php" 
             </script>';
            exit();
        }
    }
    else
    {
        $idMembreGet = $_SESSION['idMembre'];
    }
    if ($idMembreGet) 
    {
        $stmt->bind_param('i', $idMembreGet);   
        $stmt->execute();    
        $Membreresult = $stmt->get_result();
        $MembreDet = $Membreresult->fetch_assoc();
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
        else
        {
            $stmtr = $mysqli->prepare("SELECT * FROM recettes WHERE membre = ?");
            $stmtr->bind_param('i', $idMembreGet);   
            $stmtr->execute();    
            $Recetteresult = $stmtr->get_result();
            $RecetteDet=$Recetteresult->fetch_all();
            $countRecettes=$Recetteresult->num_rows;
            ?>
            <div class="title mt-5 mb-2">
                <h2 style="color:#9D0461; text-align: left;"   > Mes données personnelles  </h2>
            </div> <hr>
            <!--       membre -->
            <div class="row mx-auto  mt-3 mb-5">
                <div class="col-md-3 ">
                    <div class="row">
                        <div class="col-sm-11 mt-3 mb-3">
                            <h1><?php echo $MembreDet['login']?></h1>
                        </div> <hr>
                        
                    </div>
                    <div class="row my-3 ">
                        <div class="col-sm-11"><!--left col http://ssl.gstatic.com/accounts/ui/avatar_2x.png-->
                            <div class="text-center">
                                <img src="photos/gravatars/<?php echo $MembreDet['gravatar']?>" class="avatar img-circle img-thumbnail" alt="avatar">   
                                <br><br><!--h6> Telecharger une nouvelle photo...</h6-->
                                <form method="post"  enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="fileupload"> <h6>Telecharger une nouvelle photo...</h6></label> 
                                    <input type="file" name="fileupload" value="fileupload" id="fileupload">
                                    <!--input type="file" class="text-center center-block file-upload"--><br><br>
                                    <!--input type="submit" class="btn btn-outline-success my-2 py-2 my-sm-0 butsearch mb-4" name ="submitNewImage" value="Changer l'image"--> 
                                    <button name="submitNewImage" type="submit" class="btn btn-primary butsearch">Changer l'image</button> 
                                    </div>
                                        <div class="form-group row">
                                    <button name="submitRecetteprof" type="submit" class="btn btn-primary butsearch"  ><a class="noUnderline" href="ajouterRecette.php">Ajouter une recette</a></button> 
                                    </div>
                                        <div class="form-group row">
                                            <button name="printdata" type="submit" class="btn btn-primary butsearch"><a class="noUnderline" href="exportpage.php?idMembre=<?php echo $idMembreGet;?>">Exporter mes données</a></button> 
                                            </div>
                                        <div class="form-group row">
                                    <button name="supprimerCompte" type="submit" class="btn btn-primary butsearch" data-target="#deleteMonCompteModal" data-toggle="modal" id="supprimerComptes"> 
                                        <i class="fa fa-trash" aria-hidden="true"></i> mon compte</button>
                                        </div>
                                </form>
                            </div> <br>
                        </div>
                    </div>

                </div>

                <div class="col-md-9  ">
		            <div class="card mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Mon profile</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post">
                                    <div class="form-group row">
                                        <label for="pseudo" class="col-4 col-form-label">Login</label> 
                                        <div class="col-8">
                                        <input id="pseudo" name="pseudo" value="<?php echo $MembreDet['login']?>" class="form-control here" required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-4 col-form-label">Prenom</label> 
                                        <div class="col-8">
                                        <input id="name" name="name" value="<?php echo $MembreDet['prenom']?>" class="form-control here" type="text" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-4 col-form-label">nom</label> 
                                        <div class="col-8">
                                        <input id="lastname" name="lastname" value="<?php echo $MembreDet['nom']?>" class="form-control here" type="text" required="required">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email</label> 
                                        <div class="col-8">
                                        <input id="email" name="email" value="<?php echo $MembreDet['email']?>" class="form-control here"   type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="facebook" class="col-4 col-form-label">facebook</label> 
                                        <div class="col-8">
                                        <input id="facebook" name="facebook" 
                                        <?php 
                                        if($MembreDet['facebook'] == NULL || (strlen(trim($MembreDet['facebook'])) == 0) )
                                        {?>
                                        placeholder="facebook" 
                                        <?php
                                        }
                                        else
                                        {?>
                                        value="<?php echo $MembreDet['facebook']?>"
                                        <?php
                                        }
                                        ?>
                                        class="form-control here" type="url">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="instagram" class="col-4 col-form-label">instagram</label> 
                                        <div class="col-8">
                                        <input id="instagram" name="instagram" 
                                        <?php 
                                        if($MembreDet['instagram'] == NULL || (strlen(trim($MembreDet['instagram'])) == 0))
                                        {?>
                                        placeholder="instagram" 
                                        <?php
                                        }
                                        else
                                        {?>
                                        value="<?php echo $MembreDet['instagram']?>"
                                        <?php
                                        }
                                        ?>
                                         class="form-control here" type="url">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="twitter" class="col-4 col-form-label">twitter</label> 
                                        <div class="col-8">
                                        <input id="twitter" name="twitter" 
                                        <?php 
                                        if($MembreDet['twitter'] == NULL || (strlen(trim($MembreDet['twitter'])) == 0))
                                        {?>
                                        placeholder="twitter" 
                                        <?php
                                        }
                                        else
                                        {?>
                                        value="<?php echo $MembreDet['twitter']?>"
                                        <?php
                                        }
                                        ?>
                                         class="form-control here" type="url">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="youtube" class="col-4 col-form-label">youtube</label> 
                                        <div class="col-8">
                                        <input id="youtube" name="youtube" 
                                        <?php 
                                        if($MembreDet['youtube'] == NULL || (strlen(trim($MembreDet['youtube'])) == 0))
                                        {?>
                                        placeholder="youtube" 
                                        <?php
                                        }
                                        else
                                        {?>
                                        value="<?php echo $MembreDet['youtube']?>"
                                        <?php
                                        }
                                        ?>
                                         class="form-control here" type="url">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-4 col-form-label">Description</label> 
                                        <div class="col-8">
                                        <textarea id="description" name="description" cols="40" rows="4" class="form-control" ><?php echo $MembreDet['About']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="AncienMdp" class="col-4 col-form-label">Ancien Mdp*</label> 
                                        <div class="col-8">
                                        <input id="AncienMdp" name="AncienMdp" placeholder="Ancien Mdp" class="form-control here" type="password" >
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="NouveauMdp" class="col-4 col-form-label">Nouveau Mdp</label> 
                                        <div class="col-8">
                                        <input id="NouveauMdp" name="NouveauMdp" placeholder="Nouveau Mdp" class="form-control here" type="password">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                        <button name="submitChanges" type="submit" class="mb-2 btn btn-primary butsearch"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> mon Profile</button>
                                        <button name="resetChanges" id= "resetChanges" type="submit" class="mb-2 btn btn-primary butsearch"> Reset</button>
                                        <!--button name="MdpChange" type="submit" class="btn btn-primary butsearch"><a href="requestpass">Forgot password</a></button-->
                                        <button type="button" class="mb-2 btn btn-primary butsearch"   >
                                        <a href="#" data-target="#pwdModal" data-toggle="modal">Forgot my password</a>
                                        </button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><hr>
            <!--       membre -->
             <?php
            if($countRecettes>1)
            {    
            ?>
            <div class="title my-5">
                <h3 style="color:#9D0461; text-align: left;"   > Mes recettes  </h3><hr>
            </div>
            <div class="row mx-auto   mt-3 p-2 mb-5"  > 
                <?php   
                for($countRecMembre = 0 ; $countRecMembre < $countRecettes ; $countRecMembre++)
                {
                    ?>
                        <div class="col-lg-4  col-md-6 col-sm-12 mb-5"> 
                            <a href="recettedetailsmembre.php?idRecette=<?php echo $RecetteDet[$countRecMembre][0]?>&idMembre=<?php echo $idMembreGet?>&edit=ok">
                            <img src="photos/recettes/<?php echo $RecetteDet[$countRecMembre][3]?>" alt="<?php echo $RecetteDet[$countRecMembre][0]?>" class="   img-thumbnail img-fluid"></a> 
                        </div> 
                    <?php   
                    }
                    //if ($countRecMembre>9)
                    //$countRecMembre=$countRecettes;
                    ?> </div><hr> 
            </div>
            <?php
            }    
            elseif ($countRecettes==1)  
            { 
            ?>
            <div class="title">
                <h3 style="color:#9D0461; text-align: left;"   > Ma recette   </h3>
            </div>

            <div class="row mx-auto   mt-3 p-2 mb-5"  >  
                <div class="col-md-12 col-sm-12 mx-auto  col-lg-12   mt-3 p-2 mb-5"  >  
                    <div class="col-lg-3  col-md-6 col-sm-12   "> 
                        <a href="recettedetailsmembre.php?idRecette=<?php echo $RecetteDet[0][0]?>&idMembre=<?php echo $idMembreGet?>&edit=ok"><img src="photos/recettes/<?php echo $RecetteDet[0][3]?>" alt="<?php echo $RecetteDet[0][0]?>" class="   img-thumbnail img-fluid"></a> 
                    </div> 
                </div><hr> 
             
            <?php      
            }
            else
            { ?>
            <hr class="mt-2 mb-5"> 
            <?php   
                /*if(isset($_SESSION))
                {
                    if (isset($_SESSION['Username']))
                    {
                        ?> 
                        <div class="row mx-auto   mt-5 p-2 mb-5"  > 
                        <?php   
                    }
                }*/

            }
        }
    }   
}
else
{
    echo'<script language="javascript">
    alert("Vous n\'avez pas le droit d\'accéder à cette page, redirection à l\'acceuil") 
     window.location.href="index.php" 
     </script>';
    exit();
}

?>

</div> <!--container --> 
 <!--modal-->
<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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

<!--modal-->
<div id="deleteMonCompteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <p>Vous etes sur le point de supprimer votre compte definitivement</p>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group row">
                                        <label for="mdpsupp" class="col-4 col-form-label"> Mdp*</label> 
                                        <div class="col-8">
                                        <input id="mdpsupp" name="mdpsupp" placeholder="votre Mdp" class="form-control here" type="password" >
                                        </div>
                                    </div> 
                                    <input class="btn btn-lg btn-primary btn-block butsearch py-2" value="supprimer mon compte" type="submit" name="validerSuppCompte">
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
<?php

if(isset($_POST['validerSuppCompte']) && (!empty($_POST['mdpsupp'])))
{
    $mdpsupp = filter_input(INPUT_POST,'mdpsupp',FILTER_SANITIZE_STRING);
    $stmtdeluser = $mysqli->query("SELECT * FROM membres WHERE idMembre = '$idMembreGet'");
    $stmtdeluser = $stmtdeluser->fetch_assoc();
    //var_dump($stmtdeluser);
    //var_dump($mdpsupp);
    if($mdpsupp && password_verify($mdpsupp, $stmtdeluser['password']))
    {
        //$idtoDel = $RecetteDet['idRecette'];
        $deletestmtimg = $mysqli->query("SELECT * FROM recettes WHERE  membre = '$idMembreGet' ");
        
        $deleteuserimg = $mysqli->query("SELECT * FROM membres WHERE  idMembre = '$idMembreGet'");
        $deleteuserimg = $deleteuserimg->fetch_assoc();
        $imgsrcgr = 'photos/gravatars/' . $deleteuserimg['gravatar'];
        
        $deletestmt = $mysqli->query("DELETE FROM recettes WHERE  membre = '$idMembreGet' ");
        $deleteuser = $mysqli->query("DELETE FROM membres WHERE  idMembre = '$idMembreGet' ");
        if($deleteuser)
        {
            while($deletestmtimg->fetch_assoc())
            {
                $imgsrc = 'photos/recettes/' . $deletestmtimg['img'];
                unlink($imgsrc);
            }
            unlink($imgsrcgr);
            //var_dump($deleteuser);
            ?>
            <div class="modal" id="myModalSuccessfulDeleteuser">
                <div class="modal-dialog">
                    <div class="modal-content">
        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Opération réussite</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

        <!-- Modal body -->
                        <div class="modal-body">
                            Le compte et recettes ont été supprimés avec succès.
                        </div>

        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="backtoindex">Revenir à l'acceuil </button>
                        </div>

                    </div>
                </div>
            </div>
        <script type="text/javascript"> 
        $(document).ready(function(){
             $('#myModalSuccessfulDeleteuser').modal('show'); 
            });
        </script>
            <?php
            session_destroy(); 
        }
        else
        {
            ?>
            <script type="text/javascript">
             $(document).ready(function(){
             $('#deleteMonCompteModal').modal('show'); 
            });
            </script>
            <?php
        }
    }//error mdp
    else
    {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
          $('#modalunsuccessfulpro').modal('show'); 
         });
        </script>
        <?php
    }
}
elseif(empty($_POST['mdpsupp']) && isset($_POST['validerSuppCompte']))
{
    ?>
    <script type="text/javascript">
      $(document).ready(function(){
      $('#modalnopasspro').modal('show'); 
     });
    </script>
    <?php  
}

?>
<div class="modal" tabindex="-1" role="dialog" id = "modalnopasspro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Password is empty </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" class="passerrorrdel">Retry</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id = "modalunsuccessfulpro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Password incorrect </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" class="passerrorrdel">Retry</button>
      </div>
    </div>
  </div>
</div>
</body>


<script>
    $('input').on('change',function(){
    let id = $(this).attr('id');
    //alert("input field is modified : ID = " + id);
    });
</script>
<?php 
if(isset($_POST['supprimerCompte']))
  {
      ?>
<script type="text/javascript">
$(document).ready(function(){
    $('#deleteMonCompteModal').modal('show');
});
</script>
<?php
  }
  ?>


<script>
    $(document).ready(function(){
    $('#backtoindex').click(function(){
    window.location.href="index.php";
});});
</script>

  <?php 
  if(isset($_POST['resetChanges']))
  {
      ?>
 <script type="text/javascript">
    $(document).ready(function(){
        $("#resetChanges").click(function(){
            location.reload(true);
            console.log('reset');
        });
    });
</script>
<?php
  }
  ?>

<?php

require('profilechange.php');
require('changeGravatar.php');
require('requestpassModal.php');
include ('sessionincludeFooter.php');

 ?>
</html>	
