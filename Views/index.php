<?php
if(isset($_POST['name'])){
  echo "Hello ".$_POST['name'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Index Page</title>
    <meta name="viewport" content="width=device-width"/>
  </head>
  <body>
    <form method="post" action="/say_hello">
      <input type="text" name="name"/>
      <input type="submit" value="Enter >"/>
    </form>
  </body>
</html>