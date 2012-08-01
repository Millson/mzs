<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->page_name; ?> - 三水志</title>
		<meta name="description" content="">
		<meta name="author" content="Millson Zhou">
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le styles -->
		<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
		<style type="text/css" media="screen">
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />

		<!-- Le fav and touch icons -->
		<!-- Update these with your own images
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/images/apple-touch-icon.png'); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/images/apple-touch-icon-72x72.png'); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/images/apple-touch-icon-114x114.png'); ?>">
		-->
	</head>

	<body>
		<div class="navbar navbar-fixed-top">
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
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">分类<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php foreach($this->menu_category as $category) : ?>
									<li>
										<?php echo anchor('category/' . $category['slug'], $category['name'], array('title'=>$category['name'])); ?>
									</li>
									<?php endforeach; ?>
								</ul>
							</li>

							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">页面<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php foreach($this->menu_pages as $page) : ?>
									<li><a href="<?php echo site_url('page/' . $page['slug']); ?>"><?php echo $page['title']; ?></a></li>
									<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">
			<div class="content">
				<div class="page-header">
					<h1><?php echo $this->page_header; ?><small><?php echo $this->page_tagline; ?></small></h1>
				</div>

