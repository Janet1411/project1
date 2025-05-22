<?php
    require_once("settings.php");
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('Location: login.php');
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EOI Management</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/manage.css">
</head>
<body>
    <h1> EOI Management </h1>
    <br><br>
    <form method="GET" action="">
        <label>Job Ref: <input type="text" name="job_ref" value="<?php echo htmlspecialchars($_GET['job_ref'] ?? ''); ?>"></label>
        <label>Status:
            <select name="status">
                <option value="">-- Choose--</option>
                <option value="New" <?php if (($_GET['status'] ?? '') === 'New') echo 'selected'; ?>>New</option>
                <option value="Current" <?php if (($_GET['status'] ?? '') === 'Current') echo 'selected'; ?>>Current</option>
                <option value="Final" <?php if (($_GET['status'] ?? '') === 'Final') echo 'selected'; ?>>Final</option>
            </select>
        </label>
        <label>First Name: <input type="text" name="first_name" value="<?php echo htmlspecialchars($_GET['first_name'] ?? ''); ?>"></label>
        <label>Last Name: <input type="text" name="last_name" value="<?php echo htmlspecialchars($_GET['last_name'] ?? ''); ?>"></label>
        <input type="submit" value="Filter">
        <input type="submit" name="reset" value="Show All">
    </form>

    <form method="POST" action="">
        <label>Delete EOIs by Job Ref:
            <input type="text" name="delete_job_ref" required>
        </label>
        <input type="submit" name="delete" value="Delete">
    </form>

    <form method="POST" action="">
        <label>EOI Number: <input type="text" name="eoi_number" required></label>
        <label>New Status:
            <select name="new_status" required>
                <option value="">-- Select Status --</option>
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
        </label>
        <input type="submit" name="update_status" value="Update Status">
    </form>

    <form method="GET" action="">
        <label for="sort_by">Sort By:</label>
        <select name="sort_by" id="sort_by">
            <option value="EOInumber" <?php if ($_GET['sort_by'] ?? '' == 'EOInumber') echo 'selected'; ?>>EOI Number</option>
            <option value="job_ref" <?php if ($_GET['sort_by'] ?? '' == 'job_ref') echo 'selected'; ?>>Job Ref</option>
            <option value="first_name" <?php if ($_GET['sort_by'] ?? '' == 'first_name') echo 'selected'; ?>>First Name</option>
            <option value="last_name" <?php if ($_GET['sort_by'] ?? '' == 'last_name') echo 'selected'; ?>>Last Name</option>
            <option value="Status" <?php if ($_GET['sort_by'] ?? '' == 'Status') echo 'selected'; ?>>Status</option>
        </select>

        <select name="sort_order" id="sort_order">
            <option value="ASC" <?php if ($_GET['sort_order'] ?? '' == 'ASC') echo 'selected'; ?>>Ascending</option>
            <option value="DESC" <?php if ($_GET['sort_order'] ?? '' == 'DESC') echo 'selected'; ?>>Descending</option>
        </select>

        <input type="submit" value="Apply Sort">
    </form>

    <?php
    if (isset($_GET['reset'])) {
        header("Location: manage.php");
        exit();
    }

    if (isset($_POST['delete']) && !empty($_POST['delete_job_ref'])) {
        $delete_job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_ref']);
        $delete_sql = "DELETE FROM EOI WHERE job_ref = '$delete_job_ref'";
        if (mysqli_query($conn, $delete_sql)) {  //used inline css below
            echo "<p style='color: red; font-weight: bold;'>All EOIs with Job Ref '$delete_job_ref' have been deleted.</p>";
        } else {    //used inline css below
            echo "<p style='color: red;'>Error deleting EOIs: " . mysqli_error($conn) . "</p>";
        }
    }

    if (isset($_POST['update_status']) && !empty($_POST['eoi_number']) && !empty($_POST['new_status'])) {
        $eoi_number = mysqli_real_escape_string($conn, $_POST['eoi_number']);
        $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

        $check_sql = "SELECT * FROM EOI WHERE EOInumber = '$eoi_number'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $update_sql = "UPDATE EOI SET Status = '$new_status' WHERE EOInumber = '$eoi_number'";
            if (mysqli_query($conn, $update_sql)) {
                echo "<p style='color: green;'>EOI #$eoi_number status updated to <strong>$new_status</strong>.</p>";
            } else {
                echo "<p style='color: red;'>Failed to update status: " . mysqli_error($conn) . "</p>";
            }
        } else { //used inline css below
            echo "<p style='color: red;'>EOI #$eoi_number not found.</p>";
        }
    }

    $where = [];
    $filters_applied = [];

    if (!empty($_GET['job_ref'])) {
        $job_ref = mysqli_real_escape_string($conn, $_GET['job_ref']);
        $where[] = "job_ref LIKE '%$job_ref%'";
        $filters_applied[] = "Job Ref: " . htmlspecialchars($job_ref);
    }

    if (!empty($_GET['status'])) {
        $status = mysqli_real_escape_string($conn, $_GET['status']);
        $where[] = "Status = '$status'";
        $filters_applied[] = "Status: " . htmlspecialchars($status);
    }

    if (!empty($_GET['first_name'])) {
        $fname = mysqli_real_escape_string($conn, $_GET['first_name']);
        $where[] = "first_name LIKE '%$fname%'";
        $filters_applied[] = "First Name: " . htmlspecialchars($fname);
    }

    if (!empty($_GET['last_name'])) {
        $lname = mysqli_real_escape_string($conn, $_GET['last_name']);
        $where[] = "last_name LIKE '%$lname%'";
        $filters_applied[] = "Last Name: " . htmlspecialchars($lname);
    }

    $where_clause = '';
    if (!empty($where)) {
        $where_clause = 'WHERE ' . implode(' AND ', $where);
        echo "<p><strong>Filters applied:</strong> " . implode(', ', $filters_applied) . "</p>";
    }


    $sort_fields = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'Status'];
    $sort_orders = ['ASC', 'DESC'];

    $sort_by = in_array($_GET['sort_by'] ?? '', $sort_fields) ? $_GET['sort_by'] : 'EOInumber';
    $sort_order = in_array($_GET['sort_order'] ?? '', $sort_orders) ? $_GET['sort_order'] : 'DESC';

    echo "<p><strong>Sorting by:</strong> $sort_by ($sort_order)</p>";

    $sql = "SELECT * FROM EOI $where_clause ORDER BY $sort_by $sort_order";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
            <tr>
                <th>EOI Number</th>
                <th>Job Ref</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Street</th>
                <th>Suburb</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>";

        $skill_map = [
            'skill_tableau' => 'Tableau',
            'skill_google' => 'Google',
            'skill_python' => 'Python',
            'skill_r' => 'R',
            'skill_sql' => 'SQL',
            'skill_relational' => 'Relational DB'
        ];

        while ($row = mysqli_fetch_assoc($result)) {
            $skills = [];
            foreach ($skill_map as $key => $label) {
                if ($row[$key] === 'Y') {
                    $skills[] = $label;
                }
            }
            $skill_str = implode(', ', $skills);

            echo "<tr>
                <td>" . htmlspecialchars($row['EOInumber']) . "</td>
                <td>" . htmlspecialchars($row['job_ref']) . "</td>
                <td>" . htmlspecialchars($row['first_name']) . "</td>
                <td>" . htmlspecialchars($row['last_name']) . "</td>
                <td>" . htmlspecialchars($row['date_of_birth']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['street']) . "</td>
                <td>" . htmlspecialchars($row['suburb']) . "</td>
                <td>" . htmlspecialchars($row['state']) . "</td>
                <td>" . htmlspecialchars($row['postcode']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['phone']) . "</td>
                <td>" . htmlspecialchars($skill_str) . "</td>
                <td>" . htmlspecialchars($row['other_skills']) . "</td>
                <td>" . htmlspecialchars($row['Status']) . "</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No EOIs match your filter criteria.</p>";
    }

    mysqli_close($conn);
    ?>

</body>
</html>
