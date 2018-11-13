<?php

$id=$_GET['id'];

$select = new PageController();
$field = $select->getPages($id);

foreach ($field as $key => $value) {
  $id=$value['id'];
  $name= $value['name'];
  $description= $value['description'];
}

$select->updatePages($id);

?>
<div class="content">
  <div class=" col-md-12 col-md-offset-3">
    <div class="col-md-6">
      <div class="error " id="error" style="color:red;"></div><br>
      <form  name="pageForm" method="post" onclick="return editValidator()">
         <div class="form-group">
            <label for="uname"> Page Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php if(isset($name)){echo $name;}?>">
         </div>
         <div class="form-group">
            <label> Description</label><br>
            <textarea name="des" rows="6" cols="50" class="form-control ckeditor"><?php if(isset($description)){echo $description;}?></textarea>
         </div>
         <div class="form-group">
            <button class="btn btn-success btn pull-right btn-lg">Update</button>
          </div>
        </form>
    </div>
  </div>
</div>