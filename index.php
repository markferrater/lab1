<?php
include "db.php";

$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];

$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f6f9;
}

.container {
    padding: 30px;
}

h2 {
    margin-bottom: 25px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 2fr));
    gap: 20px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover {
    transform: translateX(-5px); 
}

.card h3 {
    margin: 0;
    font-size: 16px;
    color: #555;
}

.card p {
    font-size: 28px;
    margin: 10px 0 0;
    font-weight: bold;
}

.clients { border-left: 6px solid #3498db; }
.services { border-left: 6px solid #2ecc71; }
.bookings { border-left: 6px solid #f39c12; }
.revenue { border-left: 6px solid #e74c3c; }

.links {
    margin-top: 30px;
}

.links a {
    text-decoration: none;
    background: #3498db;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    margin-right: 10px;
    transition: 0.3s;
}

.links p {
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

.links a:hover {
    background: #2c80b4;
}
</style>
</head>

<body>

<?php include "nav.php"; ?>

<div class="container">

<h2>Dashboard</h2>

<div class="cards">
    <div class="card clients">
        <h3>Total Clients</h3>
        <p><?php echo $clients; ?></p>
    </div>

    <div class="card services">
        <h3>Total Services</h3>
        <p><?php echo $services; ?></p>
    </div>

    <div class="card bookings">
        <h3>Total Bookings</h3>
        <p><?php echo $bookings; ?></p>
    </div>

    <div class="card revenue">
        <h3>Total Revenue</h3>
        <p>₱<?php echo number_format($revenue,2); ?></p>
    </div>
</div>

<div class="links">
    <p>Quick Links:</p>
    <a href="/assessment_beginner/pages/clients_add.php">Add Client</a>
    <a href="/assessment_beginner/pages/bookings_create.php">Create Booking</a>
</div>

</div>

</body>
</html>
