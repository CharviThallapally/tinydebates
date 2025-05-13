<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch debates
$sql = "SELECT * FROM debates ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <meta charset="UTF-8">
  <title>All Debates</title>
  <style>
    body { font-family: Arial; padding: 20px; background-color: #f4f4f4; }
    .debate { background: white; padding: 15px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
    .options button { margin-right: 10px; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; }
    .option1 { background-color: #007bff; color: white; }
    .option2 { background-color: #28a745; color: white; }
  </style>
</head>
<body>
  <h1>Welcome to Tiny Debates 🗣️</h1>

  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="debate">
        <h3><?= htmlspecialchars($row['question']) ?></h3>
        <div class="options">
          <form action="vote.php" method="POST" style="display:inline;">
            <input type="hidden" name="debate_id" value="<?= $row['id'] ?>">
            <input type="hidden" name="vote_option" value="1">
            <button type="submit" class="option1"><?= htmlspecialchars($row['option1']) ?></button>
          </form>
          <form action="vote.php" method="POST" style="display:inline;">
            <input type="hidden" name="debate_id" value="<?= $row['id'] ?>">
            <input type="hidden" name="vote_option" value="2">
            <button type="submit" class="option2"><?= htmlspecialchars($row['option2']) ?></button>
          </form>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No debates available. <a href="create_debate.php">Create one?</a></p>
  <?php endif; ?>
</body>
</html>
