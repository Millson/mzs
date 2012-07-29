<?php $this->load->view('admin/header'); ?>

<div class="container">
	<div class="row">
		<div class="span7">
			<table class="table table-scriped">
				<thead>
					<tr>
						<th>名称</th>
						<th>缩略名</th>
						<th>文章数</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach( $metas as $meta ) : ?>
					<tr>
						<td><a href="<?php echo site_url('admin/meta/category/' . $meta['mid']); ?>"><?php echo $meta['name']; ?></a></td>
						<td><?php echo $meta['slug']; ?></td>
						<td><a href="<?php echo site_url('admin/post/' . $meta['mid']); ?>"><?php echo $meta['count']; ?></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="span4">
			<?php echo form_open('admin/meta/publish', array('class'=>'well'), $hidden); ?>

			<?php echo form_label('分类名称', 'meta_name'); ?>
			<?php echo form_input(array('name'=>'meta_name', 'id'=>'meta_name', 'value'=>$meta_name)); ?>

			<?php echo form_submit(array('class'=>'btn btn-primary'), $button_name); ?>

			<?php echo form_close(); ?>
		</div>
	</div>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
