<?php
$siteConfig = new SiteController();
$site_data = $siteConfig->select_site();

?>

<div class="loginPage col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
    	<div class="panel-heading" align="center">Site Configuration</div>
    	<table class="table">
    	  <tr>
    	    <th>S.N</th>
    	    <th>Logo</th>
    	    <th>Site Name</th>
    	    <th>Site URL</th>
            <th>Footer</th>
            <th>Action</th>
    	  </tr>
    	  <?php foreach ($site_data as $key => $value) { ?>
			<td><?=$key+1?></td> 
     		<td><img src="../admin/static/images/logo.jpg" width=100></td>
    		<td><?= $value['site_name']?></td>
            <td><?= $value['server_root']?></td>
            <td><?= $value['footer']?></td>
    		<td>
    			<a href="home.php?page=edit-site-configuration&uid=<?= $value['id']?>">
                    <button class="btn btn-success btn-md">
                        Edit
            		</button>
                </a>
    		</td>
     	  <?php } ?>
		</table>
    </div>
</div>