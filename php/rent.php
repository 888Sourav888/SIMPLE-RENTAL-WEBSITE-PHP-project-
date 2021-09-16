<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = ""> 
    <title>Rent Heaven - Display</title>
    <link rel = 'stylesheet' href=  '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'icon' href='../images/logo.png'>
    <link rel = 'stylesheet' href = '../css/rent.css?v=<?php echo time();?>' > 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
</head>
<body>
    <?php
    //This file creates the display of all the properties that are there in the database 
    include '../templates/header.php' ;
    include '../templates/dbcon.php' ; 
    if(isset($_GET['mini'])) $min = $_GET['mini'] ; //setting the min price range in the filter section 
    else $min = 0 ; 
    ?>
    <div class="search-filter">
    <div class="search" id = 'search'>
        <form method = 'get'>
            <input type = 'text' name = 'searchbar' placeholder= 'Search by city, ownername , area , type'>
            <input type = 'submit' value = 'Search' name = 'search'>
    </form></div>
    <div class ='visited' >
    <?php
            if(isset($_COOKIE['p1'])){
                //By using the cookies that has been created in the property.php , here the recently viewed properties will be displayed 
                ?><p>Recently viewed Properties:</p><?php
               $id1 = (int)$_COOKIE['p1'] ; 
               $q = "SELECT area,city FROM properties WHERE id = ".$id1 ; 
               $cookieres = mysqli_query($con , $q) ; 
               while($rz = mysqli_fetch_array($cookieres)){
                   $area =  str_replace(" ","_",$rz['area']) ; $area = ltrim($area,'_') ; $area=  rtrim($area,'_') ; 
                   $city =  str_replace(" ","_",$rz['city']) ; $city = ltrim($city,'_') ; $city=  rtrim($city,'_') ; 
                   $disval = $area."-".$city ; 
                ?> 
            <form action = "property.php?action=more&a=<?php echo $id1 ;?>" method = 'POST'><input type = 'submit' name ='more' value = <?php echo $disval  ?>></form> 
            <?php } }
            if(isset($_COOKIE['p2'])){
                $id1 = (int)$_COOKIE['p2'] ; 
                $q = "SELECT area,city FROM properties WHERE id = ".$id1 ; 
                $cookieres = mysqli_query($con , $q) ; 
                while($rz = mysqli_fetch_array($cookieres)){
                    $area =  str_replace(" ","_",$rz['area']) ; $area = ltrim($area,'_') ; $area=  rtrim($area,'_') ; 
                    $city =  str_replace(" ","_",$rz['city']) ; $city = ltrim($city,'_') ; $city=  rtrim($city,'_') ; 
                    $disval = $area."-".$city ; 
                 ?> 
             <form action = "property.php?action=more&a=<?php echo $id1 ;?>" method = 'POST'><input type = 'submit' name ='more' value = <?php echo $disval  ?>></form> 
             <?php } }

             if(isset($_COOKIE['p3'])){
                $id1 = (int)$_COOKIE['p3'] ; 
                $q = "SELECT area,city FROM properties WHERE id = ".$id1 ; 
                $cookieres = mysqli_query($con , $q) ; 
                while($rz = mysqli_fetch_array($cookieres)){
                    $area =  str_replace(" ","_",$rz['area']) ; $area = ltrim($area,'_') ; $area=  rtrim($area,'_') ; 
                    $city =  str_replace(" ","_",$rz['city']) ; $city = ltrim($city,'_') ; $city=  rtrim($city,'_') ; 
                    $disval = $area."-".$city ; 
                 ?> 
             <form action = "property.php?action=more&a=<?php echo $id1 ;?>" method = 'POST'><input type = 'submit' name ='more' value = <?php echo $disval  ?>></form> 
             <?php } }
        
        ?>
     </div>
    <div class="rent-display">
 <!-- This is the filter form for the display , for this to be displayed , the user must use a pc and the browser must be in fullscreen -->
        <div class="rent-filter">
            <h3>FILTER</h3>
            <form action = "" method = "get">
                <div class="tenant">
                    <h4>Preferred Tenant:</h4> 
                    <span>
                    <div><input type  ='radio' value = 'Family' name = 'tenant' <?php if(isset($_GET['tenant']) and $_GET['tenant'] == 'Family') echo "checked" ; ?>><label>Family</label></div> 
                    <div><input type  ='radio' value = 'Bachelor' name = 'tenant' <?php if(isset($_GET['tenant']) and $_GET['tenant'] == 'Bachelor') echo "checked" ; ?> ><label>Bachelor</label></div> 
                    <div><input type  ='radio' value = 'Any' name = 'tenant' <?php if(isset($_GET['tenant']) and $_GET['tenant'] == 'Any') echo "checked" ; ?>  ><label>Any</label></div> 
                    </span>
                </div>
                <div class="furnish">
                    <h4>Furnishing:</h4>
                    <span>
                    <div><input type  ='radio' value = 'Fully' name = 'furnish' <?php if(isset($_GET['furnish']) and $_GET['furnish'] == 'Fully') echo "checked" ; ?> ><label>Fully-Furnished</label></div> 
                    <div><input type  ='radio' value = 'Semi' name = 'furnish' <?php if(isset($_GET['furnish']) and $_GET['furnish'] == 'Semi') echo "checked" ; ?> ><label>Semi-Furnishing</label></div> 
                    <div><input type  ='radio' value = 'No' name = 'furnish' <?php if(isset($_GET['furnish']) and $_GET['furnish'] == 'No') echo "checked" ; ?> ><label>No-Furnishing</label></div> 
                    </span> 
                </div>
                <div class="price-range">
                    <h4>Price Range</h4>
                    <span>
                    <div><label for = 'min'>Min:</label><input type = 'number' name = 'mini' id = 'min' value = <?php echo $min ?> ></div>  
                    <div><label for = 'max'>Max:</label><input type = 'number' name = 'max' id = 'max' <?php if(isset($_GET['max'])){?> value  = <?php echo $_GET['max'] ;}?>></div> 
                    </span>
                </div>
                <div class="rent-submit">
                    <input type  ='submit' value = 'filter' name = 'filter'>
                </div>
            </form>
        </div>
        <div class="rent-items-display">
            <?php
                if(isset($_GET['search'])){
                    //This code is responsible for displaying the contents that match with the keyword in the search bar 
                    $search = mysqli_real_escape_string($con , $_GET['searchbar']) ; 
                    $sql = "SELECT * FROM properties WHERE ownername LIKE '%$search%' OR city  LIKE '%$search%' OR type LIKE '%$search%' OR area LIKE '%$search%' OR state LIKE '%$search%' OR country LIKE '%$search%'"  ; 
                }
                else if(isset($_GET['filter'])){
                    // This code is responsible for displaying the content that meets the conditions that has been given in the filter
                    $furnish = '' ; 
                    $tenant = '' ; 
                    if(isset($_GET['furnish'])) $furnish = $_GET['furnish']  ;  
                    if(isset($_GET['tenant'])) $tenant = $_GET['tenant']  ;  
                    if(isset($_GET['mini'])) $min = $_GET['mini'] ; 
                    if($_GET['max'] != NULL) $max = $_GET['max'] ; 
                    else $max = PHP_INT_MAX ; 
                    $sql = "SELECT * FROM properties WHERE tenant LIKE '%$tenant%' AND furnish LIKE '%$furnish%' AND (price >= $min and price <= $max)" ; 
                }
                else{
                    //This is the default condition when no filter conditions ans search keywords are there
                    $sql = "SELECT * FROM properties" ; 
                }                
                $result = mysqli_query($con , $sql) ;
                if(mysqli_num_rows($result) != 0){
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <div class="rent-items">
                        <?php 
                            $id = $row['id'] ; 
                            $query = "SELECT * FROM images WHERE property = '$id'" ; 
                            $res = mysqli_query($con ,$query) ; 
            
                            while($r = mysqli_fetch_array($res)){ ?>
                                <div class="rent-items-image">
                                    <img src = '../images/property_images/<?php echo $r['imagename'];?>' alt = 'img not found'>
                                </div>
                                <?php
                                break ; 
                            } ?> 
                        <div class="rent-items-info">
                            <div class = "border">
                                <div class="info1">
                                    <div class="rent-price">Rent/Month :&nbsp; &#8377; <?php echo $row['price'] ; ?></div>
                                    <div class="sqft">Square Feet:&nbsp;  <?php echo $row['sqft'] ; ?></div>
                                </div>
                                <div class="info2">
                                    <div class="Owner">Owner:&nbsp;<?php echo $row['ownername'] ; ?></div>
                                    <div class="city">City:&nbsp;<?php echo $row['city'] ; ?></div>
                                </div>
                            </div>
                            <div class="moreinfo">
                            <?php if(isset($_SESSION['name'])){ ?> 
                                <form action = "property.php?action=more&a=<?php echo $row['id'] ;?>" method = 'POST'><input type = 'submit' name ='more' value = 'More Info'></form> 
                            <?php 
                            }
                            else{ ?>
                                <a href = 'login.php'>Login for more infomation</a>
                            <?php 
                            } ?>
                            </div>
                        </div>
                    </div>
                    <?php } 
                }
                else{
                    echo "No results Found!" ;  
                }?>
        </div>
    </div>
<?php  include '../templates/footer.php' ;?>
</body>
</html>
