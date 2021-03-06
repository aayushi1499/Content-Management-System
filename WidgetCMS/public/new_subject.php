<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php'; ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<head>
		<title>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
      <h1>Widget Corp <?php if ($layout_context == "admin") { echo "Admin"; } ?></h1>
	</div>
<?php find_selected_page(); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page) ?>
	</div> <!--ends navigation-->
	<div id="page">
		<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo form_errors($errors); ?>

		<h2>Create Subject</h2>

		<form action="create_subject.php" method="post">
			<p>Menu name:
				<input type="text" name="menu_name" value="" />
			</p>
			<p>Position:
				<select name="position">
				<?php
					$subject_set = find_all_subjects(false);
					$subject_count = mysqli_num_rows($subject_set);
					for($count=1; $count <= ($subject_count +1); $count++) {
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" /> No
				&nbsp
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<input type="submit" name="submit" value="Create Subject" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>

	</div> <!--ends page-->
</div> <!--ends main-->