<?php
// Global constants

define('APP_NAME', env('APP_NAME'));
define('SHORT_NAME', env('SHORT_NAME'));
define('DS',DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(__DIR__.DS."../.."));
define('APP_PATH', realpath(ROOT_PATH . DS . 'app'));
define('PUBLIC_PATH',realpath(ROOT_PATH . DS . 'html'));