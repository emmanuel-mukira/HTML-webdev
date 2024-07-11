<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Generate a cache buster using the current timestamp
    $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="style.css?v=<?php echo $cacheBuster; ?>">
    <title>HomePage</title>
    </head>
<body>
      <?php include 'header.php'?>
     <main>
        <div class="container">
         <img src="images/lily-banse--YHSwy6uqvk-unsplash.jpg" alt="hero-image">
         <div class="hero-text">
         <h1>Cook What You Crave</h1>
         <p> Find recipes tailored to your dietary needs and preferred ingredients, creating meals you'll love.</p>
         <div id="link">
         <a href="myrecipebook.html">Explore Now</a>
         </div>
         </div>
        </div>
        <!-- About Us section -->
        <section id="about-us" class="about">
          <h2>About Us</h2>
          <div class="about-main">
            <div class="about-text">
                <p>We created Whisk because we know navigating the world of recipes can be overwhelming.<br> Our website is designed to simplify your meal planning and 
                    cooking experience.<br> We offer a curated selection of recipes from various cuisines and dietary needs, along with clear instructions and helpful tools to ensure success in the kitchen.</p>
             </div>
             <img src="images/alyson-mcphee-yWG-ndhxvqY-unsplash.jpg" alt="about-us image">
          </div>
          </section>
          <!-- Benefits Section -->
          <section class="benefits">
            <h2>Benefits</h2>
            <div class="benefit-cards">
              <div class="benefit-card">
                <h3>Discover Delicious Recipes</h3>
                <p>Find a wide variety of recipes suitable for all tastes and dietary needs. Explore cuisines from around the world or search for recipes based on specific ingredients you have on hand.</p>
              </div>
              <div class="benefit-card">
                <h3>Simplify Meal Planning</h3>
                <p>Save time and frustration by using our website to plan your weekly meals. Browse collections and easily create a personalized meal plan.</p>
              </div>
              <div class="benefit-card">
                <h3>Cook with Confidence</h3>
                <p>Our recipes are clear, concise, and easy to follow, with step-by-step instructions and helpful tips to ensure success in the kitchen, regardless of your experience level.</p>
              </div>
              <div class="benefit-card">
                <h3>Find Inspiration</h3>
                <p>Get inspired to explore new flavors and cooking techniques. Discover new favorite dishes and expand your culinary repertoire.</p>
              </div>
              <div class="benefit-card">
                <h3>Save Time and Money</h3>
                <p>Reduce reliance on takeout and expensive meal kits. Our website helps you find creative ways to use ingredients you already have and cook delicious meals at home.</p>
              </div>
            </div>
          </section>
          
          <!-- Features section -->
          <section class="features">
            <h2>Features</h2>
            <ul>
              <li>
                <h3>1. Search & Explore</h3>
                <p>Find the perfect recipe for your needs. Search by keyword, specific ingredient, or explore a vast collection categorized by cuisine.</p>
              </li>
              <li>
                <h3>2. Personalized Meal Plans</h3>
                <p>Save time and reduce food waste with personalized meal planning tools. Create meal plans based on your preferences and dietary needs.</p>
              </li>
              <li>
                <h3>3. Clear Instructions & Tips</h3>
                <p>Our recipes are clear, concise, and easy to follow, with helpful tips and variations to guide you through the cooking process.</p>
              </li>
              <li>
                <h3>4. Interactive Features</h3>
                <p>Save favorites, rate recipes, leave comments, and connect with our community of passionate cooks.</p>
              </li>
            </ul>
          </section>          
          
          <!-- Trust Indicators -->
          <section class="trust-indicators">
            <h2>Why Choose Us? </h2>
            <div class="indicator-cards">
              <div class="indicator-card">
                <img src="images/360_F_635201516_G2TFpFPoFA6utXYNgFlgPJGwU24mj6CJ.jpg" alt="Customer 1 image">
                <h3>Sarah Jones</h3>
                <p>"Whisk has been a lifesaver for me!<br> I love the variety of recipes and the easy-to-follow instructions.
                  I've never felt so confident in the kitchen."</p>
              </div>
              <div class="indicator-card">
                <img src="images/360_F_646488127_8rHBLR3ln8YoELqitzdcAReAbsPhZpHs.jpg" alt="Customer 2 image">
                <h3>David Otieno</h3>
                <p>"I've learned so much about cooking from Whisk. The personalized meal planning feature is a game-changer for me and my family.<br>
                     We're always trying new and delicious recipes."</p>
              </div>
              <div class="indicator-card ">
                <img src="images/socialmedia-1-1024x512.jpg" alt="social media">
                <h3>100,000 Shares</h3>
                <p>Shared across Social Media Platforms</p>
              </div>
            </div>
          </section>
          <!-- Additional Content -->
        <section class="content">
            <h2>Additional Content</h2>
            <div class="content-grid">
              <div class="content-item">
                <h3>Recommendations</h3>
                <p>Explore our blog for delicious recipe inspiration, helpful cooking tips, and insightful articles to elevate your culinary skills.</p>
                <a href="#">Read our Blog</a>
              </div>
              <div class="content-item">
                <h3>Contact Us</h3>
                <p>Have questions, feedback, or suggestions? We'd love to hear from you! Get in touch with our friendly support team.</p>
                <a href="mailto:support@whisk.com">support@whisk.com</a>
              </div>
              <div class="content-item">
                <h3>Product Launches</h3>
                <p>Stay up-to-date on our latest features and exciting new developments. Sign up for our newsletter to be the first to know!</p>
                <a href="#">Subscribe Now</a>
              </div>
            </div>
          </section>
          
     </main>
     <footer>
        <p>&copy; 2024 Whisk. All Rights Reserved.</p>
     </footer>
</body>
</html>
