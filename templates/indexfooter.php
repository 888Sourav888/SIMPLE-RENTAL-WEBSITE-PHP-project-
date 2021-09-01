<link rel = 'stylesheet' href = 'css/footer.css?v=<?php echo time(); ?>'> 

<style>

</style>

<div class="footer">
<div class="box1">
    <div class="col1">
        <h2>Site Links</h2>
        <ul>
            <?php 
                //This index footer is a copy of footer.php 
                // But the only difference is that hyperlinks in this file will differ from the footer.php 
                // Checkout footer.php for comments of the php code block
                if(isset($_SESSION['id'])){
                    ?> 
                        <li><a href= 'php/list.php'>List Property</a></li>
                        <li><a href= 'php/rent.php'>Rent Property</a></li>
                        <li><a href= 'php/myaccount.php'>Edit Account Details</a></li>
                        <li><a href= 'php/myproperties.php'>See my Properties</a></li>
                    <?php 
                }
                else{
                    ?> 
                    <li><a href= 'php/login.php'>Login</a></li>
                    <li><a href= 'php/signup'>SignUp</a></li>
                    <?php 
                }
            ?>
            <li><a href= 'php/terms.php'>Terms & Condition</a></li>
        </ul>
    </div>
    <div class="col2">
        <h2>Contact Details</h2>
                <ul>
                    <li><a href = "mailto:souravorton2003@gmail.com"><img src = 'images/mail.png'> Mail Us</a></li>
                    <li>Help Desk - 044-xxxxxxx</li>
                </ul>
    </div>
</div>
<div class="box2">
        <div class="allrights">
            <img src = 'images/logo.png' alt  = 'img not found' > <p>All Rights Reserved &copy; </p>
        </div>
</div>
</div>