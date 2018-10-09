<?php

$add = new User();
$field=$add->getUser();

if(isset($_POST['delete-page'])){
    $objUser = new User();
    $objUser->deleteUsers();
}

?>
<div class="col-md-12">
  <div class="col-md-6">
    <h1 align="center">Pages</h1>
  </div>
  <div class="col-md-6">
     <a style="color:white;" href="home.php?page=add_page"><button class="btn btn-warning btn btn-lg btn pull-right">Add New Page
    </button></a>
  </div>
</div>

<!-- <?php
if (isset($_SESSION['msg'])):?>
<div class="alert alert-success"><i class="glyphicon glyphicon-warning-sign"></i>
<?= $_SESSION['msg']; ?>
</div>
<?php unset($_SESSION['msg']) ?>
<?php endif; ?> -->

<table class="table">
  <tr>
    <th>S.N</th>
    <th>Name</th>
    <th>Description</th>
    <th>Action</th>
    <th>Image</th>
  </tr>
  <?php 
      foreach ($field as $key => $value) { ?>
        <tr>
        <td><?=$key+1?></td>
        <td><?= $value['name']; ?></td>
        <td><?= $value['description']; ?></td>
        <td>
            <form method="post">
            <button type="submit" name='delete-page' value="<?= $value['id']?>" class="btn btn-danger" onclick="return confirm('are you sure delete')">Delete</button> </form>
            <a href="home.php?page=edit&id=<?= $value['id']?>"><button class="btn btn-success btn-md">Edit
            </button></a>
        </td>
        <td>
          <a href="home.php?page=view_image&id=<?= $value['id']?>"><button class="btn btn-primary btn-md">
          View Image
        </button></a>
        </td>
      </tr>
      <?php } ?>
</table>
