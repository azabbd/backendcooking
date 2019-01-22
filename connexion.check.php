<!DOCTYPE html>
<?php 

if (isset($_POST['Seconnecter'] ))
 {
	 //echo 'okkkkkkkkkkkkkkkkkkk<br><br><br><br>';
	 if ( !empty($_POST['Username'] ) && !empty($_POST['Password'] )  )
	 {
		//echo 'okkkkkkkkkkkkkkkkkkk<br><br><br><br>';
		$Username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
		//var_dump($Username);
		//echo 'okkkkkkkkkkkkkkkkkkk<br><br><br><br>';
		//var_dump($name);
		$Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
		//var_dump($Password);
		//echo 'okkkkkkkkkkkkkkkkkkk<br><br><br><br>';
		if($Username)//good format
		{
			$stmt = $mysqli->prepare("SELECT * FROM membres where login = ?");
			$stmt->bind_param('s', $Username);   
			$stmt->execute();    
			$Membreresult = $stmt->get_result();
			$MembreDet=$Membreresult->fetch_assoc();
			//var_dump($MembreDet);
			if($Membreresult->num_rows>0)//is member
			{ 
				if( $Password )//good format
				{
					if(password_verify($Password, $MembreDet['password']))//$Password == $MembreDet['password'])//good pass
					{ 
						$_SESSION['Username'] = $Username;
						$_SESSION['idMembre'] = $MembreDet['idMembre'];
						$_SESSION['Connected']= 'yes';
						$url= 'profildetails.php?idMembre='.$MembreDet['idMembre'].'&idConnexion=istablished';
						if (isset($_POST['Sesouvenir'])) 
						{
							$_COOKIE['Username'] = $Username;
							$_COOKIE['idMembre'] = $MembreDet['idMembre'];
							$cookie_name = 'cookie'. $MembreDet['Username'];
							$cookie_value = $MembreDet['Username'];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
							setcookie('cookie'.$_COOKIE['idMembre'], $_COOKIE['idMembre'], time() + (86400 * 30), "/"); // 86400 = 1 day
							//echo $_COOKIE['pseudo'];
						}
						if (isset($_POST['Sesouvenir'])) 
						{
							$_COOKIE['Username'] = $Username;
							$_COOKIE['idMembre'] = $MembreDet['idMembre'];
							$cookie_name = 'cookie'. $MembreDet['Username'];
							$cookie_value = $MembreDet['Username'];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
							setcookie('cookie'.$_COOKIE['idMembre'], $_COOKIE['idMembre'], time() + (86400 * 30), "/"); // 86400 = 1 day
							//echo $_COOKIE['pseudo'];
						}
						if($MembreDet['isAdmin'] == 1 && $MembreDet['idAdmin'] != NULL && $MembreDet['statut'] == "admin")
						{
							$_SESSION['isAdmin'] = 1;
							$_SESSION['idAdmin'] = $MembreDet['idAdmin'];
							$_SESSION['statutmembre'] = $MembreDet['statut'];
							$url= 'index.php?idMembre='.$MembreDet['idMembre'].'&idConnexion=istablished';
						}
						else
						{
							$_SESSION['statutmembre'] = $MembreDet['statut'];
						}
						echo ' <script>
								$(document).ready(function(){
										window.location.href = "'.$url.'"
								 });</script>';
						?>
						
						<?php
						//header($url );
						//echo '<script language="javascript"> 
						//window.location.href="'.$url.'" 
						//</script>';
					}
					else//wrong pass
					{
						
						//<script language="javascript"> 
						//alert("Erreur Login et/ou Mdp1") ;
						//</script> 
						?>
						<script type="text/javascript">
						$(document).ready(function(){
							$('#myModalSuccessfulconn').modal('show');
						});
						</script>
						
						<?php
					}
				}
				else//wrong pass format
				{
					//<script language="javascript"> 
						//alert("Erreur Login et/ou Mdp1") ;
						//</script> 
						?>
						<script type="text/javascript">
						$(document).ready(function(){
							$('#myModalSuccessfulconn').modal('show');
						});
						</script>
						
						<?php
				}
			}
			else //not a member
			{
				?>
				<script language="javascript"> 
						r = confirm("Merci pour votre intéret mais Vous n\'etes pas encore inscrit sur notre site! \n Vous souhaitez réessayer?");
						if (r == false) 
						{
							s = confirm("Souhaitez-vous vous inscrire?");
							if(s == true)
							{
							window.location = "inscription.php";
							}
							else
						{
							window.history.go(-1);
						}
							
						}
						
						</script> 
						<?php
				
			}
		}
		else//not valid login
		{
		//<script language="javascript"> 
						//alert("Erreur Login et/ou Mdp1") ;
						//</script> 
						?>
						<script type="text/javascript">
						$(document).ready(function(){
							$('#myModalSuccessfulconn').modal('show');
						});
						</script>
						
						<?php
		}		
	}
	else
	{
		//<script language="javascript"> 
						//alert("Erreur Login et/ou Mdp1") ;
						//</script> 
						?>
						<script type="text/javascript">
						$(document).ready(function(){
							$('#myModalempty').modal('show');
						});
						</script>
						
						<?php
	}
}
?>


<div class="modal" id="myModalSuccessfulconn">
                <div class="modal-dialog">
                    <div class="modal-content">
        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Opération echouée</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

        <!-- Modal body -->
                        <div class="modal-body">
                            erreur mdp et/ou login
                        </div>

        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="toptofiless">Réessayer </button>
                        </div>

                    </div>
                </div>
            </div>
 
				 
			<div class="modal" id="myModalempty">
                <div class="modal-dialog">
                    <div class="modal-content">
        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Opération echouée</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

        <!-- Modal body -->
                        <div class="modal-body">
                            Merci de remplir tous les champs
                        </div>

        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="toptofilesss">Réessayer </button>
                        </div>

                    </div>
                </div>
            </div>					 
	</html>