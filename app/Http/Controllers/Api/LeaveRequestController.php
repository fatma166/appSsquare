<?php

namespace App\Http\Controllers\Api;
use App\Library\NotificationManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    //
    public function Index(Request $request,$id=null){



        if($id){
            return   $request->user()->leave_requests()->find($id);
        }

        return $request->user()->leave_requests()->orderBy('created_at','desc')->get();
    }



    public function checkExistRequestBefore($request,$from,$to){

        return($request->user()->leave_requests()->where('leave_from','>=',$from)->where('leave_to','<=',$to)->get()->toArray());

    }

    public function Request(\App\Http\Requests\Api\LeaveRequest $request){


        $validated=$request->validated();


        $requested_leave_time=date_diff(date_create(),date_create($validated['leave_to']));
        $requested_leave_days=$requested_leave_time->d+1;//$requested_leave_time->d==0?
        $requested_leave_hours=$requested_leave_time->h;

        $leaveRequest=new \App\Models\LeaveRequest();
        $leaveRequest->user_id= $request->user()->id;
        $leaveRequest->leave_from=$validated['leave_from'];
        $leaveRequest->leave_to=$validated['leave_to'];
        $leaveRequest->days=$requested_leave_days;
        $leaveRequest->num_hours=$requested_leave_hours;

        $check_exist=$this->checkExistRequestBefore($request,$leaveRequest->leave_from,$leaveRequest->leave_to);

        if(!empty($check_exist))return response()->json(['msg' => "LEAVE_REQUEST_EXIST_BEFORE"], 422);
        $leaveRequest=$request->user()->leave_requests()->save($leaveRequest);

        $NotificationManager=new NotificationManager();
        $NotificationManager->build($leaveRequest->id,"make_leave",$request);
        $NotificationManager->commit();

        $data["msg"]="sucess";
        return   $data;

    }
}
