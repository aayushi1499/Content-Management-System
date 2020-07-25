<?php
require_once '../includes/session.php';
require_once '../includes/functions.php';
require_once '../includes/connect.php';
require_once '../includes/validation.php';
?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['submit'])) {
	$menu_name = mysql_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);
	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	if(!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("new_subject.php");
	}
	$query   = "INSERT INTO subjects (";
	$query	.= " menu_name, position, visible";
	$query	.= ") VALUES (";
	$query	.= " '{$menu_name}', {$position}, {$visible}";
	$query	.= ")";

	$result = mysqli_query($conn, $query);

	if ($result) {
		$_SESSION["message"] = "Subject created.";
		redirect_to("manage_content.php");
	} else {
		$_SESSION["message"] = "Subject creation failed.";
		redirect_to("new_subject.php");
	}
} else {
	redirect_to("new_subject.php");
}
?>

<?php
	if(isset($conn)){ mysqli_close($conn); }
?>