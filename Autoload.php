<?php
spl_autoload_register(function($class){
  require_once("Logic/{$class}.class.php");
});
require_once('Logic/func.php');