<?php
session_start();
error_reporting(E_ALL);

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CONTROLLER_PATH', ROOT.'/backend/controllers/');
define('MODEL_PATH', ROOT.'/backend/models/');
define('VIEW_PATH', ROOT.'/backend/views/');

set_include_path(get_include_path().PATH_SEPARATOR."backend/config".PATH_SEPARATOR."backend/controllers".PATH_SEPARATOR."backend/models".PATH_SEPARATOR."backend/views");
spl_autoload_register(function ($class) {
    include  $class . '.php';
});

require_once('route.php');
require_once MODEL_PATH. 'BaseModel.php';
require_once VIEW_PATH. 'View.php';
require_once CONTROLLER_PATH. 'BaseController.php';

Routing::buildRoute();