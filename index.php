<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <title>Wallpapers</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/lightbox-2.5.1.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/decoder-lite.css" />
  <link rel="alternate" type="application/rss+xml" title="RSS feed" href="rss.php" />
  <script type="text/javascript" src="js/jquery-min-1.7.2.js"></script>
  <script type="text/javascript" src="js/lightbox-2.5.1.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/gaq.js"></script>
  <script type="text/javascript" src="js/external.js"></script>
  <script type="text/javascript" src="js/hover.js"></script>
</head>

<body>

  <div class="header">
    <h1 id="top">Wallpapers</h1>
    <hr />
  </div>

  <div class="content">
    <p>
      These are wallpapers made by me (@dword1511), mostly from photos I took.<br />
      <em>
        Note: images may have been edited or cropped, and extra lenses and filters may have been applied.
        Therefore values for F number, shutter speed, ISO speed and focal length may not
        represent real ones. They are extracted from the EXIF information of the original photos.
      </em><br />
      If you want a copy of the original photos, please contact me with the information at
      <a rel="external" href="http://blog.dword1511.info/?page_id=2">the about page on my blog</a>.
      <br />
      <a href="#license">License information</a>
      <a href="rss.php">RSS Feed</a>
    </p>
    <hr />

    <table>
      <tbody>
<?php

if(($handle = fopen("catalog.csv", "r")) !== FALSE) {
  $row = 1;
  $data = fgetcsv($handle);

  while(($data = fgetcsv($handle)) !== FALSE) {
    if(count($data) >= 9) {
      $row ++;
      if($row % 2 == 0) $class = "even";
      else $class = "odd";

      $hash  = $data[0];
      $date  = $data[1];
      $place = $data[2];
      $cam   = $data[3];
      $res   = $data[4];
      $fnum  = $data[5];
      $shut  = $data[6];
      $iso   = $data[7];
      $f35mm = $data[8];

      $place = str_replace('|', ',', $place);

      echo '
<tr class="'.$class.'" id="wp_'.$hash.'">
  <td class="thumb">
    <a href="output/'.$hash.'.jpg" rel="lightbox[wallpapers]">
      <img alt="Thumbnail of '.$hash.'.jpg" src="output/'.$hash.'-thumb.jpg" />
      <img alt="Click to enlarge" class="hint" src="lightbox-images/mark.png" />
    </a>
  </td>
  <td class="shrink">
    <table class="emptybg">
      <tbody>
        <tr>
          <th title="yyyy-mm-dd in UTC+8">Date:</th>
          <td class="left">'.$date.'</td>
          <th title="last 2 letters are country code">Place:</th>
          <td class="right">'.htmlentities($place).'</td>
        </tr>
        <tr>
          <th title="make &amp; model">Camera:</th>
          <td class="left">'.htmlentities($cam).'</td>
          <th title="width x height, pixels">Size:</th>
          <td class="right">'.$res.'</td>
        </tr>
        <tr>
          <th>F number:</th>
          <td class="left">'.$fnum.'</td>
          <th title="exposure time">Shutter:</th>
          <td class="right">'.$shut.'</td>
        </tr>
        <tr>
          <th>ISO:</th>
          <td class="left">'.$iso.'</td>
          <th title="in full frame (35mm) unless otherwise specified">Focal length:</th>
          <td class="right">'.$f35mm.'</td>
        </tr>
      </tbody>
    </table>
    <p class="dl">
      &bull; <a href="getfile.php?u=output/'.$hash.'.jpg">Save</a>
      &bull; <a href="#wp_'.$hash.'">Link</a>
    </p>
  </td>
</tr>
';
    }
  }
}
else echo 'Error: Missing catalog.';

?>

      </tbody>
    </table>
    <p><a href="#top">Back to top</a></p>
  </div>

  <div class="footer" id="license">
    <table class="shrink">
      <tbody>
        <tr>
          <td class="shrink">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">
              <img alt="Creative Commons License" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" />
            </a>
          </td>
          <td class="shrink">
            Copyright &copy; <a rel="external" href="http://dword1511.info">dword1511.info</a>
            <br />
            This page and the wallpapers are licensed under the <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons BY-NC-SA 3.0 Unported License</a>.
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
