<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->page_name; ?> - MZSAdmin</title>
		<meta name="author" content="Millson Zhou">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le styles -->
		<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />

		<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
		
		<!-- Le fav and touch icons -->
		<!-- Update these with your own images
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/img/apple-touch-icon-72x72.png'); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/img/apple-touch-icon-114x114.png'); ?>">
		-->
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
					<a class="brand" href="<?php echo site_url('admin'); ?>">MZSAdmin</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">创建<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('admin/post/edit'); ?>">新日志</a></li>
									<li><a href="<?php echo site_url('admin/page/edit'); ?>">新页面</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">管理<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('admin/post'); ?>">日志</a></li>
									<li><a href="<?php echo site_url('admin/page'); ?>">页面</a></li>
									<li><a href="<?php echo site_url('admin/category'); ?>">分类</a></li>
									<li><a href="<?php echo site_url('admin/tag'); ?>">标签</a></li>
								</ul>
							</li>
							<li></i><a href="<?php echo site_url(); ?>"><i class="icon-plane icon-white"></i>访问前台</a></li>
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

