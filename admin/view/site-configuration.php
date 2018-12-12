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
         		<td><img src="<?php echo $server_root ?>/admin/static/images/logo.jpg" width=100></td>
        		<td><?php echo $value['site_name']?></td>
                <td><?php echo $value['server_root']?></td>
                <td><?php echo $value['footer']?></td>
                <td><?php echo $value['page_limit']?></td>            
        		<td>
        			<a href="edit-site-configuration/<?php echo $value['id']?>">
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