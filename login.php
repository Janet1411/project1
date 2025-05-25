
<?php
session_start();

$manager_username = "manager"; 
$hashed_password = '$2y$10$kjEPsQtA92cjxt6n60ft7uSvlLyfI3UcALQU4kVEVIN6HiN2q0Gjq'; // password: 12345

//initialize session variables for login attempts and lockout
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['locked_until'])) {
    $_SESSION['locked_until'] = 0;
}
// Check if the user is locked out
if ($_SESSION['login_attempts'] >= 3) {
    if (time() < $_SESSION['locked_until']) {
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['locked_until'] = 0;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

     // Validate input
    if ($username === $manager_username && password_verify($password, $hashed_password)) {
        session_regenerate_id(true);
        $_SESSION['role'] = 'manager';
        $_SESSION['username'] = $username;
        header("Location: manage.php");
        exit;
    } else {    
        // Increment login attempts and set error message
        $_SESSION['login_attempts'] += 1;
        $remaining = 3 - $_SESSION['login_attempts'];
        $error = $remaining > 0 ? "Invalid credentials. $remaining attempt(s) left." : "Too many attempts. Redirecting...";
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['locked_until'] = time() + 300; 
            $error = "Too many attempts. You are locked out for 5 minutes.";
            header("Refresh: 4; URL=index.php"); 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>Manager Login</title>
</head>
<body>
    <div class="login-card">
        <h1>Manager Login</h1>
        <br>
        <?php if (!empty($error)) echo "<p class = 'failed'> $error </p>"; ?>

        <form method="POST" action="login.php">
            <div class="form-options">
                <label for = "username"> Username: </label><br>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-options">
                <label for = "password"> Password: </label><br>
                <input type="password" id= "password" name="password" required>
            </div>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
