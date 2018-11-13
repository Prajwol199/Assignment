<?php
  if(!isset($_GET['id'])){
    $page = 1;
  }else{
    $page = $_GET['id'];
  }
  $select_post_page = new Pagination();
  $all_post = $select_post_page->view_all_post($page);
  $pagebar = $select_post_page->admin_post_bar();
    foreach ($pagebar as $key => $value) {
    $row = $value['pagination'];
  }

	$select_post = new PostController();

	if(isset($_POST['delete-post'])){
		$select_post->delete_post();
	}
	if(isset($_POST['deactive'])){
		$select_post->deactive_post();
	}
	if(isset($_POST['active'])){
		$select_post->active_post();
	}
?>
<div class="content">
  <div class="col-md-12">
    <div class="col-md-6">
      <?php if(count($all_post)>0) :?>
        <h1 align="center">Posts</h1>
      <?php endif; ?>
    </div>
    <div class="col-md-6">
       <a style="color:white;" href="<?=$server_root?>admin/home/add-post"><button class="btn btn-warning btn btn-lg btn pull-right"><i class="glyphicon glyphicon-plus"></i> Add New Post
      </button></a>
    </div>
  </div>

  <?php if(count($all_post) > 0) {?>
  <table class="table">
    <tr>
      <th>S.N</th>
      <th>Title</th>
      <th>Content</th>
      <th>SEO Title</th>
      <th>Meta title</th>
      <th>Meta Keyword</th>
      <th>Added Date</th>
      <th>Is Active</th>
      <th>Action</th>
      <th>Image</th>
    </tr>
  <?php 
      foreach ($all_post as $key => $value) { ?>
       <tr>
        <td><?=$key+1?></td>
        <td><?= $value['title']; ?></td>
        <td><?= $value['content']; ?></td>
        <td><?= $value['seo_title']; ?></td>
        <td><?= $value['meta_title']; ?></td>
        <td><?= $value['meta_keyword']; ?></td>
        <td><?= $value['date']; ?></td>
        <td>
        	<?php 
        	$val = $value['isactive'];
        	if($val == 1){?>
        		<form method="post">
        		<button type="submit" name='deactive' value="<?= $value['id']?>" class="btn btn-danger">DeActive</button>
        		</form>
        	<?php }else{?>
        		<form method="post">
        		<button type="submit" name='active' value="<?= $value['id']?>" class="btn btn-primary">Active</button>
        		</form>
        	<?php }	?>
        	
        </td>
        <td>
        	<form method="post">
              <button type="submit" name='delete-post' value="<?= $value['id']?>" class="btn btn-danger" onclick="return confirm('are you sure delete')"><i class="glyphicon glyphicon-trash"></i> Delete</button> </form>
              <a href="<?=$server_root?>admin/home/edit-post/<?= $value['id']?>"><button class="btn btn-success btn-md"><i class="glyphicon glyphicon-edit"></i> Edit
              </button></a>
        </td>
        <td>
        	 <a href="<?=$server_root?>admin/home/view-post-image/<?= $value['id']?>"><button class="btn btn-primary btn-md"><i class="glyphicon glyphicon-eye-open"></i>
               View Image
            </button></a>
        </td>
    	</tr>
   <?php }?>
  </table>
  <?php }else{ ?>
  	<h1 align="center">Post Not Found</h1>
  <?php } ?>

  <?php if($row > $limit){;?>
    <div class="pagination">
      <?php if($page > 1) { ?>
        <a href="<?=$server_root?>admin/home/post-manager/<?= ($page-1) ?>">&laquo;</a>
      <?php } ?>
      <?php 
        $display_page = ceil($row/$limit);
        for($i=1;$i<=$display_page;$i++){?>
      <a href="<?=$server_root?>admin/home/post-manager/<?=$i?>"
        <?php
          if($page == $i ){?>
          class="active" 
        <?php } ?>
        ><?=$i?></a>
      <?php } if($page < $display_page) { ?>
      <a href="<?=$server_root?>admin/home/post-manager/<?= ($page+1)?>">&raquo;</a>
      <?php }?>
    </div>
  <?php }?>
</div>