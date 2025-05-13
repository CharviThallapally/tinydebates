<?php
include 'db.php';

// Get debate ID from URL parameter
$debate_id = $_GET['id'];

// Fetch the debate details based on ID
$sql = "SELECT * FROM debates WHERE id = $debate_id";
$result = $conn->query($sql);
$debate = $result->fetch_assoc();

// Fetch the total number of votes for each option
$sql_option1_votes = "SELECT COUNT(*) as option1_votes FROM votes WHERE debate_id = $debate_id AND vote_option = 1";
$sql_option2_votes = "SELECT COUNT(*) as option2_votes FROM votes WHERE debate_id = $debate_id AND vote_option = 2";

$option1_votes_result = $conn->query($sql_option1_votes);
$option2_votes_result = $conn->query($sql_option2_votes);

$option1_votes = $option1_votes_result->fetch_assoc()['option1_votes'];
$option2_votes = $option2_votes_result->fetch_assoc()['option2_votes'];

// Calculate the total number of votes
$total_votes = $option1_votes + $option2_votes;

// Calculate percentages for each option
$option1_percentage = ($total_votes > 0) ? round(($option1_votes / $total_votes) * 100, 2) : 0;
$option2_percentage = ($total_votes > 0) ? round(($option2_votes / $total_votes) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debate Results</title>
</head>
<body>
    <h1>Results for: <?php echo $debate['question']; ?></h1>

    <p>Option 1: <?php echo $debate['option1']; ?> - <?php echo $option1_votes; ?> votes (<?php echo $option1_percentage; ?>%)</p>
    <p>Option 2: <?php echo $debate['option2']; ?> - <?php echo $option2_votes; ?> votes (<?php echo $option2_percentage; ?>%)</p>

    <p>Total Votes: <?php echo $total_votes; ?></p>
</body>
</html>
