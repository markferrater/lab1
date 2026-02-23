<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Clients</title>

  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 20px;
  }

  h2 {
    text-align: center;
  }

  .container {
    width: 90%;
    max-width: 900px;
    margin: 20px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .add-btn {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 12px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
  }

  .add-btn:hover {
    background-color: #45a049;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: left;
  }

  td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  .edit-btn {
    padding: 5px 8px;
    background-color: #2196F3;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
  }

  .edit-btn:hover {
    background-color: #0b7dda;
  }
</style>

</head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Clients</h2>
<p> <a class="edit-btn" href="clients_add.php">+ Add Client</a></p>
 
<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['client_id']; ?></td>
      <td><?php echo $row['full_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td>
        <a class="edit-btn" href="clients_edit.php?id=<?php echo $row['client_id']; ?>">Edit</a>
      </td>
    </tr>
  <?php } ?>
</table>
</body>
</html>