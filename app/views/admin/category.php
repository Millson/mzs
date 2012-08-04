<?php $this->load->view('admin/header'); ?>

	<div class="row">
		<div class="span8">
			<table class="table table-scriped">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>名称</th>
						<th>缩略名</th>
						<th>文章数</th>
						<th>排序</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach( $this->metas as $meta ) : ?>
					<tr>
						<td><a href="<?php echo site_url('admin/category/del/' . $meta['mid']); ?>"><i class="icon-trash"></i></a></td>
						<td><a href="<?php echo site_url('admin/category/' . $meta['mid']); ?>"><?php echo $meta['name']; ?></a></td>
						<td><?php echo $meta['slug']; ?></td>
						<td><?php echo $meta['count']; ?></td>
						<td>
							<?php if($meta['order'] > 1) : ?><a href="<?php echo site_url('admin/category/change_order/'.$meta['mid'].'/up/'); ?>"><i class="icon-chevron-up"></i></a><?php endif; ?>
							<?php if($meta['order'] < count($this->metas)) : ?><a href="<?php echo site_url('admin/category/change_order/'.$meta['mid'].'/down/'); ?>"><i class="icon-chevron-down"></i></a><?php endif; ?>
							<?php echo $meta['order']; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="span4">
			<form action="<?php echo site_url('admin/category/publish'); ?>" method="post">
				<label for="meta_name">分类名称</label>
				<input type="text" name="meta_name" id="meta_name" value="<?php echo $this->meta_name; ?>" />

				<label for="meta_slug">分类缩略名</label>
				<input type="text" name="meta_slug" id="meta_slug" value="<?php echo $this->meta_slug; ?>" />
				<hr />
				
				<button class="btn btn-primary" type="submit"><?php echo $this->mid != 0 ? 'Update' : 'Publish'; ?></button>
			</form>
		</div>
	</div>

<?php $this->load->view('admin/footer'); ?>
