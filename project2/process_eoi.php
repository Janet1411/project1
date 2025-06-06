<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/eoi.css">
    <title>EOI number</title>
</head>
<body>

<?php
    include("header.inc");
    include("nav.inc");
?>

<?php
    error_reporting(E_ALL); #report error
    ini_set('display_errors', 1); #show error on screen

    require_once("settings.php");

    session_start();

    #santize input: remove whitespace, html special characters, backslashes
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $job_ref = sanitize_input($_POST['job_ref_num'] ?? '');
    $first_name = sanitize_input($_POST['first_name'] ?? '');
    $last_name = sanitize_input($_POST['last_name'] ?? '');
    $date_of_birth = sanitize_input($_POST['dob'] ?? '');
    $gender = sanitize_input($_POST['gender'] ?? '');
    $street = sanitize_input($_POST['street_ad'] ?? '');
    $suburb = sanitize_input($_POST['suburb'] ?? '');
    $state = sanitize_input($_POST['state'] ?? '');
    $postcode = sanitize_input($_POST['postcode'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone_no'] ?? '');
    $skill_tableau = sanitize_input($_POST['tableau'] ?? '');
    $skill_google = sanitize_input($_POST['data_studio'] ?? '');
    $skill_python = sanitize_input($_POST['python'] ?? '');
    $skill_r = sanitize_input($_POST['R'] ?? '');
    $skill_sql = sanitize_input($_POST['sql'] ?? '');
    $skill_relational = sanitize_input($_POST['rel_dbms'] ?? '');
    $other = sanitize_input($_POST['other'] ?? '');
    $other_skills = sanitize_input($_POST['other_skills'] ?? '');
    $terms = ($_POST['terms'] ?? '');

    $errors = [];

    if (empty($terms)) {
        $errors[] = "Please agree to the terms and conditions before proceeding.";
    }

    #validate input, || means OR
    if (empty($job_ref) || empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($gender) || empty($street) || empty($suburb) || empty($state) || empty($postcode) || empty($email) || empty($phone)) {
        $errors[] = "Please fill in all required fields.";
    }

    if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
        $errors[] = "Last name: 20 alpha characters allowed.";
    }

    if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) {
        $errors[] = "First name: 20 alpha characters allowed.";
    }

    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_of_birth)) {
        $errors[] = "Date of birth format invalid.";
    }

    if (strlen($street) > 40) {
        $errors[] = "Street: Maximum 40 characters allowed.";
    }
    
    if (strlen($suburb) > 40) {
        $errors[] = "Suburb: Maximum 40 characters allowed.";
    }    

    function in_range($number, $ranges) {
        foreach ($ranges as $range) {
            if ($number >= $range[0] && $number <= $range[1]) {
                return true;
            }
        }
        return false;
    }

    $post_vali = [
        'vic' => [[3000, 3996], [8000, 8999]],
        'nsw' => [[1000, 2599], [2619, 2898]],
        'qld' => [[4000, 4999], [9000, 9999]],
        'nt'  => [[800, 999]],
        'wa'  => [[6000, 6797], [6800, 6999]],
        'sa'  => [[5000, 5999]],
        'tas' => [[7000, 7150], [7152, 7799], [7800, 7999]],
        'act' => [[200, 299], [2600, 2618], [2900, 2920]],
    ];

    $postcode_num = (int) $postcode;
    if (!preg_match("/^\d{4}$/", $postcode)) {
        $errors[] = "Postcode: 4 digits required.";
    } elseif (!isset($post_vali[$state]) || !in_range($postcode_num, $post_vali[$state])) {
        #!isset: check if variable is null (when function return false)
        $errors[] = "Please input the correct postcode for the selected state.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
        $errors[] = "Phone number: Only digits and spaces allowed (8-12 characters).";
    }

    if ($skill_tableau){
        $skill_tableau = 'Y';
    } else {
        $skill_tableau = 'N';
    }
    if ($skill_google){
        $skill_google = 'Y';
    } else {
        $skill_google = 'N';
    }
    if ($skill_python){
        $skill_python = 'Y';
    } else {
        $skill_python = 'N';
    }
    if ($skill_r){
        $skill_r = 'Y';
    } else {
        $skill_r = 'N';
    }
    if ($skill_sql){
        $skill_sql = 'Y';
    } else { 
        $skill_sql = 'N';
    }
    if ($skill_relational){
        $skill_relational = 'Y';
    } else {
        $skill_relational = 'N';
    }

    #Other skills not empty if check box selected validation
    if (($other) && empty($other_skills)) {
        $errors[] = "Please specify your other skills.";
    }



        #if the table doesn't exist:
    $create_table_sql= "CREATE TABLE IF NOT EXISTS EOI (
        `EOInumber` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `job_ref` varchar(50) NOT NULL,
        `first_name` varchar(50) NOT NULL,
        `last_name` varchar(50) NOT NULL,
        `date_of_birth` date NOT NULL,
        `gender` enum('male','female','other','') NOT NULL,
        `street` varchar(50) NOT NULL,
        `suburb` varchar(50) NOT NULL,
        `state` enum('vic','nsw','qld','nt','wa','sa','tas','act') NOT NULL,
        `postcode` char(4) NOT NULL,
        `email` varchar(50) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `skill_tableau` varchar(1) DEFAULT NULL,
        `skill_google` varchar(1) DEFAULT NULL,
        `skill_python` varchar(1) DEFAULT NULL,
        `skill_r` varchar(1) DEFAULT NULL,
        `skill_sql` varchar(1) DEFAULT NULL,
        `skill_relational` varchar(1) DEFAULT NULL,
        `other` varchar(1) DEFAULT NULL,
        `other_skills` varchar(100) DEFAULT NULL,
        `Status` enum('New','Current','Final','') NOT NULL DEFAULT 'New'
    )";

    mysqli_query($conn, $create_table_sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($errors)) {
            echo "<div class='alert'><ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul></div>";
            include("footer.inc");
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO EOI ( #prep data, send query to database but doesn't execute it immediately
            job_ref, first_name, last_name, date_of_birth, gender,
            street, suburb, state, postcode, email, phone,
            skill_tableau, skill_google, skill_python, skill_r, skill_sql,
            skill_relational, other_skills
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); #?: placeholder

        $stmt->bind_param( #Binds actual values to the placeholders. "ss" means two strings are being passed in safely.
            "ssssssssssssssssss",
            $job_ref, $first_name, $last_name, $date_of_birth, $gender,
            $street, $suburb, $state, $postcode, $email, $phone,
            $skill_tableau, $skill_google, $skill_python, $skill_r, $skill_sql,
            $skill_relational, $other_skills
        );

        if ($stmt->execute()) { #Sends the safe, complete SQL query to the database to run.
            $eoi_num = $conn->insert_id; #Returns the ID (generated with AUTO_INCREMENT) from the last inserted query
            if ($eoi_num) {
                $_SESSION['eoi_number'] = $eoi_num;
                header("Location: eoi_num.php");
                exit();
            } else {
                echo "<p>Please try again.</p>";
            }
        } else {
            echo "<p>Error: " . $stmt->error . "</p>"; #$stmt->error: Return the last error description for the most recent function call, if any
        }

        $stmt->close();

    } else {
        header("Location: apply.php");
        exit();
    }

    mysqli_close($conn);
?>

<?php
    include("footer.inc");
?>
</body>
</html>