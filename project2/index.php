<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Janet Yin" content="Home page: The page contains description of what the company is about">
    <title>Home</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <?php include_once("header.inc"); ?>

    <?php include_once("nav.inc"); ?>

    <main>
        <aside>
            <nav>
                <h2>Home</h2>
                <ul>
                    <li><a href="#purpose">Our Purpose</a></li>
                    <li><a href="#reason">Why choose Solvex?</a></li>
                    <li><a href="#values">Our values</a></li>
                </ul>
            </nav>
        </aside>

        
        <section id="purpose">
        <h2> Our Purpose </h2>
            <p>At Solvex, we specialize in crafting high-quality, tailoring your web demands for businesses of all sizes. Our mission is to empower organizations by delivering visually appealing, user-friendly websites that not only reflect your brand but also drive growth and success in the digital world. Whether you need a simple landing page or a complex e-commerce platform, Solvex offers reliable, innovative, and scalable solutions tailored to your unique needs.</p>
            <!-- Chatgpt command prompt: can you write company description, the company name is solvex, sell web page, close knit family, reliable and other info needed can be made up, divide it into three parts, purpose, why choose solvex and our values, the why choose solvex part should be aimed and customers and employees, the why and value parts should not be in big paragraph and the whole description shouldn't be too repetivite-->
            <p>This is one of our client's revenue before and after implementing Solvex's design.</p>
            <img src="../images/revenue_index.png" alt="Client's company growth before and after using solvex" title="Graph display a clear increase in revenue after implementing Solvex's solutions, reflecting the positive impact on business performance." loading="lazy">
            <!--Chatgpt command prompt: can you generate a graph how company bussiness went up before and after using our design-->
        </section>

        <section id="reason">
        <h2>Why choose Solvex </h2>    
            <p>For Customers:</p>    
            <ul>
                <li><strong>Tailored Solutions:</strong> Meeting yourspecific needs is our calling. We listen, understand and implement.</li> <!-- part of line 42's prompt -->
                <li><strong>Dependability:</strong> We ensure timely project delivery, so you can count on us for consistent results.</li> <!-- part of line 42's prompt -->
                <li><strong>Ongoing Support:</strong> We strive to build long-term partnerships, providing continuous assistance as your business evolves.</li> <!-- part of line 42's prompt -->
                <li><strong>Modern Designs:</strong> Incoorperating the latest trends and technology, our design ensures your brand stays competitive.</li> <!-- part of line 42's prompt -->
            </ul>
            <img src="https://www.freshbooks.com/blog/wp-content/uploads/2017/05/face-to-face-communications-1.jpg" alt="Customer's satisfaction" title="Customer's satisfaction image" loading="lazy"> <!-- This image was taken from https://www.freshbooks.com/blog/face-to-face-communications, google search prompt: deeply connectly with customers sitting face to face-->

            <p>For Employees:</p>
            <ul>
                <li><strong>Collaborative Environment:</strong> At Solvex, you're more than just an employee—you're part of our close-knit family.</li> <!-- part of line 42's prompt -->
                <li><strong>Opportunities:</strong> Professional development are available and continous persuit of knowledge are always encouraged.</li> <!-- part of line 42's prompt -->
                <li><strong>Lifestyle:</strong> We prioritize work-life balance, fostering a motivated and happy team.</li> <!-- part of line 42's prompt -->
                <li><strong>Culture:</strong> Our workplace is built on trust, innovation, and mutual respect, creating a positive and supportive atmosphere.</li> <!-- part of line 42's prompt -->
            </ul>
            <img src="../images/employee_index.png" alt="Employees' satisfaction" title="Employees' satisfaction image" loading="lazy"> <!-- Image: Chategpt command prompt: Can you create an image based on For employees-->
        </section>

        <section id="values">
        <h2>Our values</h2>
            <h3>Our core values are the foundation of everything we do:</h3>
            <ol>
                <li><strong>Reliability:</strong> We deliver projects on time and within budget, giving our clients peace of mind.</li> <!-- part of line 42's prompt -->
                <li><strong>Service:</strong> Every project is tailored to meet the distinct needs of our clients.</li> <!-- part of line 42's prompt -->
                <li><strong>Innovation:</strong> We stay ahead of industry trends to offer cutting-edge web solutions.</li> <!-- part of line 42's prompt -->
                <li><strong>Family-Oriented Culture:</strong> We are built on a foundation of trust and respect, this extends to both clients and employees.</li> <!-- part of line 42's prompt -->
            </ol>
        </section> 
    </main>

    <?php include_once("footer.inc"); ?>
</body>
</html>