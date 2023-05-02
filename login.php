<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'links/links.php' ?>
</head>
<body>
    <?php 
    $con = mysqli_connect("localhost","phpmyadmin","Password@123","signup");
    if($con){
        echo '<script type="text/javascript">alert("Connection Success");</script>';
    }else{
        echo '<script type="text/javascript">alert("CNo Connection");</script>';
    }

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $emailSearch = "select * from registration where email='$email'";
        $searchResultCount = mysqli_num_rows(mysqli_query($con,$emailSearch)) ;

        if($searchResultCount){
            $row = mysqli_fetch_assoc(mysqli_query($con,$emailSearch));
            $dbPassword = $row['password'];

            $_SESSION['username'] = $row['username'];
            
            $passVerify = password_verify($password,$dbPassword);

            if($passVerify){
                echo "Login Successfull";
                ?>
                    <script>location.replace("home.php");</script>
                <?php
            }else{
                echo "Incorrect Password";
            }
        }else{
            echo "Email does not exists";
        }

    }
    ?>

<div class="card bg-light">
        <article class="card-body mx-auto" style="max-width:400px">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="text-center">Get statrted with your free account</p>
            <p>
                <a href="" class="btn btn-block btn-gmail">
                    <i class="fa fa-google"></i>Login via Gmail
                </a>
                <a href="" class="btn btn-block btn-facebook">
                    <i class="fa fa-facebook"></i>Login via Facebook
                </a>
            </p>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-solid fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                 <!-- Form Group -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" 
                    placeholder="Password" value="" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="submit">
                    Log In</button> 
                </div> <!-- Form Group// -->
                <p class="text-center">Don't Have an account? <a href="login.php">Signup</a></p>
            </form>
        </article>
    </div> <!-- Card-->
    
</body>
</html>