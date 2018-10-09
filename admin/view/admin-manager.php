<?php
$admin_manager = new User();
$result = $admin_manager->admin_manager();  


?>

<div class="loginPage col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
    	<div class="panel-heading" align="center">Admin manager</div>
    	<table class="table">
		  <tr>
		    <th>S.N</th>
		    <th>Name</th>
		    <th>email</th>
		    <th>action</th>
		  </tr>
		  <?php 
     		foreach ($result as $key => $value) { ?>
   				<td><?=$key+1?></td> 
         		<td><?= $value['name'] ?></td>
        		<td><?= $value['email']?></td>
        		<td>
        			<a href="home.php?page=edit-admin&uid=<?= $value['id']?>"><button class="btn btn-success btn-md">Change Password
            		</button></a>
        		</td>
     		<?php } ?>
		</table>
    </div>
</div>
