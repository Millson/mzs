<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span8">
		<?php echo $this->post['content']; ?>
		<hr>
		<div class="pagination">
			<ul>
				<?php if($this->prev) : ?>
				<li class="prev"><?php echo anchor('post/' . $this->prev['slug'], '&larr; 上一篇', array('title'=>$this->prev['title'])); ?></li>
				<?php else : ?>
				<li class="prev disabled"><a>&larr; 上一篇</a></li>
				<?php endif; ?>
				<li><a href="<?php echo site_url('archive'); ?>">归档</a></li>
				<?php if($this->next) : ?>
				<li class="next"><?php echo anchor('post/' . $this->next['slug'], '下一篇 &rarr;', array('title'=>$this->next['title'])); ?></li>
				<?php else : ?>
				<li class="next disabled"><a>Next &rarr;</a>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<div class="span4">
		<h4>Published</h4>
		<div class="date"><span><?php echo date("Y年m月d日 H时i分s秒", $this->post['modified']); ?></span></div>
		
		<?php if($this->post['categories']) : ?>
		<hr />
		<h4>Categories</h4>
		<ul class="tag_box inline">
			<?php foreach($this->post['categories'] as $tag) : ?>
				<li><a href="<?php echo site_url('category') . "#" . $tag['slug']; ?>"><?php echo $tag['name']; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

		<?php if($this->post['tags']) : ?>
		<hr />
		<h4>Tags</h4>
		<ul class="tag_box inline">
			<?php foreach($this->post['tags'] as $tag) : ?>
				<li><a href="<?php echo site_url('tag') . "#" . $tag['slug']; ?>"><?php echo $tag['name']; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
</div>

<?php $this->load->view('footer'); ?>
