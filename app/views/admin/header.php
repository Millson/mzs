<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
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
					<a class="brand" href="<?php echo site_url('admin'); ?>">MZS Admin</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Posts<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another</a></li>
									<li class="divider"></li>
									<li class="nav-header">Nav header</li>
									<li><a href="#">A</a></li>
									<li><a href="#">B</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>


