<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Janet Yin" content="Position Descriptions page. The page contains description of what the jobs available at Solvex at the moment">
    <title>Jobs Available</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/jobs.css">
</head>

<body>

<?php
// Show errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include shared elements and DB config
include_once("header.inc");
include_once("nav.inc");
require_once("settings.php");
?>

<main>
    <h2>Current Job Openings at Solvex</h2>

    <?php
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p class='error'>❌ Failed to connect to the database.</p>";
    } else {
        $query = "SELECT * FROM jobs";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p class='error'>❌ Query failed: " . mysqli_error($conn) . "</p>";
        } elseif (mysqli_num_rows($result) == 0) {
            echo "<p class='info'>ℹ️ No job listings found.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<section class="job-Available">';
                echo "<h2 class='position'>{$row['title']}</h2>";
                echo "<section class='basicInfo'>";
                echo "<p><strong>Reference Number:</strong> {$row['job_ref']}</p>";
                echo "<p><strong>Salary:</strong> {$row['salary']}</p>";
                echo "<p><strong>Location:</strong> {$row['location']}</p>";
                echo "<p><strong>Work Mode:</strong> {$row['mode']}</p>";
                echo "</section>";

                echo "<section class='furtherInfo'>";
                echo "<p class='description'>{$row['description']}</p>";
                echo "<h3 class='responsibility'>Key Responsibilities</h3>";
                echo "{$row['responsibilities']}";
                echo "<h3 class='skills'>About You</h3>";
                echo "<table><thead><tr><th>What we require</th><th>Preferred</th></tr></thead><tbody>";
                echo "<tr><td>{$row['requirements']}</td><td>{$row['preferred']}</td></tr>";
                echo "</tbody></table>";
                echo "</section></section><br><br>";
            }
        }

        mysqli_close($conn);
    }
    ?>
</main>

<?php include_once("footer.inc"); ?>

</body>

</html>