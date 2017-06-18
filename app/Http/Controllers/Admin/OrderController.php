<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\ShipRequest;
use App\Models\GoodAttr;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\Ship;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index(Request $req)
    {
    	$title = '订单列表';
        $q = $req->input('q');
    	$starttime = $req->input('starttime');
        $endtime = $req->input('endtime');
        $status = $req->input('status');
        $shipstatus = $req->input('shipstatus');
        $ziti = $req->input('ziti');
        // 找出订单
        $orders = Order::with(['good'=>function($q){
                    $q->select('id','user_id','order_id','good_id','good_title','good_spec_key','good_spec_name','nums','price','total_prices');
                },'address','zitidian'])->where(function($r) use($q){
                    if ($q != '') {
                        // 查出来用户ID
                        $uid = User::where('nickname','like',"%$q%")->orWhere('phone','like',"%$q%")->pluck('id')->toArray();
                        $r->whereIn('user_id',$uid);
                    }
                })->where(function($q) use($starttime){
	                if ($starttime != '') {
	                    $q->where('created_at','>',$starttime);
	                }
	            })->where(function($q) use($endtime){
	                if ($endtime != '') {
	                    $q->where('created_at','<',$endtime);
	                }
	            })->where(function($q) use($status){
	                if ($status != '') {
	                    $q->where('orderstatus',$status);
	                }
	            })->where(function($q) use($shipstatus){
                    if ($shipstatus != '') {
                        $q->where('shipstatus',$shipstatus);
                    }
                })->where(function($q) use($ziti){
                    if ($ziti != 0 && $ziti != '') {
                        $q->where('ziti','!=',0);
                    }
                    elseif($ziti == 0 && $ziti != '')
                    {
                        $q->where('ziti',0);
                    }
                })->where('status',1)->orderBy('id','desc')->paginate(10);
        return view('admin.order.index',compact('title','orders','q','status','starttime','endtime','ziti'));
    }
    // 关闭
    public function getDel($id = '')
    {
    	Order::where('id',$id)->update(['orderstatus'=>0]);
    	return back()->with('message','关闭成功！');
    }
    // 自提、完成
    public function getZiti($id = '')
    {
        Order::where('id',$id)->update(['orderstatus'=>2]);
        return back()->with('message','自提成功！');
    }
    // 发货
    public function getShip($id = '')
    {
    	$title = '快递单号';
    	return view('admin.order.ship',compact('title','id'));
    }
    public function postShip(Request $req,$id = '')
    {
    	// 更新为已经发货
    	Order::where('id',$id)->update(['shipstatus'=>1,'shopmark'=>$req->input('data.shopmark'),'ship_at'=>date('Y-m-d H:i:s')]);
        return $this->ajaxReturn(1,'发货成功！');
    }
    /*// 退货
    public function getTui($id = '')
    {
        // 更新为关闭，退款到余额里
        DB::transaction(function() use ($id){
            $order = Order::findOrFail($id);
            if ($order->paystatus) {
                User::where('id',$order->user_id)->increment('user_money',$order->total_prices);
            }
            Order::where('id',$id)->update(['orderstatus'=>0]);
        });
        return back()->with('message','退货成功！');
    } */
}