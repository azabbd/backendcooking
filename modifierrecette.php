<!DOCTYPE html>
<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>
 
  
<body>

<div class="container page-container mt-3 "  >

<?php
include ('includemenu.php');
//if(!isset[$_POST['submitRecetteprof'])
//{
    $idrecsess = $_SESSION['idRecetteConsultee'];
    $idRecetteGet = filter_input(INPUT_GET,"idRecette", FILTER_SANITIZE_NUMBER_INT);
    
if ($idRecetteGet && $idrecsess == $idRecetteGet)
{
    $stmt = $mysqli->prepare("SELECT * FROM recettes where idRecette = ?  ");
    $stmt->bind_param('i', $idrecsess);
    $stmt->execute();    
    $Recetteresult = $stmt->get_result();
    $RecetteDet=$Recetteresult->fetch_assoc();
 }
else
{
    ?>
</div>

    
     <script language="javascript">
    alert("unauthorised access, \n redirection vers la page precedente") 
    window.history.go(-1);" 
    </script> 
    </body>
</html>
    <?php
    exit();
}
//}
?>
<div class="row my-2 ">
    <div class="col-md-12">
        <h4>Ma recette</h4>
        <hr>
    </div>
</div>
<div class="row my-5 ">
    <div class="col-lg-4 col-md-12"><!--left col http://ssl.gstatic.com/accounts/ui/avatar_2x.png-->
        <div class="text-center">
            <img src="photos/recettes/<?php echo $RecetteDet['img']?>" class="avatar img-circle img-thumbnail" alt="avatar">   
            <br><br><!--h6> Telecharger une nouvelle photo...</h6-->
             
                 
        </div> <br>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="titre" class="col-4 col-form-label">titre</label> 
                                <div class="col-8">
                                <input id="titre" name="titre" value="<?php echo $RecetteDet['titre']?>" class="form-control here"   type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileupload" class="col-4 col-form-label">Photo</label> 
                                <div class="col-4 offset-2">
                                <input type="file" name="fileupload" value="fileupload" id="fileupload">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chapo" class="col-4 col-form-label">chapo</label> 
                                <div class="col-8">
                                <textarea id="chapo" name="chapo" cols="40" rows="4" class="form-control" ><?php echo $RecetteDet['chapo']?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="couleur" class="col-4 col-form-label">couleur</label> 
                                <div class="col-8">
                                <input id="couleur" name="couleur" value="<?php echo $RecetteDet['couleur']?>" class="form-control here" type="color" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="categorie" class="col-4 col-form-label">categorie</label> 
                                <div class="col-8">
                                <select id="categorie" name="categorie"  class="form-control here">
                                    <option value="1" <?php  if ($RecetteDet['categorie'] == "4"){ ?> selected="selected" <?php }  ?>>Viande</option>
                                    <option value="2" <?php  if ($RecetteDet['categorie'] == "2"){ ?> selected="selected" <?php }  ?>>Légume</option>
                                    <option value="3" <?php  if ($RecetteDet['categorie'] == "3"){ ?> selected="selected" <?php }  ?>>Poisson</option>
                                    <option value="4" <?php  if ($RecetteDet['categorie'] == "4"){ ?> selected="selected" <?php }  ?>>Fruit</option>
                                 </select>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempsCuisson" class="col-4 col-form-label">temps Cuisson</label> 
                                <div class="col-8">
                                <input id="tempsCuisson" name="tempsCuisson" value="<?php echo $RecetteDet['tempsCuisson']?>" class="form-control here" type="text" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempsPreparation" class="col-4 col-form-label">temps Preparation</label> 
                                <div class="col-8">
                                <input id="tempsPreparation" name="tempsPreparation" value="<?php echo $RecetteDet['tempsPreparation']?>" class="form-control here" type="text" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="difficulteselect" class="col-4 col-form-label">difficulté</label> 
                                <div class="col-8">
                                <select id="difficulteselect" name="difficulteselect"  class="form-control here">
                                    <option value="Facile" <?php  if ($RecetteDet['difficulte'] == "Facile"){ ?> selected="selected" <?php }  ?>>Facile</option>
                                    <option value="Moyen" <?php  if ($RecetteDet['difficulte'] == "Moyen"){ ?> selected="selected" <?php }  ?>>Moyen</option>
                                    <option value="Difficile" <?php  if ($RecetteDet['difficulte'] == "Difficile"){ ?> selected="selected" <?php }  ?>>Difficile</option>
                                 </select>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prix" class="col-4 col-form-label">prix</label> 
                                <div class="col-8">
                                <input id="prix" name="prix" value="<?php echo $RecetteDet['prix']?>" class="form-control here" type="text" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newItem" id="newItem" class="col-4 col-form-label">ingredients</label> 
                                <div class="col-8">
                                <textarea class="text_field col-12" id="task" placeholder="Write a new ingredient here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new ingredient here...'"  ><?php if(!empty($RecetteDet['ingredient'])){ echo $RecetteDet['ingredient']; } ?> </textarea>
                                    
                                </div>
                             </div>
                             <!--div class="form-group row">
                                <label for="tasks" id="youring" name="ingred" class="col-4 col-form-label">  </label> 
                                <div class="items col-8">
                                     
                                    <?php //if(!empty($RecetteDet['ingredient'])){ echo $RecetteDet['ingredient'];
                                     // } ?>  
                                </div>
                                </div-->
                                <div class="form-group row">
                                <label for="newItem" id="newItem" class="col-4 col-form-label">ingredients</label> 
                                <div class="col-8">
                                    <span id="display"><?php if(!empty($RecetteDet['ingredient'])){ echo $RecetteDet['ingredient'];
                                      } ?></span>
                                    <input type="text" id="edit" style="display:none" />
                                </div>
                                </div>
                            <div class="form-group row">
                                <label for="newItemprep" id="newItemprep" class="col-4 col-form-label">préparation</label> 
                                <div class="col-8">
                                <textarea class="text_field col-12" id="taskprep" placeholder="Write a new step here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new step here...'"  ><?php if(!empty($RecetteDet['preparation'])){ echo $RecetteDet['preparation']; } ?> </textarea>
                                </div>
                            </div>
                            <!--div class="form-group row">
                                <label for="yourprep" id="yourprep" class="col-4 col-form-label">  </label> 
                                <div class="items col-8">
                                    <ol id="tasksprep" class="sortable">
                                        
                                    <?php //if(!empty($RecetteDet['preparation'])){ echo 
                                       // ($RecetteDet['preparation']); } ?>   
                                    </ol>
                                  
                                </div>
                            </div-->
                            <div class="form-group row">
                                <label for="yourprep" id="yourprep" class="col-4 col-form-label">preparation</label> 
                                <div class="items col-8">
                                <ol id="tasksprep" class="sortable">
                                    <span id="display2"><?php if(!empty($RecetteDet['preparation'])){ echo $RecetteDet['preparation'];
                                      } ?></span>
                                    <input type="text" id="edit2" style="display:none" />
                                    </ol>
                                </div>
                                </div>
                            <div class="form-group row">
                                <label for="MdpAjout" class="col-4 col-form-label">  Mdp*</label> 
                                <div class="col-8">
                                <input id="MdpAjout" name="MdpAjout" placeholder="  Mdp" class="form-control here" type="password" >
                                </div>
                            </div> 
                            
                            
                            <div class="form-group row">
                                <div class="offset-6 col-4">
                                <button  id="submitChangesAjout" name="submitChangesAjout" type="submit" class="mb-2 btn btn-primary butsearch  "  > enregister </button> 
                                
                                <button id= "resetChangesAjout" name="resetChangesAjout"  type="submit" class="mb-2 btn btn-primary butsearch  "  >Reset  </button>
                                <!--button name="MdpChange" type="submit" class="btn btn-primary butsearch"><a href="requestpass">Forgot password</a></button-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<?php
require('modifierRecette.inc.php');  
include ('sessionincludeFooter.php');
  ?>
  <?php 
  if(isset($_POST['resetChangesAjout']))
  {
      ?>
 <script type="text/javascript">
    $(document).ready(function(){
        $("#resetChangesAjout").click(function(){
            location.reload(true);
            console.log('reset');
        });
    });
</script>
<?php
  }
  ?>
  <script>
    //console.log($("#tasks li").length);
    let column1RelArray = new Array($("#youring li").length);
    $('#youring').each(function(){// id of ul
    let li = $(this).find('li')//get each li in ul
    //console.log(li.text());//get text of each li
    column1RelArray.push(li.text());
    });
    //console.log(column1RelArray);
    //console.log(column1RelArray.length);
    //let arr = jQuery.makeArray( "#tasks li" );
// Use an Array method on list of dom elements
//arr.reverse();
//$( arr ).appendTo( document.body );
$("#display").click(function(){
  $(this).hide();
  $(this).siblings("#edit").show().val($(this).text()).focus();
});

$("#edit").focusout(function(){
$(this).hide();  $(this).siblings("#display").show().text($(this).val());
});

$("#display2").click(function(){
  $(this).hide();
  $(this).siblings("#edit2").show().val($(this).text()).focus();
});

$("#edit2").focusout(function(){
$(this).hide();  $(this).siblings("#display2").show().text($(this).val());
});
    </script>