<?php

session_start();

include('/xampp/htdocs/BMS_3.0/assets/php/connect.php');

include('/xampp/htdocs/BMS_3.0/assets/php/functions.php');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   if(!empty($email) && !empty($password) && !is_numeric($email)){

    //save to database
        $query = "insert into users ( firstName, lastName, email, password) values ( '$firstName', '$lastName', '$email', '$password')";

        mysqli_query($conn,  $query);

        header("Location: login.php");
        die;

    }else{

        echo "<script>alert('Please enter valid information')</script> ";
    }
 

 }



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


  
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registration Form</h3></div>
                                    <div class="card-body">

                                        <!--connect to the database-->
                                       <!-- <form action="/Applications/MAMP/htdocs/BMS_3.0/assets/php/connect.php" method="POST"> -->
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="firstName" type="text" name="firstName" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="lastName" type="text" name="lastName" required placeholder="Enter your last name" />
                                                        <label for="lastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" type="email" name="email" required  placeholder="Enter your email: name@example.com" />
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="password" type="password" required name="password" placeholder="Create a password" />
                                                        <label for="password">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" value="Register"/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/BMS_3.0/login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
   

   <?php

include ('includes/footer.php');
include ('includes/scripts.php');

?>
