
<?
include_once('database/UsersHTMLDecorator.php');
include_once('database/UsersFacade.php');

$usersDB = new UsersHTMLDecorator(new UsersFacade());
$username = Session\getHTMLLogin();
$photo = $usersDB->getPhoto($username, "thumbs_tiny");
?>

<body>

<div id="container">

    <header id="header">
      <div class="wrapper">
        <a href="index.php" id="title" class="inner">
            <div id="logo">
              <img id="logo_image" src="images/logo2.png" alt="logo"><span id="site_name">TODO Lists</span>
            </div>
        </a>
      </div>


            <?php  if(Session\isLoggedIn()) { ?>
              <div class="dropdown">
                Hello <?=Session\getHTMLLogin()?>
                <a href="upload_user_photo.php"><img id="profile_pic" src="<?=$photo?>"/></a>
                <div class="dropdown-content">
                  <p><a href="my_lists.php">My Lists</a></p>
                  <p><a href="edit_account.php">Edit Account</a></p>
                  <p><a href="PHP/actions/accounts/action_logout.php">Logout</a></p>
                </div>
              </div>
            <?php } ?>
        <!-- <menu>
            <ul>
                <li><a href="index.php">??</a></li>
            </ul>
        </menu> -->
    </header>

    <div id="body-section">
