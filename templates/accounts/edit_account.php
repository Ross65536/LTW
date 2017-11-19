<section id="edit_account" class="account" >
    <p id="user_p"> User: <?= "$username" ?></p>
    <h1>Edit Account Information:</h1>
    <p>Edit the fields you want to change and enter your password for confirmation. </p>
    <form action="PHP/actions/accounts/action_edit_account.php" method="post">
        <label>
            <span> Name: </span>
            <input type="text" name="name" value="<?=$name?>" >
        </label>
        <label>
            <span> E-mail: </span>
            <input type="email" name="email" value="<?=$email?>" >
        </label>
        <label>
            <span> New Password: </span>
            <input type="password" name="new_password">
        </label>
        <label>
            <span> Confirm New Password: </span>
            <input type="password" name="confirm_new_password">
        </label>
        <label id="old_password">
            <span> Enter Old Password: </span>
            <input type="password" name="old_password" required>
        </label>
        <input type="submit" value="Update">
    </form>
</section>