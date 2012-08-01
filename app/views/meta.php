<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<ul class="tag_box inline">
		<?php foreach($this->metas as $meta) : ?>
			<li><a href="<?php echo current_url() . "#" . $meta['name'] . "-ref"; ?>"><?php echo $meta['name']; ?><span><?php echo $meta['count']; ?></span></a></li>
		<?php endforeach; ?>
		</ul>
	<?php foreach($this->archives as $meta_name=>$posts) : ?>
		<h2 id="<?php echo $meta_name . "-ref"; ?>"><?php echo $meta_name; ?></h2>
		<ul>
		<?php foreach($posts as $post) : ?>
			<li>
				<span><?php echo $post['date']; ?></span>
				 &raquo;
				<a href="<?php echo $post['permalink']; ?>" title="<?php echo $post['title']; ?>"><?php echo $post['title']; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
		<hr />
	<?php endforeach; ?>
	</div>
</div>

<?php $this->load->view('footer'); ?>
