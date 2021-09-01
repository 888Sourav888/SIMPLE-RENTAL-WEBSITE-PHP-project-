<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = "SOURAV KUMAR NRS 2020115089"> 
    <title>Rent-Heaven : MyProperties</title>
    <link rel = 'icon' href = '../images/logo.png'> 
    <link rel = 'stylesheet' href=  '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href=  '../css/myproperties.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
</head>
<body>

    <?php 
    //This page is responsible for all the properties that a user has 
    //This page also contains all the requesting of the property that a user has recieved 
    //From this page the user can unlist his listing , he can accept , reject his request
    //If ulist or accept button is clicked the property will be removed from the database 

    session_start()  ;
    if(isset($_SESSION['id'])){ ?>
    <?php 
        include '../templates/dbcon.php' ; 
        //if block responsible for rejecting the request
        //When reject button is clicked simply the request will be taken out from the database 
        if(isset($_POST['reject'])){
            $msgid = $_POST['rej'] ; 
            $query1 = "DELETE FROM inbox WHERE msgid = $msgid" ; 
            mysqli_query($con ,$query1) ; 
        }
        //This if statement is responsible for accepting a property 
        //if a property is accepted that property will be removed from the database 

        if(isset($_POST['accept'])){

            //The next three lines will remove the request from the database 
            $msgid = $_POST['acc'] ; 
            $query1 = "DELETE FROM inbox WHERE msgid = $msgid" ; 
            mysqli_query($con ,$query1) ; 

            //The following lines will unlist the property from the database and delete all the image files related to it 
            //unlink() function is used to delete the images of the property from the directory in which they are there
            $images = array() ; 
            $P_id = $_POST['accp'] ; 
            $query1 = "SELECT * FROM images WHERE property = $P_id" ; 
            $result = mysqli_query($con , $query1) ; 
            while($row = mysqli_fetch_array($result)){
                array_push($images , $row['imagename']) ; 
            }
            for($i  =0  ;$i <count($images) ; $i++){
                $imgname = $images[$i] ; 
                $url = "../images/property_images/".$imgname ; 
                unlink($url)  ;
            }
            $query1 = "DELETE FROM properties WHERE id = $P_id" ;
            mysqli_query($con , $query1) ; 
        }
        //This if block is responsible for unlisting the property 
        //Functionality is similar to the one that is done while accepting the offer 
        if(isset($_POST['unlist'])){
            $images = array() ; 
            $P_id = $_POST['proid'] ; 
            $query1 = "SELECT * FROM images WHERE property = $P_id" ; 
            $result = mysqli_query($con , $query1) ; 
            while($row = mysqli_fetch_array($result)){
                array_push($images , $row['imagename']) ; 
            }
            for($i  =0  ;$i <count($images) ; $i++){
                $imgname = $images[$i] ; 
                $url = "../images/property_images/".$imgname ; 
                unlink($url)  ;
            }
            $query1 = "DELETE FROM properties WHERE id = $P_id" ;
            mysqli_query($con , $query1) ;
        }

    ?>
    <?php 
    include '../templates/mypropheader.php' ; 
    ?>
    <div class="properties">
        <h1>My Properties</h1>
        <?php  
            $ownerid = $_SESSION['id'] ; 
            $query = "SELECT * FROM properties WHERE owner = $ownerid" ; 
            $result = mysqli_query($con , $query) ;
            $n =1  ;
            if(mysqli_num_rows($result )!=0){
                ?> 
                    <table>
                    <tr class = 'box'>
                        <th class ='box-content'>S.no</th>
                        <th class ='box-content' >Image</th>
                        <th class ='box-content' id = 'medis'>Area</th>
                        <th class ='box-content' id = 'medis'>City</th>
                        <th class="box-content" id = 'medis'>State</th>
                        <th class ='box-content' id = 'medis'>Rent-Amount/Month</th>
                        
                    </tr>
                <?php
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr class="box">
                        <td class="box-content" ><?php echo $n ; ?></td>
                            <td class="box-content">
                                <?php  
                                    $pid = $row['id'] ; 
                                    $sql = "SELECT * FROM images WHERE property = $pid " ; 
                                    $res = mysqli_query($con , $sql) ; 
                                    while($r = mysqli_fetch_array($res)){
                                        $url = '../images/property_images/'.$r['imagename'] ; 
                                        ?>
                                        <?php echo "<img src = '$url' alt = 'img not found' "  ; ?>
                                    <?php 
                                        break  ; 
                                    }
                                ?>
                            </td>
                            <td class="box-content" id = 'medis'><?php echo $row['area'] ; ?></td>
                            <td class="box-content" id = 'medis'><?php echo $row['city'] ; ?></td>
                            <td class="box-content" id = 'medis'><?php echo $row['state'] ; ?></td>
                            <td class="box-content" id = 'medis'>&#8377;<?php echo $row['price'] ; ?></td>
                            <td class ='box-items'><form action ="property.php?action=see&a=<?php echo $pid; ?>" method = "post" class = 'seeprop'>
                            <input type = 'submit' name= 'see'  value = 'See Details' >
                            </form></td>
                            <td class="box-content">
                                    <form action ="" method = 'post'>
                                        <input type = 'hidden' name = 'proid' value = <?php echo $row['id'] ; ?> >
                                        <input type = 'submit' name = 'unlist' value = 'Unlist'>
                                    </form>
                            </td>
                        
                    </tr> <?php 
                    $n++ ; 
                }
                ?></table><?php 
            }
            else {
        ?>
        <div class="noprop">
            <h2>Currently there are no properties listed !</h2>
            <a href = 'list.php'>List Property</a> 
        </div>
        <?php } ?>
    </div>
    <div class="requests">
        <h1>Requests</h1>
        <?php 
            $reciever = $_SESSION['id'] ; 
            $query = "SELECT * FROM inbox WHERE reciever = $reciever" ; 
            $result = mysqli_query($con , $query) ;
            $n =1  ; 
            if(mysqli_num_rows($result)){
                ?>
                <table>
                    <tr class = 'box'>
                        <th class = 'box-items' >S.No</th>
                        <th class ='box-items' >Requester</th>
                        <th class  ='box-items'>Phone</th>
                        <th class  ='box-items'>Email</th>
                        <th class ='box-items' id = 'medis'>Area</th>
                        <th class ='box-items' id = 'medis'>City</th>
                        <th class ='box-items' id = 'medis'>Property</th>
                        <th class ='box-items'></th>
                        <th class ='box-items'></th>
                    </tr><?php 
                while($row = mysqli_fetch_array($result)){ 
                    ?> <tr class = 'box'><?php 
                    $sender = $row['sender'] ; 
                    $sender_sql = "SELECT fname , lname , phone , email FROM account WHERE id = $sender"  ; 
                    $res = mysqli_query($con , $sender_sql) ; 
                    ?><td class ='box-items'><?php echo $n ; ?></td><?php
                    while($r = mysqli_fetch_array($res)){
                        ?>
                            <td class ='box-items'  > <?php echo $r['fname']." ".$r['lname'] ;  ?></td>
                            <td class = 'box-items'><?php echo $r['phone'] ;?></td>
                            <td class = 'box-items'><?php echo $r['email'] ;?></td>
                        <?php
                        break ; 
                    }
                    $pro_id = $row['pid'] ; 
                    $sql = "SELECT * FROM properties WHERE id = $pro_id" ; 
                    $res = mysqli_query($con , $sql) ; 
                    while($r = mysqli_fetch_array($res)){
                        ?>
                        <td class ='box-items' id = 'medis'><?php echo $r['area'] ?></td>
                        <td class ='box-items' id = 'medis'><?php echo $r['city'] ?></td>
                    <?php   
                    }
                    ?> 
                    
                        <td class ='box-items'><form action ="property.php?action=see&a=<?php echo $pro_id; ?>" method = "post" class = 'seedetail'>
                            <input type = 'submit' name= 'see'  value = 'See details' >
                        </form></td>
                        <td class ='box-items'><form action ="" onsubmit = 'return transaction()' method = "post">
                            <input type = "hidden" name = 'acc' value = <?php echo $row['msgid'] ; ?>> 
                            <input type = "hidden" name = 'accp' value = <?php echo $pro_id ; ?>> 
                            <input type = 'submit' value = 'Accept' name = 'accept' id ='accept'>
                        </form></td>   
                        <td class ='box-items'><form action ="" method = "post">
                            <input type = "hidden" name = 'rej' value = <?php echo $row['msgid'] ; ?>> 
                            <input type = 'submit' name = 'reject' value = 'Reject'>
                        </form></td>        
                <?php
                $n++ ; 
                }
                ?>
                </table>
            <?php 
            }
            else{
        ?>
        <div class="norequests">
            <h2>Currently There are no requests!</h2>
        </div>
        <?php } ?> 
    </div>
    <?php
    }
    else{
        header('Location: ../index.php') ; 
    }
    ?>
    <script>
        //This is a validation for the accepting request form 
        //It asks the user to confirm whether he is sure about accepting the offer or not 
        function transaction(){
            if(confirm('Are you Sure , you wanna accept the request?')){
                alert('Thank you for Choosing our platform')  ; 
                return true ; 
            }
            else{
                return false ; 
            }
        }

    </script>
    

<?php  include '../templates/footer.php' ;?>
</body>
</html>