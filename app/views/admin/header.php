<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $page_name; ?> - MZAdmin</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="" />

		<!-- Le styles -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
		<style>
			body {padding-top: 60px;}
		</style>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
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
					<a class="brand" href="<?php echo site_url('admin'); ?>">MZSAdmin</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">日志<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('admin/post'); ?>">日志列表</a></li>
									<li><a href="<?php echo site_url('admin/post/edit'); ?>">发表新日志</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">页面<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('admin/page'); ?>">页面列表</a></li>
									<li><a href="<?php echo site_url('admin/page/edit'); ?>">创建新页面</a></li>
								</ul>
							</li>
							<li><a href="<?php echo site_url('admin/meta/category'); ?>">分类</a></li>
							<li><a href="<?php echo site_url('admin/meta/tag'); ?>">标签</a></li>
							<li></i><a href="<?php echo site_url(); ?>"><i class="icon-plane icon-white"></i>访问前台</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container"><h1><?php echo $page_name; ?></h1></div>
