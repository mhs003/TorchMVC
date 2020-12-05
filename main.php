<?php
include('./Autoload.php');

Route::add('/', function(){
  echo Skin::get('index');
});

Route::add('/say_hello', function(){
  echo Skin::get('index');
}, 'post');

Route::add('/test', function(){
  echo Skin::get('test');
});

Route::run('/');
