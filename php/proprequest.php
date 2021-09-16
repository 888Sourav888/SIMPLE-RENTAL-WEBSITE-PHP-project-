<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = ""> 
    <title>Rent Heaven - Requested</title>
    <link rel = 'icon' href = '../images/logo.png'> 
    <link rel = 'stylesheet' href = '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href = '../css/footer.css?v=<?php echo time();?>' > 
    <style>
        .success-container{
            display:flex ; 
            justify-content:center ; 
            align-items: center ; 
            height:100vh ; 
        }
        .success{
            display:flex ; 
            justify-content:center ; 
            align-items: center ; 
            color:white ; 
            background-color:#1b1b1b ; 
            padding:50px;
        }
    </style>
</head>
<body>
    <?php
        include '../templates/header.php' ;
        include '../templates/dbcon.php' ; 
    ?>
    <?php
    //This is a php file which will run once the property request has been confirm 
    // This php file will take the request and put it into the table called as inbox 
    //with the sender id and reciever id and the property id 
    if(isset($_SESSION['id'])){
        if(isset($_SERVER['HTTP_REFERER'] )){
        $pid = $_GET['pid'] ; 
        $sender = $_SESSION['id']  ;
        $query = "SELECT owner FROM properties WHERE id = $pid " ; 
        $result = mysqli_query($con , $query) ; 
        while($row =mysqli_fetch_array($result)){
            $reciever = $row['owner'] ; 
            break ; 
        }
        $query = "INSERT INTO inbox(sender,reciever,pid) VALUES($sender,$reciever,$pid)" ; 
        mysqli_query($con , $query) ; 
        }
    ?>
    <div class="success-container">
        <div class="success">
            <h1>Your Request has been sent to the Property Owner</h1>
        </div>
    </div>
    <?php 
    }
    else{
        header('Location: ../index.php') ; 
    }
    ?>
    <?php include '../templates/footer.php' ; ?> 
</body>
</html>
