<section id="edit_account">
    <h1>Edit Account Information</h1>
    <p>User: <?= "$username" ?></p>
    <p>Edit the fields you want to change, and enter your password for confirmation </p>
    <form action="action_edit_account.php" method="post">
        <label>
            Name <input type="text" name="name" value="<?=$name?>" >
        </label>
        <label>
            e-mail <input type="email" name="email" value="<?=$email?>" >
        </label>
        <label>
            New Password <input type="password" name="new_password">
        </label>
        <label>
            Confirm New Password <input type="password" name="confirm_new_password">
        </label>
        <label>
            <!-- isto podia ser mais á parte do resto-->
            Password <input type="password" name="old_password" required>
        </label>
        <input type="submit" value="Update">
    </form>
</section>