<?php
include 'db.php';

// Fetch all debates
$sql = "SELECT * FROM debates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debate Vote Results</title>
</head>
<body>
    <h1>Debate Vote Results</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?php echo $row['question']; ?></h3>
            
            <?php
            // Fetch the total votes for each option
            $debate_id = $row['id'];
            $sql_votes = "SELECT vote_option, COUNT(*) as vote_count FROM votes WHERE debate_id = $debate_id GROUP BY vote_option";
            $votes_result = $conn->query($sql_votes);
            
            $option1_votes = 0;
            $option2_votes = 0;

            // Assign the votes count for each option
            while ($vote_row = $votes_result->fetch_assoc()) {
                if ($vote_row['vote_option'] == 1) {
                    $option1_votes = $vote_row['vote_count'];
                } elseif ($vote_row['vote_option'] == 2) {
                    $option2_votes = $vote_row['vote_count'];
                }
            }
            ?>

            <p>Option 1: <?php echo $row['option1']; ?> - <?php echo $option1_votes; ?> votes</p>
            <p>Option 2: <?php echo $row['option2']; ?> - <?php echo $option2_votes; ?> votes</p>
        </div>
        <hr>
    <?php endwhile; ?>
</body>
</html>
