<?php
require_once __dir__. '/controller/User.php';
require_once __dir__.'/model/database.php';
require_once __dir__.'/controller/User.php';
require_once __dir__.'/controller/PageController.php';
require_once __dir__.'/controller/ImageController.php';
require_once __dir__.'/controller/SiteController.php';
require_once __dir__.'/controller/UserEndController.php';
require_once __dir__.'/controller/setting.php';
require_once __dir__.'/controller/PostController.php';
require_once __dir__.'/controller/sliderController.php';
require_once __dir__.'/controller/Pagination.php';


global $server_root;
global $site_name;
global $footer;
$page = $_GET['page'] ? $_GET['page'] : 'dashboard';
$title = ucfirst($page);
$page = $page . '.php';

?>
<?php if(isset($_SESSION['login']) == "login" && isset($_SESSION['user'])=="user") {?>
<?php require_once __dir__.'/view/layouts/header.php' ?>

<?php
$fileName = __dir__.'/view/' . $page;

if (file_exists($fileName) && is_file($fileName)) {
    require_once $fileName;
} else {
    // require_once __dir__.'/view/layouts/404.php';
    $redirect_path = $server_root.'admin';				
	header("Location:$redirect_path");
}
?>

<?php require_once __dir__.'/view/layouts/footer.php' ?>

<?php }else{
	$redirect_path = $server_root.'admin/login.php';				
	header("Location:$redirect_path");
} ?>
