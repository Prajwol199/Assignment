<?php
$select_page = new UserEndController();
$pages = $select_page->page_info();

foreach ($pages as $key => $value) {
	$name = $value['name'];
	$description = $value['description'];
}

$image = $select_page->select_image();
?>

<div class="col-md-12">
	<h1 align="center"><b><?= $name ?></b></h1>

	<div class="description">
		<p align="center"><?= $description ?></p>
	</div>
</div>

<?php if(count($image)>0) {?>
	<?php foreach ($image as $key => $value) {?>
		<div class="col-md-4" style="padding:30px;">
			<a href="../admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="<?= $name ?>"><img src="../admin/static/images/cropImage/<?= $value['crop'] ?>" width="300" height="250" style="padding: 10px;"><br></a>
		</div>
	<?php } ?>
<?php }else{ ?>
	    <div class="alert alert-success">
        	<h1 align="center">Image not found</h1>
        </div>
     <?php } ?>