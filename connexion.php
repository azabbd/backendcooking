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
?>
    <div class="row  text-center   mt-3 p-2 mb-5 "   >
        <div class="login-form pt-3 " >
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="formco" >
                <div class="title">
                    <h4 class="forttle"> Connexion  </h4>
                </div>      
                <div class="form-group">
                    <input type="text" class="form-control  mt-5 brrd"  name="Username" placeholder="login" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control mb-5 brrd"  name="Password" placeholder="mdp" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success my-2 py-2 my-sm-0 butsearch mb-4" name="Seconnecter">Se connecter</button>
                </div>
                <div class="clearfix custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                    <label class="custom-control-label" for="defaultUnchecked" name="Sesouvenir">Se souvenir de moi</label>
                    <a href="#" data-target="#pwdModal2" data-toggle="modal" class="pull-right">Mdp oublié?</a>

                    <!--a href="requestpass" class="pull-right"name="Mdpoublie" style="color:#9D0461!important;  ">Mdp oublié?</a-->
                </div>
                </form>
            <p></p>
            <p class="text-center"><a href="inscription.php" >Créer un compte</a></p>
        </div>
    </div>   <!--se connecter-->
    
</div> 
<!--modal-->
<div id="pwdModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
require('connexion.check.php');
require('requestpassModal.php'); 
?>
</html>