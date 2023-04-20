<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Models\NotificationsModel;
use Illuminate\Support\Facades\Auth;

class UserNotifications extends Controller
{
    public function viewNotifications()
    {
        return view('layouts/employes/view_notifications');
    }
    public function toSend($user, $dataInfo)
    {

        Notification::send($user, new Notifications($dataInfo));
        return True;
    }
    public function markRead()
    {
        Auth::user()->unReadNotifications->markAsRead();
        return redirect()->back();
    }
    public function markUnRead()
    {
        Auth::user()->readNotifications->markAsUnRead();
        return redirect()->back();
    }
    public function markReadSingle($id)
    {
        Auth::user()->unReadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }
    public function markUnReadSingle($id)
    {
        Auth::user()->readNotifications->where('id', $id)->markAsUnRead();
        return redirect()->back();
    }
    public function tookaction($id)
    {
        $employeemodel = NotificationsModel::find($id);
        $employeemodel->took_action = Date('Y-m-d H:i:sa');
        $employeemodel->save();
        return redirect()->back();
    }
}
