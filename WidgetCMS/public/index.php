<?php 
require_once'../includes/session.php';
require_once'../includes/connect.php';
require_once'../includes/functions.php'; 

$layout_context = "public"; ?>
<head>
		<title>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
      <h1>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></h1>
	</div>
</body>
<?php find_selected_page(true); ?>

<div id="main">
  <div id="navigation">
		<?php echo public_navigation($current_subject, $current_page); ?>
  </div>
  <div id="page">
		<?php if ($current_page) { ?>
			
			<h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
			<?php echo nl2br(htmlentities($current_page["content"])); ?>
			
		<?php } else { ?>
			
			<h2>Welcome to my Widget Corps first PHP based CMS site !<br><br><br> Please feel free to explore all its features.</h2>
			<br><br><h3>For Admin Login :&nbsp;<a href="login.php" style="color:black";>Click Here !</a></h3>
		<?php }?>
  </div>
</div>

