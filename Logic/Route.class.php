<?php
class Route{
  private static $routes = array();
  private static $noPath = null;
  private static $noEntry = null;

  public static function add($expr, $func, $method = 'get'){
    self::$routes[] = array(
      'expression' => $expr,
      'function' => $func,
      'method' => $method
    );
  }

  public static function noPath($func){
    self::$noPath = $func;
  }

  public static function noEntry($func){
    self::$noEntry = $func;
  }

  public static function run($basepath = '/'){
    $url = parse_url($_SERVER['REQUEST_URI']);

    if(isset($url['path'])){
      $path = $url['path'];
    } else {
      $path = '/';
    }

    $method = $_SERVER['REQUEST_METHOD'];

    $path_match_found = false;
    $route_match_found = false;

    foreach(self::$routes as $route){

      if($basepath != '' && $basepath != '/'){
        $route['expression'] = '('.$basepath.')'.$route['expression'];
      }

      $route['expression'] = '^'.$route['expression'];

      $route['expression'] = $route['expression'].'$';

      if(preg_match('#'.$route['expression'].'#',$path,$matches)){//>>Start2
        $path_match_found = true;

        if(strtolower($method) == strtolower($route['method'])){

          array_shift($matches);

          if($basepath != '' && $basepath != '/'){
            array_shift($matches);
          }

          call_user_func_array($route['function'], $matches);

          $route_match_found = true;

          break;
        }
      }
    }

    if(!$route_match_found){
      if($path_match_found){
        header("HTTP/1.0 405 Method Not Allowed");
        if(self::$noEntry){
          call_user_func_array(self::$noEntry, Array($path, $method));
        }
      } else {
        header("HTTP/1.0 404 Not Found");
        if(self::$noPath){
          call_user_func_array(self::$noPath, Array($path));
        }
      }
    }
  }
}