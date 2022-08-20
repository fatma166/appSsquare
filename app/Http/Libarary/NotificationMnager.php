<?php
namespace App\Library;

use App\Models\Notification;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class NotificationManager
{
    private $notification;

    public function build($data_id,$type, $request)
    {
        $user = Auth::guard('api')->user();
        $manger=$user->parent_manger;
        $manger_details=User::find($manger);
        $hr=$manger->parent_manger;
        $notification_content = $this->format_notification($type, $user);
        $notification = new notification();
        $notification->title = $notification_content["title"];
        $notification->message = $notification_content["message"];
        $notification->type = $type;
        $notification->from = $user->id;
        $notification->to = $manger;
       // $notification->data_id=$data_id;
        $this->notification = $notification;
        if($type==accepted){
            $notification->from = $manger;
            $notification->to = $hr;
            $this->notification = $notification;
        }

    }

    public function commit()
    {
        if (!$this->notification) {
            throw new \Exception("Build Notification First");
        }
        $this->notification->save();
    }

    public function getNotification()
    {

        return $this->notification ?? 0;

    }

    private function format_notification($type, $user)
    {
        $data=array();
        switch ($type) {
            case "make_leave":
                $data["title"] = "طلب اذن";
                $data["message"] = "الموظف " . $user->name . " طالب اذن مغادرة";
                break;
            case "refused":
                $data["title"] = "تم رفض الاذن";
                $data["message"] = "الموظف " . $user->name . "تم رفض الاذن";
                break;
            case "accepted":
                $data["title"] = "تم الموافقه";
                $data["message"] = "الموظف " . $user->name . "تم الموافقه";
                break;

        }
        return $data;
    }

}
