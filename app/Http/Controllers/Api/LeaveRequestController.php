<?php

namespace App\Http\Controllers\Api;
use App\Libarary\NotificationManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    //
    public function Index(Request $request,$id=null,$start=0,$end){



        if($id){
            return   $request->user()->leave_requests()->find($id);
        }

        return $request->user()->leave_requests()->limit($end,$start)->orderBy('created_at','desc')->get();
    }



    public function checkExistRequestBefore($request,$from,$to){

        return($request->user()->leave_requests()->where('leave_from','>=',$from)->where('leave_to','<=',$to)->get()->toArray());

    }

    public function Request(\App\Http\Requests\Api\LeaveRequest $request){


        $validated=$request->validated();
       // print_r($request->user()); exit;

        $requested_leave_time=date_diff(date_create($validated['leave_from']),date_create($validated['leave_to']));
        $requested_leave_days=$requested_leave_time->d+1;//$requested_leave_time->d==0?
        $requested_leave_hours=$requested_leave_time->h;

        $leaveRequest=new \App\Models\LeaveRequest();
        $leaveRequest->user_id= $request->user()->id;
        $leaveRequest->leave_from=$validated['leave_from'];
        $leaveRequest->leave_to=$validated['leave_to'];
        $leaveRequest->days=$requested_leave_days;
        $leaveRequest->num_hours=$requested_leave_hours;

        $check_exist=$this->checkExistRequestBefore($request,$leaveRequest->leave_from,$leaveRequest->leave_to);

        if(!empty($check_exist))return response()->json([
            'status' => 'error',
            'message' => 'Leave existes before',
        ], 403);
        $leaveRequest=$request->user()->leave_requests()->save($leaveRequest);

        $NotificationManager=new NotificationManager();

        $NotificationManager->build($leaveRequest->id,"pending",$request);
        $NotificationManager->commit();

        $data["msg"]="sucess";
        return   $data;

    }
    public function requestAction(Request $request){

        $leave_id=$request->leave_id;
        $status=$request->status;
       $updated= LeaveRequest::where('id',$leave_id)->update(['status'=>$status]);
       if(!$updated){
           return response()->json([
               'status' => 'failed',
               'data' =>"",

           ],400);
       }
        $NotificationManager=new NotificationManager();

        $NotificationManager->build($leave_id,$status,$request);
        $NotificationManager->commit();
        return response()->json([
            'status' => 'success',
            'data' =>"",

             ],200);
    }
}
