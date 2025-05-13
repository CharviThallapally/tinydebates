<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Debate</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to the CSS file -->
</head>
<body>
    <header>
        <h1>Create a New Debate</h1>
    </header>
    <div class="container">
        <form action="create_debate.php" method="POST">
            <label for="question">Debate Question:</label>
            <input type="text" id="question" name="question" required>
            
            <label for="option1">Option 1:</label>
            <input type="text" id="option1" name="option1" required>
            
            <label for="option2">Option 2:</label>
            <input type="text" id="option2" name="option2" required>
            
            <input type="submit" value="Create Debate">
        </form>
    </div>
    <footer>
        <p>&copy; 2025 TinyDebates</p>
    </footer>
</body>
</html>
