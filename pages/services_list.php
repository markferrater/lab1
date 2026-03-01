<?php
include "../db.php";
 
 
/* ============================
   SOFT DELETE (Deactivate)
   ============================ */
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
 
 
  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");
 
 
  header("Location: services_list.php");
  exit;
}
 
 
/* ============================
   FETCH ALL SERVICES
   ============================ */
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
 
 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Services</title>

  <style>
  body{
    background: #dfe3e4;
  }
  
  .container  {
    display: flex;
    justify-content: center;
  }

  .atr {
    text-decoration: none;
    padding: 7px;
    width: 120px;
    margin-left: 555px;
    border-radius: 7px;
    color: white;
    background: #222020;
  }

  .atr:hover{
    background: #584d4d;
    color: white;
  }
  
 
  h2{
    display: flex;
    justify-content: center;
    font-size: 30px;
    font-family: 'Segoe UI', Tahoma, sans-serif;
  }

  th {
    background: #2e2c2c;
    color: white;
    border: none;
  }
  

   table, td, th{
    border: 1px solid gray;
    border-collapse: collapse;
    width: 900px; 
    text-align: center;
    font-family: 'Segoe UI', Tahoma, sans-serif;

   
  }

  .edit-btn, .deactivate-btn{
    border-radius: 5px;
    padding: 4px;
    text-decoration: none;
    background: #96fd66;
    color: #353333;
  }

  .deactivate-btn{
    background: #fd7373;
  }

  .btn {
  text-decoration: none;
  border: 1px solid;
  padding: 3px;
  border-radius: 9px;
  
  background: white;
  color: black;
  }

   .btn:hover { 
    background: grey;
    color: white;
  }


</style>


</head>
<body>
 
 
<?php include "../nav.php"; ?>
 
 
<h2>Services</h2>
 
 
<p>
  <a class='atr' href="services_add.php">+ Add Service</a>
</p>
 
<div class='container'>
<table border="1" cellpadding="8">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Rate</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
 
 
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['service_id']; ?></td>
      <td><?php echo $row['service_name']; ?></td>
      <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
 
 
      <td>
        <?php
          if ($row['is_active'] == 1) {
            echo "Active";
          } else {
            echo "Inactive";
          }
        ?>
      </td>
 
 
      <td>
        <a class='edit-btn' href="services_edit.php?id=<?php echo $row['service_id']; ?>">Edit</a>
 
 
        <?php if ($row['is_active'] == 1) { ?>
          |
          <a class='deactivate-btn' href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
             onclick="return confirm('Deactivate this service?')">
             Deactivate
          </a>
        <?php } ?>
      </td>
    </tr>
  <?php } ?>
 
 
</table>
</div>
 
 
</body>
</html>