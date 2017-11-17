<section id="login">
  <?if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] == 'not_logged_in') {
      ?> <h3>You need to be logged in to access lists </h3> <?
      unset($_SESSION['error']);
    }
  }?>
    <h1>Login</h1>
    <form action="action_login.php" method="post">
        <label>
            Username <input type="text" name="username" required>
        </label>
        <label>
            Password <input type="password" name="password" required>
        </label>
        <input type="submit" value="Login">
    </form>
</section>
