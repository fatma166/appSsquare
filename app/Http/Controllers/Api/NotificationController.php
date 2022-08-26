<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\Api\NotificationRequest;
class NotificationController extends Controller
{
    public function index(NotificationRequest $request,$id=null){
        $validated= $request->validated();

        if($id){
            return   $request->user()->notifications()->find($id);
        }elseif(!empty($validated->status)){
            return   $request->user()->notifications()->where("status",$validated->status)->orderBy("created_at","desc")->get();
        }


        return $request->user()->notifications;

    }
    //
    public function change_status(Request $request){
        $notify_id=$request['notify_id'];
        $status=$request['status'];
        $upadte_status=Notification::where('id',$notfy_id)->update(['status'=>$status]);
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
