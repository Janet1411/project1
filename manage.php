<?php
require_once("settings.php");
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'manager') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize variables for filtering and sorting
$where_clauses = [];
$filters_applied = [];

// filter out the fields 
if (!empty($_GET['job_ref'])) {
    $job_ref = mysqli_real_escape_string($conn, $_GET['job_ref']);
    $where_clauses[] = "job_ref LIKE '%$job_ref%'";
    $filters_applied[] = "Job Ref: " . htmlspecialchars($job_ref);
}
if (!empty($_GET['status'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $where_clauses[] = "Status = '$status'";
    $filters_applied[] = "Status: " . htmlspecialchars($status);
}
if (!empty($_GET['first_name'])) {
    $first_name = mysqli_real_escape_string($conn, $_GET['first_name']);
    $where_clauses[] = "first_name LIKE '%$first_name%'";
    $filters_applied[] = "First Name: " . htmlspecialchars($first_name);
}
if (!empty($_GET['last_name'])) {
    $last_name = mysqli_real_escape_string($conn, $_GET['last_name']);
    $where_clauses[] = "last_name LIKE '%$last_name%'";
    $filters_applied[] = "Last Name: " . htmlspecialchars($last_name);
}
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = "WHERE " . implode(' AND ', $where_clauses);
}

//  Sorting through the fields
$sort_fields = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'Status'];
$sort_orders = ['ASC', 'DESC'];
$sort_by = in_array($_GET['sort_by'] ?? '', $sort_fields) ? $_GET['sort_by'] : 'EOInumber';
$sort_order = in_array($_GET['sort_order'] ?? '', $sort_orders) ? $_GET['sort_order'] : 'DESC';

$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Reset the filters apllied (shows all EOIs)
if (isset($_GET['reset'])) {
    header("Location: manage.php");
    exit();
}

// Delete EOIs by Job Ref
if (isset($_POST['delete']) && !empty($_POST['delete_job_ref'])) {
    $delete_job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_ref']);
    $delete_sql = "DELETE FROM EOI WHERE job_ref = '$delete_job_ref'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<p class = 'failed'> All EOIs with Job Ref '$delete_job_ref' have been deleted. </p>";
    } else {
        echo "<p class = 'failed'> Error deleting EOIs: " . mysqli_error($conn) . "</p>";
    }
}

// Update EOI status
if (isset($_POST['update_status']) && !empty($_POST['eoi_number']) && !empty($_POST['new_status'])) {
    $eoi_number = mysqli_real_escape_string($conn, $_POST['eoi_number']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

    $check_sql = "SELECT * FROM EOI WHERE EOInumber = '$eoi_number'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        $update_sql = "UPDATE EOI SET Status = '$new_status' WHERE EOInumber = '$eoi_number'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<p class='passed'> EOI #$eoi_number status updated to <strong>$new_status</strong>.</p>";
        } else {        
            echo "<p class='failed'> Failed to update status: " . mysqli_error($conn) . "</p>";
        }
    } else {        
        echo "<p class = 'failed'> EOI #$eoi_number not found. </p>";
    }
}

$count_sql = "SELECT COUNT(*) AS total FROM EOI $where_clause";
$count_result = mysqli_query($conn, $count_sql);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $limit);

$data_sql = "SELECT * FROM EOI $where_clause ORDER BY $sort_by $sort_order LIMIT $limit OFFSET $offset";
$data_result = mysqli_query($conn, $data_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EOI Management</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/manage.css">
</head>
<body>
<div class="top_bar">
    <h1>EOI Management</h1>
    <a href="logout.php" class="logout_button">Logout</a>
</div>

<form method="GET" action="">
    <label>Job Ref: <input type="text" name="job_ref" value="<?= htmlspecialchars($_GET['job_ref'] ?? '') ?>"></label>
    <label>Status:
        <select name="status">
            <option value="">-- Choose--</option>
            <option value="New" <?= ($_GET['status'] ?? '') === 'New' ? 'selected' : '' ?>>New</option>
            <option value="Current" <?= ($_GET['status'] ?? '') === 'Current' ? 'selected' : '' ?>>Current</option>
            <option value="Final" <?= ($_GET['status'] ?? '') === 'Final' ? 'selected' : '' ?>>Final</option>
        </select>
    </label>
    <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($_GET['first_name'] ?? '') ?>"></label>
    <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($_GET['last_name'] ?? '') ?>"></label>
    <input type="submit" value="Filter">
    <input type="submit" name="reset" value="Show All">
</form>

<form method="POST" action="">
    <label>Delete EOIs by Job Ref: <input type="text" name="delete_job_ref" required></label>
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
        <?php foreach ($sort_fields as $field): ?>
            <option value="<?= $field ?>" <?= ($sort_by == $field) ? 'selected' : '' ?>><?= $field ?></option>
        <?php endforeach; ?>
    </select>
    <select name="sort_order">
        <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
        <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
    </select>
    <input type="submit" value="Apply Sort">
</form>

<!-- displays the filters and sorting applied on the eoi table -->
<?php
if (!empty($filters_applied)) {
    echo "<p><strong>Filters applied:</strong> " . implode(', ', $filters_applied) . "</p>";
}
echo "<p><strong>Sorting by:</strong> $sort_by ($sort_order)</p>";

if (mysqli_num_rows($data_result) > 0) {
    echo "<table border='1'><tr>
        <th> EOI Number </th>
        <th> Job Ref </th>
        <th> First Name </th>
        <th> Last Name </th>
        <th> DOB </th>
        <th> Gender </th>
        <th> Street </th>
        <th> Suburb </th>
        <th> State </th>
        <th> Postcode </th>
        <th> Email </th>
        <th> Phone </th>
        <th> Skills </th>
        <th> Other Skills </th>
        <th> Status </th>
    </tr>";
    while ($row = mysqli_fetch_assoc($data_result)) {
        $skills = [];
        if ($row['skill_tableau'] === 'Y') $skills[] = 'Tableau';
        if ($row['skill_google'] === 'Y') $skills[] = 'Google';
        if ($row['skill_python'] === 'Y') $skills[] = 'Python';
        if ($row['skill_r'] === 'Y') $skills[] = 'R';
        if ($row['skill_sql'] === 'Y') $skills[] = 'SQL';
        if ($row['skill_relational'] === 'Y') $skills[] = 'Relational DB';

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
            <td>" . htmlspecialchars(implode(', ', $skills)) . "</td>
            <td>" . htmlspecialchars($row['other_skills']) . "</td>
            <td>" . htmlspecialchars($row['Status']) . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No EOIs match your filter criteria.</p>";
}

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $query_params = $_GET;
    $query_params['page'] = $i;
    $query_string = http_build_query($query_params);
    if ($i == $page) {
        echo "<span class='current_page'> $i </span> ";
    } else {
        echo "<a href='?$query_string'> $i </a> ";
    }
}
echo "</div>";

mysqli_close($conn);
?>
</body>
</html>
