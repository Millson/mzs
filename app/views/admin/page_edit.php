<?php $this->load->view('admin/header'); ?>

<div class="container">
	<?php echo form_open('admin/page/publish', array('class'=>'well'), $this->hidden); ?>
	<div class="row">
		<div class="span8">
			<?php echo form_label('页面标题', 'title'); ?>
			<?php echo form_input(array('value'=>isset($this->post)?$this->post['title']:'', 'name'=>'title', 'id'=>'title', 'class'=>'input-xxlarge', 'placeholder'=>'输入标题', 'style'=>'width:620px;')); ?>

			<?php echo form_label('页面内容', 'content'); ?>
			<?php echo form_textarea(array('value'=>isset($this->post)?$this->post['content']:'', 'name'=>'content', 'id'=>'content', 'class'=>'input-xxlarge', 'style'=>'width:620px;height:400px;')); ?>
		</div>
		<div class="span3">
			<?php echo form_label('缩略名', 'slug'); ?>
			<?php echo form_input(array('value'=>isset($this->post)?$this->post['slug']:'', 'name'=>'slug', 'id'=>'slug', 'placeholder'=>'输入缩略名')); ?>

			<?php echo form_submit(array('name'=>'publish', 'class'=>'btn btn-primary'), $this->button_name); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div> <!--/container -->

<?php $this->load->view('admin/footer'); ?>
