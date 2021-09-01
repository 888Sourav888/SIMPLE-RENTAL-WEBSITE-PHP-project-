<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = "SOURAV KUMAR NRS 2020115089"> 
    <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
    <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
    <title>Rent Heaven</title>
    <link rel = 'stylesheet' href = 'css/header.css?v=<?php echo time();?>'>
    <link rel = 'stylesheet' href=  'css/index.css?v=<?php echo time() ;?>'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time(); ?>'> 
    <link rel = 'icon' href= 'images/logo.png'>
</head>
<body class = 'homepage'>
    <?php
        //All the pages will have some files , included from the templates folder 
        //Files that contain the header , footer and connection to the database will included in every php file of this website
        include 'templates/indexheader.php' ; 
    ?>
    <div class="homepage-container">
        <div class="banner1">
            <h1>
                <?php 
                //All the php code blocks will bring dynamicness to the webpage such as displaying the username 
                // removing /updating content according to the login 
                if(!isset($_SESSION['name'])){ ?>
                Join the Biggest Property renting platform now!
                <?php }
                else{
                    ?> Welcome to Rent Heaven , <?php echo $_SESSION['name']." ".$_SESSION['lname'] ; ?>
                    <br> Hope you are doing Good. 
                    <?php
                }?> 
            </h1>
        </div>
        <div class="banner3">
            <div class="list">
                    <?php if(!isset($_SESSION['name'])){ ?>
                   <h2> List Properties <br> Get tenants at lightning speed</h2>
                   <?php }
                   else{
                       ?>   
                       <a href="php/list.php">List Property</a>
                       <?php
                   }
                   ?>
            </div>
            
            <div class="rent">
                    <?php if(!isset($_SESSION['name'])){ ?>
                        <h2>Rent <br> The Most Comfortable Heaven around you</h2>
                   <?php }
                   else{
                       ?>   
                       <a href="php/rent.php">Rent Property</a>
                       <?php
                   }
                   ?>
            </div>     
        </div>
        <?php if(!isset($_SESSION['name'])){?>
        <div class="banner2-content">
            <div class="buttons">
                    <h1>Get Started Now</h1>
                    <a href="php/login.php">Login</a>
                    <a href="php/signup.php">SignUp</a>
            </div>
            <div class="display-image">
                    <img src = 'images/balcony.jpg' alt = 'img not found'> 
            </div>
        </div>
        <?php } ?>
        <?php include 'templates/indexfooter.php' ; ?>
    </div>
   
</body>
</html>