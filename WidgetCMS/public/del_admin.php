<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php'; ?>
<?php confirm_logged_in(); ?>

<?php
  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
   
    redirect_to("manage_admins.php");
  }
  
  $id = $admin["id"];
  $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_affected_rows($conn) == 1) {
   
    $_SESSION["message"] = "Admin deleted.";
    redirect_to("manage_admins.php");
  } else {
   
    $_SESSION["message"] = "Admin deletion failed.";
    redirect_to("manage_admins.php");
  }
  
?>
