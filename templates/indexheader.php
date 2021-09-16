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
    //This index header is a copy of header.php 
    // But the only difference is that hyperlinks in this file will differ from the header.php 
    // Checkout header.php for comments of the php code block
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
        <div class="logo"><img src = 'images/logo.png' height="50" width="50">
        <div class="title"><b>R</b>ent&nbsp;<b>H</b>eaven</div>
        </div>
        <label for = 'btn' class = 'icon'>
            <span class = 'threebars'>☰</span>
        </label>
        <input type  ='checkbox' id = 'btn'>
        <ul>
        <li><a href="index.php">Home</a></li>
            <?php 
                if(isset($_SESSION['name'])){
                    ?>
                    <li><button data-modal-target ='#modal'>Requests
                        <?php
                            if($msgcount>0){ ?>
                            <sup><?php echo $msgcount ; ?></sup>
                        <?php
                            }
                        ?>

                    </button></li>
                    <li>
                        <label for = 'btn-1' class = 'show'>Services +</label> 
                        <a href="#" class ='mediadisapper'>Services</a>
                        <input type  ='checkbox' id = 'btn-1'> 
                        <ul>
                            <li><a href ='php/list.php'>List</a></li>
                            <li><a href='php/rent.php'>Rent</a></li>
                        </ul>
                    </li>
                <?php
                }
            ?>  
            <li><a href="php/terms.php">Terms &amp; Conditions</a></li>
            <?php 
                if(!isset($_SESSION['name'])){ ?>
            <li><a href="php/login.php" >Login</a>
                <?php }
                else{ ?>
                    <label for = 'btn-2' class = 'show'>👤 <?php echo $_SESSION['name'] ; ?>+</label>
                    <li><a href="#" class = 'mediadisapper'>👤 <?php echo $_SESSION['name'] ; ?></a>
                        <input type  ='checkbox' id = 'btn-2'> 
                <ul>
                    <li><a href="php/myaccount.php">My Account</a></li>
                    <li><a href="php/myproperties.php">My Properties</a></li>
                    <li><a href = "templates/logout.php">Logout</a></li>
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
                                    <td><a href = 'php/myproperties.php'>Go To My properties</a></td>
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
    <div id = 'overlay'></div>
    <script src = 'javascript/header.js'></script>
</body>
</html>
