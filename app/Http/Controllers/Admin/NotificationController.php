<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeviceTokens;
use App\Models\NotificationDetials;
use App\Models\Notifications;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notifications::latest()->paginate();
        $users = User::where('role_id', 4)->get();
        return view('admin.notifications.index', compact('notifications', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'message_ar' => 'required|string',
            'message_en' => 'required|string',
        ]);

        $notification = Notifications::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'message_ar' => $request->message_ar,
            'message_en' => $request->message_en,
            'all' => ($request->choose) ? 1 : 0,
            'user_id' => (!$request->choose) ? $request->employee_id : ""
        ]);
        if ($request->choose) {
            $users = User::where('role_id', 4)->get();
            foreach ($users as $user) {
                NotificationDetials::create([
                    'notification_id' => $notification->id,
                    'user_id' => $user->id
                ]);
                if ($request->phone_message) {
                    $this->_sendMessage($request->title_ar, $request->message_ar, $user->device);
                }
                if ($request->sms_message) {
                    $this->_sendMessage($request->title_ar, $request->message_ar, $user->device);
                }
            }
        } else {
            $user = user::where('id', $request->employee_id)->first();
            if ($user) {
                NotificationDetials::create([
                    'notification_id' => $notification->id,
                    'user_id' => $user->id
                ]);
                if ($request->phone_message) {
                    $this->_sendMessage($request->title_ar, $request->message_ar, $user->device);
                }
                if ($request->sms_message) {
                    $this->_sendMessage($request->title_ar, $request->message_ar, $user->device);
                }
            }
        }
        return back()->with('message', );
    }

    public static function _sendMessage($subjecet, $message, $device)
    {
        $SERVER_API_KEY = Setting::first()->firebase;
        $data = [
            "registration_ids" => $device,
            "notification" => [
                "title" => $subjecet,
                "body" => $message,
            ]
        ];

        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
    }
}
