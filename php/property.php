<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = "SOURAV KUMAR NRS 2020115089"> 
    <title>RentHeaven-Property</title>
    <link rel = 'stylesheet' href= '../css/header.css?v=<?php echo time(); ?>'> 
    <link rel = 'stylesheet' href = '../css/property.css?v=<?php echo time();?>'>
    <link rel = 'icon' href = '../images/logo.png'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
</head>
<body class = 'prop'>
    <?php  
            //This is the file which displays more information about the property that has been displayed in the rent.php file 
            //it gets the id of the property and fetches data from the database 
            $pid = $_GET['a'] ; 
            if(isset($_SERVER['HTTP_REFERER'])){
                //this if block is used to create the cookies to have information about the recently visited property 
                //The swapping done here is similar to the swapping that happens in min-max algorithm 
                $a  = array() ; 
                if(isset($_COOKIE['p1'])) array_push($a , $_COOKIE['p1']) ; 
                if(isset($_COOKIE['p2'])) array_push($a , $_COOKIE['p2']) ; 
                if(isset($_COOKIE['p3'])) array_push($a , $_COOKIE['p3']) ; 
                $isthere = strval($pid) ; 
                if(!in_array($isthere , $a )){
                    if(!isset($_COOKIE['p1']) ){
                        setcookie('p1',strval($pid),time()+86000*30) ; 
                    }
                    else if(!isset($_COOKIE['p2'])){
                        setcookie('p2',strval($_COOKIE['p1']),time()+86000*30) ; 
                        setcookie('p1',strval($pid),time()+86000*30) ; 
                    }
                    else{
                        setcookie('p3',strval($_COOKIE['p2']),time()+86000*30) ; 
                        setcookie('p2',strval($_COOKIE['p1']),time()+86000*30) ; 
                        setcookie('p1',strval($pid),time()+86000*30) ; 
                    }
                }
            }
            include '../templates/header.php'  ; 
            include '../templates/dbcon.php' ; 
            //if suppose the property does no longer exist and the user has bookmarked this page or 
            //he accesses it using the recently visited property , this message will be dipsplayed
            $isexist = "SELECT * FROM properties WHERE id = ".$pid ; 
            $isexistres = mysqli_query($con , $isexist) ; 
            if(mysqli_num_rows($isexistres) == 0){
                echo "<h1>Sry This Property doesn't exist any more</h1>" ; 
                die() ; 
            }
    ?> 
    <div class="property-details">
        <h1>Property-Details</h1>
        <div class="slider">
                <div class="slideleft" id = 'previous' onclick = 'slideleft()'><img src = '../images/previous.png'></div>
            <div class="imageslider-display">  
                <div class="image" id = 'slider'>
                    <?php
                        $query = "SELECT * FROM images WHERE property = '$pid'" ; 
                        $result = mysqli_query($con , $query) ; 
                        while($row = mysqli_fetch_array($result)){
                        ?>
                            <img src = "../images/property_images/<?php echo $row['imagename'] ; ?>">
                    <?php } ?>
                </div>   
            </div>
                <div class="slideright" id = 'next' onclick = 'slideright()'><img src  = '../images/next.png'></div>
        </div>
        <?php
            $query= "SELECT * FROM properties WHERE id = '$pid'" ;
            $result = mysqli_query($con , $query) ; 
            while($row = mysqli_fetch_array($result)){
                $ownerid = $row['owner'] ; 
                ?>
            <table>
                    <tr>
                        <td>Preferred Tenants:</td>
                        <td><?php echo $row['tenant'] ; ?></td>
                    </tr>

                    <tr>
                        <td>Property Type:</td>
                        <td><?php echo $row['type'] ; ?></td>
                    </tr> 
                    <tr>
                        <td>Property Sqft:</td>
                        <td><?php echo $row['sqft'] ; ?></td>
                    </tr> 
                    <tr>
                        <td>Rent Amount / month:</td>
                        <td>&#8377;<?php echo $row['price'] ;?> </td>
                    </tr> 
                    <?php 
                    if(isset($_SESSION['id'])){
                    if($ownerid == $_SESSION['id']){
                        ?>
                        <tr>
                        <td>Listing Expiry Date:</td>
                        <td><?php
                            $date = strtotime($row['expiry']) ; 
                             echo date('d/m/Y',$date);
                        ?> </td>
                        </tr> 
                        
                        <?php 
                        } 
                    }?>
                    <tr>
                        <td>Property Address:</td>
                        <td><?php echo $row['street'] ; ?>,<br>
                            <?php echo $row['area'] ; ?> ,<br>
                            <?php echo $row['city'].' - '.$row['pincode'] ;?>.<br>
                            <?php echo $row['state'].' , '.$row['country'] ; ?><br>
                    </td>
                    </tr> 
            </table>
            <?php } ?>
    </div>
    <?php 
    if(isset($_SESSION['id'])){
    if($ownerid != $_SESSION['id']){ 
        //This code displays the details about the owner of the property if and only if the user that 
        //is logged in is not the owner of this property 
        ?>
    <div class = 'owner-details'>
        <h1 >Owner Details</h1>
        <div class="owner">
        <?php
                $q = "SELECT * FROM account WHERE id = ".$ownerid  ; 
                $result = mysqli_query($con , $q) ; 
            while($r = mysqli_fetch_array($result)){
                    ?>
            <div class="owner-image">
                    <?php 
                        if($r['image']){
                            $url = '../images/profile/'.$r['image'] ; 
                            ?>  <img src = <?php echo $url ?> alt = "img not found" >  <?php
                        }
                        else{ ?>
                                <img src = '../images/user.jpg' alt = 'img not found' >
                        <?php 
                        }
                    ?>
            </div>
            <div class="details">
                <table>
                    
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $r['fname']." ".$r['lname'] ; ?></td>
                    </tr>
                    <tr>
                        <td>Age:</td>
                        <td><?php echo $r['age'] ; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><?php echo $r['phone'] ; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $r['email'] ; ?></td>
                    </tr>
                </table>
            </div>
            
            <?php } ?>
        </div>
        <form method = 'get' action = "proprequest.php" class = 'submit-btn' onsubmit = 'return con()'>
            <input type = 'hidden' name = 'pid' hidden value = <?php echo $pid ;?> >  
            <input type  = 'submit' value = "Resquest for Renting" name = 'request'>
        </form>
    </div>

        <?php }
    }
        ?>
        <!-- A javascript file is attached below which is responsible for the image slider feature 
        and the js file also contains a confirmation for requesting the property -->
    <script src = '../javascript/property.js?v=<?php echo time();?>'></script>
    <?php  include '../templates/footer.php' ;?>
</body>
</html>