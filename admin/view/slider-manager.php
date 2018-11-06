<?php
$select_slider = new SliderController();
$field = $select_slider->select_slider();

if(isset($_POST['delete-slider'])){
  $select_slider->delete_slider();
}
?>
<div class="col-md-12">
  <div class="col-md-6">
    <?php if(count($field)>0) :?>
      <h1 align="center">Slider</h1>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
     <a style="color:white;" href="<?=$server_root?>admin/home/add-slider"><button class="btn btn-warning btn btn-lg btn pull-right"><i class="glyphicon glyphicon-plus"></i> Add New Slider
    </button></a>
  </div>
</div>

<table class="table">
  <tr>
    <th>S.N</th>
    <th>Title</th>
    <th>Description</th>
    <th>Action</th>
    <th>Image</th>
  </tr>
   <?php 
        foreach ($field as $key => $value) { ?>
          <tr>
            <td><?=$key+1?></td>
            <td><?= $value['title']; ?></td>
            <td><?= $value['description']; ?></td>
            <td>
              <form method="post">
              <button type="submit" name='delete-slider' value="<?= $value['id']?>" class="btn btn-danger" onclick="return confirm('are you sure delete')"><i class="glyphicon glyphicon-trash"></i> Delete</button> </form>
              <a href="<?=$server_root?>admin/home/edit-slider/<?= $value['id']?>"><button class="btn btn-success btn-md"><i class="glyphicon glyphicon-edit"></i> Edit
              </button></a>
            </td>
            <td><img src="<?=$server_root?>admin/static/images/sliderImage/<?=$value['image']?>" width="100" ></td>
          </tr>
    <?php } ?>
</table>
