<section id="login" class="account">
    <h1>Login</h1>
    <form action="#">
        <label>
            <span> Username: </span> 
            <input type="text" name="username" required>
        </label>
        <label>
            <span> Password: </span>
            <input type="password" name="password" required>
        </label>
        <?php include_once('templates/form_captcha.php'); ?>
        <p id="login_error" class="error_message_invisible"> Username or Password Invalid </p> 
        <p id="captcha_error" class="error_message_invisible"> Please Solve the Captcha. </p>
        <input type="submit" value="Login">
    </form>
</section>
