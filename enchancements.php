<?php
include("header.inc");
include("nav.inc");
?>

<main>
  <h1>Enhancements</h1>
  <p>This page documents the enhancements implemented in our project beyond the basic requirements. Each enhancement improves the functionality, usability, or security of the website.</p>

  <section>
    <h2>1. Modular PHP Includes</h2>
    <p>We modularized our website using PHP <code>include</code> statements for the header, navigation, and footer. This promotes code reuse and simplifies maintenance. Implemented in all main pages like <code>index.php</code>, <code>apply.php</code>, and <code>about.php</code>.</p>
  </section>

  <section>
    <h2>2. Centralized Database Configuration</h2>
    <p>We created a <code>settings.php</code> file to store database connection variables. This allows secure and consistent access to the database across all PHP scripts.</p>
  </section>

  <section>
    <h2>3. Dynamic Job Listings</h2>
    <p>Job descriptions are stored in a MySQL table and dynamically displayed on <code>jobs.php</code> using PHP. This allows easy updates and scalability.</p>
  </section>

  <section>
    <h2>4. Expression of Interest (EOI) Form Processing</h2>
    <p>We implemented <code>process_eoi.php</code> to handle form submissions. It includes server-side validation, sanitization, and dynamic table creation if the EOI table doesn't exist. A confirmation message with the EOInumber is displayed upon successful submission.</p>
  </section>

  <section>
    <h2>5. HR Manager Portal</h2>
    <p>The <code>manage.php</code> page allows HR managers to view, search, sort, update, and delete EOIs. It includes secure login, status updates, and job-based filtering.</p>
  </section>

  <section>
    <h2>6. Manager Authentication and Security</h2>
    <p>We implemented a secure login system with server-side validation. After three failed login attempts, access is temporarily disabled to prevent brute-force attacks.</p>
  </section>

  <section>
    <h2>7. Conditional Validation for 'Other Skills'</h2>
    <p>If the 'Other Skills' checkbox is selected, the corresponding text field must be filled. This is enforced through server-side validation in <code>process_eoi.php</code>.</p>
  </section>

  <section>
    <h2>8. Updated About Page</h2>
    <p>The <code>about.php</code> page was updated to reflect each team member’s contributions, aligning with the project’s collaborative goals.</p>
  </section>
</main>

<?php
include("footer.inc");
?>