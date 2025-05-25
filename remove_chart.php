<?php
$screen = (int)$_POST['screen'];
$index = (int)$_POST['index'];
$file = "layout_screen{$screen}.json";

if (file_exists($file)) {
  $data = json_decode(file_get_contents($file), true);
  array_splice($data, $index, 1);
  file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

header("Location: controller.php");
?>