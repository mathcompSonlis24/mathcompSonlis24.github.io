<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Protection</title>
</head>
<body>

<form action="opening.php" method="post" onsubmit="return validatePassword()">
    <label for="password">Enter Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Submit</button>
</form>

<script>
    function validatePassword() {
        var enteredPassword = document.getElementById('password').value;
        var correctPassword = "SoNLiS2empat";

        if (enteredPassword === correctPassword) {
            return true; // Allow form submission and redirect
        } else {
            alert("Incorrect password! Please try again.");
            return false; // Prevent form submission
        }
    }
</script>

</body>
</html>
