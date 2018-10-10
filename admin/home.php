<?php
require_once __dir__. '/controller/User.php';
require_once __dir__.'/model/database.php';
require_once __dir__.'/controller/User.php';
require_once __dir__.'/controller/PageController.php';
require_once __dir__.'/controller/ImageController.php';
require_once __dir__.'/controller/setting.php';


global $server_root;
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
    require_once __dir__.'/view/layouts/404.php';
}
?>

<?php require_once __dir__.'/view/layouts/footer.php' ?>

<?php }else{
	header('Location:login.php');
} ?>
