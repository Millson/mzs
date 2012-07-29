<?php $this->load->view('admin/header'); ?>

<div class="container">
	<table class="table tabel-striped">
		<thead>
			<tr>
				<th>标题</th>
				<th>分类</th>
				<th>日期</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($posts as $post) : ?>
			<tr>
				<td><a href="<?php echo site_url('admin/post/edit/'.$post['pid']); ?>"><?php echo $post['title']; ?></a></td>
				<td><a href="<?php echo site_url('admin/meta/category/'.$post['mid']); ?>"><?php echo $post['meta_name']; ?></a></td>
				<td><?php echo $post['date']; ?></td>
			</tr>
			<?php endforeach; ?>
	</table>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
