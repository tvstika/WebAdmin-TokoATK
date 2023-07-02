<?php
session_start();

require'functions.php';

if( isset($_SESSION["login"])){
	header("Location:index.php");
	exit;
}


if(isset($_POST["login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];

    $result=mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

    //cek useername
    if(mysqli_num_rows($result)===1){

        //cek password
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){

            //set session
            $_SESSION["login"]=true;
            header("Location:index.php");
            exit;

        }else{
            echo"
            <script>
            alert('Username atau password salah!');
            document.location.href='login.php';
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="pasword">
            </li>
            <li>
                <button type="submit" name="login" >Login</button>
            </li>
        </ul>
    </form>
</body>
</html>