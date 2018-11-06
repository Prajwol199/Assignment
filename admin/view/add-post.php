<?php
$post = new PostController();
if(isset($_POST['post_add'])){
	$post->add_post();
}
?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6">
  	<h1 align="center"><i class="glyphicon glyphicon-book"></i> Add Post</h1>
    <div class="error" id="error" style="color:red;"></div>
    <form method="post" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Title </label>
			<input type="text" name="title" class="form-control" required>
		</div>

		<div class="form-group">
			<label>Content </label>
			<textarea name="content" rows="6" cols="50" class="form-control" required></textarea>
		</div>

		<div class="form-group">
			<label>Seo Title</label>
			<input type="text" name="seo-title" class="form-control" required> 
		</div>

		<div class="form-group">
			<label>Meta Title</label>
			<input type="text" name="meta-title" class="form-control" required>
		</div>

		<div class="form-group">
			<label>Meta Keyword</label>
			<input type="text" name="meta-keyword" class="form-control" required>
		</div>

		<div class="form-group">
			<label>Image</label>
			<input type="file" name="uploadfile[]" class="form-control" multiple>
		</div>

		<div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="post_add" >Add</button>
		</div>
	</form>
  </div>
</div>