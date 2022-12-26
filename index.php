<?php

require __DIR__ . '/autoloader.php';
require __DIR__ . '/functions.php';

use Session\Auth;

Auth::init();

if (!isset($_GET['page']) || empty($_GET['page'])) {
    $_GET['page'] = 'index';
}
$page = $_GET['page'];

// cek apakah /src/views/$page.php ada
if (file_exists(__DIR__ . '/src/views/' . $page . '.php')) {
    require __DIR__ . '/src/views/' . $page . '.php';
} else {
    require __DIR__ . '/src/views/404.php';
}

?>