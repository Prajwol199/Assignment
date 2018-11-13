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
  <?php
     if (isset($_SESSION['success'])):?>
        <div class="alert alert-success">
            <h1 align="center"><i class="glyphicon glyphicon-info-sign"></i> <?= $_SESSION['success']; ?></h1>
        </div>
        <?php unset($_SESSION['success']) ?>
    <?php endif; ?> 
<div class="content">
<form method="post" enctype="multipart/form-data">
	<div class="col-md-6 col-md-offset-3" style="background: pink; padding: 30px;">
	   	<div class="form-group">
	  		<label> <h1>Add Image</h1></label><br>
	  		<input type="file" name="file" class="form-control">
		</div>
		<button type="submit" name='image-upload' class="btn btn-primary">Upload</button>
	</div>
</form>
<?php if(count($image)>0) {?>
<div class="col-md-12"><h1 align="center"><b>Images in site</b></h1></div>
	<?php foreach ($image as $key => $value) {?>
		<div class="col-md-4 navbar  navbar-default" style="padding:30px;">
			 <a class="example-image-link" href="<?= $server_root ?>/admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="gallery"><img src="<?= $server_root ?>/admin/static/images/pageImage/<?= $value['image'] ?>" width="300" height="250" style="padding: 10px;"><br></a>
			<form method="post" >
				<a onclick="return confirm('are you sure delete')"><button class="btn btn-danger" name="delete-image" value="<?= $value['id']?>">
					 <i class="glyphicon glyphicon-trash"></i> Delete
				</button></a>
			</form>
		</div>
	<?php } ?>
<?php }else{ ?>
	  	<div class="alert alert-success" style="margin-top:310px;">
            <h1 align="center">Image not found</h1>
     	</div>
      <?php } ?>
</div>
