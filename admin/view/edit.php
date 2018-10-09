<?php

$id=$_GET['id'];

$select = new User();
$field = $select->getUsers($id);

foreach ($field as $key => $value) {
  $id=$value['id'];
  $name= $value['name'];
  $description= $value['description'];
}

$select->updateUser($id);

?>
 <div class=" col-md-12 col-md-offset-3">

  <div class="col-md-6">
    <form method="post">
       <div class="form-group">
          <label for="uname"> Page Name</label>
          <input type="text" name="name" id="name" class="form-control" value="<?=$name?>">
       </div>

       <div class="form-group">
          <label> Description</label><br>
          <textarea name="des" rows="6" cols="50" class="form-control"><?=$description?></textarea>
       </div>

       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg">Add</button>
        </div>

</div>
</form>
</div>