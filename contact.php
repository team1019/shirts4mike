<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// From contact-process.php
	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
	$message = trim($_POST["message"]);
	
	if ($name == "" OR $email = "" OR $message = "") {
		$error_message = "You must specify a value for name, email and a message";
	}
	// Prevents Email Header Injection Attacks
	if (!isset($error_message)) {
		foreach( $_POST as $value ) {
			if (stripos($value,'content-Type: ') !== FALSE) {
				$error_message = "There was a problem with the information you entered.";
			}
		}
	}
	if (!isset($error_message) AND $_POST["address"] != "") {
		$error_message = "Your form submission has an error.";
	} // Honey Pot

	require_once("inc/phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	if (!isset($error_message) AND !$mail->ValidateAddress($email)) {
		$error_message = "You must specify a valid email address.";
	}

	if (!isset($error_message)) {
		$email_body = "";
		$email_body += "Name: " . $name. "\n";
		$email_body += "Email: " . $email . "\n";
		$email_body += "Message: " . $message;
		// TODO: Send email
		header("Location: contact.php?status=thanks");
		exit;
	} // End error message check
} // End POST Check
$pageTitle = "Contact Mike";
$section = "contact";
include('inc/header.php');
?>
<div class="section page">
	<div class="wrapper">
		<h1>Contact</h1>
		<?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
		<p>Thanks for contacting mike!</p>
		<?php } else { ?>
		<p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
		<?php 
			if (isset($error_message)) {
				echo '<p class="message">' . $error_message . '</p>';
			}
		 ?>
		<form method="post" action="contact.php">
			<table>
				<tr>
					<th><label for="name">Name</label></th>
					<td><input type="text" name="name" id="name"></td>
				</tr>
				<tr>
					<th><label for="email">Email</label></th>
					<td><input type="text" name="email" id="email"></td>
				</tr>
				<tr>
					<th><label for="message">Message</label></th>
					<td><textarea name="message" id="message"></textarea></td>
				</tr>
				<tr style="display: none;">
					<th><label for="address">Address</label></th>
					<td><textarea name="address" id="address"></textarea></td>
				</tr>
			</table>
			<input type="submit" value="Send">
		</form>
		<?php } ?>
	</div>
</div>
<?php include('inc/footer.php'); ?>