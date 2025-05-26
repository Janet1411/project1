<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/styles.css">
  <title>enhancements</title>
</head>
<body>
<?php
include("header.inc");
include("nav.inc");
?>

<main>
  <h1>Enhancements</h1>
  <p>This page outlines the enhancements implemented in our project, going beyond the core requirements to improve accessibility, usability, performance, and maintainability.</p>

  <section>
    <h2>1. Modular PHP Includes</h2>
    <p>Common elements like the header, navigation, and footer were modularized using PHP <code>include</code> statements. This promotes code reuse and simplifies updates across the site.</p>
  </section>

  <section>
    <h2>2. Centralized Database Configuration</h2>
    <p>All database connection variables are stored in <code>settings.php</code>, ensuring secure and consistent access across all PHP scripts.</p>
  </section>

  <section>
    <h2>3. Dynamic Job Listings</h2>
    <p>Job descriptions are stored in a MySQL table and dynamically rendered in <code>jobs.php</code> using PHP. This allows for easy updates and scalability.</p>
  </section>

  <section>
    <h2>4. EOI Form Processing with Validation</h2>
    <p>The <code>process_eoi.php</code> script handles form submissions with server-side validation and sanitization. It dynamically creates the EOI table if it doesn't exist and displays a confirmation with the EOInumber.</p>
  </section>

  <section>
    <h2>5. HR Manager Portal</h2>
    <p><code>manage.php</code> allows HR managers to view, search, sort, update, and delete EOIs. It includes secure login, status updates, and job-based filtering.</p>
  </section>

  <section>
    <h2>6. Manager Authentication and Lockout</h2>
    <p>We implemented a secure login system with server-side validation. After three failed login attempts, access is temporarily disabled to prevent brute-force attacks.</p>
  </section>

  <section>
    <h2>7. Conditional Validation for 'Other Skills'</h2>
    <p>If the 'Other Skills' checkbox is selected, the corresponding text field must be filled. This is enforced through server-side validation in <code>process_eoi.php</code>.</p>
  </section>

  <section>
    <h2>8. Accessibility Enhancements</h2>
    <p>We followed accessibility best practices by using semantic HTML, proper <code>alt</code> attributes, readable color contrasts, and accessible form controls. Navigation is consistent and forms are user-friendly. Minor improvements like image compression and ARIA attributes are planned for future updates.</p>
  </section>

  <section>
    <h2>9. Responsive and Professional CSS</h2>
    <p>Our CSS uses external stylesheets, CSS variables, flexbox, hover transitions, and media queries. The site is visually coherent and responsive, with minor issues on the About page. More extensive commenting is planned to improve maintainability.</p>
  </section>

  <section>
    <h2>10. About Page Enhancements</h2>
    <p>The <code>about.php</code> page includes all required elements: group members, tutor, student IDs, group photo, contributions, and interests. It uses semantic HTML and consistent navigation. The group photo will be optimized to meet the 300KB limit.</p>
  </section>

  <section>
    <h2>11. Form Design and Validation</h2>
    <p>Forms are logically grouped and styled using flexbox. Validation is implemented using patterns and field types. Minor issues like postcode-state mismatch and use of text input for date of birth will be addressed in future iterations.</p>
  </section>
</main>

<?php
include("footer.inc");
?>

</body>
</html>