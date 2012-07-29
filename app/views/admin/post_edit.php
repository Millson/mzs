<?php $this->load->view('admin/header'); ?>

<div class="container">
	<?php echo form_open('admin/post/publish', array('class'=>'well')); ?>
	<div class="row">
		<div class="span8">

			<?php echo form_label('日志标题', 'title'); ?>
			<?php echo form_input(array('name'=>'title', 'id'=>'title', 'class'=>'input-xxlarge', 'placeholder'=>'输入标题', 'style'=>'width:620px;')); ?>

			<?php echo form_label('日志内容', 'content'); ?>
			<?php echo form_textarea(array('name'=>'content', 'id'=>'content', 'class'=>'input-xxlarge', 'style'=>'width:620px;')); ?>
		</div>
		<div class="span3">
			<?php echo form_label('分类', 'category[]'); ?>
			<?php echo form_multiselect('category[]', $categories, '1'); ?>

			<?php echo form_label('标签', 'tags'); ?>
			<?php echo form_input(array('name'=>'tags', 'id'=>'tags', 'placeholder'=>'输入标签')); ?>

			<?php echo form_label('缩略名', 'slug'); ?>
			<?php echo form_input(array('name'=>'slug', 'id'=>'slug', 'placeholder'=>'输入缩略名')); ?>

			<?php echo form_submit(array('name'=>'publish', 'class'=>'btn btn-primary'), '提交'); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
