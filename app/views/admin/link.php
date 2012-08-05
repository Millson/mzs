<?php $this->load->view('admin/header'); ?>

	<div class="row">
		<div class="span8">
			<table class="table table-scriped">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>链接名称</th>
						<th>链接地址</th>
						<th>分类</th>
						<th>排序</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach( $this->links as $link ) : ?>
					<tr>
						<td><a href="<?php echo site_url('admin/link/del/' . $link['lid']); ?>"><i class="icon-trash"></i></a></td>
						<td><a href="<?php echo site_url('admin/link/' . $link['lid']); ?>"><?php echo $link['name']; ?></a></td>
						<td><?php echo $link['url']; ?></td>
						<td><?php echo $link['sort']; ?></td>
						<td><?php echo $link['order']; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="span4">
			<form action="<?php echo site_url('admin/link/publish'); ?>" method="post">
				<label for="name">链接名称</label>
				<input type="text" name="name" id="name" value="<?php echo $this->name; ?>" />

				<label for="url">链接地址</label>
				<input type="text" name="url" id="url" value="<?php echo $this->url; ?>" />

				<label for="sort">分类</label>
				<input type="text" name="sort" id="sort" value="<?php echo $this->sort; ?>" />

				<label for="order">排序</label>
				<input type="text" name="order" id="order" value="<?php echo $this->order; ?>" />

				<hr />
				<input type="hidden" name="lid" value="<?php echo $this->lid; ?>" />
				<button class="btn btn-primary" type="submit"><?php echo $this->lid != 0 ? 'Update' : 'Publish'; ?></button>
			</form>
		</div>
	</div>

<?php $this->load->view('admin/footer'); ?>
