<?php
include('config/config.php');
include($config['include_dir'] . DIRECTORY_SEPARATOR . 'bootstrap.php');

$tv->theme->render('page');
?>
