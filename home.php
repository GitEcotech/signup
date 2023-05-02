<?php 
session_start();

if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="float:left">Hi This Is <?php echo $_SESSION['username']; ?></h1>

    <div style="text-align: right;">
        <button style="margin: 30px;">
            <a href="logout.php" style="text-decoration: none;">Logout</a>
        </button>
    </div>
</body>
</html>