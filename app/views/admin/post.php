<?php $this->load->view('admin/header'); ?>

<div class="row">
	<span class="span12">
	<table class="table tabel-striped">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>标题</th>
				<th>分类</th>
				<th>日期</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->posts as $post) : ?>
			<tr>
				<td><a href="<?php echo site_url('admin/post/del/' . $post['pid']); ?>" title="删除"><i class="icon-trash"></i></a></td>
				<td><?php echo anchor('admin/post/edit/'.$post['pid'], $post['title']); ?></td>
				<td><?php $cate = $post['categories'][0]; echo anchor('admin/post/index/post/'.$cate['mid'], $cate['name']); ?></td>
				<td><?php echo $post['date']; ?></td>
			</tr>
			<?php endforeach; ?>
	</table>
	</div>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
