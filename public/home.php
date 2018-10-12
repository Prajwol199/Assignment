<?php
$selectImg = new ImageController();

$image = $selectImg->selectimage();

?>

<?php if(count($image)>0) {?>
	<?php foreach ($image as $key => $value) {?>
		<div class="col-md-4 navbar  navbar-default" style="padding:30px;">
			<img src="../admin/static/images/pageImage/<?= $value['image'] ?>"  style="padding: 10px;"><br>
		</div>
	<?php } ?>
<?php }else{ ?>
	  	<div class="alert alert-success" style="margin-top:310px;">
            <h1 align="center">Image not found</h1>
     	</div>
      <?php } ?>