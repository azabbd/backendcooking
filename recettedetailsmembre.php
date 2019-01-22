<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
<body>

<div class="container page-container mt-3 "  >

<?php
include ('includemenu.php');
$idRecetteGet = filter_input(INPUT_GET,"idRecette", FILTER_SANITIZE_NUMBER_INT);
$idMembreGet = filter_input(INPUT_GET,"idMembre", FILTER_SANITIZE_NUMBER_INT);    
$idedit = filter_input(INPUT_GET,"edit", FILTER_SANITIZE_STRING);  

if ($idRecetteGet && $idMembreGet && $idedit) //valid  
{
    if($idedit == 'ok')
    {
        $_SESSION['edit'] = 'ok';
        
        
    
//  prepared query.
        $stmt = $mysqli->prepare("SELECT * FROM recettes where idRecette = ? ORDER BY titre");
        // sanitize input
        // Execute the prepared query.
        $stmt->bind_param('i', $idRecetteGet);  // Bind "$idRecetteGet" to ?.
        $_SESSION['idRecetteConsultee']=$idRecetteGet;
        $stmt->execute();    
        $Recetteresult = $stmt->get_result();
        $RecetteDet=$Recetteresult->fetch_assoc();
        if ($Recetteresult->num_rows==0)
        {
            
            echo 'Aucun article trouvé.'; 
            //include('footer.php');
            ?>
            <!--a href="index.php?">Retour à l\'accueil</a--> 
            </html>
            <?php	
            echo'<script language="javascript">
                alert("Aucune recette qui correspond dans la BDD, \n redirection vers la page precedente") 
                window.history.go(-1);
                </script>';   
            // echo 'Aucune recette qui correspond dans la BDD ';
            exit();
        }
        else
        {
            if ($RecetteDet['membre'] != $idMembreGet)
            {
                ?>
                </html>
                <?php
                echo'<script language="javascript">
                $("document").ready(function(){
                alert("vous n\etes pas l\'auteur de cette recette, \n redirection vers la page precedente") 
                window.history.go(-1); });
                </script>';   
            // echo 'Aucune recette qui correspond dans la BDD ';
            exit();
            }
            else //sa rectte et peut editer
            {
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
        }
    }
}
else
{
    ?>
    </html>
    
     <script language="javascript">
         $('document').ready(function(){
    alert("unauthorised access, \n redirection vers la page precedente") 
    window.history.go(-1);});
    </script> 
    <?php
    exit();
}
  

?>
    <div class=" row  mt-3 ">
        <div class= "col-6 title ">
        <h2 style="color:#9D0461; text-align: left;"  > <?php echo $RecetteDet['titre'];?> 
        </h2>
        </div>
        <div class= "col-3">
            <form method ="post" action="modifierrecette.php?idRecette=<?php echo $RecetteDet['idRecette'];?>">  
                <button name="modifyrecette" type="submit" class="btn btn-primary butsearch">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier Recette</button>
        </div>
        <div class= "col-3">
            </form>
            <button name="supprimerrecette" type="submit" class="btn btn-primary butsearch" data-target="#deleteRecetteModal" data-toggle="modal"> 
                    <i class="fa fa-trash" aria-hidden="true"></i>Supprimer Recette</button> 
        </div>
    </div>
        
    <div class="row    mx-auto" >
        <!-- A propos de la recette -->
        <div class="  col-lg-12 col-md-12 col-sm-12       text-center " > 
        <hr>
            <img src="photos/recettes/<?php echo $RecetteDet['img'];?> " 
            alt="<?php echo $RecetteDet['titre'];?>" class=" mb-3 img-fluid img-thumbnail"> 
            <span><p>  <?php echo $RecetteDet['chapo'];?></p></span>
        </div> <!-- A propos de la recette -->  
    </div>
 

    <div class="row mx-auto  mb-2">
<!-- recette  detaillée -->
        <div class="    col-lg-12 col-md-12 col-sm-12 center-block d-block text-center">
            <!-- tete  -->  
            <hr>
            <div class="row mb-2 mx-auto   ">
                
                <div class="  title  mb-3  "style="text-align:left">
                    <h4 style="color: #4e049d;"> <?php echo $RecetteDet['titre'];?> </h4>
                    <p style="color:rgb(194, 194, 194); text-align: left; "> 
                    Ajoutée le <?php echo date("d-m-Y", strtotime($RecetteDet['dateCrea']));?>
                     | Catégorie <a href="<?php echo $cat['nom'];?>.php?cat=<?php echo $cat['nom'];?>"> 
                    <?php echo $cat['nom'];?>  </a></p> 
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
                                    <td class=" "> <?php echo $RecetteDet['tempsPreparation']; ?> </td>
                                    <td class=" "> <?php echo $RecetteDet['tempsCuisson'];?> </td>
                                    <td class=" "> <?php echo $RecetteDet['difficulte'];?> </td>
                                    <td class=" "> <?php echo $RecetteDet['prix'];?> </i></td>
                                    
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
        </div>

</div > <!--container --> 
<!--modal-->
<div id="deleteRecetteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <p>Vous etes sur le point de supprimer cette recette definitivement</p>
                            <div class="panel-body">
                                <form method="post">
                                <div class="form-group row">
                                        <label for="mdpsupprec" class="col-4 col-form-label"> Mdp*</label> 
                                        <div class="col-8">
                                        <input id="mdpsupprec" name="mdpsupprec" placeholder="votre Mdp" class="form-control here" type="password" >
                                        </div>
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block butsearch py-2" value="supprimer la recette" type="submit" name="validerSuppRecette">
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

if(isset($_POST['validerSuppRecette']) && (!empty($_POST['mdpsupprec'])))
{
    $mdpsupp = filter_input(INPUT_POST,'mdpsupprec',FILTER_SANITIZE_STRING);
    $idmmbrrec = $RecetteDet["membre"];
    $stmtdeluser = $mysqli->query("SELECT * FROM membres WHERE idMembre = '$idmmbrrec'");
    $stmtdeluser = $stmtdeluser->fetch_assoc();
    //var_dump($stmtdeluser);
    //var_dump($mdpsupp);
    if($mdpsupp && password_verify($mdpsupp, $stmtdeluser['password']))
    {
        $idtoDel = $RecetteDet['idRecette'];
        $imgsrc = 'photos/recettes/' . $RecetteDet['img'];
           
        $deletestmt = $mysqli->query("DELETE FROM recettes WHERE idRecette = '$idtoDel' AND membre = '$idMembreGet' ");
        if($deletestmt)
        {
            unlink($imgsrc);
            var_dump($deletestmt);
            ?>
            <div class="modal" id="myModalSuccessfulDelete">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Opération réussite</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        La recette a été supprimée avec succès.
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="backprof">Revenir au profile </button>
                    </div>

                    </div>
                </div>
            </div>
    <script type="text/javascript">
        
            $('#myModalSuccessfulDelete').modal('show');
            
    </script>
            <?php
        }
    }//error mdp
    else
    {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
          $('#modalunsuccessful').modal('show'); 
         });
        </script>
        <?php
    }
}
elseif(isset($_POST['validerSuppRecette']) && (empty($_POST['mdpsupprec'])))
{
    ?>
    <script type="text/javascript">
      $(document).ready(function(){
      $('#modalnopass').modal('show'); 
     });
    </script>
    <?php  
}

?>

<div class="modal" tabindex="-1" role="dialog" id = "modalunsuccessful">
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

<div class="modal" tabindex="-1" role="dialog" id = "modalnopass">
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
<?php
include ('sessionincludeFooter.php');
  ?>
  <script>
      $('document').ready(function(){
        $('#backprof').click(function(){
        window.location.href="profildetails.php";
        });});
        

    </script>
</html>	




