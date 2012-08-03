<?php $this->load->view('admin/header'); ?>

	<div class="row">
		<div class="span8">
			<?php foreach( $this->metas as $meta ) : ?>
				<a href="<?php echo site_url('admin/meta/tag/' . $meta['mid']); ?>"><?php echo $meta['name']; ?></a>&nbsp;&nbsp;
			<?php endforeach; ?>
		</div>
		<div class="span4">
			<form action="<?php echo site_url('admin/tag/publish'); ?>">
				<label for="meta_name">标签名称</label>
				<input type="text" name="meta_name" id="meta_name" value="<?php echo $this->meta_name; ?>" />
				
				<label for="meta_slug">标签缩略名</label>
				<input type="text" name="meta_slug" id="meta_slug" value="<?php echo $this->meta_slug; ?>" />
				<hr />

				<button class="btn btn-primary" type="submit"><?php echo $this->mid != 0 ? 'Update' : 'Publish'; ?></button>
			</form>
		</div>
	</div>

<?php $this->load->view('admin/footer'); ?>
