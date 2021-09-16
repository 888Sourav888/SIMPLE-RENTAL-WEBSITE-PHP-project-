<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = 'author' content = ""> 
        <meta name = 'keywords' content = 'houses to rent home for rent cheap houses for rent cheap apartments for rent'>
        <meta name = 'description' content = 'Looking for Houses to Rent ?  We got you covered . Rent a house at your desired location at Rent Heaven. Create an account now!'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rent Heaven</title>
        <link rel = 'icon' href = 'images/logo.png'> 
        <link rel = 'stylesheet' href = 'css/header.css?v=<?php echo time() ;?>'>
    </head>
<body>
    <?php 
        // In this block of php code , session is started , database is connected and from the database
        // the number of requests that the user has recieved is fetched 
        session_start();
        include 'dbcon.php'  ;
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'] ; 
            $q  = "SELECT * FROM inbox WHERE reciever = $id" ; 
            $xresult = mysqli_query($con , $q) ; 
            $msgcount = mysqli_num_rows($xresult)  ; 
        }
        
    ?>
    <nav>
        <div class="logo"><img src = '../images/logo.png' height="50" width="50">
        <div class="title"><b>R</b>ent&nbsp;<b>H</b>eaven</div>
        </div>
        <label for = 'btn' class = 'icon'>
            <span class = 'threebars'>☰</span>
        </label>
        <input type  ='checkbox' id = 'btn'>
        <ul>
        <li><a href="../index.php">Home</a></li>
            <?php 
                //This if condition is for checking if someone is logged in the website or not
                // this is condition is used in almost every page of the website 
                if(isset($_SESSION['name'])){
                    ?>
                    <li><button data-modal-target ='#modal'>Requests
                        <?php
                            if($msgcount>0){ ?>
                            <sup><?php 
                            //The msg count is displayed 
                            echo $msgcount ; ?></sup>
                        <?php
                            }
                        ?>

                    </button></li>
                    <li>
                        <label for = 'btn-1' class = 'show'>Services +</label> 
                        <a href="#" class ='mediadisapper'>Services</a>
                        <input type  ='checkbox' id = 'btn-1'> 
                        <ul>
                            <li><a href ='list.php'>List</a></li>
                            <li><a href='rent.php'>Rent</a></li>
                        </ul>
                    </li>
                <?php
                }
            ?>  
            <li><a href="terms.php">Terms &amp; Conditions</a></li>
            <?php 
                //Displaying the name of the user in the button 
                if(!isset($_SESSION['name'])){ ?>
            <li><a href="login.php" >Login</a>
                <?php }
                else{ ?>
                    <label for = 'btn-2' class = 'show'>👤 <?php echo $_SESSION['name'] ; ?>+</label>
                    <li><a href="#" class = 'mediadisapper'>👤 <?php echo $_SESSION['name'] ; ?></a>
                        <input type  ='checkbox' id = 'btn-2'> 
                
                <ul>
                    <li><a href="../php/myaccount.php">My Account</a></li>
                    <li><a href="../php/myproperties.php">My Properties</a></li>
                    <li><a href = "../templates/logout.php">Logout</a></li>
                </ul>
                <?php } ?>
            </li>
        </ul>
    </nav>
    <div class="modal" id = 'modal'>
        <div class="modal-header">
                <div class="title">REQUESTS</div>
                <button data-close-button  class="close-button">&times;</button>
        </div>
        <div class="modal-body">
            
                 <?php 
                 //This block of code fetches details about all the requests that has been recieved 
                 //and displayed in a modal entitled as 'REQUESTS' 
                    if(isset($_SESSION['name'])){
                        $query  = "SELECT * FROM inbox WHERE reciever = $id" ; 
                        $result =  mysqli_query($con , $query) ; 
                        $c =  1 ; 
                        if(mysqli_num_rows($result) !=  0){ ?>
                            <table>
                                <tr>
                                    <th>S.no</th>
                                    <th>Request from</th>
                                    <th>Property Area</th>
                                    <th>Property City</th>
                                </tr>
                            <?php 
                            while($row = mysqli_fetch_array($result)){

                                $sender = $row['sender'] ; 
                                $q = "SELECT fname , lname FROM account WHERE id = $sender" ; 
                                $res = mysqli_query($con  , $q) ; 
                                while($r = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <td><?php echo $c ; ?></td>
                                    <td><?php echo $r['fname']." ".$r['lname'] ;?> </td>
                                
                                <?php
                                }
                                $pro_id = $row['pid'] ; 
                                $q  = "SELECT area,city FROM properties WHERE id = $pro_id " ; 
                                $res = mysqli_query($con , $q) ; 
                                while($r=  mysqli_fetch_array($res)){
                                ?>
                                    <td><?php echo $r['area'] ; ?></td>
                                    <td><?php echo $r['city'] ; ?></td>
                                    <td><a href = 'myproperties.php'>Go To My properties</a></td>
                                    </tr>
                                <?php 
                                }
                                $c++  ;
                            }
                            ?> </table><?php 
                        }
                        else{
                            echo "<div class = 'no-msg'>Currently There are no requests!</div>" ; 
                        }
                    }
                ?> 
            
        </div>
    </div>
    <?php 
        //This block of PHP code will terminate all the listings that is beyond the expiry date from the database 
        if(!isset($scavengedue))$scavengedue = time() ; 
        if($scavengedue <= time()){
            $scaquery = "SELECT * FROM properties " ; 
            $scares = mysqli_query($con , $scaquery) ; 
            $scavenge_id = array() ; 
            while($r = mysqli_fetch_array($scares)){
                if($r['expiry']<= date('Y-m-d')){
                    array_push($scavenge_id,$r['id']) ; 
                }
            }
            for($i = 0 ; $i<count($scavenge_id) ; $i++){
                $scadrop = "DELETE FROM properties WHERE id = ".$scavenge_id[$i] ; 
                mysqli_query($con , $scadrop) ; 
            }
            $scavengedue = time() + 86400*28 ; // every 28 days the properties that are beyond the expiry date will be terminated 
        }

    ?>
    <div id = 'overlay'></div>
    <script src = '../javascript/header.js'></script>
</body>
</html>
