@extends('admin.right')

@section('content')
<form action="" class="pure-form pure-form-stacked" method="post">
    {{ csrf_field() }}
    <!-- 提交返回用的url参数 -->
    <input type="hidden" name="ref" value="{!! $ref !!}">
    <div class="row">
        <div class="col-xs-4">

            <div class="form-group">
                <label for="title">标题：<span class="color-red">*</span>不超过255字符</label>
                <input type="text" name="data[title]" value="{{ $info->title }}" class="form-control">
                @if ($errors->has('data.title'))
                    <span class="help-block">
                        {{ $errors->first('data.title') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">满多少元：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[price]" value="{{ $info->price }}" class="form-control">
                @if ($errors->has('data.price'))
                    <span class="help-block">
                        {{ $errors->first('data.price') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="lessprice">减多少元：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[lessprice]" value="{{ $info->lessprice }}" class="form-control">
                @if ($errors->has('data.lessprice'))
                    <span class="help-block">
                        {{ $errors->first('data.lessprice') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="nums">数量：<span class="color-red">*</span>数字</label>
                <input type="number" min="0" name="data[nums]" value="{{ $info->nums }}" class="form-control">
                @if ($errors->has('data.nums'))
                    <span class="help-block">
                        {{ $errors->first('data.nums') }}
                    </span>
                @endif
            </div>



            <div class="form-group">
                <label for="starttime">开始时间：</label>
                <input type="text" name="data[starttime]" class="form-control" value="{{ $info->starttime }}" id="laydate">
            </div>

            <div class="form-group">
                <label for="endtime">结束时间：</label>
                <input type="text" name="data[endtime]" class="form-control" value="{{ $info->endtime }}" id="laydate2">
            </div>

            <div class="form-group">
                <label for="sort">排序：</label>
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control">
                @if ($errors->has('data.sort'))
                    <span class="help-block">
                        {{ $errors->first('data.sort') }}
                    </span>
                @endif
            </div>
            

            <div class="form-group">
                <label for="status">状态：</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '1') checked="checked" @endif class="input-radio" value="1">
                    进行中</label>
                <label class="radio-inline"><input type="radio" name="data[status]"@if($info->status == '0') checked="checked" @endif class="input-radio" value="0">关闭</label>
            </div>

        </div>
    </div>



    <div class="btn-group mt10">
        <button type="reset" name="reset" class="btn btn-warning">重填</button>
        <button type="submit" name="dosubmit" class="btn btn-info">提交</button>
    </div>
</form>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    laydate({
        elem: '#laydate',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
    laydate({
        elem: '#laydate2',
        format: 'YYYY-MM-DD hh:00:00', // 分隔符可以任意定义，该例子表示只显示年月
        istime: true,
    });
</script>

@endsection