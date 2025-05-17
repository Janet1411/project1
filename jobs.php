<?php
include_once("header.inc");
include_once("nav.inc");
require_once("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "<p class='error'>Unable to connect to the database.</p>";
} else {
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<main><h2>Current Job Openings</h2>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<section class="job-Available">';
            echo "<h2>{$row['title']} (Ref: {$row['job_ref']})</h2>";
            echo "<section class='basicInfo'>";
            echo "<p><strong>Salary:</strong> {$row['salary']}</p>";
            echo "<p><strong>Location:</strong> {$row['location']}</p>";
            echo "<p><strong>Work Mode:</strong> {$row['mode']}</p>";
            echo "</section>";

            echo "<section class='furtherInfo'>";
            echo "<p class='description'>{$row['description']}</p>";
            echo "<h3 class='responsibility'>Key Responsibilities</h3>";
            echo $row['responsibilities'];
            echo "<h3 class='skills'>About You</h3>";
            echo "<table><thead><tr><th>What we require</th><th>Preferred</th></tr></thead><tbody>";
            echo "<tr><td>{$row['requirements']}</td><td>{$row['preferred']}</td></tr>";
            echo "</tbody></table>";
            echo "</section></section><br><br>";
        }

        echo "</main>";
    } else {
        echo "<p>No jobs found in the database.</p>";
    }

    mysqli_close($conn);
}

include_once("footer.inc");
?>
