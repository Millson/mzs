<?php $this->load->view('admin/header'); ?>

	<div class="row">
		<div class="span9">
			<span>选中项：
					<a id="del_tags" href="javascript:;">删除</a>,&nbsp;&nbsp;
					<a id="merge_tags" href="javascript:;">合并到</a>：
						<input type="text" name="to_tag" id="to_tag" placeholder="输入标签名" data-provide="typeahead" data-source="<?php echo $this->tag_source; ?>" data-items="4" />
			<hr />
			<ul class="tag_box inline">
				<?php foreach($this->metas as $meta) : ?>
					<li id="tag_<?php echo $meta['mid']; ?>">
						<input type="checkbox" name="tag" value="<?php echo $meta['mid']; ?>" />
						<a href="<?php echo site_url('admin/tag/' . $meta['mid']); ?>"><?php echo $meta['name']; ?><span><?php echo $meta['count']; ?></span></a>&nbsp;
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="span3">
			<form action="<?php echo site_url('admin/tag/publish'); ?>">
				<label for="meta_name">标签名称</label>
				<input type="text" name="meta_name" id="meta_name" value="<?php echo $this->meta_name; ?>" />

				<label for="meta_slug">标签缩略名</label>
				<input type="text" name="meta_slug" id="meta_slug" value="<?php echo $this->meta_slug; ?>" />
				<hr />

				<button class="btn btn-primary" type="submit"><?php echo $this->mid != 0 ? 'Update' : 'Publish'; ?></button>
			</form>
		</div>
	</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#del_tags").click(function(){
		var tags = selected_tags();

		if(tags == '') {
			alert('未选中任一标签');
			return ;
		}

		$.ajax({
			'type': 'POST',
			'url': '/admin/tag/del',
			'data': {'tags': tags},
			'datatype': 'json',
			'success': function(result){
				alert('ok');

				result = eval("(" + result + ")");

				$.each(result, function(idx, item) {
					$("#tag_"+item).remove();
				});
			}
		});
	});	

	$("#merge_tags").click(function(){
		var to_tag = $("#to_tag").val();

		if(to_tag == '') {
			alert('没有填写要合并到的标签');
			return ;
		}

		var tags = selected_tags();

		if(tags == '') {
			alert('未选中任一标签');
			return ;
		}

		$.ajax({
			'type': 'POST',
			'url': '/admin/tag/merge',
			'data': {'tags': tags, 'to_tag': to_tag},
			'datatype': 'json',
			'success': function(result){
				alert('ok');

				result = eval("(" + result + ")");

				$.each(result, function(idx, item) {
					$("#tag_"+item).remove();
				});
			}
		});
	});
});

function selected_tags()
{
	var tags = '';
	$(":checkbox[checked]").each(function(){
		tags += $(this).val() + ",";
	});

	if(tags === '') {
		alert('未选中任一项');
		return ;
	}

	return tags.substring(0, tags.length - 1);
}

</script>

<?php $this->load->view('admin/footer'); ?>
