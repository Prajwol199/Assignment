<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../admin/static/style/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../admin/static/style/css/syle.css">

</head>
<boby >
<div class="loginPage col-md-5 col-md-offset-4">
    <div class="panel panel-primary" style="margin-top:100px; ">
        <div class="panel-heading">Recover password</div>
        	<div class="panel-body">
        		<form  method="post">
        			<div class="form-group">
          				<label for="uname"> Name </label>
          				<input type="text" name="name" id="name" class="form-control">
       				</div>
       				<div class="form-group">
          				<label for="uname"> Email </label>
          				<input type="text" name="email" id="name" class="form-control">
       				</div>
       				<div class="form-group">
          				<label for="uname"> New Password </label>
          				<input type="password" name="password" id="name" class="form-control">
       				</div>
       				<div class="form-group">
          				<button class="btn btn-primary btn pull-right btn-md">Recover</button>
        			</div>
        		</form>
        	</div>
    </div>
</div>
<script type="text/javascript" src="../css/js/script.js"></script>
</body>
</html>