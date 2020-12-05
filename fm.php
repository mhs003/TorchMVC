<!DOCTYPE html>
<html>
  <head>
    <title> Manager </title>
    <meta name="viewport" content="width=device-width,intial-scale=1" />
    <style>
      ::-webkit-scrollbar {
        width: 20px;
      }
      ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb {
        background: red;
        border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #b30000;
      }
      body{
        font-family: notoserif-regular, Georgia, sans-serif, cfonts, Times New Roman;
        user-select: none;
        max-width: 600px;
        margin: auto;
      }
      .sp{
        border: 1px solid #03A9F7;
        border-radius: 4px;
        margin: 6px;
      }
      .fold{
        border-color: #03A97F;
      }
      .link{
        color: #03A9F7;
        display: block;
        padding: 3px 5px;
        text-decoration: none;
      }
      .lfol{
        color: #03A97F;
      }
      .tit{
        font-size: 25px;
        color: #03A97F;
        padding: 9px;
        border: 1px solid #03A97F;
        border-bottom: 5px solid #03A97F;
        text-align: center;
        font-weight: bold;
      }
      .front{
        box-shadow: 0 0 6px 1px #575757;
        text-align: center;
        padding: 5px;
        margin: 5px;
        margin-top: 7px;
        color: #575757;
        border-radius: 4px;
      }
      .mlnk{
        color: #1976D2;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="tit"> Manager </div>
<?php
    $main = $_SERVER['SCRIPT_NAME'];
if(isset($_GET['open'])){
  $dir = trim($_GET['open']);
} else {
  $dir = '.';
}
define('CRD', base64_decode("TW9uenVydWwgSGFzYW4="));

if($dir == '.'){
  $cdir = '<a class="mlnk" href="' . $main . '">home://</a>';
} else {
  $cdir = '<a class="mlnk" href="' . $main . '">home://</a>' . $dir;
}
echo '<div class="front" style="text-align: left;"><span style="color: red">Directorey:</span> <span style="color: #43A047">' . $cdir . '</span></div>' . "\n";

$all = scandir($dir);

foreach($all as $m){
  if($m != '.' && $m != '..'){
    if(!is_dir($dir.'/'.$m)){
      $now = ltrim($dir.'/'.$m,'./');
      echo '<div class="sp"><a class="link" href="' . $now . '"> VIEW : ' . $m . '</a></div>' . "\n";
    } else {
      $now = ltrim($dir.'/'.$m,'./');
      echo '<div class="sp fold"><a class="link lfol" href="?open=' . $now . '"> OPEN : ' . $m . '</a></div>' . "\n";
    }
  }
}
?>
    <div class="front"><?php echo CRD ?></div>
  </body>
</html>