<?php include("db.php"); ?>

<style>
body {font-family: Arial; background: linear-gradient(120deg,#74ebd5,#9face6); text-align:center;}
.box {background:white; padding:20px; margin:80px auto; width:300px; border-radius:10px;}
input,button {width:90%; padding:10px; margin:5px;}
.msg{font-size:12px;}
</style>

<div class="box">
<h2>Register</h2>

<form method="POST">
<input name="username" placeholder="Username" required><br>

<input name="email" id="email" placeholder="Email" required><br>
<span id="emailMsg" class="msg"></span><br>

<input type="password" name="password" id="pass" placeholder="Password" required><br>
<span id="passMsg" class="msg"></span><br>

<button>Register</button>
</form>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

$u=$_POST['username'];
$e=$_POST['email'];
$p=$_POST['password'];

if(empty($u)||empty($e)||empty($p)) die("All fields required!");

if(!filter_var($e,FILTER_VALIDATE_EMAIL)) die("Invalid Email!");

if(strlen($p)<6) die("Password must be 6+ chars!");

$hash=password_hash($p,PASSWORD_DEFAULT);

$stmt=$conn->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");

if(!$stmt) die("Error: ".$conn->error);

$stmt->bind_param("sss",$u,$e,$hash);

if($stmt->execute()){
    echo "<p style='color:green'>Registered! <a href='login.php'>Login</a></p>";
}else{
    die("Email already exists!");
}
}
?>
</div>

<script>
email.oninput = () => {
    emailMsg.innerHTML = email.value.includes("@") ? "✅ Valid" : "❌ Invalid";
}
pass.oninput = () => {
    passMsg.innerHTML = pass.value.length>=6 ? "✅ Strong" : "❌ Weak";
}
</script>