<?php
    
    require dirname(__FILE__)."/config.php";

    /* Routes initialization */
    require DIR_UTILS.'getCurrentUri.php';
    $routes = explode('/', getCurrentUri());   

    /* Load main layout */
  	require DIR_VIEWS.'layout.php';  
    

?>


