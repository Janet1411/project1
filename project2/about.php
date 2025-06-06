<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/about.css">
    <title> About Page</title>
</head>

<body>
  <?php include_once("header.inc"); ?>

  <?php include_once("nav.inc"); ?>
 
<main>
  <h2> Group 3 </h2>
<div class="row">
  <div class="column">
    <div class="card">
      <div class="box">
        <h3>Janet Yin</h3>
        <p class="job">Web Developer</p>
        <!-- description generated from chatgpt  -->
        <p> A passionate first-year Computer Science student with a strong curiosity for technology and problem-solving. </p>
        <p>105943249@student.swin.edu.au</p>
        <p><a href="#section1" class="button"> Click to Know More </a></p>
      </div>
    </div>
  </div>
  
    <div class="column">
      <div class="card">
        <div class="box">
          <h3>Khubi Shah</h3>
          <p class="job"> Web Designer </p>
          <!-- description taken frpm chatgpt  -->
          <p>First-year Computer Science student passionate about front-end development, with a love for CSS and crafting seamless user experiences.</p>
          <p> 105933114@student.swin.edu.au </p>
          <p><a href="#section2" class="button"> Click to Know more </a></p>
        </div>
      </div>
    </div>
  
    <div class="column">
      <div class="card">
        <div class="box">
          <h3>Shivi Gupta</h3>
          <p class="job">Web Developer</p>
          <!-- description taken from chatgpt  -->
          <p>Part-time web developer and first-year Computer Science student passionate about clean code, CSS and artifical intelligence. </p>
          <p> 105543995@student.swin.edu.au</p>
          <p><a href="#section3" class="button"> Click to Know more </a></p>
        </div>
      </div>
  </div>
</div>

<aside>
    <h2> A Little about Our Company </h2>
    <p> At Solvex, we specialize in crafting high-quality, custom web solutions that help businesses thrive in the digital world. Whether you're a startup in need of a landing page or an enterprise building a robust e-commerce platform, we deliver tailored, visually stunning, and user-friendly websites designed to elevate your brand and drive growth.
    <p> Our team blends creativity, innovation, and technical excellence to turn your ideas into reality. We pride ourselves on being reliable partners—offering not just development, but long-term support and collaboration.</p>
    <p> At Solvex, we believe in relationships. Our company culture reflects our values: trust, transparency, innovation, and a close-knit team spirit. When you work with us, you become part of the family. </p>
    <!-- chatgpt command promopt: can you write a brief 'about us' for the company, the compansy is solvex which specialiases crafting high-quality, customized web solutions for businesses of all sizes-->
</aside>

    <ol> 
        <li>8:30 am Friday classes</li>
        <li>Student Ids of Group members:
          <ul>
            <li> Janet Yin - 105943249 </li>
            <li> Khubi Shah - 105933114 </li>
            <li> Shivi Gupta - 105543995 </li>
          </ul>
        </li>
        <li>Tutor - Razeen Hashmi </li>
    </ol>

    <figure>
       <img src="../images/IMG_2628.jpeg" alt ="Group Photo"  loading ="lazy">
    </figure>
      
  <dl>
    <dt>Contributions made by Group Members</dt>
    
    <dt>Janet Yin</dt>
    <dd>
      Janet was responsible for setting up reusable components across the website using PHP include files for the header, navigation, and footer. She also created the database connection file ('settings.php'), established the structure and creation of the Expressions of Interest (EOI) table in MySQL, and developed the form processing script ('process_eoi.php') that securely validates and stores application data into the database using server-side validation. [Tasks 1 to 4]
    </dd>

    <dt>Shivi Gupta</dt>
    <dd>
      Shivi developed the administrative interface ('manage.php') that allows the HR manager to view, sort, update, and delete job applications. She also implemented login authentication, built secure session handling for access control, and added protections against repeated failed login attempts to enhance the site's security. [Task 5]
    </dd>

    <dt>Khubi Shah</dt>
    <dd>
      Khubi was responsible for updating and maintaining the About page content, ensuring that team member contributions were accurately documented. She also created a dynamic job listing system that loads job descriptions from a MySQL database using PHP, and implemented a range of functional and aesthetic enhancements across the site, such as improved responsiveness and user interactivity. [Tasks 6 to 8]
    </dd>
</dl>
    
  <table>
    <caption> Members Interests</caption>
    <tr>
      <th> Name</th>
      <th> Interests</th>
    </tr>
    <tr>
      <td> Janet Yin </td>
      <td> Reading Mystery Novels and Swimming </td>
    </tr>
    <tr>
      <td> Khubi Shah</td>
      <td> Books, Horror Movies, Batminton and Cars </td>
    </tr>
    <tr>
      <td>Shivi Gupta</td>
      <td>Non-fiction novels, Skating and Watching Movies</td>
    </tr>
  </table>

  <br><br>
  <h2> A lot more to know about us</h2>
  <section id="description">
  <!-- decriptions for each person is generated from chapgpt "can you generate a brief description for three computer science students; modified a bit of the content as well   -->
   <ul>
     <li>
       <h4 id="section1">Janet Yin  – The Problem Solver</h4>
       <div class="year">1st Year – Software Development</div>
       <p class="info">Logic-first, hoodie-wearing debugger-in-chief. Calm under pressure and addicted to clean code.</p>
       <p class="hometown"> Belong from Cambodia,which is known for its rich history, vibrant traditions, and the incredible legacy of Angkor Wat. Growing up there taught me the value of community, adaptability, and cultural pride</p>
       <p class="fact">💡 Fun Fact: Has a GitHub streak that’s older than some relationships.</p>
     
    </li>
    
    <li>
      <h4 id="section2"> Khubi Shah  – The Creative Coder</h4>
      <div class="year">1st Year – Web Dev & UI/UX</div>
      <p class="info">Color-coded notes, iced coffee always in hand. Passionate about beautiful, intuitive design.</p>
      <p class="hometown"> Belong from a place Known for its flavorful street food and colorful festivals that bring the whole community together. Whether it’s the smell of sizzling snacks in evening markets or the vibrant music and traditions during cultural celebrations, there’s always something to enjoy. Growing up in this environment gave me a deep appreciation for heritage, hospitality, and the way food and festivals connect people.</p>
      <p class="fact">💡 Fun Fact: Designed the student club website that went viral on Tumblr.</p>
    </li>
    
    <li>
      <h4 id="section3">Shivi Gupta – The Hacker with a Heart</h4>
      <div class="year">1st Year – Cybersecurity & AI </div>
      <p class="info">Terminal always open, black hoodie aesthetic. Big on CTFs, soft for Studio Ghibli.</p>
      <p class="hometown">Hailing from India. Grew up in a bilingual home filled with books, music, and a lot of tech thanks to her older brother. She started coding at 14, but it was a natural language AI project in high school that made her fall in love with CS.</p>
      <p class="fact">💡 Fun Fact: Runs an anonymous tech blog about hacking and mental health.</p>
    </li>
  </ul>
  </section>
  <br><br>
</main>
<br><br><br><br>

  <?php include_once("footer.inc"); ?>

</body>
</html>