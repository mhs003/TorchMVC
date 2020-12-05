<?php
class Skin{
  public static function get($file){
    ob_start();
    require(__DIR__."/../Views/{$file}.php");
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }
}