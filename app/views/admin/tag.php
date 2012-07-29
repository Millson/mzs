<?php $this->load->view('admin/header'); ?>

<div class="container">
	<div class="row">
		<div class="span7">
			<?php foreach( $metas as $meta ) : ?>
				<a href="<?php echo site_url('admin/meta/tag/' . $meta['mid']); ?>"><?php echo $meta['name']; ?></a>&nbsp;&nbsp;
			<?php endforeach; ?>
		</div>
		<div class="span4">
			<?php echo form_open('admin/meta/publish', array('class'=>'well'), $hidden); ?>

			<?php echo form_label('标签名称', 'meta_name'); ?>
			<?php echo form_input(array('name'=>'meta_name', 'id'=>'meta_name', 'value'=>$meta_name)); ?>

			<?php echo form_submit(array('class'=>'btn btn-primary'), $button_name); ?>

			<?php echo form_close(); ?>
		</div>
	</div>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
