<?php

namespace App\Http\Controllers;

use App\Models\employeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    public function showReport()
    {
        $a_date = Carbon::now();
        $employees = DB::table('employes')
            ->select('*')
            ->whereBetween('created_on', [$a_date->startOfMonth()->toDateTimeString(), $a_date->endOfMonth()->toDateTimeString()])
            ->orderBy('id', 'DESC')
            ->get();
        $users = DB::table('employes')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();

        $act = [];
        $inact = [];
        foreach ($employees as $employee) {
            if ($employee->is_deleted == 'Y') {
                $act[] = $employee->is_deleted;
            } else {
                $inact[] = $employee->is_deleted;
            }
        }

        return view('layouts/reports/employees-report')->with(compact('employees', 'users'));
    }

    public function rateEmployee()
    {
        $users = employeeModel::select('id', 'joining_date')
            ->whereYear('joining_date', Carbon::now()->year)
            ->get()
            ->groupBy(function ($date) {
                // return Carbon::parse($date->created_at)->format('Y');
                return Carbon::parse($date->joining_date)->format('m');
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int) $key] = count($value);
        }

        for ($i = 1; $i <= 12; ++$i) {
            if (!empty($usermcount[$i])) {
                $userArr[$i] = $usermcount[$i];
            } else {
                $userArr[$i] = 0;
            }
        }

        return $userArr;
    }

    public function raterange(Request $req)
    {
        if ($req->start_date != '' && $req->end_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } elseif ($req->start_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->start_date)
                ->endOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
        } elseif ($req->end_date != '') {
            $from = Carbon::parse($req->end_date)
                ->startOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } else {
            $from = '';
            $to = '';
        }

        $userid = $req->userid;



        if (empty($userid)) {
            $employes = DB::table('employes')
                ->select('*')
                ->whereBetween('joining_date', [$from, $to])

                ->orderBy('id', 'DESC')
                ->get();
            $employees = DB::table('employes')
                ->select('*')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $employes = DB::table('employes')
                ->select('*')
                ->where('id', $userid)
                ->orWhereBetween('joining_date', [$from, $to])

                ->orderBy('id', 'DESC')
                ->get();

            $employees = DB::table('employes')
                ->select('*')
                ->orderBy('id', 'DESC')
                ->get();
        }

        if (!empty($from)) {
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
        }
        $userdata = [
            'from' => $from,
            'to' => $to,
            'userid' => $userid,
        ];
        $act = [];
        $inact = [];
        foreach ($employees as $employee) {
            if ($employee->is_deleted == 'Y') {
                $act[] = $employee->is_deleted;
            } else {
                $inact[] = $employee->is_deleted;
            }
        }

        $mydata = [
            'total' => count($employees),
            'active' => count($act),
            'inactive' => count($inact),
        ];

        return view('layouts/reports/employees-report', ['employees' => $employes, 'mydata' => $mydata, 'users' => $employees, 'userdata' => $userdata]);
    }

    public function showUsersReport()
    {
        $a_date = Carbon::now();

        $users = DB::table('users as u')
            ->select('u.id', 'u.name as uname', 'u.email', 'u.created_at', 'r.name as rname')
            ->join('roles as r', 'u.role_id', '=', 'r.id')
            ->whereBetween('u.created_at', [date('Y-m-01'), $a_date->endOfDay()])
            ->orderBy('u.id', 'DESC')
            ->get();


        $users_sum['employee'] = 0;
        $users_sum['supervisor'] = 0;
        $users_sum['administrator'] = 0;

        return view('layouts/reports/users-report')->with(compact('users', 'users_sum'));
    }

    public function showUsersRange(REQUEST $req)
    {
        if ($req->start_date != '' && $req->end_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } elseif ($req->start_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->start_date)
                ->endOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
        } elseif ($req->end_date != '') {
            $from = Carbon::parse($req->end_date)
                ->startOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } else {
            $from = '';
            
            $to = '';
            
        }

        $users = DB::table('users as u')
            ->select('u.id', 'u.name as uname', 'u.email', 'u.created_at', 'r.name as rname', 'u.role_id', 'r.name')
            ->join('roles as r', 'u.role_id', '=', 'r.id')
            ->whereBetween('u.created_at', [$from, $to])
            ->whereNot('u.role_id', 1)
            ->orderBy('u.id', 'DESC')
            ->get();

        $users_role_based = DB::table('users as u')
            ->select('u.role_id', 'r.name')
            ->join('roles as r', 'u.role_id', '=', 'r.id')
            ->whereBetween('u.created_at', [$from, $to])
            ->whereNot('u.role_id', 1)
            ->groupBy('u.role_id')
            ->get();

        $users_key = [];

        foreach ($users_role_based as $key => $value) {
            $role_count = DB::table('users')->where('role_id', $value->role_id)->whereBetween('created_at', [$from, $to])->count();
            $users_key += [$value->name => $role_count];
        }

        $dates = [
            'to' => $to,
            'from' => $from,
        ];
        // if($users)
        // $users = array();
        return view('layouts/reports/users-report')->with(compact('users', 'dates', 'users_key'));
    }



    public function showSalaryReport(REQUEST $req)
    {
        $a_date = Carbon::now();
        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/reports/salary-report')->with(compact('users', 'breakupTypes'));
    }

    public function showPayrollReport(REQUEST $req)
    {
        $a_date = Carbon::now();

        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/reports/payroll-report')->with(compact('users'));
    }

    public function showPayrollRange(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('report-payroll')
                ->withErrors($validator)
                ->withInput();
        } else {
            $date = $req->year . '-' . $req->month;
            $users = DB::table('employes')
                ->select('*')

                ->where('is_deleted', 'N')
                ->orderBy('id', 'DESC')
                ->get();
            $userid = $req->userid;

            if ($req->userid) {
                if ($req->year) {
                    $payrolls = DB::table('employee_payroll as p')
                        ->select('p.*', 'e.full_name', 'e.designation')
                        ->join('employes as e', 'p.employee_id', '=', 'e.id')
                        ->where('p.date', $date)
                        ->where('p.employee_id', $req->userid)
                        ->where('e.status', '!=', 'fired')
                        ->where('e.status', '!=', 'resign')
                        ->where('p.is_deleted', 'N')
                        ->orderBy('p.id', 'DESC')
                        ->get();
                } else {
                    $payrolls = DB::table('employee_payroll as p')
                        ->select('p.*', 'e.full_name', 'e.designation')
                        ->join('employes as e', 'p.employee_id', '=', 'e.id')
                        ->where('p.employee_id', $req->userid)
                        ->where('e.status', '!=', 'fired')
                        ->where('e.status', '!=', 'resign')
                        ->where('p.is_deleted', 'N')
                        ->orderBy('p.id', 'DESC')
                        ->get();
                }
            } else {
                $payrolls = DB::table('employee_payroll as p')
                    ->select('p.*', 'e.full_name', 'e.designation')
                    ->join('employes as e', 'p.employee_id', '=', 'e.id')
                    ->where('p.date', $date)
                    ->where('p.is_deleted', 'N')
                    ->where('e.status', '!=', 'fired')
                    ->where('e.status', '!=', 'resign')
                    ->orderBy('p.id', 'DESC')
                    ->get();
            }

            $dates = [
                'empid' => $userid,
                'month' => $req->month,
                'year' => $req->year,
            ];
        }

        return view('layouts/reports/payroll-report')->with(compact('payrolls', 'users', 'dates'));
    }

    public function showSalaryRange(REQUEST $req)
    {

        $payrolls = DB::table('employee_salary as p')
            ->select('p.*', 'e.full_name', 'e.designation', 'e.status', 'e.BreakUpTypeId')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.is_deleted', 'N')
            ->orderBy('p.id', 'DESC')
            ->get();
        if ($req->userid) {
            $payrolls = $payrolls->where('employee_id', $req->userid);
        }
        if ($req->status) {
            $payrolls = $payrolls->where('status', $req->status);
        }
        if ($req->breakupType) {
            $payrolls = $payrolls->where('BreakUpTypeId', $req->breakupType);
        }

        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        $userid = $req->userid;

        $dates = [
            'empid' => $userid,
            'status' => $req->status,
            'type' => $req->breakupType,
        ];

        return view('layouts/reports/salary-report')->with(compact('payrolls', 'users', 'dates', 'breakupTypes'));
    }

    public function showLeaveReport()
    {
        $a_date = Carbon::now();
        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();
        $leaves = null;
        $leavesd = DB::table('leaves as l')
            ->select('l.*', 'e.full_name', 't.type_name')
            ->join('employes as e', 'l.employee_id', '=', 'e.id')
            ->join('leaves_type as t', 't.id', '=', 'l.type_id')
            ->whereBetween('l.created_on', [$a_date->startOfMonth()->toDateTimeString(), $a_date->endOfMonth()->toDateTimeString()])
            ->where('l.is_deleted', 'N')
            ->orderBy('l.id', 'DESC')
            ->get();

        foreach ($leavesd as $leave) {
            $date1 = Carbon::parse($leave->start_date);

            $date2 = Carbon::parse($leave->end_date)->addDay();

            $diff = $date1->diffInDays($date2);
            $leaves[] = [
                'name' => $leave->full_name,
                'start_date' => $leave->start_date,
                'end_date' => $leave->end_date,
                'is_paid' => $leave->ispaid,
                'reason' => $leave->type_name,
                'no_of_days' => $diff,
                'assign_by' => $leave->created_by,
                'assign_date' => $leave->created_on,
            ];
        }

        // if($users)
        // $users = array();
        return view('layouts/reports/leave-report')->with(compact('users', 'leaves'));
    }

    public function showLeaveRange(REQUEST $req)
    {
        if ($req->start_date == '' && $req->end_date == '' && $req->userid == '') {
            return redirect('report-payroll');
        }
        if ($req->start_date != '' && $req->end_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00
            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } elseif ($req->start_date != '') {
            $from = Carbon::parse($req->start_date)
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00
            $to = Carbon::parse($req->start_date)
                ->endOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
        } elseif ($req->end_date != '') {
            $from = Carbon::parse($req->end_date)
                ->startOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

            $to = Carbon::parse($req->end_date)
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
        } else {
            $from = '';
            $to = '';
        }
        $leaves = null;
        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();
        $userid = $req->userid;
        if ($req->userid) {
            if ($from) {
                $leavesd = DB::table('leaves as l')
                    ->select('l.*', 'e.full_name', 't.type_name')
                    ->join('employes as e', 'l.employee_id', '=', 'e.id')
                    ->join('leaves_type as t', 't.id', '=', 'l.type_id')
                    ->whereBetween('l.created_on', [$from, $to])
                    ->where('l.employee_id', $req->userid)
                    ->where('l.is_deleted', 'N')
                    ->orderBy('l.id', 'DESC')
                    ->get();
            } else {
                $leavesd = DB::table('leaves as l')
                    ->select('l.*', 'e.full_name', 't.type_name')
                    ->join('employes as e', 'l.employee_id', '=', 'e.id')
                    ->join('leaves_type as t', 't.id', '=', 'l.type_id')

                    ->where('l.employee_id', $req->userid)
                    ->where('l.is_deleted', 'N')
                    ->orderBy('l.id', 'DESC')
                    ->get();
            }
        } else {
            $leavesd = DB::table('leaves as l')
                ->select('l.*', 'e.full_name', 't.type_name')
                ->join('employes as e', 'l.employee_id', '=', 'e.id')
                ->join('leaves_type as t', 't.id', '=', 'l.type_id')
                ->whereBetween('l.created_on', [$from, $to])
                ->where('l.is_deleted', 'N')
                ->orderBy('l.id', 'DESC')
                ->get();
        }

        $dates = [
            'empid' => $userid,
            'to' => $to,
            'from' => $from,
        ];
        $a_date = Carbon::now();
        $users = DB::table('employes')
            ->select('*')

            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($leavesd as $leave) {
            $date1 = Carbon::parse($leave->start_date);

            $date2 = Carbon::parse($leave->end_date)->addDay();

            $diff = $date1->diffInDays($date2);
            $leaves[] = [
                'name' => $leave->full_name,
                'start_date' => $leave->start_date,
                'end_date' => $leave->end_date,
                'is_paid' => $leave->ispaid,
                'reason' => $leave->type_name,
                'no_of_days' => $diff,
                'assign_by' => $leave->created_by,
                'assign_date' => $leave->created_on,
            ];
        }


        return view('layouts/reports/leave-report')->with(compact('users', 'leaves', 'dates'));
    }

    public function showAttendance()
    {
        $users = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/reports/attendance-report')->with(compact('users'));
    }

    public function showAttendanceRange(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('report-attendance')
                ->withErrors($validator)
                ->withInput();
        } else {
            $users = DB::table('employes')
                ->select('*')
                ->where('status', '!=', 'fired')
                ->where('status', '!=', 'resign')
                ->where('is_deleted', 'N')
                ->orderBy('id', 'DESC')
                ->get();
            if ($req->userid) {
                $usersz = DB::table('employes')
                    ->select('*')
                    ->where('id', $req->userid)
                    ->where('status', '!=', 'fired')
                    ->where('status', '!=', 'resign')
                    ->where('is_deleted', 'N')
                    ->orderBy('id', 'DESC')
                    ->get();
            } else {
                $usersz = DB::table('employes')
                    ->select('*')
                    ->where('status', '!=', 'fired')
                    ->where('status', '!=', 'resign')
                    ->where('is_deleted', 'N')
                    ->orderBy('id', 'DESC')
                    ->get();
            }
            $date = $req->year . '-' . $req->month;

            $dates = [];

            foreach ($usersz as $u) {
                $employee_attendance = DB::table('attendance')
                    ->where('employee_id', $u->id)
                    ->where('attendance_type', 'Clock In')
                    ->whereYear('attendance_date', '=', $req->year)
                    ->whereMonth('attendance_date', '=', $req->month)
                    ->orderBy('attendance_date', 'ASC')
                    ->pluck('attendance_date')
                    ->toArray();
                $employee_leaves = DB::table('leaves')
                    ->where('employee_id', $u->id)

                    ->where('is_deleted', 'N')
                    ->get()
                    ->toArray();
                //    dd($employee_attendance);
                $a_date = Carbon::parse($date);

                $from = $a_date->copy()->startOfMonth();

                $to = $a_date->copy()->endOfMonth();
                $monthdays = [];
                $offdays = [];
                $workingdays = [];
                $count_attendance[$u->id] = [];
                for ($d = $from; $d->lte($to); $d->addDay()) {
                    $ecc = $d->format('Y-m-d');
                    $monthdays[] = $d->format('Y-m-d');
                    if (!$d->isSunday()) {
                        $workingdays[] = $d->format('Y-m-d');
                        $dates[$u->id][] = $d->format('Y-m-d');

                        if (!empty($employee_attendance)) {
                            if (in_array($ecc, $employee_attendance)) {
                                $count_attendance[$u->id][] = $d->format('Y-m-d');

                                // $key = array_search($ebc, $dates[$e->employee_id]);
                                $key = array_search($ecc, $dates[$u->id]);

                                unset($dates[$u->id][$key]);
                            }
                        }
                        $dates[$u->id] = array_values($dates[$u->id]);
                        $count_absent[$u->id] = count($dates[$u->id]);
                    } else {
                        $offdays[] = $d->format('Y-m-d');
                    }
                }

                $leaves_count[$u->id] = [];
                if (!empty($employee_leaves)) {
                    foreach ($employee_leaves as $leave) {
                        $fro = Carbon::parse($leave->start_date);
                        $t = Carbon::parse($leave->end_date);
                        for ($d = $fro; $d->lte($t); $d->addDay()) {
                            $ebc = $d->format('Y-m-d');

                            if (in_array($ebc, $dates[$u->id])) {
                                // $key = array_search($ebc, $dates[$e->employee_id]);
                                $key = array_search($ebc, $dates[$u->id]);
                                $leaves_count[$u->id][] = $d->format('Y-m-d');
                                unset($dates[$u->id][$key]);
                            }

                            $dates[$u->id] = array_values($dates[$u->id]);
                            $count_absent[$u->id] = count($dates[$u->id]);
                        }
                    }
                }

                $finaldata[$u->id] = [
                    'name' => $u->full_name,
                    'designation' => $u->designation,
                    'present' => count($count_attendance[$u->id]),
                    'leave' => count($leaves_count[$u->id]),
                    'absent' => $count_absent[$u->id],
                    'monthdays' => count($monthdays),
                    'offdays' => count($offdays),
                    'workingdays' => count($workingdays),
                ];
            }
            $datas = [
                'empid' => $req->userid,
                'month' => $req->month,
                'year' => $req->year,
            ];
            $c_date = Carbon::parse($date);

            $monthName = $c_date->format('F');
            $rowspan['month'] = $monthName;
        }

        return view('layouts/reports/attendance-report')->with(compact('users', 'finaldata', 'datas', 'rowspan'));
    }

    public function showMonthlyAttendance()
    {
        $users = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/reports/monthly-attendance-report')->with(compact('users'));
    }

    public function showMonthlyAttendanceRange(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'month' => 'required',

            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('report-monthly-attendance')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (isset($req->status)) {
                if ($req->status == 'active') {
                    $users = DB::table('employes')
                        ->select('*')
                        ->where('status', 'active')
                        ->where('is_deleted', 'N')
                        ->orderBy('id', 'DESC')
                        ->get();
                } else {
                    $users = DB::table('employes')
                        ->select('*')
                        ->where('status', 'inactive')
                        ->where('is_deleted', 'N')
                        ->orderBy('id', 'DESC')
                        ->get();
                }
            } else {
                $users = DB::table('employes')
                    ->select('*')
                    ->where('status', '!=', 'fired')
                    ->where('status', '!=', 'resign')
                    ->where('is_deleted', 'N')
                    ->orderBy('id', 'DESC')
                    ->get();
            }
            $date = $req->year . '-' . $req->month;

            $dates = [];
            $a_date = Carbon::parse($date);

            $from = $a_date->copy()->startOfMonth();

            $to = $a_date->copy()->endOfMonth();
            for ($d = $from; $d->lte($to); $d->addDay()) {
                $ecc['date'][$d->format('d')] = $d->format('d');
                $ecc['datecheck'][$d->format('d')] = $d->format('Y-m-d');
                $ecc['day'][$d->format('d')] = $d->format('l');
            }
            foreach ($users as $u) {
                $ecc['details'][$u->id] = [
                    'name' => $u->full_name,
                    'designation' => $u->designation,
                    'joining_date' => $u->joining_date,
                ];
                $employee_attendance = DB::table('attendance')

                    ->where('employee_id', $u->id)
                    ->where('attendance_type', 'Clock In')
                    ->whereYear('attendance_date', '=', $req->year)
                    ->whereMonth('attendance_date', '=', $req->month)
                    ->orderBy('attendance_date', 'ASC')
                    ->pluck('attendance_date')
                    ->toArray();
                $employee_leaves = DB::table('leaves')
                    ->where('employee_id', $u->id)

                    ->where('is_deleted', 'N')
                    ->get()
                    ->toArray();

                $from = $a_date->copy()->startOfMonth();

                $to = $a_date->copy()->endOfMonth();
                for ($d = $from; $d->lte($to); $d->addDay()) {
                    $checkcc = $d->format('Y-m-d');
                    $key = array_search($d->format('d'), $ecc['date']);
                    $ecc['emp'][$u->id][$d->format('d')] = 'A';
                    if ($d->isSunday()) {
                        $ecc['emp'][$u->id][$d->format('d')] = ' ';
                    }
                    if (!empty($employee_attendance)) {
                        if (in_array($checkcc, $employee_attendance)) {
                            $key = array_search($d->format('d'), $ecc['date']);
                            $ecc['emp'][$u->id][$d->format('d')] = 'P';
                        }
                    }
                }
                if (!empty($employee_leaves)) {
                    foreach ($employee_leaves as $leave) {
                        $fro = Carbon::parse($leave->start_date);
                        $t = Carbon::parse($leave->end_date);
                        for ($d = $fro; $d->lte($t); $d->addDay()) {
                            $ebc = $d->format('d');
                            $enc = $d->format('Y-m-d');

                            if (in_array($enc, $ecc['datecheck'])) {
                                // $key = array_search($ebc, $dates[$e->employee_id]);
                                $key = array_search($ebc, $ecc['date']);
                                if ($ecc['emp'][$u->id][$d->format('d')] != ' ') {
                                    $ecc['emp'][$u->id][$d->format('d')] = 'L';
                                }
                            }
                        }
                    }
                }
            }
            $c_date = Carbon::parse($date);

            $monthName = $c_date->format('F');
            $datas = [
                'status' => $req->status,
                'month' => $req->month,
                'year' => $req->year,
                'monthname' => $monthName,
            ];

            return view('layouts/reports/monthly-attendance-report')->with(compact('users', 'ecc', 'datas'));
        }
    }

    public function showTimesheetReport()
    {
        $users = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/reports/timesheet-report')->with(compact('users'));
    }

    public function showTimesheetRange(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('report-timesheet')
                ->withErrors($validator)
                ->withInput();
        } else {
            $users = DB::table('employes')
                ->select('*')
                ->where('status', '!=', 'fired')
                ->where('status', '!=', 'resign')
                ->where('is_deleted', 'N')
                ->orderBy('id', 'DESC')
                ->get();
            $attendances = DB::table('attendance as l')
                ->select('l.*', 'e.full_name')
                ->join('employes as e', 'l.employee_id', '=', 'e.id')
                ->where('e.status', '!=', 'fired')
                ->where('e.status', '!=', 'resign')
                ->where('e.is_deleted', 'N')
                ->orderBy('l.attendance_type', 'asc')
                // ->where('attendance_type', 'Clock In')
                ->get();

            if ($req->start_date != '' && $req->end_date != '') {
                $from = Carbon::parse($req->start_date)
                    ->startOfDay()        // 2018-09-29 00:00:00.000000
                    ->toDateTimeString(); // 2018-09-29 00:00:00

                $to = Carbon::parse($req->end_date)
                    ->endOfDay()          // 2018-09-29 23:59:59.000000
                    ->toDateTimeString();
            } elseif ($req->start_date != '') {
                $from = Carbon::parse($req->start_date)
                    ->startOfDay()        // 2018-09-29 00:00:00.000000
                    ->toDateTimeString(); // 2018-09-29 00:00:00

                $to = Carbon::parse($req->start_date)
                    ->endOfDay()        // 2018-09-29 00:00:00.000000
                    ->toDateTimeString();
            } elseif ($req->end_date != '') {
                $from = Carbon::parse($req->end_date)
                    ->startOfDay()          // 2018-09-29 23:59:59.000000
                    ->toDateTimeString(); // 2018-09-29 00:00:00

                $to = Carbon::parse($req->end_date)
                    ->endOfDay()          // 2018-09-29 23:59:59.000000
                    ->toDateTimeString();
            } else {
                $from = '';
                $to = '';
            }
            $fro = Carbon::parse($from);
            $fro->subDays(1);
            $userid = $req->userid;
            if ($req->userid) {
                if ($from) {
                    $attendances = $attendances->where('employee_id', $req->userid)
                        ->whereBetween('attendance_date', [$fro, $to]);
                } else {
                    $attendances = $attendances->where('employee_id', $req->userid);
                }
            } else {
                $attendances = $attendances->whereBetween('attendance_date', [$fro, $to]);
            }
            $data = [];
            foreach ($attendances as $a) {
                $empid = $a->employee_id;

                if ($a->attendance_type == 'Clock In') {
                    $startTime = Carbon::parse($a->attendance_time);

                    $data[$a->attendance_date . $empid]['name'] = $a->full_name;
                    $data[$a->attendance_date . $empid]['date'] = $a->attendance_date;
                    $data[$a->attendance_date . $empid]['clock_in'] = $a->attendance_time;
                    $data[$a->attendance_date . $empid]['time'] = 0.0;
                    $data[$a->attendance_date . $empid]['clock_out'] = '';
                }
                if ($a->attendance_type == 'Clock Out') {
                    if (isset($data[$a->attendance_date . $empid]['clock_in'])) {
                        $finishTime = Carbon::parse($a->attendance_time);
                        $time = $finishTime->diff($startTime)->format('%H:%I');

                        $data[$a->attendance_date . $empid]['clock_out'] = $a->attendance_time;
                        $data[$a->attendance_date . $empid]['time'] = $time;
                    }
                }
            }
        }

        $from = Carbon::parse($from)->format('Y-m-d');
        $to = Carbon::parse($to)->format('Y-m-d');
        $dates = [
            'empid' => $userid,
            'from' => $from,
            'to' => $to,
        ];

        return view('layouts/reports/timesheet-report')->with(compact('users', 'data', 'dates'));
    }
}
