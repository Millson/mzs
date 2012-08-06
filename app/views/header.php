<!DOCTYPE html>
<html lang="en">
	<head>
		<meta content="text/html" charset="utf-8" http-equiv="Content-Type" />
		<title><?php echo $this->page_name; ?> - 三水志</title>
		<meta name="description" content="">
		<meta name="author" content="Millson Zhou">
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="<?php echo base_url('assets/js/html5.js'); ?>"></script>
		<![endif]-->

		<!-- Le styles -->
		<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/img/apple-touch-icon-72x72.png'); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/img/apple-touch-icon-114x114.png'); ?>">
	</head>

	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="<?php echo site_url(); ?>">三水志</a>
					<div class="nav-collapse">
						<ul class="nav">
						<?php foreach($this->permanent_pages as $page) : ?>
							<li <?php if($this->uri->segment(1) == $page['slug']) : ?>class="active"<?php endif; ?>>
								<?php echo anchor($page['slug'], $page['title'], array('title'=>$page['title'])); ?>
							</li>
						<?php endforeach; ?>

							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages<b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php foreach($this->menu_pages as $page) : ?>
									<li <?php if($this->uri->segment(2) == $page['slug']) : ?>class="active"<?php endif; ?>>
										<a href="<?php echo site_url('page/' . $page['slug']); ?>"><?php echo $page['title']; ?></a>
									</li>
								<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div><!--/.container -->
			</div><!--/.navbar-inner -->
		</div><!--/.navbar -->

		<div class="container">
			<div class="content">
				<div class="page-header">
					<h1><?php echo $this->page_header; ?><small><?php echo $this->page_tagline; ?></small></h1>
				</div>

