<?php 
if(php_sapi_name()!='cli' && !defined('SECURE')) exit('<h1>Access Denied</h1>'); 
/***** Settings "********/
define("PROJECT_NAME","MPM_PROJECT");
define("UPLOAD_PATH",'uploads/');
/* Database  Configurations */
define('DATABASE',[
  'username' => "root",
  'password' => "root",
  'host'     => "0.0.0.0:3306",
  'database' => "Testdb",//databasse name;
  'load_files'=>array('mpm/auth/User.sql'),
]);

define("LOGIN_REDIRECT_URL","home");
define("LOGOUT_REDIRECT_URL","home");
define("AUTH_USER_MODEL","User");