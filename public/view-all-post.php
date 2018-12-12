<?php
  if(!isset($_GET['id'])){
    $page = 1;
  }else{
    $page = $_GET['id'];
  }
  $select_post = new Pagination();
  $all_post = $select_post->view_post_user($page);
  $pagebar = $select_post->page_bar();
  foreach ($pagebar as $key => $value) {
    $row = $value['pagination'];
  }
?>
<?php if(count($all_post) > 0) {?>
<table class="table">
  <tr>
    <th>S.N</th>
    <th>Title</th>
    <th>Content</th>
    <th>SEO Title</th>
    <th>Meta title</th>
    <th>Meta Keyword</th>
    <th>View</th>
  </tr>
<?php 
    foreach ($all_post as $key => $value) { ?>
     <tr>
      <td><?php echo$key+1?></td>
      <td><?php echo $value['title']; ?></td>
      <td><?php echo $value['content']; ?></td>
      <td><?php echo $value['seo_title']; ?></td>
      <td><?php echo $value['meta_title']; ?></td>
      <td><?php echo $value['meta_keyword']; ?></td>
      <td>
          <a href="<?php echo$server_root?>user/read-more/<?php echo $value['id']?>"><button class="btn btn-primary btn-md"><i class="glyphicon glyphicon-eye-open"></i>
             View Post
          </button></a>
      </td>
  	</tr>
 <?php }?>
</table>
<?php }else{ ?>
	<h1 align="center">Post Not Found</h1>
<?php } ?>

<?php if($row > $limit){;?>
  <div class="page_display">
    <div class="pagination">
      <?php if($page > 1) { ?>
        <a href="<?php echo$server_root?>user/view-all-post/page/<?php echo ($page-1) ?>">&laquo;</a>
      <?php } ?>
      <?php 
        $display_page = ceil($row/$limit);
        for($i=1;$i<=$display_page;$i++){?>
      <a href="<?php echo$server_root?>user/view-all-post/page/<?php echo$i?>"
        <?php
          if($page == $i ){?>
          class="active" 
        <?php } ?>
        ><?php echo$i?></a>
      <?php } if($page < $display_page) { ?>
      <a href="<?php echo$server_root?>user/view-all-post/page/<?php echo ($page+1)?>">&raquo;</a>
      <?php }?>
    </div>
  </div>
<?php }?>