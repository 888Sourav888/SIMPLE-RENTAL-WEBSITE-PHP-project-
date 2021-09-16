<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = 'author' content = ""> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered</title>
    <link rel = 'icon' href = '../images/logo.png'> 
    <style>
        body{
            margin:0 ; 
            height:100vh ; 
            display:flex ; 
            justify-content:center ; 
            align-items:center;  
            background-image:url('../images/interior.jpg')  ;
            background-size:cover ; 
            background-repeat:no-repeat ; 
        }
        .box{
            background-image : linear-gradient(70deg , black ,grey);
            border:2px solid black ; 
            padding:50px ; 
            display:flex ; 
            flex-direction: column;  
            justify-content:center ; 
            align-items:center;
            color:white ; 
        }
        .box a{
            text-decoration:none ; 
            color: white; 
            cursor : pointer ; 
            transtion: 0.1s ; 
            border-radius:5px ;
            padding:15px;
        }
        .box a:hover{
            background-color:black ;
            box-shadow: 2px 2px 10px cyan ;
            border:2px solid cyan ; 
        }

    </style>
</head>
<body>
    <!-- This page is displayed when an account for the user is successfully setup  -->
    <div class="box">
        <h1>Registration successful!</h1>
        <h2>Your account has been created</h2>
        <a href = 'login.php'>LOGIN</a>
    </div>
</body>
</html>
