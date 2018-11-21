   <!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/">Good Shepard Academy</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php
            if(!isset($_SESSION["loggedin"])){
          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/sign-up">Sign-up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/login">Log-in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/about">About us</a>
          </li>
          <?php
            } else {
          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/child-sheet">View Child Sheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/financial-info">View Financial Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/about">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/logout">Logout</a>
          </li>
          <?php 
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>