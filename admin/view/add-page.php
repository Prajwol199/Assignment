<?php
$add = new PageController();
$select_page = $add->select_page();

if(isset($_POST['add'])) {
  $add->AddPage();
}
?>
<div class="content">
  <div class=" col-md-12 col-md-offset-3">
    <div class="col-md-6"><br>
      <div class="error" id="error" style="color:red;"></div><br>
      <form method="post" enctype="multipart/form-data" name="pageForm" onsubmit="return pageValidate()">
           <div class="form-group">
            <label for="page">Select Page</label>
            <select name="page" id="page" class="form-control">
              <option value="-1">Parent Page</option>
              <option value="-2">Footer Page</option>
              <?php foreach ($select_page as $key => $value) { ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
              <?php }?>
            </select>
          </div>
         <div class="form-group col-md-6">
            <label for="uname"> Page Name</label>
            <input type="text" name="name" id="name" class="form-control slug-input">
         </div>
          <div class="form-group col-md-6">
            <label for="uname"> Slug</label>
            <input type="text" name="slug"  class="form-control slug-output" readonly>
         </div>
         <div class="form-group">
            <label> Description</label><br>
            <textarea name="des" rows="6" cols="50" class="form-control ckeditor"></textarea>
         </div>
         <div class="form-group">
            <label> Image</label><br>
            <input type="file" name="file" class="form-control">
         </div>
         <div class="form-group">
            <button class="btn btn-success btn pull-right btn-lg" name="add">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
