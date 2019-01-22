<!DOCTYPE html>

<?php
include ('sessioninclude.php');
include ('DbConnect.php');
?>

<body>

<div class="container page-container mt-3 "  >

<?php
include ('includemenu.php');
if(!empty($_POST['tempsPreparation']))
{
    $tptempsPreparation = filter_input(INPUT_POST,'tempsPreparation',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['titre']))
{
    $tptitre = filter_input(INPUT_POST,'titre',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['chapo']))
{
    $tpchapo = filter_input(INPUT_POST,'chapo',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['prix']))
{
    $tpprix = filter_input(INPUT_POST,'prix',FILTER_SANITIZE_NUMBER_INT);
}
if(!empty($_POST['tempsCuisson']))
{
    $tptempsCuisson = filter_input(INPUT_POST,'tempsCuisson',FILTER_SANITIZE_NUMBER_INT);
}
if(!empty($_POST['difficulte']))
{
    $tpdifficulte = filter_input(INPUT_POST,'difficulte',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['categorie']))
{
    $tpcategorie = filter_input(INPUT_POST,'categorie',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['listinputing']))
{
    $tplistinputing = filter_input(INPUT_POST,'listinputing',FILTER_SANITIZE_STRING);
}
if(!empty($_POST['listinputprep']))
{
    $tplistinputprep = filter_input(INPUT_POST,'listinputprep',FILTER_SANITIZE_STRING);
}





//}
?>
<div class="row my-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                         <h4> Ajouter une  recette </h4>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row my-3">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post"enctype="multipart/form-data" ><!--action="ajouterRecette.inc.php"-->
                            <div class="form-group row">
                                <label for="titre" class="col-4 col-form-label">titre</label> 
                                <div class="col-8">
                                <input id="titre" name="titre" placeholder ='titre' value="<?php if(!empty($_POST['titre'])){ echo $tptitre; } ?>" onfocus="this.placeholder = ''" onblur="this.placeholder ='titre'" class="form-control here"   type="text">
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
                                <textarea id="chapo" name="chapo" cols="40" rows="4" class="form-control" > <?php if(!empty($_POST['chapo'])){ echo $tpchapo; } ?>  </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="couleur" class="col-4 col-form-label">couleur</label> 
                                <div class="col-4 offset-2">
                                <input id="couleur" name="couleur"  type="color" value="#ff0000">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categorie" class="col-4 col-form-label">categorie</label> 
                                <div class="col-8">
                                <select id="categorie" name="categorie"  class="form-control here">
                                    <option value="1">Viande</option>
                                    <option value="2">Légume</option>
                                    <option value="3">Poisson</option>
                                    <option value="4">Fruit</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempsCuisson" class="col-4 col-form-label">temps Cuisson</label> 
                                <div class="col-8">
                                <input id="tempsCuisson" name="tempsCuisson"  value="<?php if(!empty($_POST['tempsCuisson'])){ echo $tptempsCuisson; } ?>"  class="form-control here" type="text" placeholder ='temps Cuisson en minutes' onfocus="this.placeholder = ''" onblur="this.placeholder ='temps Cuisson en minutes'">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempsPreparation" class="col-4 col-form-label">temps Preparation</label> 
                                <div class="col-8">
                                <input id="tempsPreparation" value="<?php if(!empty($_POST['tempsPreparation'])){ echo $tptempsPreparation; } ?>" name="tempsPreparation"  class="form-control here" type="text" placeholder ='temps preparation en minutes' onfocus="this.placeholder = ''" onblur="this.placeholder ='temps preparation en minutes'">
                                </div>
                            </div>
                            <!--div class="form-group row">
                                <label for="difficulte" class="col-4 col-form-label">difficulté</label> 
                                <div class="col-8">
                                <input id="	difficulte" name="difficulte"  class="form-control here" type="text" placeholder="facile/moyen/difficile" onfocus="this.placeholder = ''" onblur="this.placeholder ='facile/moyen/difficile'">
                                </div>
                            </div-->
                            <div class="form-group row">
                                <label for="difficulteselect" class="col-4 col-form-label">difficulté</label> 
                                <div class="col-8">
                                <select id="difficulteselect" name="difficulteselect"  class="form-control here">
                                    <option value="Facile">Facile</option>
                                    <option value="Moyen">Moyen</option>
                                    <option value="Difficile">Difficile</option>
                                 </select>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prix" class="col-4 col-form-label">prix</label> 
                                <div class="col-8">
                                <input id="prix" name="prix" value="<?php if(!empty($_POST['prix'])){ echo $tpprix; } ?>"  class="form-control here" type="text" placeholder="prix" onfocus="this.placeholder = ''" onblur="this.placeholder ='prix'" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newItem" id="newItem" class="col-4 col-form-label">ingredients</label> 
                                <div class="col-8">
                                <textarea class="text_field col-12" id="task" placeholder="Write a new ingredient here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new ingredient here...'"  ></textarea>
                                <input type="button" id="addItem" class="add_btn col-4 offset-4   butsearch" value="Ajouter" />    
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="tasks" id="youring" name="ingred" class="col-4 col-form-label">  </label> 
                                <div class="items col-8">
                                    <ul id="tasks" class="sortable" >
                                    <?php if(!empty($_POST['listinputing'])){ echo $tplistinputing; } ?>  
                                    </ul>
                                </div>
                                </div>
                             
                            <div class="form-group row">
                                <label for="newItemprep" id="newItemprep" class="col-4 col-form-label">préparation</label> 
                                <div class="col-8">
                                <textarea class="text_field col-12" id="taskprep" placeholder="Write a new step here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new step here...'"  ></textarea>
                                <input type="button" id="addItemprep" class="add_btn col-4 offset-4   butsearch" value="Ajouter" />    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="yourprep" id="yourprep" class="col-4 col-form-label">  </label> 
                                <div class="items col-8">
                                    <ol id="tasksprep" class="sortable">
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
                                <button  id="submitChangesAjout" name="submitChangesAjout" type="submit" class="btn btn-primary butsearch  "  > enregister </button> 
                                
                                <button id= "resetChangesAjout" name="resetChangesAjout" id= "resetChanges" type="submit" class="btn btn-primary butsearch  "  >Reset  </button>
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

<?php

require('ajouterRecette.inc.php');  
include ('sessionincludeFooter.php');
  ?>
</body>
</html>
<script>
    $("#addItem").click(function(){
        let task = $('#task').val();
        //let index = $('ul>li').index();
        let numitems =  $("#tasks li").length;
        //console.log( numitems);
        $("#tasks").append("<li id='"+ numitems + "' name='listing["+ numitems + "]'><input type ='text' class='LiInput' name='listinputing["+ numitems + "]' value='"+ task + " ''> </li>");
      });

     $("#newItem").on('submit',function(e){                 
       //add stuff to database if necessary
         e.preventDefault();
         return false;
      });
</script>
<script>
    $('document').ready(function(){
    $("#addItemprep").click(function(){
        let taskprep = $('#taskprep').val();
        let numitemsprep =  $("#tasksprep li").length;
        $("#tasksprep").append("<li id='"+ numitemsprep + "' name='listprep["+ numitemsprep + "]'><input type ='text' name='listinputprep[" + numitemsprep +"]' class='LiInput' value='"+ taskprep + " ''> </li>");
      });

     $("#newItemprep").on('submit',function(e){                 
       //add stuff to database if necessary
         e.preventDefault();
         return false;
      });
      
     
      
      });
</script>
<script>
$('#submitChangesAjout').click(function(){
    let indexEmptyFields = 0;
      $(":text, :file, :checkbox, select, textarea, color, :password").each(function() {
        if($(this).val()  === "")
        indexEmptyFields = 1;
        });
        if(indexEmptyFields > 0)
        alert("Empty Fields!!");
    });
    </script>
