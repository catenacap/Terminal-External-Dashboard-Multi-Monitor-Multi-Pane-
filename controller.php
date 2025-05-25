<?php
$screenFiles = [
  1 => 'layout_screen1.json',
  2 => 'layout_screen2.json',
  3 => 'layout_screen3.json'
];

$layouts = [];
foreach ($screenFiles as $screen => $file) {
  $layouts[$screen] = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Terminal External Dashboard Controller</title>
  <style>
    body { background: #111; color: white; font-family: sans-serif; padding: 20px; }
    input, select, button { margin: 5px; padding: 5px; }
    .entry { margin: 10px 0; }
    table { width: 100%%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #444; }
    th { background: #222; }
  </style>
</head>
<body>
  <h1>Terminal Exteral Dashboard Controller</h1>

  <form method="POST" action="save_chart.php">
    <input name="url" placeholder="Chart URL" style="width: 400px;" required />
    <select name="screen">
      <option value="1">Screen 1</option>
      <option value="2">Screen 2</option>
      <option value="3">Screen 3</option>
    </select>
    <button type="submit">➕ Add Chart</button>
  </form>

  <h2>🧩 Existing Charts</h2>
  <?php foreach ($layouts as $screen => $charts): ?>
    <h3>Screen <?= $screen ?> <a href="screen<?= $screen ?>.html" target="_blank">[Open]</a></h3>
    <table>
      <tr><th>#</th><th>URL</th><th>Actions</th></tr>
      <?php foreach ($charts as $i => $chart): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($chart['url']) ?></td>
          <td>
            <form method="POST" action="remove_chart.php" style="display:inline;">
              <input type="hidden" name="screen" value="<?= $screen ?>">
              <input type="hidden" name="index" value="<?= $i ?>">
              <button type="submit">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endforeach; ?>
</body>
</html>