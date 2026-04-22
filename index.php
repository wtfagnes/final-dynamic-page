<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            width: 320px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
        }

        h1 {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: darkred;
        }
    </style>
</head>

<body>

<div class="box">
    <h1>Welcome, <?php echo $_SESSION['user']; ?> 👋</h1>

    <form action="logout.php" method="post">
        <button>Logout</button>
    </form>
</div>

</body>
</html>