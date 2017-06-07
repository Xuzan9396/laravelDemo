@extends('default.layout')


@section('title')
    <title>购物车-吉鲜商城</title>
@endsection


@section('content')
<div class="container-fluid bgf">
	<div class="user_order_list clearfix">
		@foreach($orders as $o)
        <div class="user_order_list_top clearfix">
            <h5>
                <span class="order_font">订单单号：</span>{{ $o->order_id }}
                @if($o->tuan_id != 0)
                <span class="label label-success">团</span>
                @endif
            </h5>
            <p class="clearfix"><span class="order_font">订单总价：</span><strong class="color_2">￥{{ $o->total_prices }}</strong>
            @if($status == 1)
            	<a href="{{ url('shop/order/pay',['oid'=>$o->id]) }}" class="text-danger pull-right topay"><span class="glyphicon glyphicon-jpy topay"></span>去支付</a>
            	<a href="{{ url('shop/order/over',['id'=>$o->id]) }}" class="text-info pull-right topay"><span class="glyphicon glyphicon-remove-circle"></span>取消</a>
            </p>
            @endif
            @if($status == 2)
            	<span class="color_l pull-right">已支付</span>
        	</p>
<!--             <p><span class="order_font">发货状态：</span>
	@if($o->shipstatus == 0)
	<span class="color-green">未发货</span>
	@else
	<span class="color-blue">已发货</span>
	@endif
</p> -->
            @endif
            @if($status == 3)
            <a href="{{ url('shop/order/ship',['oid'=>$o->id]) }}" class="text-danger pull-right"><span class="glyphicon glyphicon-compressed topay"></span>确认收货</a>
        	</p>
            @endif
            @if($status == 4 || $status == 5)
            <p><span class="order_font">订单状态：</span>
	            @if($o->orderstatus == 0)
            	<span class="color-red">已关闭</span>
            	@elseif($o->orderstatus == 1)
            	<span class="color-green">正常</span>
            	<!-- 三天内完成的可申请退货 -->
            	@elseif($o->orderstatus == 2 && (time() - strtotime($o->updated_at)) < 259200 )
            	<span class="color-success">已完成</span>
            	<a href="{{ url('shop/order/tui',['id'=>$o->id]) }}" class="text-info pull-right topay"><span class="glyphicon glyphicon-transfer"></span>申请退货</a>
            	@elseif($o->orderstatus == 3)
            	<span class="text-warning">已退货</span>
            	@else
            	<span class="text-danger">结束</span>
            	@endif
            </p>
            @endif
            <p class="created_at"><span class="order_font">下单时间：</span>{{ $o->created_at }}</p>
        </div>
			<div class="good_cart_list good_cart_list_order overh">
			@foreach($o->good as $l)
			<div class="mt5 good_cart_list_div">
				<div class="media">
					<a href="{{ url('/shop/good',['id'=>$l->good->id,'format'=>$l->format['format']]) }}" class="pull-left"><img src="{{ $l->good->thumb }}" width="100" class="media-object img-thumbnail" alt=""></a>
					<div class="media-body">
						<h4 class="mt5 cart_h4"><a href="{{ url('/shop/good',['id'=>$l->good->id,'format'=>$l->format['format']]) }}">{{ $l->good->title }}</a>
                        </h4>
                        @if($l->format['format_name'] != '')<span class="btn btn-sm btn-info mt10">{{ $l->format['format_name'] }}</span>@endif
                        <!-- 价格 -->
                        <p class="fs12">价格：<span class="good_prices color_l">￥{{ $l->price }}</span></p>
                        <p class="fs12">数量：<span class="good_prices color_l">￥{{ $l->nums }}</span></p>
                        <p class="fs12">小计：<span class="good_prices color_l">￥{{ $l->total_prices }}</span></p>
                        @if($l->commentstatus == 0 && $o->orderstatus == 2)
                        <p><a href="{{ url('shop/good/comment',['oid'=>$o->id,'gid'=>$l->good->id]) }}" class="text-success"><span class="glyphicon glyphicon-edit"></span>提交评价</a></p>
                        @endif
					</div>
				</div>
			</div>
			@endforeach
		</div>
   		@endforeach
	</div>
	<div class="pages">
	    {!! $orders->links() !!}
	</div>
</div>
@include('default.foot')
@endsection