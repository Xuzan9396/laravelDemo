@extends('default.layout')


@section('title')

    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">

@endsection



<!-- 内容 -->
@section('content')

<section class="container-fluid mt20">
	<ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        {{ App::make('tag')->goodcatpos($info->cate_id) }}
    </ol>
    <div class="good_top">
		<div class="good_show row">
			<a href="{{ url('shop/good',['id'=>$info->id]) }}" class="col-xs-12 col-sm-3"><img src="{{ $info->thumb }}" class="img-responsive" alt="{{ $info->title }}"></a>
			<div class="col-xs-12 col-sm-9">
				<h1 class="good_show_title"><a href="{{ url('shop/good',['id'=>$info->id]) }}">{{ $info->title }}</a></h1>
				<!-- <h4>{{ $info->pronums }}</h4> -->
				<form action="{{ url('shop/addcart') }}">
				{{ csrf_field() }}

				<!-- 价格、库存，购物车 -->
				<div class="row mt10">
					<div class="col-xs-12 col-sm-3">价格：<span class="price">{{ $info->price }}</span>￥</div>
					<div class="col-xs-12 col-sm-3">库存：<span class="store">{{ $info->store }}</span></div>
				</div>
				
				<!-- 加购物车 -->
				<div class="row mt10">
						<input type="hidden" value="{{ $info->id }}" name="gid">
						<input type="hidden" value="{{ $info->price }}" name="gp">
						<div class="col-xs-6 col-sm-2"><input type="number" min="0" value="1" class="form-control" name="num"></div>
						<div class="col-xs-6 col-sm-2"><button class="addcart btn btn-sm btn-success">加入购物车</button></div>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">内容</span></h3>
		{!! $info->content !!}
	</div>
	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">购买须知</span></h3>
		{!! $info->notice !!}
	</div>
	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">规格包装</span></h3>
		{!! $info->pack !!}
	</div>

</section>










@endsection
