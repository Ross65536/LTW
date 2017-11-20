<section id="login" class="account">
  <?if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] == 'not_logged_in') {
      ?> <h3 class="error_message">You need to be logged in to access lists </h3> <?
      unset($_SESSION['error']);
    }
  }?>
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
        <input type="submit" value="Login">
    </form>
</section>
