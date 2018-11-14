<?php
$siteConfig = new SiteController();
$site_data = $siteConfig->select_site();

?>
<div class="content">
    <div class="small_content col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
        	<div class="panel-heading" align="center">Site Configuration</div>
        	<table class="table">
        	  <tr>
        	    <th>Logo</th>
        	    <th>Site Name</th>
        	    <th>Site URL</th>
                <th>Footer</th>
                <th>Page Limit</th>
                <th>Action</th>
        	  </tr>
        	  <?php foreach ($site_data as $key => $value) { ?>
         		<td><img src="<?= $server_root ?>/admin/static/images/logo.jpg" width=100></td>
        		<td><?= $value['site_name']?></td>
                <td><?= $value['server_root']?></td>
                <td><?= $value['footer']?></td>
                <td><?= $value['page_limit']?></td>            
        		<td>
        			<a href="edit-site-configuration/<?= $value['id']?>">
                        <button class="btn btn-success btn-md">
                            Edit
                		</button>
                    </a>
        		</td>
         	  <?php } ?>
    		</table>
        </div>
    </div>
</div>