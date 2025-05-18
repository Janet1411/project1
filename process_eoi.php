<?php
    error_reporting(E_ALL); #report report
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
    if (empty($terms)) {
        die ("Please agree to the terms and conditions before proceeding.");
    }

    #validate input, || means OR
    if (empty($job_ref) || empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($gender) || empty($street) || empty($suburb) || empty($state) || empty($postcode) || empty($email) || empty($phone)) {
        die ("Please fill in the required field.");
    }

    if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
        die ("Last name: 20 alpha characters allowed.");
    }
    if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) {
        die ("First name: 20 alpha characters allowed.");
    }

    if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $date_of_birth)) {
        die ("dd-mm-yyyy required.");
    }

    if (!preg_match("/^[A-Za-z]{1,40}$/", $street)) {
        die  ("Street: Please fill in the required field, 20 alpha characters allowed.");
    }
    if (!preg_match("/^[A-Za-z]{1,40}$/", $suburb)) {
        die ("Suburb: Please fill in the required field, 20 alpha characters allowed.");
    }

    $post_vali = [
        'vic' => ['3', '8'],
        'nsw' => ['1', '2'],
        'qld' => ['4', '9'],
        'nt'  => ['0'],
        'wa'  => ['6'],
        'sa'  => ['5'],
        'tas' => ['7'],
        'act' => ['0']
    ];

    if (!preg_match("/^\d{4}$/", $postcode)) {
        die ("Postcode: 4 digits allowed.");
    } elseif (!in_array($postcode[0], $post_vali[$state] ?? [])) {
    #$postcode[0] -> first digit in the postcode should match $post_vali[$state]
        die ("Please input the correct postcode.");
    }
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die ("Email: Please fill in the required field in the correct format.");
    }
    
    if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
        die ("Phone number: Only digits and spaces allowed.");
    }

    #!!!! the check box are not working !!!!
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
        die("Please specify your other skills.");
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

    $insert_query = "INSERT INTO EOI (
        job_ref, first_name, last_name, date_of_birth, gender,
        street, suburb, state, postcode, email, phone,
        skill_tableau, skill_google, skill_python, skill_r, skill_sql,
        skill_relational, other, other_skills
    ) VALUES (
        '$job_ref', '$first_name', '$last_name', STR_TO_DATE('$date_of_birth', '%d-%m-%Y'), '$gender',
        '$street', '$suburb', '$state', '$postcode', '$email', '$phone',
        '$skill_tableau', '$skill_google', '$skill_python', '$skill_r', '$skill_sql',
        '$skill_relational', '$other', '$other_skills'
    )";
    mysqli_query($conn, $insert_query);

    if ($_SERVER["REQUEST_METHOD"] == "POST") { #is form is submitted
        $query = "SELECT * FROM EOI";
        $result = mysqli_query($conn, $query);
        echo "<p>Your EOI number is:</p>".
        mysqli_insert_id($conn);
    } else {
        header("Location: apply.php");
        exit();
    }
    mysqli_close($conn);
?>