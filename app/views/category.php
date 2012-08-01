<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<ul>
		<?php foreach($this->posts as $post) : ?>
			<li>
				<span><?php echo $post['date']; ?></span>
				 &raquo;
				<a href="<?php echo $post['permalink']; ?>" title="<?php echo $post['title']; ?>"><?php echo $post['title']; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

<?php $this->load->view('footer'); ?>
