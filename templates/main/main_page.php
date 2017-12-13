<div id="main-content">
  <div id="landing" class="full-height jumbotron light def-size">
      <h1> Organize your life. </h1>
      <div>
          <h2> A simple, straightforward way to organize your tasks. </h2>
          <h2> Get started. It's simple! </h2>
      </div>
      <div class="inline-buttons">
        <? if(Session\isLoggedIn()) { ?>
              <a href="my_lists.php"><button class="btn">My Lists</button></a>
              <a href="PHP/actions/accounts/action_logout.php"><button class="btn">Logout</button></a>
         <? } else {?>
        <a href="login.php"><button class="btn">Login</button></a>
        <a href="register.php"><button class="btn">Register</button></a><br />
        <a href="#info_steps"><button style="margin-top:15px" class="btn">Learn More</button></a>
        <?}?>
      </div>
  </div>

  <? if(!Session\isLoggedIn()) { ?>
  <div id="info_steps" class="blurbs blurbs-4 dark">
    <h1 class="dash-bot">Easy Peasy</h1>
      <div class="blurb">
        <span class="fa fa-user fa-5x"></span>
        <h3> Create account</h3>
      </div>
      <div class="blurb">
        <span class="fa fa-list fa-5x"></span>
        <h3> Create TODO List </h3>
      </div>
      <div class="blurb">
        <span class="fa fa-sort-numeric-asc fa-5x"></span>
        <h3> Insert all the tasks you need to do </h3>
      </div>
      <div class="blurb">
        <span class="fa fa-check fa-5x"></span>
        <h3> You're good to go! </h3>
      </div>
  </div>
   <? } ?>
</div>
