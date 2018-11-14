<?php

$select_page = new UserEndController();
$pages = $select_page->page_info();

foreach ($pages as $key => $value) {
	$name = $value['name'];
	$description = $value['description'];
}

$image = $select_page->select_image();
?>

<div class="col-md-12" style="background-color: #bbc0c4">
	<h1 align="center" style="font-size: 40px;"><b><?= $name ?></b></h1>

	<div class="description">
		<p align="center"><?= $description ?></p>
	</div>
</div>

<?php if(count($image)>0) {?>
	<?php foreach ($image as $key => $value) {?>
		<?php if (count($image) == 1) { ?>
			<div class="col-md-12 display_page">
				<a href="<?= $server_root ?>admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="<?= $name ?>"><img src="<?= $server_root ?>admin/static/images/cropImage/<?= $value['crop'] ?>" width="300" height="250" class="center"><br></a>
			</div>
		<?php } elseif (count($image) == 2) { ?>
			<div class="col-md-6 display_page">
				<a href="<?= $server_root ?>admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="<?= $name ?>"><img src="<?= $server_root ?>admin/static/images/cropImage/<?= $value['crop'] ?>" width="300" height="250" class="center"><br></a>
			</div>
		<?php }else{ ?>
			<div class="col-md-4 display_page">
				<a href="<?= $server_root ?>admin/static/images/pageImage/<?= $value['image'] ?>" data-lightbox="<?= $name ?>"><img src="<?= $server_root ?>admin/static/images/cropImage/<?= $value['crop'] ?>" width="300" height="250" class="center"><br></a>
			</div>
		<?php } ?>
	<?php } ?>
<?php }else{ ?>
	    <div class="alert alert-success">
        	<h1 align="center">Image not found</h1>
        </div>
     <?php } ?>