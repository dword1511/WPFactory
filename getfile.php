<?php

if($_GET["u"] != NULL) $file = $_GET["u"];
else {
  echo 'Parameter not set.';
  die();
}

if(!file_exists($file)) {
  echo 'File not found :(';
}
else {
  $path = explode('/', $file);
  $fn   = end($path);
  $segs = explode('.', $fn);
  $ext  = end($segs);

  if($ext != 'jpg') {
    echo 'Grab the source code at https://github.com/dword1511/WPFactory/';
    die();
  }

  header('Cache-Control: public');
  header('Content-Description: File Transfer');
  header('Content-Disposition: attachment; filename='.$fn);
  header('Content-Type: application/octet-stream');
  header('Content-Transfer-Encoding: binary');

  readfile($file);
}

?>