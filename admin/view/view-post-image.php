<?php
	$select = new PostController();
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	$image = $select->select_post_image($id);
	}

	if(isset($_POST['delete-image'])){
		$select->delete_view_post();
	}

	if(isset($_POST['addPostImage'])){
		$select->add_post_image();
	}
?>
<div class="content">
	<div class="col-md-12">
		<h2 style="margin-left: 400px;"><b>Images in current Post</b></h2>
		<div class="pull-right" style="background: pink; padding: 10px;margin-top: -60px;">
		<form method="post" enctype="multipart/form-data" >
			<input type="file" name="uploadfile[]" class="form-control" multiple>
			<br>
			<button class="btn btn-success btn-lg" name="addPostImage" value="<?php echo$id=$_GET['id'];?>">
				<i class="glyphicon glyphicon-plus"></i> Add Image
			</button>
		</form>
		</div>
	</div>
	<?php if(count($image)>0) {?>
		<?php foreach ($image as $key => $value) {?>
			<div class="col-md-4 navbar  navbar-default" style="padding:30px;">
				<img src="<?php echo$server_root?>admin/static/images/pageImage/<?php echo $value['image'] ?>" width="300" height="250" style="padding: 10px;"><br>
				<form method="post" >
					<a onclick="return confirm('are you sure delete')"><button class="btn btn-danger" name="delete-image" value="<?php echo $value['id']?>">
						<i class="glyphicon glyphicon-trash"></i> Delete
					</button></a>
				</form>
			</div>
		<?php } ?>
	<?php }else{ ?>
		    <div class="alert alert-success">
	        	<h1 align="center">Image not found</h1>
	        </div>
	     <?php } ?>
</div>