<div id="login-page" class="full-height parallax">
  <div id="login" class="account vertical-align one-edge-shadow">
      <form action="#">
          <h1>Login</h1>
          <label>
              <input id="username_input" type="text" name="username" placeholder="Username" required>
          </label>
          <label>
              <input id="password_input" type="password" name="password" placeholder="Password" required>
          </label>
          <?php include_once('templates/form_captcha.php'); ?>
          <p id="login_error" class="error_message_invisible"> Username or Password Invalid </p>
          <p id="captcha_error" class="error_message_invisible"> Please Solve the Captcha. </p>
          <button class="btn submit" type="submit" id="submit_button_id">Login</button>
      </form>
      <p>
        Don't have an account? <a style="color: blue" href="register.php">Register!</a>
      </p>
  </div>
</div>
