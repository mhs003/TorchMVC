<?php
error_reporting(0);
require_once('lib/func.php');

$tf = 'download.php';
$if = 'index.php';

$error = $id = $title = $thumbnail = $count_formats = $formats = '';
if(isset($_GET['id'])){
  $id = trim($_GET['id']);
  $logic = new logic();
  $logic->id = $id;
  $vinfo = $logic->getVideoInfo();
  if(!$vinfo['error']){
    $title = $vinfo['title'];
    $thumbnail = $vinfo['thumbnail'];
    $count_formats = count($vinfo['adaptive_formats']);
    $formats = array_merge($vinfo['formats'], $vinfo['adaptive_formats']);
   
    // --- Download
    if(isset($_GET['no']) && isset($_GET['act']) && $_GET['act'] == 'download'){
      $no = (int) $_GET['no'];
      
      $mime = explode('/', $formats[$no]['mimeType']);
      $ext = $mime[1];
      
      $title = str_replace([' ', '?', '/', '\\', '&'], '_', $title).".".$ext;
      
      $url = $formats[$no]['url'];
      $size = $formats[$no]['Content-Length'];

      //$logic->download($title, $url, $size);
      header('location: '.$url);
      exit;
    }
    
  } else {
    $_SESSION['error'] = $vinfo['reason'];
    header('location: '.$if);
  }
} else {
  header('location: '.$if);
}

echo render_template('download',[
  'tf' => $tf,
  'id' => $id,
  'error' => $error,
  'title' => $title,
  'thumbnail' => $thumbnail,
  'count_formats' => $count_formats,
  'formats' => $formats
]);