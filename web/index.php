<?php

include_once 'helpers/HttpHelper.php';
include_once 'helpers/global_function.php';
include_once 'helpers/connection.php';
include_once 'helpers/alert.php';
include_once 'config/App.php';

$app = new App();


echo $app->init();