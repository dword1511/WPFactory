<?php

error_reporting(E_ALL ^ E_NOTICE);

function sort_date($a, $b) {
  return $a[1] < $b[1];
}

if(($handle = fopen("catalog.csv", "r")) !== FALSE) {
  // Skip header
  $data   = fgetcsv($handle);
  $item[] = array();

  while(($data = fgetcsv($handle)) !== FALSE) {
    if(count($data) >= 9) {
      // Place modifications
      $data[2]  = str_replace('|', ',', $data[2]);

      $item[] = $data;
    }
  }

  usort($item, 'sort_date');

  $output = '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:atom="http://www.w3.org/2005/Atom"
>
  <channel>
    <title>Wallpapers @ dword1511.info</title>
    <atom:link href="http://dword1511.info/dword/wallpapers/rss.php" rel="self" type="application/rss+xml" />
    <link>http://dword1511.info/dword/wallpapers/</link>
    <description>Wallpapers made by dword1511</description>
    <language>en-us</language>
';
  foreach ($item as $line) {
    if($line[0] != NULL) $output .= '
<item>
  <title>'.$line[1].', '.htmlentities($line[2]).'</title>
  <link>http://dword1511.info/dword/wallpapers/#'.$line[0].'</link>
  <description>New wallpaper</description>
  <pubDate>'.date("D, d M o H:i:s +0800", strtotime($line[1])).'</pubDate>
  <guid>http://dword1511.info/dword/wallpapers/#'.$line[0].'</guid>
  <content:encoded>
    <![CDATA[
      <p>
        <img src="http://dword1511.info/dword/wallpapers/output/'.$line[0].'-thumb.jpg" alt="Thumbnail of '.$line[0].'.jpg" />
        <ul>
          <li><strong>Date: </strong>'.$line[1].'</li>
          <li><strong>Place: </strong>'.$line[2].'</li>
          <li><strong>Camera: </strong>'.$line[3].'</li>
          <li><strong>Resolution: </strong>'.$line[4].'</li>
          <li><strong>F number: </strong>'.$line[5].'</li>
          <li><strong>Exposure time: </strong>'.$line[6].'</li>
          <li><strong>ISO speed: </strong>'.$line[7].'</li>
          <li><strong>35mm equivalent focal length: </strong>'.$line[8].'</li>
        </ul>
        <a href="http://dword1511.info/dword/wallpapers/#'.$line[0].'">See details</a>
      </p>
    ]]>
  </content:encoded>
</item>
';
  }
  $output .= '
  </channel>
</rss>
';

  header("Content-Type: text/xml");
  echo $output;
}
else {
  header(500, 'Internal Server Error');
  echo 'Data file is missing.';
}

?>