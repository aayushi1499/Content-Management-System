<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php';
require_once '../includes/validation.php';?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
    
    $query  = "INSERT INTO admins (";
    $query .= "  username, hashed_password";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}'";
    $query .= ")";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION["message"] = "Admin created.";
      redirect_to("manage_admins.php");
    } else {
      $_SESSION["message"] = "Admin creation failed.";
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
    
    <h2>Create Admin</h2>
    <form action="new_admin.php" method="post">
      <p>Username:
        <input type="text" name="username" value="" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Create Admin" />
    </form>
    <br />
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>


