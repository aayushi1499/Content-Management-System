<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php';
require_once '../includes/validation.php';
 ?>
<?php confirm_logged_in(); ?>

<?php
  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    redirect_to("manage_admins.php");
  }
?>
<?php
if (isset($_POST['submit'])) {
 
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    $id = $admin["id"];
    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
  
    $query  = "UPDATE admins SET ";
    $query .= "username = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_affected_rows($conn) == 1) {
      $_SESSION["message"] = "Admin updated.";
      redirect_to("manage_admins.php");
    } else {
      $_SESSION["message"] = "Admin update failed.";
    }
  
  }
} 
?>
<?php $layout_context = "admin"; ?>
<head>
		<title>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
      <h1>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></h1>
	</div>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Edit Admin: <?php echo htmlentities($admin["username"]); ?></h2>
    <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Edit Admin" />
    </form>
    <br />
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>

