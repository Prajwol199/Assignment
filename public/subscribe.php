<?php

$suscribe = new UserEndCOntroller();
if(isset($_POST['suscribe'])){
  $message = $suscribe->suscriber_me();
}
?>
<div class=" col-md-12 col-md-offset-4">
  <div class="col-md-3"><br>
    <?php
    if(isset($message)){?>
        <div class="alert alert-danger" id="error" style="color:red;"><?= $message ?></div>
    <?php } ?>
    <div class="error" id="error" style="color:red;"></div>
    <form method="post" name="pageForm">
        <div class="form-group">
          <label for="email"> Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
       </div>
       <div class="form-group">
          <button class="btn btn-success" name="suscribe">Suscribe</button>
      </div>
    </form>
  </div>
</div>