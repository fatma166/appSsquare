<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
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
