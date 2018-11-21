<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
      require DIR_VIEWS.'header.php';
    ?>
  </head>

  <body>
    
    <?php 
      require DIR_VIEWS.'navigation.php';

      $currentPage = $routes[1];
      switch ($currentPage) {
          case "":
              require DIR_VIEWS.'pages/home.php';
              break;
          case "user":
              require DIR_VIEWS.'pages/user.php';
              break;
          case "sign-up":
              require DIR_VIEWS.'pages/sign-up.php';
              break;
          case "login":
              require DIR_VIEWS.'pages/login.php';
              break;
          case "logout":
              require DIR_VIEWS.'pages/logout.php';
              break;
          case "about":
              require DIR_VIEWS.'pages/about.php';
              break;
          case "child-sheet":
              require DIR_VIEWS.'pages/child-sheet.php';
              break;              
          case "financial-info":
              require DIR_VIEWS.'pages/financial-info.php';
              break;
          default:
              require DIR_VIEWS.'pages/404.php';
      }

      require DIR_VIEWS.'footer.php';
    ?>

  </body>

</html>
