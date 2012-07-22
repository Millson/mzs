<?php $this->need('header.php'); ?>
<section class="post">
	<header class="post_head">
		<h2><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
		<p><?php $this->date('Y-m-d'); ?> &bull; <?php $this->category(','); ?> &bull; <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('No Comments', '1 Comment', '%d Comments'); ?></a></p>
	</header>
	<article class="post_artice">
		<?php $this->content(); ?>
		<div class="tags"><?php $this->tags('', true, ''); ?></div>
	</article>
</section>
<?php $this->need('comments.php'); ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
