<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\Api\NotificationRequest;
use function PHPUnit\Framework\isNull;

class NotificationController extends Controller
{
    public function index(NotificationRequest $request,$id=null){
        $validated= $request->validated();
        // print_r($validated); exit;
        $start = $request['start'];
        $end=$request['end'];
        if($id){
            return   $request->user()->notifications()->find($id);
        }
        if(!empty($validated->status)){
            return   $request->user()->notifications()->take($end,$start)->where("status",$validated->status)->orderBy("created_at","desc")->get();
        }


        return $request->user()->notifications->take($end,$start);

    }
    //
    public function change_status(Request $request){

        $notify_id=$request->notify_id;
        $status=$request->status;
     //  print_r($notify_id);exit;
        $upadte_status=Notification::where('id',$notify_id)->update(['status'=>$status]);

        if(!$upadte_status){
            return response()->json([
                'status' => 'error',
                'data' => "",
            ],400);
        }
        return response()->json([
            'status' => 'success',
            'data' => "",
        ],200);
    }
}
