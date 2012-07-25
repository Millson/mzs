<?php $this->load->view('admin/header'); ?>

<div class="container">
	<?php echo form_open('admin/post/do_edit', array('class'=>'well')); ?>
		<?php echo form_label('日志标题', 'title'); ?>
		<?php echo form_input(array('name'=>'title', 'id'=>'title', 'style'=>'width:890px;', 'placeholder'=>'输入标题')); ?>

		<?php echo form_label('日志内容', 'content'); ?>
		<?php echo form_textarea(array('name'=>'content', 'id'=>'content', 'rows'=>'20', 'cols'=>'70', 'style'=>'width:890px;')); ?>

		<?php echo form_label('标签', 'tags'); ?>
		<?php echo form_input(array('name'=>'tags', 'id'=>'tags', 'style'=>'width:890px;', 'placeholder'=>'输入标签')); ?>
		
		<?php echo form_submit(array('name'=>'publish', 'class'=>'btn btn-primary'), '提交'); ?>
	<?php echo form_close(); ?>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
