<?php $session = new Session();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon"
	href="<?php echo BASE_URL; ?>/public_html/ico/favicon.png">
<title><?php echo SITE_NAME; ?></title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public_html/css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public_html/css/bootstrap.icon-large.min.css" />
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public_html/css/fam-icons.css" />
<!-- Colorbox CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public_html/css/colorbox.css" />
<!-- Custom styles for this template -->
<link href="<?php echo BASE_URL; ?>/public_html/css/style.css"
	rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		<script src="<?php echo BASE_URL; ?>/public_html/js/html5shiv.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/respond.min.js"></script>
<![endif]-->
	<script src="<?php echo BASE_URL; ?>/public_html/js/jquery.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-xIt_53-tSbyBxMzIvY1HKq69smDJXrY&sensor=false"></script>
	<script>

		function showConfirmDialog(msg){
			return confirm(msg);
		}

	</script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo BASE_URL; ?>/user/index"><?php echo SITE_NAME; ?>
				</a>
			</div>
			<form class="navbar-form navbar-left" role="search">
				<div class="btn-group">
					<button type="button" class="btn btn-info">Looking for .....</button>
					<button type="button" class="btn btn-info dropdown-toggle"
						data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo BASE_URL; ?>/friend/search/m">Boy</a></li>
						<li><a href="<?php echo BASE_URL; ?>/friend/search/f">Girl</a></li>
					</ul>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"> Welcome, <span class="full-name"><?php echo $session->get('fullname'); ?></span>  <b class="caret"></b>
				</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo BASE_URL; ?>/auth/logout"><i
								class="icon-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div id="main" class="container">
		<img src="<?php echo BASE_URL; ?>/public_html/img/loader.gif" id="loading-indicator" />
		<div class="row">

			<div class="col-md-3" id="sidebar">
				<a href="<?php echo BASE_URL; ?>/user/index"><h4 class="full-name"><?php echo $session->get('fullname'); ?></h4></a>
				<?php //if(!empty($user))
					$avarta = $session->get('avarta');
					if(!empty($avarta)){
				?>
					<a href="#" class="thumbnail"> <img class="img-responsive" id="img-avarta"
						data-src="<?php echo BASE_URL; ?>/uploads/<?php echo $avarta; ?>" src="<?php echo BASE_URL; ?>/uploads/<?php echo $avarta; ?>">
					</a>
				<?php }else{ ?>
					<a href="#" class="thumbnail"> <img class="img-responsive" id="img-avarta"
						data-src="<?php echo BASE_URL; ?>/public_html/js/holder.js/350x200/text:Comming soon!">
					</a>
				<?php }?>

				<p>
					<a href="#" id="btn-update" class="btn btn-xs btn-primary"><span
						class="glyphicon glyphicon-user"></span> Update profile image</a>
					<div id="update-avarta">
						<form enctype="multipart/form-data" id="upload_avarta" method="POST">
							<input id="avarta_file" name="avarta" type="file" multiple accept='image/*' />
							<input id="btn-upload-avarta"type="button" value="Upload" />
						</form>
					</div>
				</p>
				<hr />
				<div class="list-group">
					<a href="<?php echo BASE_URL; ?>/friend/list_friend"
						class="list-group-item"><i class="fam-group"></i>
						<span class="badge"><?php $session = new Session(); echo $session->get('current_friend'); ?></span> Friends</a>
					<a href="<?php echo BASE_URL; ?>/friend/list_receive_request"
						class="list-group-item"><i class="fam-user-add"></i>
						<span class="badge"><?php echo $session->get('requesting_friend'); ?></span> Waiting requests
						</a>
					<a href="<?php echo BASE_URL; ?>/friend/list_sent_request"
						class="list-group-item"><i class="fam-user-add"></i>
						<span class="badge"><?php echo $session->get('requesting_friend'); ?></span> Sent requests
						</a>
				</div>
			</div>
			<div class="col-md-9">
