<?php
require_once __dir__.'/../admin/controller/setting.php';
require_once __dir__.'/../admin/controller/ImageCOntroller.php';
require_once __dir__.'/../admin/controller/UserEndController.php';
require_once __dir__.'/../admin/controller/RequestQuoteController.php';

global $server_root;
global $site_name;
global $footer;

// echo($_GET['page']);


// $page = $_GET['page'] ? $_GET['page'] : 'home';
$page = $_GET['page'];

$title = ucfirst($page);
$page = $page . '.php';
?>
<?php require_once __dir__.'/header.php' ?>
<?php
$fileName = __dir__ .'/'. $page;

if (file_exists($fileName) && is_file($fileName)) {
    require_once $fileName;
} else {
    echo "Page not found";
}
?>


<?php require_once __dir__.'/footer.php' ?>