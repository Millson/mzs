<!DOCTYPE html>
<html>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="content-type" content="text/html; charset=<?php $this->options->charset(); ?>" />
    <title><?php $this->archiveTitle(' &raquo; ', '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>" />
    <!–[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]–>
    <?php $this->header(); ?>
</head>

<body>
<div id="top">
    <nav id="nav">
        <ul id="menu">
            <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
            <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
            <?php while($categories->next()): ?>
                <li<?php if($this->is('category', $categories->slug)): ?> class="current"<?php endif; ?>><a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a></li>
            <?php endwhile; ?>
        </ul>
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>">
            <input type="text" name="s" class="text" size="20" required />
            <button type="submit">搜索</button>
        </form>
    </nav>
</div>
<div id="wrap">
    <header id="header">
    	<div id="logo">
    	    <h1>
                <a href="<?php $this->options->siteUrl(); ?>">
                    <?php if ($this->options->logoUrl): ?>
                    <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
                    <?php else : ?>
                        <?php $this->options->title() ?>
                    <?php endif; ?>
                </a>
            </h1>
    	    <small class="description"><?php $this->options->description() ?></small>
        </div>
    </header>