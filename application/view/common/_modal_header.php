<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/public_html/ico/favicon.png">

    <title><?php echo SITE_NAME; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URL; ?>/public_html/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL; ?>/public_html/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo BASE_URL; ?>/public_html/js/html5shiv.js"></script>
      <script src="<?php echo BASE_URL; ?>/public_html/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo SITE_NAME; ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <form role="form" method="POST" action="<?php echo BASE_URL ?>/auth/login/" class="navbar-form navbar-right" autocomplete="on">
            <div class="form-group">
              <input type="text" name="username" placeholder="Username" class="form-control" required="">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control" required="">
            </div>
            <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

