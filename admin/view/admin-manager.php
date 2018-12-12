<?php
$admin_manager = new User();
$result = $admin_manager->admin_manager();

?>
<div class="content">
    <div class=" small_content col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
        	<div class="panel-heading" align="center">Admin manager</div>
        	<table class="table">
        	  <tr>
        	    <th>S.N</th>
        	    <th>Name</th>
        	    <th>email</th>
        	    <th>action</th>
        	  </tr>
        	  <?php foreach ($result as $key => $value) { ?>
    			<td><?php echo$key+1?></td> 
         		<td><?php echo ucfirst($value['name']) ?></td>
        		<td><?php echo $value['email']?></td>
        		<td>
        			<a href="edit-admin/<?php echo $value['id']?>">
                        <button class="btn btn-success btn-md">
                            Change Password
                		</button>
                    </a>
        		</td>
         	  <?php } ?>
    		</table>
        </div>
    </div>
</div>