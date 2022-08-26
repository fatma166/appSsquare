<?php
namespace App\Libarary;

use App\Models\Notification;
use App\Models\User;
use App\Models\Role;
use App\Notifications\LeaveNotification;
use Illuminate\Support\Facades\Auth;

class NotificationManager
{
    protected $notification;
    protected $notification1;



    public function build($data_id,$type,$request)
    {

        $user = Auth::guard('api')->user();

        $manger=$user->manger_Parent;

        $manger_details=User::find($manger);
        $hr=$manger_details->manger_Parent;
        $notification_content = $this->format_notification($type, $user);
       // $notification = new Notification;
        $notification= new \stdClass();
        $notification->title = $notification_content["title"];
        $notification->message = $notification_content["message"];
        $notification->type = $type;
        $notification->from = $user->id;
        $notification->to = $manger;
        $notification->data_id=$data_id;
        $this->notification = $notification;

        if($type=="accept"){
            $notification1= new \stdClass();
            $notification1->from = $manger;
            $notification1->to = $hr;
            $this->notification1=$notification1;

        }

    }

    public function commit()
    {
        if (!$this->notification) {
            throw new \Exception("Build Notification First");
        }
        $nof=Notification::create( json_decode(json_encode($this->notification), true));
       //$nof= $this->notification->save();
       $from_user_notfy=auth::user()->find($this->notification->from) ;
        $notfy_setting = [
            'title' => $this->notification->title,
            'body' => 'You received an leave request.',
            'thanks' => 'Thank you',
            'leaveText' => 'leave request from employee '.$from_user_notfy->name,
            'leaveUrl' => route('leave-index',$this->notification->data_id),
            'leave_id' => $this->notification->data_id
        ];


        Auth::guard('api')->user()->notify(new LeaveNotification($notfy_setting));

        if($nof&&!empty($this->notification1)){


          $this->notification->from=$this->notification1->from;
          $this->notification->to=$this->notification1->to;
          //$this->notification->save();
            Notification::create( json_decode(json_encode($this->notification), true));
        }


    }

    public function getNotification()
    {

        return $this->notification ?? 0;

    }

    private function format_notification($type, $user)
    {
        $data=array();
        switch ($type) {
            case "pending":
                $data["title"] = "طلب اذن";
                $data["message"] = "الموظف " . $user->name . " طالب اذن مغادرة";
                break;
            case "refuse":
                $data["title"] = "تم رفض الاذن";
                $data["message"] = "الموظف " . $user->name . "تم رفض الاذن";
                break;
            case "accept":
                $data["title"] = "تم الموافقه";
                $data["message"] = "الموظف " . $user->name . "تم الموافقه";
                break;

        }
        return $data;
    }

}
