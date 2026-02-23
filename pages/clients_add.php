<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address)
            VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Add Client</title>

  <style>
    h2 {
      text-align: center;
    }

    .form{
      border: 1px solid;    
      margin: 0 auto;
      width: 300px;
    
    }

    body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
  }

  h2 {
    text-align: center;
    margin-top: 30px;
  }

  .form {
    background: #ffffff;
    width: 450px;
    margin: 30px auto;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  label {
    font-weight: bold;
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
  }

  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  input:focus {
    outline: none;
    border-color: #4CAF50;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049;
  }

  p {
    text-align: center;
  }
    
  </style>
</head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Add Client</h2>
<p style="color:red;"><?php echo $message; ?></p>
 
 <form class="form" method="post">
  <label>Full Name</label><br>
  <input type="text" name="full_name" required><br><br>

  <label>Email*</label><br>
  <input type="text" name="email" required><br><br>

  <label>Phone</label><br>
  <input type="text" name="phone" required><br><br>

  <label>Address</label><br>
  <input type="text" name="address" required><br><br>
 
  <button type="submit" name="save">Save</button>
 </form>

</body>
</html>
