

<body>
    <header id="header">
        <a href="index.php" id="title">
            <img id="logo_image" src="images/todo_image.png" alt="logo">  
            <h1> TODO Lists</h1>
        </a>
        

        <?php if(Session\isLoggedIn()) { ?>
            <p id="display_username" >Hello <?=htmlentities(Session\getLoginUsername())?></p>
        <? } ?>

        <ul id="accounts_bar">
            <?php  if(! Session\isLoggedIn()) { ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <li><a href="my_lists.php">My Lists</a></li>
                <li><a href="edit_account.php">Edit Account</a></li>
                <li><a href="PHP/actions/accounts/action_logout.php">Logout</a></li>
            <?php } ?>
        </ul>

        <!-- <menu> 
            <ul>
                <li><a href="index.php">??</a></li>
            </ul>
        </menu> -->
    </header>
    <div id="body-section">
