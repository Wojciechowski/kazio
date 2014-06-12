<?php
//ini_set( 'display_errors', 'On' );
//error_reporting( E_ALL );
include './protected/config/common.conf.php';
include './protected/config/routes.conf.php';
include './protected/config/db.conf.php';

#Just include this for production mode
include $config['BASE_PATH'].'Doo.php';
include $config['BASE_PATH'].'app/DooConfig.php';

Doo::conf()->set($config);

# remove this if you wish to see the normal PHP error view.
include $config['BASE_PATH'].'diagnostic/debug.php';

# database usage
Doo::db()->setMap($dbmap);
Doo::db()->setDb($dbconfig, $config['APP_MODE']);
Doo::db()->sql_tracking = true; #for debugging/profiling purpose

Doo::app()->route = $route;

# Uncomment for DB profiling
Doo::app()->run();

?>