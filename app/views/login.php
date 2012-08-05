<?php $this->load->view('header'); ?>

<div class="row">
	<div class="span12">
		<form class="form-inline" action="<?php echo site_url('ms/login'); ?>" method="post">
			<input type="text" class="input-small" name="username" placeholder="输入用户名">
			<input type="password" class="input-medium" name="password" placeholder="输入密码">
			<label class="checkbox">
				<input type="checkbox"> 记住
			</label>
			<button type="submit" class="btn btn-primary">登录</button>
		</form>
	</div>
</div>

<?php $this->load->view('footer'); ?>
