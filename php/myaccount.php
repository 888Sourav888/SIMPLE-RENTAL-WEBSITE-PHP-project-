<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'author' content = "SOURAV KUMAR NRS 2020115089"> 
    <title>RentHeaven - My Account</title>
    <link rel = 'icon' href = '../images/logo.png'> 
    <link rel = 'stylesheet' href=  '../css/header.css?v=<?php echo time();?>'> 
    <link rel = 'stylesheet' href=  '../css/myaccount.css?v=<?php echo time();?>'> 
</head>
<body>
    <?php 
    //This code file allows user to change his account details , if in case he need to change 
    //It provides the functionality to change the profile picture 
    //functionality to change the account details such as name ,age , email , dob etc 
    //functionality to change the password for the user's account 
        include '../templates/header.php' ;
        include '../templates/dbcon.php' ; 
    ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //This first if block contains the code to change the profile picture of the user 
            //The mechanism used here is similar to the one used to handle all the uploaded property images 
            //Checkout the list.php to know about the image handling mechanism 
            //functions such as move_uploaded_file is used , extension of the file that is uploaded is checked 

            if(isset($_POST['upload'])){
                if(isset($_FILES['profile'])){
                    $target_dir = "../images/profile/";
                    $filename = basename($_FILES["profile"]["name"]);
                    $targetFilePath = $target_dir . $filename ; 
                    $imageFileType = (pathinfo($targetFilePath,PATHINFO_EXTENSION));
                    $allowtypes = array('jpg','png','jpeg') ; 
                    if(in_array($imageFileType , $allowtypes)){
                        if(!move_uploaded_file($_FILES['profile']['tmp_name'] , $targetFilePath)){
                            echo "Profile pic was not moved to the database" ; 
                        } 
                        else{
                            $aaid = $_SESSION['id'] ; 
                            $_SESSION['profile_pic'] = 1 ; 
                            $sql = "UPDATE account SET image = '$filename' WHERE id = $aaid" ; 
                            if(!mysqli_query($con,$sql)) echo $con -> error ; 
                        }
                        
                    }
                    else{
                        echo "<script>alert('Image file type not supported');</script>" ; 
                    }
                }
                else{
                    echo "<script>alert('No image is chosen');</script>" ; 
                }
            }
            //This if block is to change the details of the user in the database 
            //It once again gets all the data from the edit form and update each and every field of the user with
            // the new data
            if(isset($_POST['editsubmit'])){
                $fname  = $_POST['fname'] ; 
                $lname = $_POST['fname'] ; 
                $age =$_POST['age'] ; 
                $dob = $_POST['dob']; 
                $mail = $_POST['mail'];  
                $phone = $_POST['phone'] ; 
                $password = $_POST['pass'] ; 
                $city = $_POST['city']  ;
                $state = $_POST['state'] ;
                $columns =array('fname','lname','age','dob','email','phone','password','city','state') ; 
                $columnvalues = array($_POST['fname'] , $_POST['lname'],$_POST['age'],$_POST['dob'],$_POST['mail'],$_POST['phone'],$_POST['pass'],$_POST['city'],$_POST['state'] )  ; 
                //for loop to update all the fields of the table 
                for($i = 0 ; $i<count($columns) ; $i++){
                    $query = "UPDATE account SET ".$columns[$i]." = ".$columnvalues[$i]." WHERE id = ".$_SESSION['id'] ; 
                    if(!mysqli_query($con , $query)){
                        $f = 1 ; 
                        $con -> error ; 
                    } 
                }
                //if no error occurs in the data updation , this if block will be executed 
                if(!isset($f)) echo "<script>alert('Data Change Successfully');</script>"    ;            
            }
            //This if block handles the change password feature 
            //This mainly checks if the oldpassword entered by the user matches with the one in the database or not 
            //If it matches then it updates the password to the newone 
            //if it doesn't match the code encourages the user to try again 
            if(isset($_POST['passchange'])){
                $oldpass = $_POST['oldpass'] ; 
                $newpass  = $_POST['newpass'] ; 
                $query = "SELECT password FROM account WHERE id = ".$_SESSION['id'] ; 
                $res = mysqli_query($con , $query) ; 
                while($r = mysqli_fetch_array($res)){
                    if($r['password'] != $oldpass){
                        echo "<script>alert('Your Old password is wrong')</script>" ; 
                        $f = 1; 
                        $_POST['changepass'] = 'Change' ; 
                    }
                }
                if(!isset($f) ){
                    $q = "UPDATE account SET password = '$newpass' WHERE id = ".$_SESSION['id'];  
                    if(!mysqli_query($con , $q)) echo $con -> $error ; 
                    echo "<script>alert('Password Changed Succesfully')</script>" ; 
                    
                }
            }
            
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            //This block of if statement is there to remove the uploaded profile photo 
            //Removing the profile photo takes place in the following manner 
            //First the name of the profile photo will be replaced by NULL in the database 
            //Then from a particular directory which has all the profile pics , the photo which needs to be removed 
            // will be deleted , the deletion is done using unlink() function 
            if(isset($_GET['remove'])){
                if(!isset($_SESSION['id'])){
                    header('Location: ../index.php') ; 
                }
                $aaid = $_SESSION['id'] ; 
                $sql = "SELECT image FROM account WHERE id = $aaid" ;
                $res = mysqli_query($con , $sql) ; 
                while($row = mysqli_fetch_array($res)){
                    $img = $row['image'] ; 
                    $url = '../images/profile/'.$img ; 
                } 
                if($img) unlink($url)  ;
                $update = NULL ; 
                $sql = "UPDATE account SET image = '$update' WHERE id = $aaid" ; 
                mysqli_query($con , $sql)  ;
                $_SESSION['profile_pic'] = 0 ;

            }
        }
    ?>
    <!-- Here is the display section of this page ,
    this either displays the account details or a form that changes the account details  -->
    <?php if(isset($_SESSION['id'])){ ?>
    <div class="details-display">
        <h1>Account Details</h1>
        <div class="display-content">
            <?php 
            //This if statement will display the form which allows the user to edit his account details
            if(isset($_POST['edit'])){
                $query = "SELECT * FROM account where id = ".$_SESSION['id'] ; 
                $result = mysqli_query($con , $query) ; 
                while($row  = mysqli_fetch_array($result) ){
                ?>
                    <div class="edit-form">
                        <form action  ="" method = 'post'>
                            <label for = 'fname'>Firstname:</label>
                            <input type = 'text' name = 'fname' id = 'fname' value = <?php echo $row['fname'] ; ?> required>
                            <label for = 'lname'>Lastname:</label>
                            <input type = 'text' name = 'lname' id = 'lname' value = <?php echo $row['lname'] ; ?> required> 
                            <label for = 'name'>Age:</label>
                            <input type = 'text' name = 'age' id = 'age' value = <?php echo $row['age'] ; ?> required> 
                            <label for = 'dob'>Date of Birth:</label>
                            <input type = 'date' name = 'dob' id = 'dob' value = <?php echo $row['dob'] ; ?> required> 
                            <label for = 'mail'>Email:</label>
                            <input type = 'text' name = 'mail' id='mail' value = <?php echo $row['email'] ; ?> required> 
                            <label for = 'phone'>Phone:</label>
                            <input type = 'text' name = 'phone' id ='phone'  value = <?php echo $row['phone'] ; ?> required> 
                            <label for = 'city'>City:</label>
                            <input type = 'text' name = 'city' id='city' value = <?php echo $row['city'] ; ?> required> 
                            <label for = 'state'>State:</label>
                            <input type = 'hidden' name = 'pass' value = <?php echo $row['password'] ?>> 
                            <input type  ='hidden' name = 'image' value = <?php echo $row['image']?>>
                            <input type = 'text' name = 'state' value = <?php echo $row['state'] ; ?> required>
                            <div class = 'editsubmit'><input type = 'submit' value = 'submit' name = 'editsubmit'></div>
                        </form>
                    </div>
                <?php
                }
            }
            else if(isset($_POST['changepass'])){
                //This if statment displays the form which allows the user to update his  password 
                ?>
                    <div class ='pass-form'>
                        <form action = '' method = 'post' onsubmit = 'return valid()'>
                            <label for = 'oldpass'>Enter Old Password:</label>
                            <input type = 'password' id = 'oldpass' name = 'oldpass' required  >
                            <label for = 'newpass'>Enter New Password:</label>
                            <input type = 'password' id = 'newpass' name = 'newpass' required  >
                            <label for = 'renewpass'>Re-Enter New Password:</label>
                            <input type = 'password' id = 'renewpass' name = 'renewpass' required  >
                            <div class = 'passsubmit'><input type = 'submit' name = 'passchange' value = 'Change'></div>
                        </form>
                    </div>
                
                <?php
            }
            else{
            ?>
            <div class="box2">  
                <?php
                //this if conditon will decide what to display in the profile photo section 
                //this session variable is set in login.php 
                if($_SESSION['profile_pic'] == 0){
                ?>
                    <img src = '../images/user.jpg' alt = 'img not found!' >
                    <div class="box-box2">
                        <form action ="myaccount.php" class = 'upload-form' enctype="multipart/form-data" method = "post">
                            <input type = 'file' name = 'profile'  class =  'choosefile' required>
                            <input type = 'submit' name = 'upload' value = 'Upload Profile Picture'>
                        </form>
                    </div>
                <?php }
                else{
                    //Then finally the else part which is the default condition 
                    // that will display the account details of the user for his reference 
                    $acc_id = $_SESSION['id'] ; 
                    $q = "SELECT image FROM account WHERE id = $acc_id " ; 
                    $result = mysqli_query($con , $q) ; 
                    while($r = mysqli_fetch_array($result)){
                        $path = '../images/profile/'.$r['image'] ; 
                    }
                    ?>
                        <img src = <?php echo $path ; ?> alt = 'img not found!' >
                        <form action = "" method = 'get' class = 'remove-photo'>
                            <input type = 'submit' value = 'Remove Photo' name = 'remove'>
                        </form>
                <?php 
                }
                ?>
            </div>
            <div class="box1">
                <table>
                    <?php 
                        $id = $_SESSION['id'] ; 
                        $query = "SELECT * FROM account WHERE id = $id" ; 
                        $result = mysqli_query($con , $query) ; 
                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td>Name:</td>
                                <td><?php echo $row['fname']." ".$row['lname'] ; ?>  </td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><?php echo $row['age'] ; ?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth:</td>
                                <td><?php 
                                $date = strtotime($row['dob']) ; 
                                echo date('d/m/Y',$date); 
                                ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td><?php echo $row['phone'] ; ?></td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td><?php echo $row['city'] ; ?></td>
                            </tr>
                            <tr>
                                <td>State:</td>
                                <td><?php echo $row['state'] ; ?></td>
                            </tr>
                        <?php 
                        }
                    ?>
                </table>
                <div class="buttons">
                <form action =  "" method = "post" class = 'edit'>
                        <input type  = 'submit' value = "Edit Details" name = 'edit'>
                </form>
                <form action =  "" method = "post" class = 'changepass'>
                        <input type  = 'submit' value = "Change Password" name = 'changepass'>
                </form>
                </div>
            </div>
            <?php } ?>
        </div>
        
    </div> <?php
    }
    else{ 
        header('Location: ../index.php') ; 
        //This page cannort be accessed without logging in ,
        // so if the website has no user logged into it if this page is opened by some situation
        // it will return the user to the index.php 
    }
    ?>

    <script>
        // This is the validation code for the change password form
        function valid(){   
            newpass = document.getElementById('newpass') ; 
            renewpass= document.getElementById('renewpass') ; 
            if(renewpass.value != newpass.value){
                alert('The new password and re-entered password did not match') ; 
                return false ; 
            }
            return true; 
        }

    </script>
</body>
</html>