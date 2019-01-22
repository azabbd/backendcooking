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
<div style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#md_save" >Ajouter</button></div><br><br>

<table class="table table-bordered">
  <thead>
      <tr>
          <th scope="col">IdMembre</th>
          <th scope="col">gravatar</th>
          <th scope="col">login</th>
          <th scope="col">nom</th>
          <th scope="col">prenom</th>
          <th scope="col">email</th>
          <th scope="col">statut</th>
          <th scope="col">date inscription</th>
          <th scope="col">description</th>
          <th scope="col">fb</th>
          <th scope="col">insta</th>
          <th scope="col">twitter</th>
          <th scope="col">twitter</th>
          <th scope="col">youtube</th>
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
              <h5 class="modal-title" id="exampleModalLabel">Ajouter membre</h5>
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
                                <label for="pseudo" class="col-4 col-form-label">login</label> 
                                <div class="col-8">
                                <input id="pseudo" name="pseudo" placeholder ='login' onfocus="this.placeholder = ''" onblur="this.placeholder ='login'" class="form-control here error" minlength=3   type="text">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="mdp" class="col-4 col-form-label">Password</label> 
                                <div class="col-8">
                                <input id="mdp" name="mdp" placeholder ='Password' onfocus="this.placeholder = ''" onblur="this.placeholder ='Password'" class="form-control here error" minlength=3   type="Password">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="nom" class="col-4 col-form-label">nom</label> 
                                <div class="col-8">
                                <input id="nom" name="nom" placeholder ='nom' onfocus="this.placeholder = ''" onblur="this.placeholder ='nom'" class="form-control here error" type="text">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="prenom" class="col-4 col-form-label">prenom</label> 
                                <div class="col-8">
                                <input id="prenom" name="prenom" placeholder ='prenom' onfocus="this.placeholder = ''" onblur="this.placeholder ='prenom'" class="form-control here error"  type="text">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">email</label> 
                                <div class="col-8">
                                <input id="email" name="email" placeholder ='email' onfocus="this.placeholder = ''" onblur="this.placeholder ='email'" class="form-control here error"  type="email">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-4 col-form-label">description</label> 
                                <div class="col-8">
                                <textarea id="description" name="description" placeholder ='description' class="form-control here error"   > </textarea>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-4 col-form-label">facebook</label> 
                                <div class="col-8">
                                <textarea id="facebook" name="facebook" placeholder ='facebook' class="form-control here error"   > </textarea>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-4 col-form-label">twitter</label> 
                                <div class="col-8">
                                <textarea id="twitter" name="twitter" placeholder ='twitter' class="form-control here error"   > </textarea>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-4 col-form-label">instagram</label> 
                                <div class="col-8">
                                <textarea id="instagram" name="instagram" placeholder ='instagram' class="form-control here error"   > </textarea>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label for="youtube" class="col-4 col-form-label">youtube</label> 
                                <div class="col-8">
                                <textarea id="youtube" name="youtube" placeholder ='youtube' class="form-control here error"   > </textarea>
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="fileupload" class="col-4 col-form-label">Photo</label> 
                                <div class="col-6 ">
                                <input type="file" name="fileupload" value="fileupload" id="fileupload">
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-4 offset-4">
                                <input type="submit" class="btn btn-outline-success my-2 py-2 my-sm-0 butsearch mb-4" name ="submitForm" value="Enregistrement"> 
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
            $('#type').val("");
            $('#ville').val("");
            $('#budget').val("");
            $('#superficie').val("");
            $('#categorie').val("");
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
                        'idDemande': idDemande
                      }
		    });
		    request.done(function(result) {

                let obj = jQuery.parseJSON(result);
                
                $("#demandeur option[value='" + obj.idPersonne + "']").prop('selected', true);
		    	$('#type').val(obj.genre);
                $('#ville').val(obj.ville);
                $('#budget').val(obj.budget);
                $('#superficie').val(obj.superficie);
                $('#categorie').val(obj.categorie);

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
                            'idDemande': idDemande
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