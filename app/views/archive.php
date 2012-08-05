<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
	<?php foreach($this->archives as $year=>$year_posts) : ?>
		<h3><?php echo $year; ?>:</h3>
		<?php foreach($year_posts as $month=>$month_posts) : ?>
		<h4><?php echo $month; ?></h4>
			<ul>
			<?php foreach($month_posts as $post) : ?>
				<li>
					<span><?php echo $post['date']; ?></span>
					 &raquo;
					<a href="<?php echo $post['permalink']; ?>" title="<?php echo $post['title']; ?>"><?php echo $post['title']; ?></a>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
		<hr />
	<?php endforeach; ?>
	</div>
</div>

<?php $this->load->view('footer'); ?>
