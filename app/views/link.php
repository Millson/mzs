<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<?php foreach($this->links as $sort=>$links) : ?>
		<h4><?php echo $sort; ?></h4>
		<ul>
			<?php foreach($links as $link) : ?>
			<li><?php echo anchor($link['url'], $link['name']); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endforeach; ?>
	</div>
</div>

<?php $this->load->view('footer'); ?>
