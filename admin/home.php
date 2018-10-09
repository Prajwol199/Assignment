<?php
require_once '../admin/controller/database.php';
require_once '../admin/controller/User.php';


$page = $_GET['page'] ? $_GET['page'] : 'dashboard';
$title = ucfirst($page);
$page = $page . '.php';

?>
<?php if(isset($_SESSION['login']) == "login" && isset($_SESSION['user'])=="user") {?>
<?php require_once '../admin/view/layouts/header.php' ?>

<?php
$fileName = '../admin/view/' . $page;

if (file_exists($fileName) && is_file($fileName)) {
    require_once $fileName;
} else {
    require_once'../admin/view/layouts/404.php';
}
?>

<?php require_once '../admin/view/layouts/footer.php' ?>

<?php }else{
	header('Location:login.php');
} ?>

