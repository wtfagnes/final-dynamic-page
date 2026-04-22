<?php
session_start();
include("db.php");
?>

<style>
body {font-family: Arial; background: linear-gradient(120deg,#f6d365,#fda085); text-align:center;}
.box {background:white; padding:20px; margin:80px auto; width:300px; border-radius:10px;}
input,button {width:90%; padding:10px; margin:5px;}
</style>

<div class="box">
<h2>Login</h2>

<form method="POST">
<input name="email" required placeholder="Email"><br>
<input type="password" name="password" required placeholder="Password"><br>
<button>Login</button>
</form>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

$email=$_POST['email'];
$pass=$_POST['password'];

if(empty($email)||empty($pass)) die("All fields required!");

$stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
if(!$stmt) die("Error: ".$conn->error);

$stmt->bind_param("s",$email);
$stmt->execute();

$res=$stmt->get_result();

if($res->num_rows==1){
    $user=$res->fetch_assoc();

    if(password_verify($pass,$user['password'])){
        $_SESSION['user']=$user['username'];

        // Log file
        file_put_contents("login_logs.txt",
        "Login: $email at ".date("Y-m-d H:i:s")."\n",
        FILE_APPEND);

        header("Location: index.php");
        exit();
    }else{
        die("Wrong Password!");
    }
}else{
    die("User Not Found!");
}
}
?>
</div>