<?php
session_start();
if(!($_SESSION['cred']=='ADMIN')){
  header('Location: index.php');
  exit;
}
    require 'database.php';
    $id = 0;
    
      if ( !empty($_GET['id'])) {
          $id = $_REQUEST['id'];
      }
       
      if ( !empty($_POST)) {
          // keep track post values
          $id = $_POST['id'];
           
          // delete data
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "DELETE FROM agents WHERE id = ?";
          $q = $pdo->prepare($sql);
          $q->execute(array($id));
          Database::disconnect();
          header("Location: agents.php");
           
      }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
 
<body>
    <div class="alt">
     
                <div class="inner">
                    <div class="row">
                        <h3>Remove Agent</h3>
                    </div>
                     
                    <form action="agents_delete.php?id=<?php echo $id;?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete this Agent?</p>
                      <div class="form-actions">
                          <input type="button" onclick="this.form.submit()" class="button special small" value="Yes"></input>
                          <input type="button" onclick="window.location='agents.php'" class="button small" value="No"></input>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/skel.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>
  </body>
</html>