<?php

include "topline.php";
include "config.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_URL, $xbmcjsonservice);

//clear audio playlist
if(!empty($_GET['argument1']))
{
  $data = '{"jsonrpc": "2.0", "method": "AudioPlaylist.Clear", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  $array = json_decode(curl_exec($ch),true);
}

echo "<div id=\"content\"><p>";

//prepare the field values being posted to the service
echo "AudioPlaylist.GetItems:<br><br>";
$audioplaylistdata = '{"jsonrpc": "2.0", "method": "AudioPlaylist.GetItems", "id": 1}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $audioplaylistdata);
$audioplaylistarray = json_decode(curl_exec($ch),true);
$audioplaylistresults = $audioplaylistarray['result'];
if (array_key_exists('items', $audioplaylistresults))
{
  $results = $audioplaylistresults['items'];
  foreach ($results as $value)
  {
    $inhoud = $value['file'];
    echo $inhoud;
    echo "<br>";
  }
}

echo "<br>";

//prepare the field values being posted to the service
echo "VideoPlaylist.GetItems :<br><br>";
$videoplaylistdata = '{"jsonrpc": "2.0", "method": "VideoPlaylist.GetItems", "id": 1}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $videoplaylistdata);
$videoplaylistarray = json_decode(curl_exec($ch),true);
$videoplaylistresults = $videoplaylistarray['result'];

if (array_key_exists('items', $videoplaylistresults))
{
  $results = $videoplaylistresults['items'];
  foreach ($results as $value)
  {
    $inhoud = $value['label'];
    echo $inhoud;
    echo "<br>";
  }
}

echo "<br>";

//clear audio playlist
echo "<a href=getplaylist.php?argument1=clearplaylist>Clear Playlist</a><br>\n";

echo "</p></div>";

include "downline.php";

?>

