<?php // nav.php ?>
<style>
  .nav-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    padding: 10px 15px;
    background-color: #f4f4f4;
    border-radius: 6px;
    margin-bottom: 15px;
    font-family: Arial, sans-serif;
  }

  .nav-bar a {
    text-decoration: none;
    color: #333;
    padding: 6px 12px;
    border-radius: 4px;
    transition: 0.2s;
    font-weight: 500;
  }

  /* Hover effect */
  .nav-bar a:hover {
    background-color: #e0e0e0;
  }

  /* Active indicator */
  .nav-bar a.active {
    background-color: #4CAF50;
    color: white;
  }

  /* Optional: small underline instead of background */
  /* .nav-bar a.active {
    border-bottom: 2px solid #4CAF50;
    color: #4CAF50;
  } */
</style>

<div class="nav-bar">
  <a href="/assessment_beginner/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Dashboard</a>
  <a href="/assessment_beginner/pages/clients_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'clients_list.php' ? 'active' : '' ?>">Clients</a>
  <a href="/assessment_beginner/pages/services_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'services_list.php' ? 'active' : '' ?>">Services</a>
  <a href="/assessment_beginner/pages/bookings_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'bookings_list.php' ? 'active' : '' ?>">Bookings</a>
  <a href="/assessment_beginner/pages/tools_list_assign.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'tools_list_assign.php' ? 'active' : '' ?>">Tools</a>
  <a href="/assessment_beginner/pages/payments_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'payments_list.php' ? 'active' : '' ?>">Payments</a>
</div>