<?php $this->load->view('admin/header'); ?>

<form action="<?php echo site_url('admin/post/publish'); ?>" method="post">
	<div class="row">
		<div class="span8">
			<label for="title">日志标题</label>
			<input type="text" name="title" id="title" class="input-xxlarge" placeholder="输入标题" style="width:100%" value="<?php echo $this->post ? $this->post['title'] : ''; ?>" />

			<label for="content">日志内容</label>
			<textarea name="content" id="content" class="input-xxlarge" style="width:100%;height:350px;">
				<?php echo $this->post ? $this->post['content'] : ''; ?>
			</textarea>
		</div>

		<div class="span4">
			<label for="category[]">分类</label>
			<?php foreach($this->categories as $mid=>$name) : ?>
			<label class="checkbox">
				<input type="checkbox" name="category[]" value="<?php echo $mid; ?>" <?php if( in_array($mid, $this->select_mids) ) : ?>checked="true"<?php endif; ?> /><?php echo $name; ?>
			</label>
			<?php endforeach; ?>
			<hr />

			<label for="tags">标签</label>
			<input type="text" name="tags" id="tags" placeholder="输入标签" value="<?php echo $this->tags; ?>" style="width:100%" />
			<hr />

			<label for="slug">缩略名</label>
			<input type="text" name="slug" id="slug" placeholder="输入缩略名" value="<?php echo $this->slug; ?>" style="width:100%" />
			<hr />

			<input type="hidden" name="pid" value="<?php echo $this->pid; ?>" />

			<button class="btn btn-primary" type="submit"><?php echo $this->pid != 0 ? 'Update' : 'Publish'; ?></button>
		</div>
	</div>
</form>

<?php $this->load->view('admin/footer'); ?>
