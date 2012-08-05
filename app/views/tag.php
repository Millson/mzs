<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<ul class="tag_box inline">
		<?php foreach($this->used_metas as $mid) : ?>
			<li><a href="<?php echo current_url() . "#" . $this->all_metas[$mid]['slug']; ?>"><?php echo $this->all_metas[$mid]['name']; ?></a></li>
		<?php endforeach; ?>
		</ul>
	<?php foreach($this->archives as $mid=>$posts) : ?>
		<h4 id="<?php echo $this->all_metas[$mid]['slug']; ?>"><?php echo $this->all_metas[$mid]['name']; ?> <span><a href="#"><i class="icon-arrow-up"></i></a></span></h4>
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
