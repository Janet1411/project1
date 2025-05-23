
<?php
session_start();

$manager_username = "manager"; 
$manager_password = "12345"; 

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['locked_until'])) {
    $_SESSION['locked_until'] = 0;
}

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
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $manager_username && $password === $manager_password) {
        $_SESSION['role'] = 'manager';
        $_SESSION['username'] = $username;
        header("Location: manage.php");
        exit;
    } else {    
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
<html>
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>Manager Login</title>
</head>
<body>
    <div class="login-card">
        <h2>Manager Login</h2>
        <br>
        <!-- used inline css below -->
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="login.php">
            <div class="form-options">
                <label>Username:</label><br>
                <input type="text" name="username" required>
            </div>
            <div class="form-options">
                <label>Password:</label><br>
                <input type="password" name="password" required>
            </div>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
