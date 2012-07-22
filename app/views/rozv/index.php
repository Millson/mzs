<?php
/**
 * This is a clear and beautiful theme for Typecho
 * 
 * @package Rozv
 * @author 摄氏度
 * @version 1.0
 * @link http://prower.cn
 */
$this->need('header.php');
?>
<?php while($this->next()): ?>
	<section class="post">
		<header class="post_head">
			<h2><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<p><?php $this->date('Y-m-d'); ?> &bull; <?php $this->category(','); ?> &bull; <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('No Comments', '1 Comment', '%d Comments'); ?></a></p>
		</header>
		<article class="post_artice">
			<?php $this->content('阅读更多...'); ?>
		</article>
	</section>
<?php endwhile; ?>
<?php $this->pageNav(); ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
