<?php
$screen = (int)$_POST['screen'];
$url = trim($_POST['url']);
$file = "layout_screen{$screen}.json";

$existing = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$existing[] = [
  "url" => $url
];

file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));
header("Location: controller.php");
?>