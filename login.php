<?php
    session_start();
    include('/xampp/htdocs/BMS_3.0/assets/php/connect.php');

    include('/xampp/htdocs/BMS_3.0/assets/php/functions.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bakery Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
     
    
    </head>

    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">


                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" required  placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" required placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div> -->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type="submit" name="login-btn"class="btn btn-primary" value="Log In" >
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/BMS_3.0/register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
            </div>
            <?php
        

        if(isset($_POST["login-btn"])){
          $mail=$_POST["email"];
          $passcode=$_POST["password"];
          $sql="SELECT userId,email,password,firstName,lastName FROM users WHERE email='$mail' and password='$passcode' ";
          $result = $conn->query($sql);
          if ($result->num_rows == 1) {
            $_SESSION['user_mail']=$mail;
            // retrive user name
            $row = $result->fetch_assoc();

            $_SESSION['user_name']= $row['firstName']."&#160".$row['lastName'];
            $_SESSION['userId']= $row['userId'];

            header("Location:index.php");
            exit();
        }
      else{
         echo"<script>alert('wrong credentials')</script>";
        }
      }
        else {
          // echo "Unable to login user";
        }
         ?>

   <?php

include ('includes/footer.php');


?>
