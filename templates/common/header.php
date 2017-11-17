

<body>
    <header id="header">
        <div id="title">
            <h1><a href="index.php">TODO Lists</a></h1>
        </div>

        <div id="signup">
            <?php  if(! Session\isLoggedIn()) { ?>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php } else { ?>
                <a href="edit_account.php">Edit Account</a>
                <a href="action_logout.php">Logout</a>
            <?php } ?>
        </div>

        <menu>
            <ul>
                <li><a href="index.php">??</a></li>
            </ul>
        </menu>
    </header>
    <div id="body-section">
