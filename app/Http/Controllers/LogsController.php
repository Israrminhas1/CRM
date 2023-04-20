<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Models\logsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LogsController extends Controller
{

    public function insertlog($desc)
    {

        $logmodel = new logsModel;
        $logmodel->user_id = auth()->user()->id;
        $logmodel->description = $desc;
        $logmodel->save();
        return true;
    }
    public function logsList()
    {

        $logs = DB::table('activity_log as i')
            ->select('*')
            ->join('users as p', 'i.user_id', '=', 'p.id')
            ->orderBy('i.id', 'DESC')
            ->get();
        $users = DB::table('users')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        return view('profile/logs', array('logs' => $logs, 'users' => $users));
    }
    public function logsrange(Request $req)
    {



        if ($req->start_date != "" && $req->end_date != "") {
            $from    = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to      = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } else if ($req->start_date != "") {
            $from    = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to      = Carbon::parse($req->start_date)
                ->endOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
        } else if ($req->end_date != "") {
            $from  = Carbon::parse($req->end_date)
                ->startOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to  = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } else {
            $from = "";
            $to = "";
        }


        $userid = $req->userid;




        $users = DB::table('users')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        $logs = DB::table('activity_log as i')
            ->select('*')
            ->join('users as p', 'i.user_id', '=', 'p.id')
            ->orWhereBetween('i.activity_date', [$from, $to])
            ->orWhere('p.id', $userid)
            ->orderBy('i.id', 'DESC')
            ->get();

        if (!empty($from)) {
            $from = date("Y-m-d", strtotime($from));
            $to = date("Y-m-d", strtotime($to));
        }
        $userdata = [
            'from' => $from,
            'to' => $to,
            'userid' => $userid
        ];
        return view('profile/logs', array('logs' => $logs, 'users' => $users, 'userdata' => $userdata));
    }
}
