<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $service_name = $_POST['service_name'];
  $description = $_POST['description'];
  $hourly_rate = $_POST['hourly_rate'];
  $is_active = $_POST['is_active'];
 
  // simple validation
  if ($service_name == "" || $hourly_rate == "") {
    $message = "Service name and hourly rate are required!";
  } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
    $message = "Hourly rate must be a number greater than 0.";
  } else {
    $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
            VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";
    mysqli_query($conn, $sql);
 
    header("Location: services_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Service</title>
<style>
   body{
    background-color: #f4f6f9;
   }

   .btn-container {
    border: 1px solid gray;
    border-radius: 6px; 
    display: flex;
    justify-content: center;
    border: none;
   }

   .btn{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-size: 13px;
    width: 120px;
   }

  .container{
    display:flex;
    justify-content: center;
    padding: 40px;
  }

  .child-container{
    border: 2px solid #c9c2c0;
    padding: 10px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    border-radius: 10px;
    background-color: #f5f5f7;
  }

  h2 {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-size: 16px;
    text-align: center; 

  }

  .text{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-size: 16px;
    color: #1d1d1f;
  }

  p{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    text-align: center; 
  }

  input, textarea{
    border: 1px solid gray;
    border-radius: 4px;
  }
</style>

</head>
<body>
<?php include "../nav.php"; ?>


<div class='container'>
<div class='child-container'>
<h2>Add Service</h2>
<p style="color:red;"><?php echo $message; ?></p>
 
<form method="post">
  <label class='text'>Service Name*</label><br>
  <input type="text" name="service_name"><br><br>
 
  <label class='text'>Description</label><br>
  <textarea name="description" rows="4" cols="40"></textarea><br><br>
 
  <label class='text'>Hourly Rate (₱)*</label><br>
  <input type="text" name="hourly_rate"><br><br>
 
  <label class='text'>Active?</label><br>
  <select name="is_active">
    <option value="1">Yes</option> 
    <option value="0">No</option>
  </select><br><br>

 <div class='btn-container'>
  <button class='btn' type="submit" name="save">Save Service</button>
 </div>
</form>
</div>
</div>
 
</body>
</html>