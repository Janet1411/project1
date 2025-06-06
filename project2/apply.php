<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply for job here">
    <meta name="author" content="Shivi">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/apply.css">

    <title>Job Application Form</title>
</head>

<body>
  <?php include_once("header.inc"); ?>

  <?php include_once("nav.inc"); ?>

  <main>
      <h2> Apply Here for the Job </h2>
        
      <form action="process_eoi.php" method="POST" novalidate="novalidate">

          <label for="job_ref_num" class="required">Job Reference number<span class="field-mandatory">*</span></label><br>
          <select name="job_ref_num" id="job_ref_num" required>
            <option value="" disabled selected>Please select.... </option>
            <option value="00125"> 00125 (Network Administrator) </option>
            <option value="00130"> 00130 (Data Analyst) </option>
            <option value="00135"> 00135 (Cybersecurity Specialist) </option>
          </select>
          <br>

          <section>
            <h3>Personal Details</h3>

            <label for="first_name" class="required"> First Name:<span class="field-mandatory">*</span></label><br>
            <input type="text" id="first_name" name="first_name"  pattern="[A-Za-z]{1,20}"  maxlength="20"  title="Only alphabets allowed (max 20 characters)"  placeholder="First Name" required><br><br>
        
            <label for="last_name" class="required"> Last Name:<span class="field-mandatory">*</span></label><br>
            <input type="text" id="last_name" name="last_name"  pattern="[A-Za-z]{1,20}"  maxlength="20" title="Only alphabets allowed (max 20 characters)" placeholder="Last Name" required><br><br>

            <label for="dob" class="required"> Date of Birth:<span class="field-mandatory">*</span></label><br>
            <input type="date" id="dob" name="dob" pattern="\d{2}-\d{2}-\d{4}"  title="Enter a date in the correct format(dd/mm/yyyy)" placeholder= "dd-mm-yyyy" required><br><br>

            <fieldset>
              <legend class="required" >Gender:<span class="field-mandatory">*</span></legend>
          
              <input type="radio" id="male" name="gender" value="male" required >
              <label for="male">Male</label><br>
          
              <input type="radio" id="female" name="gender" value="female">
              <label for="female">Female</label><br>
          
              <input type="radio" id="other" name="gender" value="other">
              <label for="other">Other</label>
            </fieldset><br>
          </section>


          <section> 
            <h3>Address </h3>

            <label for="street_ad" class="required"> Street Address:<span class="field-mandatory">*</span></label>
            <input type="text" id="street_ad" name="street_ad" maxlength="40" placeholder="e.g: , street no., street name" required><br><br>

            <label for="suburb" class="required"> Suburb:<span class="field-mandatory">*</span></label>
            <input type="text" id="suburb" name="suburb" maxlength="40" placeholder="e.g: Croydon" required><br><br>
            <!-- <input type="text" id="suburb" name="suburb" pattern="[A-Za-z]{1,40}" maxlength="40" placeholder="e.g: Croydon" required><br><br> -->

            <label for="state" class="required"> State:<span class="field-mandatory">*</span></label>
            <select id="state" name="state"  required>
              <option value="" disabled selected>Select your state </option>
              <option value="vic">VIC</option>
              <option value="nsw">NSW</option>
              <option value="qld">QLD</option>
              <option value="nt">NT</option>
              <option value="wa">WA</option>
              <option value="sa">SA</option>
              <option value="tas">TAS</option>
              <option value="act">ACT</option>       
            </select><br><br>

            <label for="postcode" class="required"> Postcode:<span class="field-mandatory">*</span></label>
            <input type="text" id="postcode" name="postcode" pattern="\d+" maxlength="4" placeholder="e.g.: 2600 (Canberra)" title= "Only 4 digits allowed" required><br><br>
            <!-- can also use css for red asterisk  -->
            <!-- add id to all the labels for the red asterisk -->
          </section>

          <section>
            <h3>Contact Details</h3>

            <label for="email" class="required"> Email:<span class="field-mandatory">*</span></label>
            <input type="email" id="email" name="email"  placeholder="example@domain.com" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br><br>

            <label for="phone_no" class="required"> Phone Number:<span class="field-mandatory">*</span></label>
            <input type="tel" id="phone_no" name="phone_no"  pattern="[0-9 ]{8,12}" title="Only digits and spaces allowed (8 to 12 characters)"  placeholder="+61 XXXX XXX XXX" required><br><br>
          </section>

          <section>
              <h3> Skills & Qualifications</h3>
            <fieldset class="flexbox">
              <legend class= "required"> Required technical skill list<span class="field-mandatory">*</span></legend>

              <!-- use flexbox for checkboxes -->
              <label class="box">
                <input type="checkbox" name="tableau" value="Tableau / Power BI" checked required>
                Tableau / Power BI
              </label>

              <label class="box">
                <input type="checkbox" name="data_studio" value="Google Data Studio">
                Google Data Studio
              </label>

              <label class="box">
                <input type="checkbox" name="python" value="Python (pandas, numpy, matplotlib)">
                Python (pandas, numpy, matplotlib)
              </label>

              <label class="box">
                <input type="checkbox" name="R" value="R">
                R (for statistical analysis and visualization)
              </label>

              <label class="box">
                <input type="checkbox" name="sql" value="SQL">
                SQL (for querying databases)
              </label>

              <label class="box">
                <input type="checkbox" name="rel_dbms" value="Relational Databases">
                Relational Databases (MySQL, PostgreSQL, SQL Server)
              </label>

              <label class="box">
                <input type="checkbox" name="other" value="other">
                Other Skills
              </label>
            </fieldset><br>

            <label for="other_skills"> Please Specify:</label>
            <textarea id="other_skills" name="other_skills" rows="5" cols="50"></textarea><br><br>


            <label for="resume" class="required">Upload Resume:</label><br>

            <!-- remove span; css for grey & italics for below text  -->
            <span class="gray">
            Please upload only .pdf, .doc, .docx only
            </span><br><br>
            
            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
            <!-- <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required class="required"> -->
          </section>
          <br><br><br>
          
          <label>
            <input type="checkbox" name="terms" required class="required">
            <span class="field-mandatory">*</span> I agree to Solvex's declared terms and conditions. <br>

            <!-- remove span; change text to small,italics, and grey  -->
          
            <span class="gray"> I confirm that I have read, understood and agree to Solvex's <a href="" > policies, terms and conditions </a> which sets out the ways in which Solvex may collect, use, disclose and hold my personal information.
            </span>

            <!-- add css for the link; like link colour, visited link,hover and active -->
            <!-- company's name, add another page to link for terms and condition  -->
          </label><br><br>
        

          <button type="submit" > Apply </button>
          <button type="reset" > Reset form </button>
          <!-- style the buttons;hover,etc -->
      </form>
  </main>  
      
  <?php include_once("footer.inc"); ?>

</body>
</html>