<?php
include "../db.php";
 
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Check if ID is valid
if ($id <= 0) {
    header("Location: bookings_create.php");
    exit;
}
 
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Edit Client</title>

<style>
  body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #f4f6f9);
    margin: 0;
    padding: 0;
  }

  .form-card {
    background: #ffffff;
    width: 420px;
    padding: 30px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
  }

  input {
    width: 100%;
    padding: 10px;
    margin-bottom: 18px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    transition: 0.3s;
  }

  input:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    outline: none;
  }

  button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background-color: #43a047;
  }

  .error-message {
    text-align: center;
    color: red;
    margin-bottom: 15px;
  }
</style>

</head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Edit Client</h2>
<p style="color:red;"><?php echo $message; ?></p>
 
<form class='form-card' method="post">
  <label>Full Name</label><br>
  <input type="text" name="full_name" value="<?php echo $client['full_name']; ?>"><br><br>
 
  <label>Email</label><br>
  <input type="text" name="email" value="<?php echo $client['email']; ?>"><br><br>
 
  <label>Phone</label><br>
  <input type="text" name="phone" value="<?php echo $client['phone']; ?>"><br><br>
 
  <label>Address</label><br>
  <input type="text" name="address" value="<?php echo $client['address']; ?>"><br><br>
    
  <button type="submit" name="update">Update</button>
</form>
</body>
</html>