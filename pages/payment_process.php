<?php
include "../db.php";
#include "../config/db.php";

 
$booking_id = $_GET['booking_id'];
 
 
$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
 
 
$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];
 
 
$balance = $booking['total_cost'] - $total_paid;
$message = "";
 
 
if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];
 
 
  if ($amount <= 0) {
    $message = "Invalid amount!";
  } else if ($amount > $balance) {
    $message = "Amount exceeds balance!";
  } else {
 
 
    // 1) Insert payment
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
      VALUES ($booking_id, $amount, '$method')");
 
 
    // 2) Recompute total paid (after insert)
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];
 
 
    // 3) Recompute new balance
    $new_balance = $booking['total_cost'] - $total_paid2;
 
 
    // 4) If fully paid, update booking status to PAID
    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }
 
 
    header("Location: bookings_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Process Payment</title>

<style>
  .container{
    display: flex;
    justify-content: center;
    padding: 30px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  }

  .inner-container{
    border: 1px solid gray;
    border-radius: 4px;
    padding: 23px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
  }

  .body{
    text-align: center;
  }

  button, select, input{
    width: 150px;
    text-align: center;

  }

</style>

</head>
<body>
<?php include "../nav.php" ?>
 

<div class='container'>
<div class='inner-container'>
<h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>

<div class='body'> 
<p>Total Cost: ₱<?php echo number_format($booking['total_cost'],2); ?></p>
<p>Total Paid: ₱<?php echo number_format($total_paid,2); ?></p>
<p><b>Balance: ₱<?php echo number_format($balance,2); ?></b></p>
 
 
<p style="color:red;"><?php echo $message; ?></p>
 
 
<form method="post">
  <label>Amount Paid</label><br>
  <input type="number" name="amount_paid" step="0.01"><br><br>
 
 
  <label>Method</label><br>
  <select name="method">
    <option value="CASH">CASH</option>
    <option value="GCASH">GCASH</option>
    <option value="CARD">CARD</option>
  </select><br><br>
 
 
  <button type="submit" name="pay">Save Payment</button>
</form>
</div>
</div>
</div>
 
 
</body>
</html>