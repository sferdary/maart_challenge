<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./app/config/Path.php');
session_start();
$_SESSION['_csrf'] = bin2hex(random_bytes(32));

if ($_SERVER['REQUEST_METHOD']==='POST'){
	if(!isset($_POST['_csrf']) || $_POST['_token'] !== $_SESSION['_csrf']){
		header("Location: ?url=index&error=you");
	}
}

require_once(HEADER);
if (!file_exists(PAGES . url . php) && !file_exists(PAGES . 'Auth/' . url . php) && !file_exists(PAGES . 'Admin/' . url . php) && !file_exists(PAGES . 'Admin/essentials/' . url . php)) {
    (url == null) ? header("Location: ".ROOT."?url=index") : require_once(ERROR . '404.php');
}
require_once(WEB);
require_once(FOOTER);

