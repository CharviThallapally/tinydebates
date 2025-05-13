<?php
include 'db.php';

$sql = "SELECT * FROM debates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['question'] . "</h2>";
        echo "<form action='vote.php' method='POST'>";
        echo "<input type='radio' name='vote_option' value='1' required> " . $row['option1'] . "<br>";
        echo "<input type='radio' name='vote_option' value='2' required> " . $row['option2'] . "<br>";
        echo "<input type='hidden' name='debate_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Vote'>";
        echo "</form>";
        echo "</div><hr>";
    }
} else {
    echo "No debates available.";
}
?>
