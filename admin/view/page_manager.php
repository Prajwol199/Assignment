<?php
$add = new PageController();
$field=$add->getUser();

if(isset($_POST['delete-page'])){
    $objUser = new PageController();
    $objUser->deleteUsers();
}

?>
<div class="col-md-12">
  <div class="col-md-6">
    <?php if(count($field)>0) :?>
      <h1 align="center">Pages</h1>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
     <a style="color:white;" href="<?=$server_root?>admin/home.php?page=add_page"><button class="btn btn-warning btn btn-lg btn pull-right">Add New Page
    </button></a>
  </div>
</div>
<?php if(count($field)>0){?>
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
            <a href="<?=$server_root?>admin/home.php?page=edit&id=<?= $value['id']?>"><button class="btn btn-success btn-md">Edit
            </button></a>
          </td>
          <td>
            <a href="<?=$server_root?>admin/home.php?page=view_image&id=<?= $value['id']?>"><button class="btn btn-primary btn-md">
            View Image
          </button></a>
          </td>
        </tr>
        <?php } ?>
      <?php }else{?>
        <div class="alert alert-success">
            <h1 align="center">Page not found</h1>
        </div>
      <?php } ?>
</table>
