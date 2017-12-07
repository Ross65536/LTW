<section id="register" class="account">
    <h1>Register</h1>
    <form action="#">
        <?php include_once('templates/form_key.php'); ?>
        <p id="username_already_exists_error" class="error_message_invisible"> Username already exists </p>
        <label>
            <span> Username: </span> 
            <input type="text" name="username" required>
        </label>
        <label>
            <span> Name: </span>  
            <input type="text" name="name">
        </label>
        <p id="email_already_exists_error" class="error_message_invisible"> Email already exists </p>
        <label>
            <span> E-mail:  </span>
            <input type="email" name="email">
        </label>
        <p id="password_match_error" class="error_message_invisible"> Passwords must match </p>
        <label>
            <span> Password: </span> 
            <input type="password" name="password" required>
        </label>
        <label>
            <span> Confirm Password:  </span> 
            <input type="password" name="confirm_password" required>
        </label>
        <input type="submit" value="Register">
    </form>
</section>