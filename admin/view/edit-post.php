<?php
	$id = $_GET['id'];
	$select_post = new PostController();
	$all_post = $select_post->select_post($id);
	foreach ($all_post as $key => $value) {
		$title = $value['title'];
		$content = $value['content'];
		$seo_title = $value['seo_title'];
		$meta_title = $value['meta_title'];
		$meta_keyword = $value['meta_keyword'];
	}
	if(isset($_POST['post_edit'])){
		$select_post->edit_post();
	}
?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6">
  	<h1 align="center"><i class="glyphicon glyphicon-book"></i> Edit Post</h1>
    <div class="error" id="error" style="color:red;"></div>
    <form method="post" enctype="multipart/form-data">
    	<div class="form-group" >
    		<label>Title </label>
			<input type="text" name="title" class="form-control" value="<?=$title?>" required>
		</div>

		<div class="form-group">
			<label>Content </label>
			<textarea name="content" rows="6" cols="50" class="form-control" required><?=$content?></textarea>

		</div>

		<div class="form-group">
			<label>Seo Title</label>
			<input type="text" name="seo-title" class="form-control" value="<?=$seo_title?>" required>
		</div>

		<div class="form-group">
			<label>Meta Title</label>
			<input type="text" name="meta-title" class="form-control" value="<?=$meta_title?>" required>
		</div>

		<div class="form-group">
			<label>Meta Keyword</label>
			<input type="text" name="meta-keyword" class="form-control" value="<?=$meta_keyword?>" required>
		</div>
		<div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="post_edit">Update</button>
		</div>
	</form>
  </div>
</div>