<div id="register-page" class="full-height">
  <section id="register" class="account vertical-align one-edge-shadow">
      <h1>Register</h1>
      <form action="#">
          <?php include_once('templates/form_key.php'); ?>
          <p id="username_already_exists_error" class="error_message_invisible"> Username already exists </p>
          <label>
              <input type="text" name="username" placeholder="Username" required>
          </label>
          <label>
              <input type="text" name="name" placeholder="Name">
          </label>
          <p id="email_already_exists_error" class="error_message_invisible"> Email already exists </p>
          <label>
              <input type="email" name="email" placeholder="Email">
          </label>
          <p id="password_match_error" class="error_message_invisible"> Passwords must match </p>
          <label>
              <input type="password" name="password" placeholder="Password" required>
          </label>
          <label>
              <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          </label>
          <?php include_once('templates/form_captcha.php'); ?>
          <p id="captcha_error" class="error_message_invisible"> Please Solve the Captcha. </p>
          <button class="btn submit">Register</button>
      </form>
      <p>
        Already have an account? <a style="color: blue" href="login.php">Log In!</a>
      </p>
  </section>
</div>
