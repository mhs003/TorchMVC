<?php
error_reporting(0);
require_once('lib/func.php');

$tf = 'index.php';
$df = 'download.php';

$error = $url = '';
if(isset($_SESSION['error'])){
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

if(isset($_POST['url'])){
  $url = trim($_POST['url']);
  if(!empty($url)){
    $logic = new logic();
    $id = $logic->getId($url);
    if($id){
      $vinfo = $logic->getVideoInfo();
      if(!$vinfo['error']){
        header('location: '.$df.'?id='.$id);
      } else {
        $error = $vinfo['reason'];
      }
    } else {
      $error = "Url is not valid!";
    }
  } else {
    $error = "Input url must not empty!";
  }
}

echo render_template('main', [
  'tf' => $tf,
  'error' => $error, 
  'url' => $url
]);
