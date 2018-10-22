<?php
$selectImg = new ImageController();

$image = $selectImg->selectimage();

?>

<?php if(count($image)>0) {?>
	<?php foreach ($image as $key => $value) {?>
		<div class="col-md-4 " style="padding:30px;">
			<a class="example-image-link" href="../admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="gallery"><img src="../admin/static/images/cropImage/<?= $value['crop'] ?>"  style="padding: 10px;"></a>
		</div>
	<?php } ?>
<?php }else{ ?>
	  	<div class="alert alert-success" style="margin-top:310px;">
            <h1 align="center">Image not found</h1>
     	</div>
      <?php } ?>