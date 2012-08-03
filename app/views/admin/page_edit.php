<?php $this->load->view('admin/header'); ?>

<form action="<?php echo site_url('admin/page/publish'); ?>">
	<div class="row">
		<div class="span8">
			<label for="title">页面标题</label>
			<input type="text" name="title" id="title" class="input-xxlarge" placeholder="输入标题" style="width:100%" value="<?php echo $this->post ? $this->post['title'] : ''; ?>" />

			<label for="content">页面内容</label>
			<textarea name="content" id="content" class="input-xxlarge" style="width:100%;height:350px;"><?php echo $this->post ? $this->post['content'] : ''; ?></textarea>
		</div>

		<div class="span4">
			<label for="slug">缩略名</label>
			<input type="text" name="slug" id="slug" placeholder="输入缩略名" value="<?php echo $this->slug; ?>" style="width:100%;" />
			<hr />

			<button class="btn btn-primary" type="submit"><?php echo $this->pid != 0 ? 'Update' : 'Publish'; ?></button>
		</div>
	</div>
</form>

<?php $this->load->view('admin/footer'); ?>
