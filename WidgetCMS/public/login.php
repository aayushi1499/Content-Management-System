<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php';
require_once '../includes/validation.php';

$username = "";

if (isset($_POST['submit'])) {
 
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
      redirect_to("admin.php");
    } else {
      
      $_SESSION["message"] = "Invalid Username/password.Try Again.";
    }
  }
} else { 
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
</body>
<div id="main">
  <div id="navigation">
  <a href="index.php">&laquo; Return to the public page</a><br />
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    
	<form method="post" action="login.php" align="center" >
	<center>
	<table width="390" align="center" >
	
		<tr>
			<td bgcolor="black" colspan="4" align="center"><h2 style="color:#D4E6F4;">Admin Login</h2></td>
		</tr>
		
		<tr>
			<td align="center">Username:</td>
			<td><input type="text" name="username" style="width:80%" value="<?php echo htmlentities($username); ?>" /></td>
		</tr>
		
		<tr>
			<td align="center">Password:</td>
			<td><input type="password" name="password" style="width:80%" value="" /></td>
		</tr>
		
		<tr>
			<td colspan="4" align="center"><input type="submit" name="submit" value="Submit" /></td>
		</tr>

	</table>
</center>
</form>

  </div>
</div>

