<?php
$dropdown = new ImageController();
// $value= $dropdown->getPage();

if(isset($_POST['image-upload'])) {
	$dropdown->addImage();
}
if(isset($_POST['delete-image'])) {
	$dropdown->deleteImage();
}

$image = $dropdown->selectimage();

?>
<form method="post" enctype="multipart/form-data">
	<div class="col-md-6 col-md-offset-3" style="background: pink; padding: 30px;">
	   	<div class="form-group">
	  		<label> <h1>Add Image</h1></label><br>
	  		<input type="file" name="file" class="form-control">
		</div>
		<button type="submit" name='image-upload' class="btn btn-primary">Upload</button>
	</div>
</form>

<div class="col-md-12"><h1 align="center"><b>Images in site</b></h1></div>
<?php foreach ($image as $key => $value) {?>
	<div class="col-md-4 navbar  navbar-default" style="padding:30px;">
		<img src="../admin/static/images/pageImage/<?= $value['image'] ?>" width="300" height="250" style="padding: 10px;"><br>
		<form method="post" >
			<button class="btn btn-danger" name="delete-image" value="<?= $value['id']?>">
				<a style="color:white"; onclick="return confirm('are you sure delete')"> Delete</a>
			</button>
		</form>
	</div>
<?php } ?>
