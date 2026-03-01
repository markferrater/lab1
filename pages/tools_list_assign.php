<?php
include "../db.php";
 
$message = "";
 
// ASSIGN TOOL
if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty = $_POST['qty_used'];
 
  $toolRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity_available FROM tools WHERE tool_id=$tool_id"));
 
  if ($qty > $toolRow['quantity_available']) {
    $message = "Not enough available tools!";
  } else {
    mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
      VALUES ($booking_id, $tool_id, $qty)");
 
    mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id=$tool_id");
 
    $message = "Tool assigned successfully!";
  }
}
 
$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
$bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tools</title>

<style>
   body{
    background: #dfe3e4;
  }

  .container {

  }

  .container-child {
   
  }

  .inner-child {
   display: flex;
   justify-content: center;
  
   padding: 55px;

  }

  .inner-child h3, h2 {
    display: flex;
    justify-content: center;
    font-family: "Segoe UI", Arial, sans-serif;

  }

  .inner-1 {
    border: 1px solid;
    width: 300px; 
    padding: 15px;
    border-radius: 10px;
    font-family: "Segoe UI", Arial, sans-serif;
    font-size: 15px;

  }

  .inner-2 {
    padding: 15px;
    width: 300px;
    border: 1px solid;
    border-radius: 10px;
    font-family: "Segoe UI", Arial, sans-serif;
    font-size: 15px;

  }

  table, tr, td {
    border-collapse: collapse;
    width: 300px;
  }

  form {

    text-align: center;
  } 

  form select, input {
    width: 170px;
    text-align: center;
   
  }

  button {
    width: 100%;
    padding: 3px;
    font-family: "Segoe UI", Arial, sans-serif;
    font-size: 12px;
    border: 1px solid gray;
    border-radius: 3px;
  }

</style>

</head>
<body>
<?php include "../nav.php"; ?>


<div class='container'>
<div class='container-child'>
  
<div class='inner-child'>
<div class='inner-1'>
<h2>Tools / Inventory</h2>
<p style="color:green;"><?php echo $message; ?></p>
 
<h3>Available Tools</h3>
<table border="1" cellpadding="8">
  <tr><th>Name</th><th>Total</th><th>Available</th></tr>
  <?php while($t = mysqli_fetch_assoc($tools)) { ?>
    <tr>
      <td><?php echo $t['tool_name']; ?></td>
      <td><?php echo $t['quantity_total']; ?></td>
      <td><?php echo $t['quantity_available']; ?></td>
    </tr>
  <?php } ?>
</table>
</div>
</div>

 
<hr>
 
<div class='inner-child'>
<div class='inner-2'>
<h3>Assign Tool to Booking</h3>
<form method="post">
  <label>Booking ID</label><br>
  <select name="booking_id">
    <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
      <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
    <?php } ?>
  </select><br><br>
 
  <label>Tool</label><br>
  <select name="tool_id">
    <?php
      $tools2 = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
      while($t2 = mysqli_fetch_assoc($tools2)) {
    ?>
      <option value="<?php echo $t2['tool_id']; ?>">
        <?php echo $t2['tool_name']; ?> (Avail: <?php echo $t2['quantity_available']; ?>)
      </option>
    <?php } ?>
  </select><br><br>
 
  <label>Qty Used</label><br>
  <input type="number" name="qty_used" min="1" value="1"><br><br>
 
  <button type="submit" name="assign">Assign</button>
</form>
</div>
</div>


</div>
</div>
 
</body>
</html>