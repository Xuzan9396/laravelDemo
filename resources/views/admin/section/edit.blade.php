<form action="javascript:ajax_submit();" method="post" id="form_ajax">
    {{ csrf_field() }}

	<div class="form-group">
		<label for="name">
			部门名称：
			<span class="color-red">*</span>
		</label>
		<input type="text" name="data[name]" class="form-control" value="{{ $info['name'] }}">
	</div>
	<div class="form-group">
		<!-- 超管不能被禁用及删除 -->
		<div class="pure-radio">
			<label for="status">状态：</label>
			<label class="radio-inline"><input type="radio" name="data[status]"@if ($info['status'] == 1) checked="checked"@endif class="input-radio" value="1">
			启用</label>
			<label class="radio-inline"><input type="radio" name="data[status]"@if ($info['status'] != 1) checked="checked"@endif class="input-radio" value="0">
			禁用</label>
		</div>
	</div>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <div onclick='ajax_submit_form("form_ajax","{{ url('/xyshop/section/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-info">提交</div>
    </div>
</form>