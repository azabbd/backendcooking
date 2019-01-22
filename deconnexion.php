<!DOCTYPE html>
<?php
  include ('sessioninclude.php');
  include ('DbConnect.php');
?>

<body>

<div class="container page-container mt-3 "  style="padding-top: 60px;">

<?php
  include ('includemenu.php'); 
  session_destroy(); 
?>
</div> 
 
<div class="modal" id="myModaldeco">
    <div class="modal-dialog">
        <div class="modal-content">
<!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Opération réussite</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

<!-- Modal body -->
            <div class="modal-body">
                deconnecté!
            </div>

<!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="backtoindex">Revenir à l'acceuil </button>
            </div>

        </div>
    </div>
</div>         
</body>
<?php
  include ('sessionincludeFooter.php');
?>
</html>
<script type="text/javascript"> 
$(document).ready(function(){
  $('#myModaldeco').modal('show'); 
  $('#backtoindex').click(function(){
    window.location.href="index.php";
});
});
</script>