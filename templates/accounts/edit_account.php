<div id="register-page" class="full-height parallax">
	<section id="edit_account" class="account vertical-align one-edge-shadow" >
		<p id="user_p"> User: <?= "$username" ?></p>
		<h3>Edit the fields you want to change and enter your password for confirmation. </h3>
		<form action="#">
			<?php include_once('templates/form_key.php'); ?>
			<label>
				<input id="name_input" type="text" name="name" placeholder="Name" value="<?=$name?>">
			</label>
			<p id="email_already_exists_error2" class="error_message_invisible"> Email already exists </p>
			<p id="email_doesnt_exist_error" class="error_message_invisible"> Email doesn't exist </p>
			<label>
				<input id="email_input" type="email" name="email" placeholder="Email" value="<?=$email?>">
			</label>
			<p class="password_regex_tip"> <?=$password_tip?> </p>
			<p id="password_match_error2" class="error_message_invisible"> Passwords must match </p>
			<label>
				<input id="new_password_input" type="password" name="new_password" placeholder="New Password" pattern="<?=$password_regex?>">
			</label>
			<label>
				<input id="confirm_new_password_input" type="password" name="confirm_new_password" placeholder="Confirm New Password">
			</label>
			<p id="wrong_password_error" class="error_message_invisible"> Password Invalid </p>
			<p id="successfuly_edited_account_message" class="success_message_invisible"> Account Edited Successfuly </p>
			<label id="old_password">
				<input id="old_password_input" type="password" name="old_password" placeholder="Old Password" required>
			</label>
      <?php include_once('templates/form_captcha.php'); ?>
      <p id="captcha_error" class="error_message_invisible"> Please Solve the Captcha. </p>
      <p id="successfuly_edited_account_message" class="success_message_invisible"> Account Edited Successfuly </p>
			<button class="btn submit" id="submit_button_id">Update</button>
		</form>
	</section>
</div>
