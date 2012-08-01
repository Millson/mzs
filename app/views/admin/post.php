<?php $this->load->view('admin/header'); ?>

<div class="container">
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
			<?php foreach($posts as $post) : ?>
			<tr>
				<td><input type="checkbox" /></td>
				<td><?php echo anchor('admin/post/edit/'.$post['pid'], $post['title']); ?></td>
				<td><?php $cate = $post['categories'][0]; echo anchor('admin/post/index/'.$cate['mid'], $cate['name']); ?></td>
				<td><?php echo $post['date']; ?></td>
			</tr>
			<?php endforeach; ?>
	</table>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
