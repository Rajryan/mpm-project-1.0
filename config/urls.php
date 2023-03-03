<?php
if(!defined('SECURE')) exit('<h1>Access Denied</h1>'); 
require_once('mpm/functions.php');

/*patterns
array(
    'path'=>"/blog_detail/(?P<id>\d+)/",
    'view'=>'blog/blog_detail.php',
    'name'=>'blog_detail'
  ),*/

$urlpatterns =  [
  ...includes('mpm/admin/urls'),//Admin Urls
  ...includes('mpm/auth/urls'),//Authentication
 array(
  'path'=>'',
  'view'=>'home',
  'name'=>'home',
  ),
];

