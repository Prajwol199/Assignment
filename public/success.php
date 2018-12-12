<?php if(isset($_SESSION['success']) == "success") {?>
	<div class="alert alert-success">
		<h1 align="center">Success!</h1>
		<h3 align="center">Thank You <?php echo ucfirst($_SESSION['name'])?> for contacting us. We’ll get back to you soon. </h3>
	</div>
	<?php unset($_SESSION['success']) ?>
<?php }elseif ( isset($_SESSION['subscribe']) == "subscribe") {?>
		<div class="alert alert-success">
		<h1 align="center">Success!</h1>
		<h3 align="center">Thank You for subscribing.</h3>
	</div>
	<?php unset($_SESSION['subscribe']) ?>
<?php } else{ 
	header('Location:http://localhost/cms');
}