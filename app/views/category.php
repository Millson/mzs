<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<?php $i = 0; foreach($this->used_metas as $mid) : ?>
				<li class="<?php if($i==0) : ?>active<?php endif; ?>"><a href="#<?php echo $this->all_metas[$mid]['slug']; ?>" data-toggle="tab"><?php echo $this->all_metas[$mid]['name']; ?></a></li>
				<?php $i++; endforeach; ?>
			</ul>
			<div class="tab-content">
				<?php $i = 0; foreach($this->archives as $mid=>$posts) : ?>
				<div class="tab-pane <?php if($i==0) : ?>active<?php endif; ?>" id="<?php echo $this->all_metas[$mid]['slug']; ?>">
					<ul>
						<?php foreach($posts as $post) : ?>
						<li>
						<span><?php echo $post['date']; ?></span>
						&raquo;
						<a href="<?php echo $post['permalink']; ?>" title="<?php echo $post['title']; ?>"><?php echo $post['title']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php $i++; endforeach; ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('footer'); ?>
