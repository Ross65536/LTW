<section id="register">
    <h1>Register</h1>
    <form action="action_register.php" method="post">
        <label>
            Username <input type="text" name="username" required>
        </label>
        <label>
            Name <input type="text" name="name">
        </label>
        <label>
            e-mail <input type="email" name="email">
        </label>
        <label>
            Password <input type="password" name="password" required>
        </label>
        <label>
            Confirm Password <input type="password" name="confirm_password" required>
        </label>
        <input type="submit" value="Register">
    </form>
</section>