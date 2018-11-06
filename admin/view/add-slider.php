<?php
if(isset($_POST['add-slider'])){
    $slider = new SliderController();
    $slider->add_slider();
}
?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6"><br>
    <div class="error" id="error" style="color:red;"></div><br>
    <form method="post" enctype="multipart/form-data" name="pageForm" >
       <div class="form-group">
          <label for="uname"> Title</label>
          <input type="text" name="title" id="name" class="form-control" required>
       </div>
       <div class="form-group">
          <label> Description</label><br>
          <textarea name="description" rows="6" cols="50" class="form-control" required></textarea>
       </div>
       <div class="form-group">
          <label> Image</label><br>
          <input type="file" name="file" class="form-control">
       </div>
       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="add-slider">Add</button>
      </div>
    </form>
  </div>
</div>