<?php
$edit_slider = new SliderController();
$result = $edit_slider->value_display($_GET['id']);
foreach ($result as $key => $value) {
      $title = $value['title'];
      $content = $value['description'];
      $image = $value['image'];
   }
if(isset($_POST['edit-slider'])){
      $edit_slider->edit_slider($_GET['id'],$image);
   }
?>
<h1 align="center"><i class="glyphicon glyphicon-log-in"></i> Edit Slider</h1>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6"><br>
    <div class="error" id="error" style="color:red;"></div><br>
    <form method="post" enctype="multipart/form-data" name="pageForm" >
       <div class="form-group">
          <label for="uname"> Title</label>
          <input type="text" name="title" id="name" class="form-control" value="<?=$title?>" required>
       </div>
       <div class="form-group">
          <label> Description</label><br>
          <textarea name="description" rows="6" cols="50" class="form-control" required><?=$content?></textarea>
       </div>
       <div class="form-group">
         <img src="<?= $server_root ?>/admin/static/images/sliderImage/<?= $value['image'] ?>" width="300"><br>
          <label> Change Image</label><br>
          <input type="file" name="file" class="form-control">
       </div>
       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="edit-slider">Add</button>
      </div>
    </form>
  </div>
</div>