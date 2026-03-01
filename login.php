<?php
session_start();
 
// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // Static admin login
    if ($username === "admin" && $password === "admin") {
 
        $_SESSION['username'] = "ADMIN";
        header("Location: index.php");
        exit();
 
    } else {
        $error = "Invalid username or password!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
      body {
        margin:100px;
        display: flex;
        justify-content: center;
        background: #0f172a;
      }

      .login-container{
        font-family: "Segoe UI", Arial, sans-serif;
        height: 200px auto;
        padding: 50px;
        background:#1e293b;
        border-radius: 5px;
        border: 1px solid;
        box-shadow:0 10px 25px rgba(0,0,0,0.4);
      }

      .login-container h2 {
        color: white;
        margin: 0px;
        text-align: center;
      }

       label{
       color:#cbd5e1;
       font-size:14px;
      }

      input {
        width: 300px;
        border:none;
        border-radius:6px;
        background:#334155;
        outline:none;
        color:white;
        height: 30px;

      }

      input:focus{
        background:#475569;
      }

      .error{
        color:#f87171;
        text-align:center;
        

      }

      form {
        margin-top: 22px;
      }

      button {
      width:100%;
      padding: 7px;
      color:white;
      background:#3b82f6;
      border: none;
      border-radius: 3px;
      }


    </style>

</head>
<body>

<div class='login-container'>
 
<h2>Login Form</h2>
 
<?php if ($error != ""): ?>
    <p class='error'><?php echo $error; ?></p>
<?php endif; ?>
 
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>
 
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
 
    <button type="submit">Login</button>
</form>
</div>
 
</body>
</html>