<link rel="stylesheet" type="text/css" href="css/main/layout.css"/>
<link rel="stylesheet" type="text/css" href="css/main/design.css"/>

<? if(Session\isLoggedIn()) { ?>
    <div id="main_logged_in">
        <a href="my_lists.php">My Lists</a>
    </div>
 <? } ?>

<div id="text">
    <h1 id="slogan"> Organize your life. </h1>
    <div>
        <h2> A simple, straightforward way to organize your tasks. </h2>
        <h2> Get started. It's simple! </h2>
    </div>
</div>

<div class="main_container">
    <img src="images/paper.jpg" style="width:100%;">
    <div class="centered">
        <p> Create account </p>
        <p> Make a TODO List </p>
        <p> Insert all the tasks you need to do </p>
        <p> Insert the deadlines for said tasks </p>
        <p> You're good to go! Now get to work! </p>
    </div>
</div>