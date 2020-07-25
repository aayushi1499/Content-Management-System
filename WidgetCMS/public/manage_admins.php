<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php'; ?>
<?php confirm_logged_in(); ?>

<?php
  $admin_set = find_all_admins();
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
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
  </div>
  <div id="page">
    <?php echo message(); ?>
    <h2>Manage Admins</h2>
    <table>
      <tr>
        <th style="text-align: left; width: 200px;">Username</th>
        <th colspan="2" style="text-align: left;">Actions</th>
      </tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
      <tr>
        <td><?php echo htmlentities($admin["username"]); ?></td>
        <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
        <td><a href="del_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>
    <br />
    <a href="new_admin.php">Add a new admin</a>
  </div>
</div>

