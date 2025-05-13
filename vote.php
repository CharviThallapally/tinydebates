<?php
include 'db.php';

// Get the debate ID from the URL
$debate_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($debate_id === 0) {
    die("Invalid debate ID.");
}

// Fetch debate data
$sql = "SELECT * FROM debates WHERE id = $debate_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Debate not found.");
}

$row = $result->fetch_assoc();
$option1_votes = 0;
$option2_votes = 0;

// Handle vote submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['option'])) {
    $option = $_POST['option'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Prevent multiple votes from same IP for the same debate
    $check_sql = "SELECT * FROM votes WHERE debate_id = $debate_id AND ip_address = '$ip_address'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows === 0) {
        $vote_sql = "INSERT INTO votes (debate_id, selected_option, ip_address) VALUES ($debate_id, '$option', '$ip_address')";
        $conn->query($vote_sql);
        echo "<p style='color: green;'>Thank you for voting!</p>";
    } else {
        echo "<p style='color: red;'>You have already voted!</p>";
    }
}

// Count votes
$count_sql = "SELECT selected_option, COUNT(*) as total FROM votes WHERE debate_id = $debate_id GROUP BY selected_option";
$count_result = $conn->query($count_sql);

while ($vote = $count_result->fetch_assoc()) {
    if ($vote['selected_option'] === 'option1') {
        $option1_votes = $vote['total'];
    } elseif ($vote['selected_option'] === 'option2') {
        $option2_votes = $vote['total'];
    }
}

$total_votes = $option1_votes + $option2_votes;
$option1_percentage = ($total_votes > 0) ? round(($option1_votes / $total_votes) * 100, 2) : 0;
$option2_percentage = ($total_votes > 0) ? round(($option2_votes / $total_votes) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vote on Debate</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Optional CSS -->
</head>
<body>
    <h1>Vote on Debate</h1>
    <h2><?php echo $row['question']; ?></h2>

    <p>Option 1: <?php echo $row['option1']; ?> - <?php echo $option1_votes; ?> votes (<?php echo $option1_percentage; ?>%)</p>
    <p>Option 2: <?php echo $row['option2']; ?> - <?php echo $option2_votes; ?> votes (<?php echo $option2_percentage; ?>%)</p>

    <form method="POST">
        <label><input type="radio" name="option" value="option1" required> <?php echo $row['option1']; ?></label><br>
        <label><input type="radio" name="option" value="option2" required> <?php echo $row['option2']; ?></label><br><br>
        <button type="submit">Vote</button>
    </form>
</body>
</html>
