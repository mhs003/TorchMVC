<?php
session_start();
spl_autoload_register(function($class){
  require_once($class.'.class.php');
});

function render_template($file, $vars){
  extract($vars);
  ob_start();
  require('static/'.$file.'.php');
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}