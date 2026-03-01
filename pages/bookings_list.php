<?php
include "../db.php";
 
$sql = "
SELECT b.*, c.full_name AS client_name, s.service_name
FROM bookings b
JOIN clients c ON b.client_id = c.client_id
JOIN services s ON b.service_id = s.service_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Bookings</title>
<style>
  body{
    background: #dfe3e4;
  }

  .container {
    display: flex;
    justify-content: center;  
    align-items: center;
    
  }

  .container-child, content {
    padding: 50px;
  }

  h2 {
    text-align: center;
    font-family: 'Segoe UI', Tahoma, sans-serif;
  }

  table {
    border-collapse: collapse;
    height: 150px;
    width: 900px;
  }

  p, a {
    text-align: center;
    text-decoration: none;
  }

  th {
    text-align: center;
    background: #2e2c2c;
    color: white;
    border: 1px solid gray;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  .btn {
    border: 1px solid gray;
    background: #292424;
    padding: 4px;
    border-radius: 5px;
    color: white;
  }

  .btn:hover{
    background: #584d4d;
    color: white;
  }

  .action-btn{
    padding: 3px;
    border-radius: 3px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    background-color: #2196F3;
    color: #fff;
  }

  .action-btn:hover{
    background-color: #5baef1;
    color: #fff;
  }

</style>

</head>
<body>
<?php include "../nav.php"; ?>

<div class='container'> 
<div class= container-child>

<h2>Bookings</h2>

<p><a class='btn' href="bookings_create.php">+ Create Booking</a></p>

<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Client</th><th>Service</th><th>Date</th><th>Hours</th><th>Total</th><th>Status</th><th>Action</th>
  </tr>
  <?php while($b = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $b['booking_id']; ?></td>
      <td><?php echo $b['client_name']; ?></td>
      <td><?php echo $b['service_name']; ?></td>
      <td><?php echo $b['booking_date']; ?></td>
      <td><?php echo $b['hours']; ?></td>
      <td>₱<?php echo number_format($b['total_cost'],2); ?></td>
      <td><?php echo $b['status']; ?></td>
      <td>
        <a class='action-btn' href="payment_process.php?booking_id=<?php echo $b['booking_id']; ?>">Process Payment</a>
      </td>
    </tr>
  <?php } ?>
</table>
</div>
</div>


</body>
</html>