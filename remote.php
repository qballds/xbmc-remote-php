<?php

include "topline.php";
include "config.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_URL, $xbmcjsonservice);

//prepare the field values being posted to the service
$request = '{"jsonrpc": "2.0", "method": "Player.GetActivePlayers", "id": 1}';
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
$array = json_decode(curl_exec($ch),true);
if (($array['result']['audio']) == 1) { echo "AudioPlayer active"; echo "<br><br>"; }

if(!empty($_GET['action'])) {

if ($_GET['action'] == 'AudioPlaylist.Play') {
  //prepare the field values being posted to the service
  $request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.Play", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
}

if ($_GET['action'] == 'AudioPlaylist.SkipPrevious') {
  //prepare the field values being posted to the service
  $request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.SkipPrevious", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
}

if ($_GET['action'] == 'AudioPlaylist.SkipNext') {
  //prepare the field values being posted to the service
  $request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.SkipNext", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
}

if ($_GET['action'] == 'AudioPlayer.PlayPause') {
  //prepare the field values being posted to the service
  $request = '{"jsonrpc": "2.0", "method": "AudioPlayer.PlayPause", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
  if (($array['result']['paused']) == 1) {echo "Song paused"; echo "<br><br>"; } else { echo "Playing"; echo "<br><br>"; }
}

}

  $request = '{"jsonrpc": "2.0", "method": "XBMC.GetVolume", "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
  echo "Current volume: "; echo $array['result']; echo "<br><br>";
  $decreasevolume = $array['result'] - 10;
  $increasevolume = $array['result'] + 10;

if(!empty($_GET['action'])) {

if ($_GET['action'] == 'Increase.Volume') {
  $request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $increasevolume . ', "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
}

if ($_GET['action'] == 'Decrease.Volume') {
  $request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $decreasevolume . ', "id": 1}';
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
  $array = json_decode(curl_exec($ch),true);
}

}

echo "<a href=remote.php?action=AudioPlaylist.Play>AudioPlaylist.Play</a><br>\n";
echo "<a href=remote.php?action=AudioPlaylist.SkipPrevious>AudioPlaylist.SkipPrevious</a><br>\n";
echo "<a href=remote.php?action=AudioPlaylist.SkipNext>AudioPlaylist.SkipNext</a><br>\n";
echo "<a href=remote.php?action=AudioPlayer.PlayPause>AudioPlayer.PlayPause</a><br>\n";
echo "<a href=remote.php?action=Increase.Volume>Increase.Volume</a><br>\n";
echo "<a href=remote.php?action=Decrease.Volume>Decrease.Volume</a><br>\n";
echo "<a href=getplaylist.php>Playlist</a><br>\n";

include "downline.php";

?>
