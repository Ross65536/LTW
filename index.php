<?php
  include_once('PHP/CommonInit.php');
  
  $BrowserTabTitle = "Todo Lists";
  include_once('templates/common/default_head.php');
  include_once('templates/common/header.php');

  if(Session\isLoggedIn())
  {
    //colocar isto num template proprio
    ?><a href="my_lists.php">My Lists</a><?
  }

  include_once('templates/main_page.php');
  
  include_once('templates/common/footer.php');

?>
