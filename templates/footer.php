
<div class="footer">
<div class="box1">
    <div class="col1">
        <h2>Site Links</h2>
        <ul>
            <?php 
            //This file contains the footer of this website , 
            //The footer is written dynamically to remove few hyperlinks from the site map based on the login state
                if(isset($_SESSION['id'])){
                    ?> 
                        <li><a href= 'list.php'>List Property</a></li>
                        <li><a href= 'rent.php'>Rent Property</a></li>
                        <li><a href= 'myaccount.php'>Edit Account Details</a></li>
                        <li><a href= 'myproperties.php'>See my Properties</a></li>
                    <?php 
                }
                else{
                    ?> 
                    <li><a href= 'login.php'>Login</a></li>
                    <li><a href= 'signup.php'>SignUp</a></li>
                    <?php 
                }
            ?>
            <li><a href= 'terms.php'>Terms & Conditions</a></li>
        </ul>
    </div>
    <div class="col2">
        <h2>Contact Details</h2>
                <ul>
                    <li><a href = "mailto:souravorton2003@gmail.com"><img src = '../images/mail.png'> Mail Us</a></li>
                    <li>Help Desk - 044-xxxxxxx</li>
                </ul>
    </div>
</div>
<div class="box2">
        <div class="allrights">
            <img src = '../images/logo.png' alt  = 'img not found' > <p>All Rights Reserved &copy; </p>
        </div>
</div>
</div>