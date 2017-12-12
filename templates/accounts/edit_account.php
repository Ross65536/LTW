<section id="edit_account" class="account" >
    <p id="user_p"> User: <?= "$username" ?></p>
    <h1>Edit Account Information:</h1>
    <h3>Edit the fields you want to change and enter your password for confirmation. </h3>
    <form action="#">
        <?php include_once('templates/form_key.php'); ?>
        <label>
            <span> Name: </span>
            <input type="text" name="name" value="<?=$name?>" >
        </label>
        <p id="email_already_exists_error2" class="error_message_invisible"> Email already exists </p>
        <label>
            <span> E-mail: </span>
            <input type="email" name="email" value="<?=$email?>" >
        </label>
        <p id="password_match_error2" class="error_message_invisible"> Passwords must match </p>
        <label>
            <span> New Password: </span>
            <input type="password" name="new_password">
        </label>
        <label>
            <span> Confirm New Password: </span>
            <input type="password" name="confirm_new_password">
        </label>
        <p id="wrong_password_error" class="error_message_invisible"> Password Invalid </p>
        <p id="successfuly_edited_account_message" class="success_message_invisible"> Account Edited Successfuly </p>
        <label id="old_password">
            <span> Enter Old Password: </span>
            <input type="password" name="old_password" required>
        </label>
        <input type="submit" value="Update">
    </form>

</section>
