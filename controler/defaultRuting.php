<?php
include('./extrass/Rute.php');
use Steampixel\Route;

include_once('./views/Post.php');
 include_once('./views/singlePost.php');
 include_once('./controler/AdminController.php');
 include_once('./controler/GetPost.php');
 $Layout = file_get_contents('./views/Layout.html');

function render($renderData){
 $page = str_replace('%%DATA%%',$renderData,$GLOBALS['Layout']); 
 return $page;
}







Route::add('/admin', function() {
 include_once('./views/Admin.php');
});
Route::add('/post/([0-9]*)', function($id) {

  ob_start();
  singlePost($id);
  $var = ob_get_clean();
  echo render($var);
 
 
});
Route::add('/', function() {
  
  ob_start();
  require('./views/PostWall.php');
  $var = ob_get_clean();
  echo render($var);

 
});

/*
Route::add('/admin', function() {
 ob_start();
 require('./views/Admin.php');
 $var = ob_get_clean();
 echo render($var);
 
});
*/
Route::add('/auth', function() {
  ob_start();
  require('./controler/auth.php');
  $var = ob_get_clean();
  echo $var;

   
  },'post');

Route::add('/upload', function() {
 uploadPost();
},'post');

Route::add('/get', function() {
getPost();
 
},'post');


///DEFAULT
Route::add('/(.*)', function() {

  ob_start();
  require('./views/PostWall.php');
  $var = ob_get_clean();
  echo render($var);

 
});
// Run the router
Route::run('/');
?>