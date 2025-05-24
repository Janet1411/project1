<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>EOI Submission Successful</title>
</head>
<body>

<?php
    include("header.inc");
    include("nav.inc");
    
    session_start();
    
    #if EOI number exists in session
    if (isset($_SESSION['eoi_number'])) {
        $eoi_num = $_SESSION['eoi_number'];
        
        echo "<p><center><h1>Your EOI number is: $eoi_num</h1></center></p>";
        echo "<p><center>Thank you for your application!</center></p>";
    } else {
        #If no EOI number in session, redirect to apply page
        header("Location: apply.php");
        exit();
    }
?>

<?php
    include("footer.inc");
?>
</body>
</html>