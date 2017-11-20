<?php
require 'common.php';
require 'Weather.php';
require 'User.php';

$content = '';

$act = !empty($_REQUEST['act']) ? $_REQUEST['act'] : 'home';

$filename = './actions/' . basename($act) . '.php';
if (!file_exists($filename)) {
    $filename = './actions/404.php';
}

ob_start();
require $filename;
$content = ob_get_clean();

require 'template.php';
//test commit

