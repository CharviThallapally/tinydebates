<?php
include 'db.php';

// Fetch all debates from the database
$sql = "SELECT * FROM debates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote for a Debate</title>
</head>
<body>
    <h1>Vote for a Debate</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?php echo $row['question']; ?></h3>
            <form action="vote.php" method="POST">
                <input type="hidden" name="debate_id" value="<?php echo $row['id']; ?>">
                <label>
                    <input type="radio" name="vote_option" value="1" required>
                    <?php echo $row['option1']; ?>
                </label><br>
                <label>
                    <input type="radio" name="vote_option" value="2" required>
                    <?php echo $row['option2']; ?>
                </label><br><br>
                <input type="submit" value="Vote">
            </form>
        </div>
    <?php endwhile; ?>
</body>
</html>
