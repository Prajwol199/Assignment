<?php
  if(!isset($_GET['id'])){
    $page = 1;
  }else{
    $page = $_GET['id'];
  }
  $select_page = new Pagination();
  $field = $select_page->view_all_page($page);
  $pagebar = $select_page->admin_page_bar();
    foreach ($pagebar as $key => $value) {
    $row = $value['pagination'];
  }

$add = new PageController();

if(isset($_POST['delete-page'])){
    $objUser = new PageController();
    $objUser->deletePages();
}

?>
<div class="content">
  <div class="col-md-12">
    <div class="col-md-6">
      <?php if(count($field)>0) :?>
        <h1 align="center">Pages</h1>
      <?php endif; ?>
    </div>
    <div class="col-md-6">
       <a style="color:white;" href="<?=$server_root?>admin/home/add-page"><button class="btn btn-warning btn btn-lg btn pull-right"><i class="glyphicon glyphicon-plus"></i> Add New Page
      </button></a>
    </div>
  </div>
  <?php if(count($field)>0){?>
  <table class="table">
    <tr>
      <th>S.N</th>
      <th>Name</th>
      <th>Description</th>
      <th>Parent_id</th>
      <th>Action</th>
      <th>Image</th>
    </tr>
    <?php 
          foreach ($field as $key => $value) { ?>
            <tr>
            <td><?=$key+1?></td>
            <td><?= $value['name']; ?></td>
            <td><?= $value['description']; ?></td>
            <td><?= $value['parent_id'] ?></td>
            <td>
              <form method="post">
              <button type="submit" name='delete-page' value="<?= $value['id']?>" class="btn btn-danger" onclick="return confirm('are you sure delete')"><i class="glyphicon glyphicon-trash"></i> Delete</button> </form>
              <a href="<?=$server_root?>admin/home/edit/<?= $value['id']?>"><button class="btn btn-success btn-md"><i class="glyphicon glyphicon-edit"></i> Edit
              </button></a>
            </td>
            <td>
              <a href="<?=$server_root?>admin/home/view-image/<?= $value['id']?>"><button class="btn btn-primary btn-md"><i class="glyphicon glyphicon-eye-open"></i>
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

  <?php if($row > $limit){;?>
  <div class="page_display">
    <div class="pagination">
      <?php if($page > 1) { ?>
        <a href="<?=$server_root?>admin/home/page-manager/<?= ($page-1) ?>">&laquo;</a>
      <?php } ?>
      <?php 
        $display_page = ceil($row/$limit);
        for($i=1;$i<=$display_page;$i++){?>
      <a href="<?=$server_root?>admin/home/page-manager/<?=$i?>"
        <?php
          if($page == $i ){?>
          class="active" 
        <?php } ?>
        ><?=$i?></a>
      <?php } if($page < $display_page) { ?>
      <a href="<?=$server_root?>admin/home/page-manager/<?= ($page+1)?>">&raquo;</a>
      <?php }?>
    </div>
  </div>
  <?php }?>
</div>