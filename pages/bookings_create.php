<?php
include "../db.php";
 
$clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
$services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");
 
if (isset($_POST['create'])) {
  $client_id = $_POST['client_id'];
  $service_id = $_POST['service_id'];
  $booking_date = $_POST['booking_date'];
  $hours = $_POST['hours'];
 
  // get service hourly rate
  $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
  $rate = $s['hourly_rate'];
 
  $total = $rate * $hours;
 
  mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
    VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");
 
  header("Location: bookings_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create Booking</title>

<style>
  body{
     font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
     background-color: #f4f6f9;

  }

 .container{
  display: flex;
  justify-content: center;
 }

 .container-child{
  border: 3px solid gray;   
  border-radius: 4px;
  height: 370px;
  width: 400px;
  margin: 20px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);

 }

 .inner-child {
   text-align: center;
 }

 .inner-child input, select, button {
  border-radius: 4px;
  border: 1px solid gray;
  text-align: center;
  
 }

 .inner-child input, select {
  width: 200px;

 }

 h2{
  text-align: center;
  font-size: 20px;
 }
</style>

</head>
<body>
<?php include "../nav.php"; ?>
 

 
<div class='container'>
  <div class='container-child'>
<form method="post">
  <h2>Create Booking</h2>

  <div class='inner-child'>
  <label>Client</label><br>
  <select name="client_id">
    <?php while($c = mysqli_fetch_assoc($clients)) { ?>
      <option value="<?php echo $c['client_id']; ?>"><?php echo $c['full_name']; ?></option>
    <?php } ?>
  </select><br><br>
 
  <label>Service</label><br>
  <select name="service_id">
    <?php while($s = mysqli_fetch_assoc($services)) { ?>
      <option value="<?php echo $s['service_id']; ?>">
        <?php echo $s['service_name']; ?> (₱<?php echo number_format($s['hourly_rate'],2); ?>/hr)
      </option>
    <?php } ?>
  </select><br><br>
 
  <label>Date</label><br>
  <input type="date" name="booking_date"><br><br>
 
  <label>Hours</label><br>
  <input type="number" name="hours" min="1" value="1"><br><br>
 
  <button type="submit" name="create">Create Booking</button>
  </div>
</form>
</div>
</div>
</body>
</html>