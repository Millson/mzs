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
				<li><?php echo anchor('archive', '归档'); ?></li>
				<?php if($this->next) : ?>
				<li class="next"><?php echo anchor('post/' . $this->next['slug'], '下一篇 &rarr;', array('title'=>$this->next['title'])); ?></li>
				<?php else : ?>
				<li class="next disabled"><a>Next &rarr;</a>
				<?php endif; ?>
			</ul>
		</div>
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			var disqus_shortname = 'zhoumiao';
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				 (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	</div>
	<div class="span4">
		<h4>Published</h4>
		<div class="date"><span><?php echo date("Y年m月d日 H时i分s秒", $this->post['modified']); ?></span></div>
		
		<?php if($this->post['categories']) : ?>
		<hr />
		<h4>Categories</h4>
		<ul class="tag_box inline">
			<?php foreach($this->post['categories'] as $tag) : ?>
				<li><?php echo anchor('category#'.$tag['slug'], $tag['name']); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

		<?php if($this->post['tags']) : ?>
		<hr />
		<h4>Tags</h4>
		<ul class="tag_box inline">
			<?php foreach($this->post['tags'] as $tag) : ?>
				<li><?php echo anchor('tag#'.$tag['slug'], $tag['name']); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

		<?php if($this->related_posts) : ?>
		<hr />
		<h4>Related</h4>
		<ul>
			<?php foreach($this->related_posts as $post) : ?>
			<li><?php echo anchor($post['permalink'], $post['title']); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
</div>

<?php $this->load->view('footer'); ?>
