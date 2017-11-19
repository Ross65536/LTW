<section id="register" class="account">
    <h1>Register</h1>
    <form action="PHP/actions/accounts/action_register.php" method="post">
        <label>
            <span> Username: </span> 
            <input type="text" name="username" required>
        </label>
        <label>
            <span> Name: </span>  
            <input type="text" name="name">
        </label>
        <label>
            <span> E-mail:  </span> 
            <input type="email" name="email">
        </label>
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