<?php
$siteConfig = new SiteController();

if(isset($_POST['edit-site'])){
	$siteConfig->edit_site();
}

$data = $siteConfig->fetch_data();

foreach ($data as $key => $value) {
	$id = $value['id'];
	$name = $value['site_name'];
	$url = $value['server_root'];
	$footer = $value['footer'];
	$limit = $value['page_limit'];
	$logo = $value['logo'];
}

?>
<div class="content">
	<div class="small_content col-md-6 col-md-offset-3">
	    <div class="panel panel-primary">
	    	<div class="panel-heading" align="center">Edit Site Configiration</div>
	    		<div class="panel-body">
	    			<div class="error " id="error" style="color:red;"></div><br>
	    			<form method="post" name="form" enctype="multipart/form-data" onclick="return siteValidation()">
						<div class="form-group">
							<label for="name"> Site Name </label>
							<input type="text" name="name" id="name" class="form-control" value="<?= $name?>">
						</div>
						<div class="form-group">
							<label for="url"> Site URL </label>
							<input type="text" name="url" id="url" class="form-control" value="<?= $url ?>">
						</div>
						<div class="form-group">
							<label for="footer"> Footer </label>
							<input type="text" name="footer" id="footer" class="form-control" value="<?= $footer ?>">
						</div>
						<div class="form-group">
							<label for="limit"> Page Limit </label>
							<input type="text" name="limit" id="limit" class="form-control" value="<?= $limit ?>">
						</div>
						<div class="form-group">
							<img src="<?= $server_root ?>/admin/static/images/<?= $logo ?>" width="100"><br>
							<label for="logo">Change Logo </label>
							<input type="file" name="logo" id="logo" class="form-control">
						</div>
						<div class="form-group">
		          			<button class="btn btn-primary btn pull-right btn-md" name="edit-site" value="<?=$id?>">Change</button>
		        		</div>
	        		</form>
				</div>			
	    </div>
	</div>
</div>