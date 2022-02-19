<?php

include 'config.php';


session_start();
error_reporting(0);



/*
if(isset($_SESSION['name'])){
    header("Location: index.php");
} 
*/

if(isset($_POST['login'])){

    $user_input = mysqli_real_escape_string($conn, $_POST['login_user_input']);
    $user_password = mysqli_real_escape_string($conn, md5($_POST['login_user_password']));


    $check_user_email_query = "SELECT * FROM userinfo WHERE userEmail = '$user_input'";
    $check_user_name_query = "SELECT * FROM userinfo WHERE userName = '$user_input'";

    if(mysqli_num_rows(mysqli_query($conn, $check_user_email_query)) > 0){

        $check_password_query = "SELECT * FROM userinfo WHERE userPassword = '$user_password'";
        if(mysqli_num_rows(mysqli_query($conn, $check_password_query)) > 0){

            $row = mysqli_fetch_assoc($check_password_query);
            $_SESSION['name'] = $row['userName'];
            $_SESSION['email'] = $row['userEmail'];
        
            header("Location: index.php");
        }
        else{

            echo "<script>alert('Log in details incorrect.')</script>";
        }
    }elseif(mysqli_num_rows(mysqli_query($conn, $check_user_name_query)) > 0){

        $check_password_query = "SELECT * FROM userinfo WHERE userPassword = '$user_password'";
        if(mysqli_num_rows(mysqli_query($conn, $check_password_query)) > 0){

            $row = mysqli_fetch_assoc($check_password_query);
            $_SESSION['name'] = $row['userName'];
            $_SESSION['email'] = $row['userEmail'];
        
            header("Location: index.php");
        }
        else{

            echo "<script>alert('Log in details incorrect.')</script>";
        }

    }else{

        echo "<script>alert('Log in details incorrect.')</script>";
    }

}



if(isset($_POST['signup'])){

    $user_name = mysqli_real_escape_string($conn, $_POST['signup_user_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['signup_user_email']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['signup_user_phone']);
    $user_password = mysqli_real_escape_string($conn, md5($_POST['signup_user_password']));

    $check_user_email = mysqli_num_rows(mysqli_query($conn, "SELECT userEmail FROM userinfo WHERE userEmail = '$user_email'"));
    $check_user_name = mysqli_num_rows(mysqli_query($conn, "SELECT userName FROM userinfo WHERE userName = '$user_name'"));

    


    if($check_user_email > 0){
        echo "<script>alert('User already exist.')</script>";
    }elseif($check_user_name > 0){      
        echo "<script>alert('Username already exist. Try a different user name')</script>";
    }elseif($check_user_email == 0 && $check_user_name == 0){

        $sql = "INSERT INTO userinfo (userEmail, userPassword, userName, userMobile) VALUES ('$user_email', '$user_password', '$user_name', '$user_phone')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('User Registration Successful.')</script>";
            //$_SESSION['name'] = $user_name;
            //header("Location: login-register.php");
        }

    }else {
        echo "<script>alert('User Registration Failed.')</script>";
    }

    
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUSTHIR CARS | LOGIN-REGISTRATION</title>
    <!-- bootstrap stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- custom stylesheet -->
    <link rel="stylesheet" href="css/login-register.css" />

    <!-- fontawesome kit -->
    <script src="https://kit.fontawesome.com/d1dbecc215.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- header start -->
    <header>
        <!-- navbar -->
        <nav id="austhir-nav" class="navbar navbar-expand-lg py-0">
            <div id="nav-bar" class="container-fluid">
                <a class="navbar-brand austhir-nav-link" href="index.php">
                    <img src="images/logo.png" alt="" width="90" height="90"
                        class="d-inline-block align-text-top" /></a>
                <button id="nav-hamburger-button" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 19.5C6.82843 19.5 7.5 18.8284 7.5 18C7.5 17.1716 6.82843 16.5 6 16.5C5.17157 16.5 4.5 17.1716 4.5 18C4.5 18.8284 5.17157 19.5 6 19.5Z"
                            fill="#FF4604" />
                        <path
                            d="M30.09 16.5H11.91C11.1313 16.5 10.5 17.1313 10.5 17.91V18.09C10.5 18.8687 11.1313 19.5 11.91 19.5H30.09C30.8687 19.5 31.5 18.8687 31.5 18.09V17.91C31.5 17.1313 30.8687 16.5 30.09 16.5Z"
                            fill="#FF4604" />
                        <path
                            d="M30.09 24H5.91C5.13128 24 4.5 24.6313 4.5 25.41V25.59C4.5 26.3687 5.13128 27 5.91 27H30.09C30.8687 27 31.5 26.3687 31.5 25.59V25.41C31.5 24.6313 30.8687 24 30.09 24Z"
                            fill="#FF4604" />
                        <path
                            d="M30.09 9H5.91C5.13128 9 4.5 9.63128 4.5 10.41V10.59C4.5 11.3687 5.13128 12 5.91 12H30.09C30.8687 12 31.5 11.3687 31.5 10.59V10.41C31.5 9.63128 30.8687 9 30.09 9Z"
                            fill="#FF4604" />
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div id="nav-items-container"
                        class="d-flex flex-column align-items-center flex-lg-row justify-content-between w-100">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item austhir-nav-item">
                                <a class="nav-link austhir-nav-link" aria-current="page"
                                    href="index.php#our-services">Our Services</a>
                            </li>
                            <li class="nav-item austhir-nav-item">
                                <a class="nav-link austhir-nav-link active" href="index.php#featured-car">Featured
                                    Cars</a>
                            </li>
                            <li class="nav-item austhir-nav-item">
                                <a class="nav-link austhir-nav-link" href="index.php#hot-sells">Hot Sells</a>
                            </li>
                            <li class="nav-item austhir-nav-item">
                                <a class="nav-link austhir-nav-link" href="index.php#why_us">Why Us?</a>
                            </li>
                            <li class="nav-item austhir-nav-item">
                                <a class="nav-link austhir-nav-link" href="index.php#contact_us">Contact Us</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav me-0 me-lg-4 mb-2 mb-lg-0">
                            <li class="nav-item log-sign-nav-item d-flex align-items-center">
                                <i class="d-none d-lg-block far fa-user me-2"></i>
                                <a class="nav-link austhir-nav-link" href="#">Log In</a>
                            </li>
                            <li class="nav-item log-sign-nav-item">
                                <a class="nav-link austhir-nav-link" href="#">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- header end -->

    <main>
        <div class="login-register">
            <div class="row">
                <!-- login -->
                <div class="content col-12 col-lg-6" id="left">
                    <div class="text">
                        <h1>
                            <b>
                                Log in to your account
                            </b>
                        </h1>
                        <p>
                            Welcome back! Sign in to your account
                        </p>
                    </div>
                    <div class="form">
                        <form action="" class="login_form" method="POST">
                            <div class="mb-3">
                              <input type="text" class="form-control inputbox" name="login_user_input" id="exampleInputEmail" placeholder="Email or Username">
                            </div>
                            <div class="mb-4">
                              <input type="password" class="form-control inputbox" name="login_user_password" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <div class="mb-4 form-check" id="remember">
                                <input type="checkbox" name= "login_checkbox" class="form-check-input check" id="exampleCheck">
                                <label class="form-check-label checktext" for="exampleCheck">Remember</label>
                            </div>
                            <button type="submit" class="btn austhir-btn" name="login">Login</button>
                        </form>
                    </div>
                </div>
                <!-- login end -->

                <!-- registration -->
                <div class="content col-12 col-lg-6" id="right">
                    <div class="text">
                        <h1>
                            <b>
                                Register
                            </b>
                        </h1>
                        <p>
                            Create new account today
                        </p>
                    </div>
                    <div class="form">
                        <form action="" class="sign_up_form" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control inputbox" name="signup_user_name" id="exampleInputName1" placeholder="Username*" required>
                            </div>
                            <div class="mb-3">
                              <input type="email" class="form-control inputbox" name="signup_user_email" id="exampleInputEmail1" placeholder="Email*" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control inputbox" name="signup_user_phone" id="exampleInputPhone1" placeholder="Phone">
                            </div>
                            <div class="mb-4">
                              <input type="password" class="form-control inputbox" name="signup_user_password" id="exampleInputPassword1" placeholder="Password*" required>
                            </div>
                            <div class="mb-4 form-check">
                                <input type="checkbox" name="signup_checkbox" class="form-check-input check" id="exampleCheck1" required>
                                <label class="form-check-label checktext" for="exampleCheck1">I accept the <a href="#" id="privacy-text">privacy policy</a></label>
                            </div>
                            <button type="submit" class="btn austhir-btn" name="signup">Register</button>
                        </form>
                    </div>
                </div>
                <!-- registration end -->
            </div>
        </div>
    </main>

    <!-- footer -->
    <footer>
        <div class="container-fluid h-100 d-flex align-items-center">
            <div class="row row-cols-1 row-cols-md-2 w-100 d-flex justify-content-between align-items-center">
                <div class="copyright-text text-center text-md-start">
                    <p>Copyright © Austhir Cars 2022. All rights reserved.</p>
                </div>

                <div class="social-links d-flex justify-content-center justify-content-md-end">
                    <a class="social-link" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="social-link" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="social-link" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
</body>

</html>