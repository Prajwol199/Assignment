<?php
require_once __dir__.'/../admin/controller/phpmailer.php';
require_once __dir__.'/../admin/controller/setting.php';
global $server_root;

if(isset($_POST['recoverPassword'])){
  $recover = new Mailer();
  $recover->recoverPassword();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/syle.css">

</head>
<boby >
<div class="loginPage col-md-5 col-md-offset-4">
    <div class="panel panel-primary" style="margin-top:100px; ">
        <div class="panel-heading">Recover password</div>
        	<div class="panel-body">
        		<form  method="post">
       				<div class="form-group">
          				<label for="uname"> Enter your email </label>
          				<input type="text" name="email" id="name" class="form-control">
       				</div>
       				<div class="form-group">
          				<button class="btn btn-primary btn pull-right btn-md" name="recoverPassword">Recover</button>
        			</div>
        		</form>
        	</div>
    </div>
</div>
<script type="text/javascript" src="<?php echo$server_root?>admin/static/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo$server_root?>admin/static/js/script.js"></script>
</body>
</html>