<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Webex Registration Upload Portal</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background-image: url(assets/squared_metal.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand">Webex Registration Upload Portal</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="divider-vertical"></li>
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In<strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <form action="login.php" method="post">
                    Email:<br />
                    <input type="text" name="email" value="<?php echo $submitted_username; ?>" />
                    <br /><br />
                    Password:<br />
                    <input type="password" name="password" value="" />
                    <br /><br />
                    <input type="submit" class="btn btn-info" value="Login" />
                </form>
            </div>
          </li>
          <li class="divider-vertical"></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h2>Please login to portal using the form below or navbar login menu.</h2><br />
    <?php if (htmlspecialchars($_GET["error"]) != ""): ?>
      <div class="alert alert-warning">
        <?php
          echo htmlspecialchars($_GET["error"]);
        ?>
      </div>
    <?php endif ?>
    <form action="login.php" method="post">
        Email:<br />
        <input type="text" name="email" value="<?php echo $submitted_username; ?>" />
        <br />
        Password:<br />
        <input type="password" name="password" value="" />
        <br /><br />
        <input type="submit" class="btn btn-info" value="Login" />
    </form>
</div>
</body>
</html>
