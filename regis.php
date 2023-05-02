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
    echo '<script type="text/javascript">alert("No Connection");</script>';
}

    if(isset($_POST['submit'])){
        $username =mysqli_real_escape_string($con,$_POST['username']);       
        $email =mysqli_real_escape_string($con,$_POST['email']);       
        $mobile =mysqli_real_escape_string($con,$_POST['mobile']);       
        $password =mysqli_real_escape_string($con,$_POST['password']);       
        $cpassword =mysqli_real_escape_string($con,$_POST['cpassword']);       

        $pass = password_hash($password,PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword,PASSWORD_BCRYPT);

        $emailCheckQuery = "select * from registration where email='$email'";
        $emailExistCount = mysqli_num_rows(mysqli_query($con,$emailCheckQuery));

        if($emailExistCount>0){
            ?>
                <script>alert("Email already exist")</script>
            <?php
        }else{
            if($password === $cpassword){
                $insertQuery = "insert into registration(username,email,mobile,password,cpassword) 
                values('$username','$email','$mobile','$pass','$cpass')";

                $result = mysqli_query($con,$insertQuery);
                if($result){
                    ?>
                        <script>alert("Data Inserted")</script>
                    <?php
                }else{
                    ?>
                    <script>alert("Data Insertion Failed")</script>
                    <?php
                }
            }else{
                ?>
                    <script>alert("Password are not matching")</script>
                <?php
            }
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
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Full Name" required>
                </div>
                <!-- Form Group -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-solid fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                 <!-- Form Group -->
                 <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" name="mobile" placeholder="Phone" required>
                </div>
                <!-- Form Group -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" 
                    placeholder="Create Password" value="" required>
                </div>
                <!-- Form Group -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="cpassword" 
                    placeholder="Create Password" value="" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="submit">
                        Create Account</button> 
                </div> <!-- Form Group// -->
                <p class="text-center">Have an account? <a href="login.php">Login</a></p>
            </form>
        </article>
    </div> <!-- Card-->
</body>
</html>