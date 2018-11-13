<?php
$id=$_GET['id'];
$select = new User();
$field = $select->getAdmin($id);
foreach ($field as $key => $value) {
  $id=$value['id'];
}

if(isset($_POST['edit-admin'])){
	$select = new User();
	$select->changePassword();
}

?>
<div class="content">
	<div class="loginPage col-md-6 col-md-offset-3">
	    <div class="panel panel-primary">
	    	<div class="panel-heading" align="center">Change Password</div>
	    		<div class="panel-body">
	    			<div class="error " id="error" style="color:red;"></div><br>
	    			<form method="post"  name="Password" onsubmit="return updatePassword()">
						<div class="form-group">
							<label for="opass"> Old Password </label>
							<input type="Password" name="opassword" id="opass" class="form-control">
						</div>
						<div class="form-group">
							<label for="npass"> New Password </label>
							<input type="Password" name="npassword" id="npass" class="form-control">
						</div>
						<div class="form-group">
		          			<button class="btn btn-primary btn pull-right btn-md" name="edit-admin" value="<?=$id?>">Change</button>
		        		</div>
	        		</form>
				</div>			
	    </div>
	</div>
</div>