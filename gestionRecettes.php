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
include ('includeheaderAdmin.php');
?>
<div style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md_save" onClick="clear_modal();">Ajouter</button></div><br><br>

<table class="table table-bordered">
  <thead>
      <tr>
      
      <th scope="col">idRecette</th>
          <th scope="col">titre</th>
          <th scope="col">chapo</th>
          <th scope="col">img</th>
          <th scope="col">preparation</th>
          <th scope="col">ingredient</th>
          <th scope="col">membre</th>
          <th scope="col">couleur</th>
          <th scope="col">dateCrea</th>
          <th scope="col">categorie</th>
          <th scope="col">tempsCuisson</th>
          <th scope="col">tempsPreparation</th>
          <th scope="col">difficulte</th>
          <th scope="col">prix</th>
           
      </tr>
  </thead>
  <tbody id="myTable">


  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="md_save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
      <form method="post" id="myform" action="ajax/adddemande_ajax.php" enctype="multipart/form-data">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ajouter recette</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <div class="form-group">
                  <label for="exampleInputEmail1">Demandeur</label>
                  <select class="form-control" id="demandeur" name="demandeur">
                      <option value="-1" selected>...</option>

                      <?php
                          $result = $mysqli->query("SELECT * FROM membres");

                          while($personne = $result->fetch_assoc())
                          {
                              ?>
                                  <option value="<?php echo $personne["idMembre"] ?>"><?php echo $personne["idMembre"] ?> - <?php echo $personne["login"] ?></option>
                              <?php
                          }
                          ?>

                  </select>
              </div>
              <div class="form-group row">
                <label for="idRecette" class="col-4 col-form-label">idRecette</label> 
                <div class="col-8">
                <input id="idRecette" name="idRecette"   class="form-control here"   type="text">
                </div>
            </div>
              <div class="form-group row">
                <label for="titre" class="col-4 col-form-label">titre</label> 
                <div class="col-8">
                <input id="titre" name="titre"   class="form-control here"   type="text">
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
                <textarea id="chapo" name="chapo" cols="40" rows="4" class="form-control" > </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="couleur" class="col-4 col-form-label">couleur</label> 
                <div class="col-8">
                <input id="couleur" name="couleur"  class="form-control here" type="color" value="#ff0000" >
                </div>
            </div>
            
            <div class="form-group row">
                <label for="categorie" class="col-4 col-form-label">categorie</label> 
                <div class="col-8">
                <select id="categorie" name="categorie"  class="form-control here">
                    <option value="1"  >Viande</option>
                    <option value="2"  >Légume</option>
                    <option value="3"  >Poisson</option>
                    <option value="4"  >Fruit</option>
                    </select>                                
                </div>
            </div>
            <div class="form-group row">
                <label for="tempsCuisson" class="col-4 col-form-label">temps Cuisson</label> 
                <div class="col-8">
                <input id="tempsCuisson" name="tempsCuisson"   class="form-control here" type="text" >
                </div>
            </div>
            <div class="form-group row">
                <label for="tempsPreparation" class="col-4 col-form-label">temps Preparation</label> 
                <div class="col-8">
                <input id="tempsPreparation" name="tempsPreparation"  class="form-control here" type="text" >
                </div>
            </div>
            
            <div class="form-group row">
                <label for="difficulteselect" class="col-4 col-form-label">difficulté</label> 
                <div class="col-8">
                <select id="difficulteselect" name="difficulteselect"  class="form-control here">
                    <option value="Facile"  >Facile</option>
                    <option value="Moyen"  >Moyen</option>
                    <option value="Difficile" >Difficile</option>
                    </select>                                
                </div>
            </div>
            <div class="form-group row">
                <label for="prix" class="col-4 col-form-label">prix</label> 
                <div class="col-8">
                <input id="prix" name="prix"  class="form-control here" type="text" >
                </div>
            </div>
            <div class="form-group row">
                <label for="newItem" id="newItem" class="col-4 col-form-label">ingredients</label> 
                <div class="col-8">
                <textarea class="text_field col-12" id="task" placeholder="Write a new ingredient here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new ingredient here...'"  > </textarea>
                    
                </div>
                </div>
                
            <div class="form-group row">
                <label for="newItemprep" id="newItemprep" class="col-4 col-form-label">préparation</label> 
                <div class="col-8">
                <textarea class="text_field col-12" id="taskprep" placeholder="Write a new step here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new step here...'"  > </textarea>
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
        </div>
        </form>
        </div>
    </div>
</div>






</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">

        //*********************************************** */
        //Fonction déclenché lorsque l'utilisateur click sur enregistrer
        //Elle ajoute une nouvelle demande en BDD
        //*********************************************** */
        $(document).ready(function (e) {
            $("form#myform").submit(function(e) {

                e.preventDefault();

                let request = $.ajax({
                    type: 'POST',
                    url: $("#myform").attr('action'),
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false
                });

                request.done(function(result){
                    
                    refreshData();
                    $('#md_save').modal('hide');

                });

                request.fail(function(result){
                    alert("NOOK");
                });
            });
        });

        //*********************************************** */
        //Fonction déclenché lorsque l'utilisateur click sur ajouter
        //Elle vide les input de la modal
        //*********************************************** */
        function clear_modal() {
            $('#demandeur option:eq(0)').prop('selected', true);
            
            $('#idRecette').val("");
            $('#titre').val("");
            $('#chapo').val("");
            $('#fileupload').val("");
            $('#taskprep').val("");
            $('#task').val("");
            $('#membre').val("#ff0000");
            $('#couleur').val("");
            $('#categorie').val("");
            $('#tempsCuisson').val("");
            $('#tempsPreparation').val("");
            $('#difficulteselect').val("");
            $('#prix').val("");
            $("#alert_save").hide();
           
        }

        //*********************************************** */
        //Fonction déclenché lorsque l'utilisateur click sur modifier
        //Elle reécupére les données de la demande et les asignes aux input de la modal
        //*********************************************** */
        function getDemande(idDemande) {
            
            let request = $.ajax({
		        'url' : 'ajax/getDemande_ajax.php',
		        'type': 'POST',
                'data': { 
                        'idRecette': idDemande
                      }
		    });
		    request.done(function(result) {

                let obj = jQuery.parseJSON(result);
                
                $("#demandeur option[value='" + obj.idPersonne + "']").prop('selected', true);
                $('#idRecette').val(obj.idRecette);
                $('#titre').val(obj.titre);
                $('#chapo').val(obj.chapo);
                $('#fileupload').val(obj.fileupload);
                $('#taskprep').val(obj.preparation);
                $('#task').val(obj.ingredient);
                $('#membre').val(obj.membre);
                $('#couleur').val(obj.couleur);
                $('#categorie').val(obj.categorie);
                $('#tempsCuisson').val(obj.tempsCuisson);
                $('#tempsPreparation').val(obj.tempsPreparation);
                $('#difficulteselect').val(obj.difficulte);
                $('#prix').val(obj.prix);
                $('#demandeur option:eq(0)').prop('selected', true);
                });
                request.fail(function() {

		    });

        }

        //*********************************************** */
        //Fonction déclenché lorsque l'utilisateur click sur supprimer
        //Elle suprime la demande en BDD
        //*********************************************** */
        function deleteDemande(idDemande) {
            let request = $.ajax({
		        'url' : 'ajax/deleteDemande_ajax.php',
		        'type': 'POST',
                'data': { 
                            'idRecette': idDemande
                        }
		    });
		    request.done(function(result) {

                if (result == 1) {

                    refreshData();

                }
		    });    
		    request.fail(function() {

		    });
        }

        //*********************************************** */
        //Fonction déclenché lorsque l'on veut rafraichir les données du tableau
        //*********************************************** */
        function refreshData() {
            let request = $.ajax({
                url: 'ajax/getListeDemandes_ajax.php',
            });

            request.done(function(result){
                
                $("#myTable").html(result);

            });

            request.fail(function(result){
                alert("NOOK");
            });
        }

        //*********************************************** */
        //Fonction déclenché après le rendu de la page pour charger les données dans le tableau
        //*********************************************** */
        $(document).ready(function (e) {
            refreshData();
        });


    </script>	
    </body>
<?php
include ('sessionincludeFooter.php');
 
  
?>
</html>