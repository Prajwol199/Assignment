<?php
	$image = [];
	if(isset($_GET['id'])){
		$id=$_GET['id'];

	$select = new User();
	$image = $select->select_image($id);
	}

	if(isset($_POST['addPageImage'])){
		$addImage = new User();
		$addImage->addPageImage();
	}
	if(isset($_POST['delete-image'])){
	$addImage = new User();
	$addImage->deleteImg_page();
	}
?>

<div class="col-md-12">
	<h2 style="margin-left: 400px;"><b>Images in current page</b></h2>
	<div class="pull-right" style="background: pink; padding: 10px;margin-top: -60px;">
	<form method="post" enctype="multipart/form-data" >
		<input type="file" name="file">
		<br>
		<button class="btn btn-success btn-lg" name="addPageImage" value="<?=$id=$_GET['id'];?>">
			Add Image
		</button>
	</form>
	</div>
</div>
<br>
<?php if(count($image)>0) {?>
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
<?php }else{ ?>
	    <div class="alert alert-success">
        	<h1 align="center">Image not found</h1>
        </div>
     <?php } ?>



