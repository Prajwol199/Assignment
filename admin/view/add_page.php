<?php

$add = new PageController();
$add->AddUser();
?>


  <div class=" col-md-12 col-md-offset-3">

  <div class="col-md-6">
    <form method="post" enctype="multipart/form-data">
       <div class="form-group">
          <label for="uname"> Page Name</label>
          <input type="text" name="name" id="name" class="form-control">
       </div>

       <div class="form-group">
          <label> Description</label><br>
          <textarea name="des" rows="6" cols="50" class="form-control"></textarea>
       </div>
       <div class="form-group">
          <label> Image</label><br>
          <input type="file" name="file" class="form-control">
       </div>
       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg">Add</button>
        </div>

</div>
</form>
</div>