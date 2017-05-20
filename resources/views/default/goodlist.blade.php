@extends('default.layout')

@section('title')
    <title>{{ $info->seotitle }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')

	<!-- 搜索 -->
	<section class="search container-fluid overh">
		<form action="#" class="form-inline mt10">
			<div class="row">
				<div class="col-xs-9">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search something">
					</div>
				</div>
				<div class="col-xs-3">
					<button type="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	</section>

<section class="container-fluid overh">
	
	<div class="row sort_list bg-info text-center">
		<div class="col-xs-3"><a href="{{ url()->current() }}?sort=sort&sc=asc">综合</a></div>
		<div class="col-xs-3"><a href="{{ url()->current() }}?sort=sales&sc=desc">销量</a></div>
		<div class="col-xs-3"><a href="{{ url()->current() }}?sort=isnew">新品</a></div>
		<div class="col-xs-3"><a href="{{ url()->current() }}?sort=price&sc=asc">价格</a></div>
	</div>

	<div class="row good_list mt10">
		
		@foreach($list as $l)
		<div class="col-xs-4 col-sm-3">
			<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
			<div class="good_info clearfix">
				<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
				<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
			</div>
		</div>
		@endforeach


	</div>

	<div class="pages">
        {!! $list->links() !!}
    </div>

</section>

	

@endsection
