<?php $this->load->view('admin/header'); ?>

<div class="container">
	<?php echo form_open('admin/post/publish', array('class'=>'well'), $hidden); ?>
	<div class="row">
		<div class="span8">
			<?php echo form_label('日志标题', 'title'); ?>
			<?php echo form_input(array('value'=>isset($post)?$post['title']:'', 'name'=>'title', 'id'=>'title', 'class'=>'input-xxlarge', 'placeholder'=>'输入标题', 'style'=>'width:620px;')); ?>

			<?php echo form_label('日志内容', 'content'); ?>
			<?php echo form_textarea(array('value'=>isset($post)?$post['content']:'', 'name'=>'content', 'id'=>'content', 'class'=>'input-xxlarge', 'style'=>'width:620px;')); ?>
		</div>
		<div class="span3">
			<?php echo form_label('分类', 'category[]'); ?>
			<?php echo form_multiselect('category[]', $categories, isset($category_select)?$category_select:'23'); ?>

			<?php echo form_label('标签', 'tags'); ?>
			<?php echo form_input(array('value'=>isset($tags)?$tags:'', 'name'=>'tags', 'id'=>'tags', 'placeholder'=>'输入标签')); ?>

			<?php echo form_label('缩略名', 'slug'); ?>
			<?php echo form_input(array('value'=>isset($post)?$post['slug']:'', 'name'=>'slug', 'id'=>'slug', 'placeholder'=>'输入缩略名')); ?>

			<?php echo form_submit(array('name'=>'publish', 'class'=>'btn btn-primary'), '提交'); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
