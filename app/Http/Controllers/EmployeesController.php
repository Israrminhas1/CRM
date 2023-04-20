<?php

namespace App\Http\Controllers;

use App\Models\AllowanceModel;
use App\Models\AllowanceQueueModel;
use App\Models\attendance;
use App\Models\DeductionModel;
use App\Models\DeductionQueueModel;
use App\Models\employeeDocModel;
use App\Models\employeeModel;
use App\Models\leaveModel;
use App\Models\leaveTypesModel;
use App\Models\PayrollModal;
use App\Models\PayslipDetailsModel;
use App\Models\PayslipModel;
use App\Models\SalaryBreakupModal;
use App\Models\SalaryBreakupTypeModal;
use App\Models\User;
use App\Models\userAuthModel;
use App\Models\userMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function employeesList(Request $req)
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();
        $roles = DB::table('roles')->orderBy('name', 'ASC')->get();

        return view('layouts/employes/listemployees')->with(compact('employees', 'roles'));
    }

    public function addEmployees(Request $req)
    {
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/employes/addemployees')->with(compact('breakupTypes'));
    }

    public function addEmployeeData(Request $req)
    {


        $validator = Validator::make($req->all(), [
            'full_name' => 'required|max:100',
            'father_name' => 'required|max:100',
            'basic_salary' => 'required|max:100',
            'salary' => 'required|max:100',
            'dob' => 'required',
            'gender' => 'required|max:100',
            'current_address' => 'required|max:100',
            'mobile' => 'required|max:20',
            'country' => 'required|max:100',
            'country_contact' => 'required|max:100',
            'country_phone' => 'required|max:20',
            'country_address' => 'required|max:100',
            'designation' => 'required|max:100',
            'join_date' => 'required',
            'visa_title' => 'required|max:100',
            'visa_expiry' => 'required',
            'breakupType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add-employees')
                ->withErrors($validator)
                ->withInput();
        } else {
            $image = $req->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->extension();

                $destinationPathThumbnail = public_path('/uploads/employeeprofile');
                $destinationPath = 'uploads/employeeprofile';
                $img = \Image::make($image->path());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail . '/' . $imageName);
                $filename = $destinationPath . '/' . $imageName;
            } else {
                $filename = 'uploads/employeeprofile/default.png';
            }

            $employeemodel = new employeeModel();
            $employeemodel->full_name = $req->full_name;
            $employeemodel->father_name = $req->father_name;
            $employeemodel->basic_salary = $req->basic_salary;
            $employeemodel->salary = $req->salary;
            $employeemodel->dob = $req->dob;
            $employeemodel->gender = $req->gender;
            $employeemodel->emp_address = $req->current_address;
            $employeemodel->mobile_phone = $req->mobile;
            $employeemodel->country = $req->country;
            $employeemodel->attachment = $filename;
            $employeemodel->contact_name = $req->country_contact;
            $employeemodel->country_phone = $req->country_phone;
            $employeemodel->BreakUpTypeId = $req->breakupType;
            $employeemodel->permanent_address = $req->country_address;
            $employeemodel->designation = $req->designation;
            $employeemodel->visa_title = $req->visa_title;
            $employeemodel->joining_date = $req->join_date;
            $employeemodel->visa_expiry_date = $req->visa_expiry;
            $employeemodel->created_on = date('Y-m-d H:i:s');
            $employeemodel->created_by = auth()->user()->id;
            $employeemodel->save();


            $user = User::where('role_id', '1')->get();


            $dataInfo = collect(['title' => 'New Employee Created', 'body' => $req->full_name]);
            $toSend = new UserNotifications();
            $toSend->toSend($user, $dataInfo);

            // logs
            $logs = new LogsController();
            $logs_desc = 'Employee "' . $req->full_name . '" was Created';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Employee has been added successfully');

            return redirect('list-employees');
        }
    }

    public function editEmployee($id, Request $req)
    {
        $employee = DB::table('employes')->where(['id' => $id, 'is_deleted' => 'N'])->first();


        if (!$employee) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-employees');
        } else {
            $breakupTypes = DB::table('salary_breakup_type')
                ->select('*')
                ->orderBy('id', 'DESC')
                ->get();

            return view('layouts/employes/editEmployee')->with(compact('employee', 'breakupTypes'));
        }
    }

    public function updateEmployee($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'full_name' => 'required|max:100',
            'father_name' => 'required|max:100',
            'basic_salary' => 'required|max:100',
            'salary' => 'required|max:100',
            'dob' => 'required',
            'gender' => 'required|max:100',
            'current_address' => 'required|max:100',
            'mobile' => 'required|max:20',
            'country' => 'required|max:100',
            'country_contact' => 'required|max:100',
            'country_phone' => 'required|max:20',
            'country_address' => 'required|max:100',
            'designation' => 'required|max:100',
            'join_date' => 'required',
            'visa_title' => 'required|max:100',
            'visa_expiry' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/edit-employees/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $employeemodel = employeeModel::find($id);
            $image = $req->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->extension();

                $destinationPathThumbnail = public_path('/uploads/employeeprofile');
                $destinationPath = 'uploads/employeeprofile';
                $img = \Image::make($image->path());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail . '/' . $imageName);
                $filename = $destinationPath . '/' . $imageName;
                $employeemodel->attachment = $filename;
            }

            $employeemodel->full_name = $req->full_name;
            $employeemodel->father_name = $req->father_name;
            $employeemodel->basic_salary = $req->basic_salary;
            $employeemodel->salary = $req->salary;
            $employeemodel->dob = $req->dob;
            $employeemodel->gender = $req->gender;
            $employeemodel->emp_address = $req->current_address;
            $employeemodel->mobile_phone = $req->mobile;
            $employeemodel->country = $req->country;
            $employeemodel->BreakUpTypeId = $req->breakupType;
            $employeemodel->contact_name = $req->country_contact;
            $employeemodel->country_phone = $req->country_phone;
            $employeemodel->permanent_address = $req->country_address;
            $employeemodel->designation = $req->designation;
            $employeemodel->visa_title = $req->visa_title;
            $employeemodel->joining_date = $req->join_date;
            $employeemodel->visa_expiry_date = $req->visa_expiry;
            $employeemodel->modified_on = date('Y-m-d H:i:s');
            $employeemodel->modified_by = auth()->user()->id;
            $employeemodel->save();

            // logs
            $logs = new LogsController();
            $logs_desc = 'Employee "' . $req->full_name . '" was Updated';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Employee has been updated successfully');

            return redirect('list-employees');
        }
    }

    public function deleteEmployee($id, Request $req)
    {
        $employee = DB::table('employes')->where('id', $id)->first();

        if (!$employee) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-employees');
        } else {
            $employeemodel = employeeModel::find($id);
            $employeemodel->is_deleted = 'Y';
            $employeemodel->modified_on = date('Y-m-d H:i:s');
            $employeemodel->modified_by = auth()->user()->id;
            $employeemodel->save();
            // logs
            $logs = new LogsController();
            $logs_desc = 'Employee "' . $employee->full_name . '" was Deleted';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Employee has been deleted successfully');

            return redirect('list-employees');
        }
    }

    public function addEmployeesDoc(Request $req)
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/employes/add_employeesdoc')->with(compact('employees'));
    }

    public function addEmployeesDocData(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'employee' => 'required',
            'document_type' => 'required',
            'doc_expiry' => 'required|max:100',
            'attachments' => 'mimes:jpeg,jpg,png,pdf|required|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect('add-employees-document')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $req->file('attachments');
            if ($file) {
                $fi = request()->file('attachments')->store('/');

                // Move Uploaded Fil
                $destinationPath = 'uploads';

                $file->move($destinationPath, $fi);

                $filename = $destinationPath . '/' . $fi;
            }
            $employeeDocmodel = new employeeDocModel();
            $employeeDocmodel->employee_id = $req->employee;
            $employeeDocmodel->document_type = $req->document_type;
            $employeeDocmodel->expiry_date = $req->doc_expiry;
            $employeeDocmodel->document_file = $filename;
            $employeeDocmodel->save();

            $employee = DB::table('employes')->where('id', $req->employee)->first();
            // logs
            $logs = new LogsController();
            $logs_desc = 'Employee "' . $employee->full_name . '" Document was Created';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Employee Document has been Inserted successfully');

            return redirect('add-employees-document');
        }
    }

    public function viewEmployeesDoc($id, Request $req)
    {
        $employees = DB::table('employee_documents')
            ->select('*')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/employes/view_employeesdoc')->with(compact('employees'));
    }

    public function deleteEmployeeDoc($id, Request $req)
    {
        $employee = DB::table('employee_documents')->where('id', $id)->first();

        if (!$employee) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('/view-employees-document/' . $employee->employee_id);
        } else {
            $employeemodel = employeeDocModel::find($id);
            $employeemodel->is_deleted = 'Y';
            $employeemodel->save();

            $employeed = DB::table('employes')->where('id', $employee->employee_id)->first();
            // logs
            $logs = new LogsController();
            $logs_desc = 'Employee "' . $employeed->full_name . '" Document was Deleted';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Employee has been deleted successfully');

            return redirect('/view-employees-document/' . $employee->employee_id);
        }
    }

    public function leavesType(Request $req)
    {
        $leaves = $projects = DB::table('leaves_type')
            ->select('*')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->get();

        return view('layouts/employes/list-leavesTypes')->with(compact('leaves'));
    }

    public function leavesRecord(Request $req)
    {
        $leaves = $projects = DB::table('leaves as t')
            ->select('t.*', 'p.type_name', 'b.full_name', 't.id as id')
            ->join('leaves_type as p', 't.type_id', '=', 'p.id')
            ->join('employes as b', 't.employee_id', '=', 'b.id')
            ->where('t.is_deleted', 'N')
            ->where('b.status', '!=', 'fired')
            ->where('b.status', '!=', 'resign')
            ->orderBy('t.id', 'DESC')
            ->get();

        return view('layouts/employes/list-leavesRecords')->with(compact('leaves'));
    }

    public function addLeaves(Request $req)
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();
        $types = DB::table('leaves_type')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/addleaves')->with(compact('employees', 'types'));
    }

    public function addLeavesData(Request $req)
    {


        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
            'type_id' => 'required',

            'start' => 'required',
            'end' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add-leaves')
                ->withErrors($validator)
                ->withInput();
        } else {
            $employeemodel = new leaveModel();

            $employeemodel->employee_id = $req->employee_id;
            $employeemodel->type_id = $req->type_id;
            $employeemodel->ispaid = $req->ispaid;

            $employeemodel->start_date = date('Y-m-d', strtotime($req->start));
            $employeemodel->end_date = date('Y-m-d', strtotime($req->end));

            $employeemodel->created_on = date('Y-m-d H:i:s');
            $employeemodel->created_by = auth()->user()->id;
            $employeemodel->save();

            // $uid = $employeemodel->id;

            $employee = DB::table('employes')
                ->select('full_name')
                ->where('id', $req->employee_id)
                ->get()
                ->first();

            $user = User::where('role_id', '1')->get();
            // echo "<pre>";
            // print_r($user);
            // exit();

            $dataInfo = collect(['title' => 'New Leave Created', 'body' => $employee->full_name]);
            $toSend = new UserNotifications();
            $toSend->toSend($user, $dataInfo);

            // logs
            $logs = new LogsController();
            $logs_desc = 'leave for "' . $employee->full_name . '" was Created';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave has been added successfully');

            return redirect('list-leaves-record');
        }
    }

    public function addLeaveTypeModel(Request $req)
    {
        $type = new leaveTypesModel();
        $type->type_name = $req->type_name;

        $type->created_on = date('Y-m-d H:i:s');
        $type->created_by = auth()->user()->id;
        $type->save();

        // logs
        $logs = new LogsController();
        $logs_desc = 'Leave Type "' . $req->type_name . '" was Created';
        $logs->insertlog($logs_desc);

        echo $type->id;
    }

    public function updateLeavetype($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'type_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('edit-leavetype/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $type = leaveTypesModel::find($id);
            $type->type_name = $req->type_name;

            $type->updated_on = date('Y-m-d H:i:s');
            $type->updated_by = auth()->user()->id;
            $type->save();

            // logs
            $logs = new LogsController();
            $logs_desc = 'Leave Type "' . $req->type_name . '" was Updated';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave has been updated successfully');

            return redirect('list-leaves-type');
        }
    }

    public function deleteLeave($id, Request $req)
    {
        $leave = DB::table('leaves')->where('id', $id)->first();
        $employeename = DB::table('employes')->where('id', $leave->employee_id)->first();

        if (!$leave) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-leaves-record');
        } else {
            $leavemodel = leaveModel::find($id);
            $leavemodel->is_deleted = 'Y';
            $leavemodel->updated_on = date('Y-m-d H:i:s');
            $leavemodel->updated_by = auth()->user()->id;
            $leavemodel->save();
            // logs
            $logs = new LogsController();
            $logs_desc = 'leave for "' . $employeename->full_name . '" was Deleted';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave has been deleted successfully');

            return redirect('list-leaves-record');
        }
    }

    public function editLeave($id, Request $req)
    {
        $leaves = DB::table('leaves')
            ->select('*')
            ->where('is_deleted', 'N')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();
        $types = DB::table('leaves_type')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/edit-leaves', ['leaves' => $leaves, 'types' => $types, 'employees' => $employees]);
    }

    public function editLeavetype($id, Request $req)
    {
        $leaves = DB::table('leaves_type')
            ->select('*')
            ->where('is_deleted', 'N')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        return view('layouts/employes/edit-leavestype', ['leaves' => $leaves]);
    }

    public function updateLeave($id, Request $req)
    {
        $employeed = DB::table('employes')->where('id', $req->employee_id)->first();
        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
            'type_id' => 'required',

            'start' => 'required',
            'end' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/edit-leave/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $leavemodel = leaveModel::find($id);
            $leavemodel->employee_id = $req->employee_id;
            $leavemodel->type_id = $req->type_id;
            $leavemodel->ispaid = $req->ispaid;

            $leavemodel->start_date = date('Y-m-d', strtotime($req->start));
            $leavemodel->end_date = date('Y-m-d', strtotime($req->end));

            $leavemodel->updated_on = date('Y-m-d H:i:s');
            $leavemodel->updated_by = auth()->user()->id;
            $leavemodel->save();

            // logs
            $logs = new LogsController();
            $logs_desc = 'leave for"' . $employeed->full_name . '" was Updated';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave has been updated successfully');

            return redirect('list-leaves-record');
        }
    }

    public function addLeavestype(Request $req)
    {
        return view('layouts/employes/addleavestype');
    }

    public function addLeavestypeData(Request $req)
    {
        // echo "hello";
        // print_r('auth()->user()->id');
        // print_r($req->gender);
        // exit();

        $validator = Validator::make($req->all(), [
            'type_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add-leavestype')
                ->withErrors($validator)
                ->withInput();
        } else {
            $leavemodel = new leaveTypesModel();

            $leavemodel->type_name = $req->type_name;

            $leavemodel->created_on = date('Y-m-d H:i:s');
            $leavemodel->created_by = auth()->user()->id;
            $leavemodel->save();

            // $uid = $employeemodel->id;

            // $user = DB::table('users')
            // ->select('*')
            // ->where('role_id','1')
            // ->get();
            $user = User::where('role_id', '1')->get();
            // echo "<pre>";
            // print_r($user);
            // exit();

            $dataInfo = collect(['title' => 'New Leave Type Created', 'body' => $req->type_name]);
            $toSend = new UserNotifications();
            $toSend->toSend($user, $dataInfo);

            // logs
            $logs = new LogsController();
            $logs_desc = 'leave type "' . $req->type_name . '" was Created';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave Type has been added successfully');

            return redirect('list-leaves-type');
        }
    }

    public function deleteLeavetype($id, Request $req)
    {
        $leave = DB::table('leaves_type')->where('id', $id)->first();

        if (!$leave) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-leaves-type');
        } else {
            $leavemodel = leaveTypesModel::find($id);
            $leavemodel->is_deleted = 'Y';
            $leavemodel->updated_on = date('Y-m-d H:i:s');
            $leavemodel->updated_by = auth()->user()->id;
            $leavemodel->save();
            // logs
            $logs = new LogsController();
            $logs_desc = 'leave Type" ' . $leave->type_name . ' " was Deleted';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'Leave Type has been deleted successfully');

            return redirect('list-leaves-type');
        }
    }

    public function assignEmployeeRole($id, Request $req)
    {
        $userauthmodel = new userAuthModel();
        $userauthmodel->name = $req->empname;
        $userauthmodel->email = $req->empemail;
        $userauthmodel->password = Hash::make($req->password);
        $userauthmodel->role_id = $req->role_name;
        $userauthmodel->save();

        $uid = $userauthmodel->id;

        $req->session()->flash('successMsg', 'Role has been assigned successfully');

        $employeemodel = employeeModel::find($id);
        $employeemodel->user_id = $uid;
        $employeemodel->save();

        $menu = DB::select('select * from roles_menus where role_id = :ip', ['ip' => $req->role_name]);
        // $menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
        foreach ($menu as $men) {
            $rolemenumodel = new userMenuModel();
            $rolemenumodel->menu_id = $men->menu_id;
            $rolemenumodel->user_id = $uid;
            $rolemenumodel->r_view = 'Y';
            $rolemenumodel->save();
        }
        // logs
        $logs = new LogsController();
        $logs_desc = 'New User "' . $req->name . '" was Created';
        $logs->insertlog($logs_desc);

        return redirect('list-users');
    }

    public function getUserData()
    {
        $users = DB::table('users')
            ->select('email')
            ->orderBy('id', 'DESC')
            ->pluck('email')
            ->toArray();

        return $users;
    }

    public function attendance()
    {
        $attendances = DB::table('attendance as a')
            ->select('a.*', 'u.name', 'b.full_name as employee_name')
            ->join('users as u', 'u.id', '=', 'a.created_by')
            ->join('employes as b', 'a.employee_id', '=', 'b.id')
            ->where('b.status', '!=', 'fired')
            ->where('b.status', '!=', 'resign')
            ->where('b.is_deleted', 'N')
            ->orderBy('a.id', 'DESC')
            ->get();

        return view('layouts/employes/list-attendance')->with(compact('attendances'));
    }

    public function addAttendance()
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/add-attendance')->with(compact('employees'));
    }

    public function addAttendanceData(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
            'type_id' => 'required',

            'attendance_date' => 'required',

            'attendance_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add-attendance')
                ->withErrors($validator)
                ->withInput();
        } else {
            $attend = DB::table('attendance')
                ->where('employee_id', $req->employee_id)
                ->where('attendance_date', date('Y-m-d', strtotime($req->attendance_date)))

                ->get();
            $attend1 = $attend->where('attendance_type', 'Clock In')
                ->first();
            $attend2 = $attend->where('attendance_type', 'Clock Out')
                ->first();
            $attendancemodel = new attendance();
            if ($req->type_id == 'Clock In') {
                if (!empty($attend1)) {
                    $req->session()->flash('errorMsg', 'attendance already registered');

                    return redirect('list-attendance');
                } else {
                    $attendancemodel->employee_id = $req->employee_id;
                    $attendancemodel->attendance_type = $req->type_id;
                    $attendancemodel->attendance_date = date('Y-m-d', strtotime($req->attendance_date));
                    $attendancemodel->attendance_time = $req->attendance_time;
                    if (isset($req->comment)) {
                        $attendancemodel->comment = $req->comment;
                    }

                    $attendancemodel->created_on = date('Y-m-d H:i:s');
                    $attendancemodel->created_by = auth()->user()->id;
                    $attendancemodel->save();
                    $req->session()->flash('successMsg', 'attendance has been added successfully');

                    return redirect('list-attendance');
                }
            }
            if ($req->type_id == 'Clock Out') {
                if (!empty($attend2)) {
                    $req->session()->flash('errorMsg', 'attendance already registered');

                    return redirect('list-attendance');
                } else {
                    $attendancemodel->employee_id = $req->employee_id;
                    $attendancemodel->attendance_type = $req->type_id;
                    $attendancemodel->attendance_date = date('Y-m-d', strtotime($req->attendance_date));
                    $attendancemodel->attendance_time = $req->attendance_time;
                    if (isset($req->comment)) {
                        $attendancemodel->comment = $req->comment;
                    }

                    $attendancemodel->created_on = date('Y-m-d H:i:s');
                    $attendancemodel->created_by = auth()->user()->id;
                    $attendancemodel->save();
                    $req->session()->flash('successMsg', 'attendance has been added successfully');

                    return redirect('list-attendance');
                }
            }
        }
    }

    public function deleteAttendance($id, Request $req)
    {
        $attendance = DB::table('attendance')->where('id', $id)->first();

        if (!$attendance) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-attendance');
        } else {
            DB::table('attendance')->where('id', $id)->delete();

            $req->session()->flash('successMsg', 'Attendance has been removed successfully');

            return redirect('list-attendance');
        }
    }

    public function editAttendance($id, Request $req)
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();
        $attendance = DB::table('attendance')->where('id', $id)->first();

        // echo "<pre>";
        // print_r($employee);
        // exit();
        if (!$employees) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-attendance');
        } else {
            return view('layouts/employes/edit-attendance')->with(compact('employees', 'attendance'));
        }
    }

    public function updateAttendance($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
            'type_id' => 'required',

            'attendance_date' => 'required',

            'attendance_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('edit-attendance/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $attend = DB::table('attendance')
                ->where('employee_id', $req->employee_id)
                ->where('attendance_date', date('Y-m-d', strtotime($req->attendance_date)))

                ->get();
            $attend1 = $attend->where('attendance_type', 'Clock In')
                ->first();
            $attend2 = $attend->where('attendance_type', 'Clock Out')
                ->first();
            $attendancemodel = attendance::find($id);
            if ($req->type_id == 'Clock In') {
                // if (!empty($attend1)) {
                //     $req->session()->flash('errorMsg', 'Attendance already registered');

                //     return redirect('list-attendance');
                // } else {
                $attendancemodel->employee_id = $req->employee_id;
                $attendancemodel->attendance_type = $req->type_id;
                $attendancemodel->attendance_date = date('Y-m-d', strtotime($req->attendance_date));
                $attendancemodel->attendance_time = $req->attendance_time;
                if (isset($req->comment)) {
                    $attendancemodel->comment = $req->comment;
                }

                $attendancemodel->updated_on = date('Y-m-d H:i:s');
                $attendancemodel->updated_by = auth()->user()->id;
                $attendancemodel->save();
                $req->session()->flash('successMsg', 'Attendance has been updated successfully');

                return redirect('list-attendance');
                // }
            }
            if ($req->type_id == 'Clock Out') {
                // if (!empty($attend2)) {
                //     $req->session()->flash('errorMsg', 'attendance already registered');

                //     return redirect('list-attendance');
                // } else {
                $attendancemodel->employee_id = $req->employee_id;
                $attendancemodel->attendance_type = $req->type_id;
                $attendancemodel->attendance_date = date('Y-m-d', strtotime($req->attendance_date));
                $attendancemodel->attendance_time = $req->attendance_time;
                if (isset($req->comment)) {
                    $attendancemodel->comment = $req->comment;
                }

                $attendancemodel->updated_on = date('Y-m-d H:i:s');
                $attendancemodel->updated_by = auth()->user()->id;
                $attendancemodel->save();
                $req->session()->flash('successMsg', 'attendance has been added successfully');

                return redirect('list-attendance');
                // }
            }
        }
    }

    public function listPayroll()
    {
        $payrolls = DB::table('employee_payroll as p')
            ->select('p.*', 'e.full_name', 'e.designation')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.is_deleted', 'N')
            ->orderBy('p.id', 'DESC')
            ->get();

        return view('layouts/employes/list-payroll')->with(compact('payrolls'));
    }

    public function listSalary()
    {
        $payrolls = DB::table('employee_salary as p')
            ->select('p.*', 'e.full_name', 'e.designation')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.is_deleted', 'N')
            ->get();

        return view('layouts/employes/list-salary')->with(compact('payrolls'));
    }

    public function generatePayslip()
    {
        // if(!in_array($ebc,$leaves)){
        //     $dates[] = $ebc;
        // }

        return view('layouts/employes/generate-payslip');
    }

    public function manualPayslip()
    {
        // if(!in_array($ebc,$leaves)){
        //     $dates[] = $ebc;
        // }
        $payrolls = DB::table('employee_salary as p')
            ->select('e.id', 'e.full_name')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.is_deleted', 'N')
            ->get();

        return view('layouts/employes/manual-payslip')->with(compact('payrolls'));
    }

    public function getGeneratePayslip(REQUEST $req)
    {
     
        $date = $req->year . '-' . $req->month;

        $employee_salary = DB::table('employee_salary as p')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('p.is_deleted', 'N')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->get();
        $data = [];
        foreach ($employee_salary as $e) {
            $payslipid = auth()->user()->id . $e->employee_id . random_int(1000000, 9999999);
            $payrolls = DB::table('employee_payroll')

                ->where('employee_id', $e->employee_id)
                ->where('date', $date)
                ->where('is_deleted', 'N')

                ->first();

            $salaryType = DB::table('employes as e')
                ->select('s.*')
                ->join('salary_breakup as s', 'e.BreakUpTypeId', '=', 's.type_id')
                ->where('e.id', $e->employee_id)
                ->get();

            foreach ($salaryType as $se) {
                $breakup[$e->employee_id][] = [
                    'name' => $se->name,
                    'percentage' => $se->percentage,
                ];
            }
            $allowances = DB::table('allowance_queue')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();
            if (!empty($allowances)) {
                foreach ($allowances as $al) {
                    $allow[$e->employee_id][] = [
                        'allowance_name' => $al->allowance_name,
                        'allowance_amount' => $al->allowance_amount,
                    ];
                }
            } else {
                $allow[$e->employee_id] = [];
            }
            $deductions = DB::table('deduction_queue')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();
            if (!empty($deductions)) {
                foreach ($deductions as $al) {
                    $deduct[$e->employee_id][] = [
                        'deduction_name' => $al->deduction_name,
                        'deduction_amount' => $al->deduction_amount,
                    ];
                }
            } else {
                $deduct[$e->employee_id] = [];
            }
            //  $nextMonth = $a_date->copy()->endOfMonth();
            //  $beforeMonth = $a_date->copy()->startOfMonth();
            $employee_leaves = DB::table('leaves')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();

            $employee_attendance = DB::table('attendance')
                ->where('employee_id', $e->employee_id)
                ->where('attendance_type', 'Clock In')

                ->pluck('attendance_date')
                ->toArray();

            $a_date = Carbon::parse($date);

            $from = $a_date->copy()->startOfMonth();

            $to = $a_date->copy()->endOfMonth();
            $perDaySalary = $e->approved_salary * 12;
            $perDaySalary = $perDaySalary / 365;
            for ($d = $from; $d->lte($to); $d->addDay()) {
                $ecc = $d->format('Y-m-d');
                if (!$d->isSunday()) {
                    $dates[$e->employee_id][] = [
                        'dates' => $d->format('Y-m-d'),
                        'amount' => number_format((float) $perDaySalary, 2, '.', ''),
                    ];
                    if (!empty($employee_attendance)) {
                        if (in_array($ecc, $employee_attendance)) {
                            // $key = array_search($ebc, $dates[$e->employee_id]);
                            $key = array_search($ecc, array_column($dates[$e->employee_id], 'dates'));

                            unset($dates[$e->employee_id][$key]);
                        }
                    }
                    $dates[$e->employee_id] = array_values($dates[$e->employee_id]);
                }
            }

            if (!empty($employee_leaves)) {
                foreach ($employee_leaves as $leave) {
                    $fro = Carbon::parse($leave->start_date);
                    $t = Carbon::parse($leave->end_date);
                    for ($d = $fro; $d->lte($t); $d->addDay()) {
                        $ebc = $d->format('Y-m-d');

                        if (in_array($ebc, array_column($dates[$e->employee_id], 'dates'))) {
                            // $key = array_search($ebc, $dates[$e->employee_id]);
                            $key = array_search($ebc, array_column($dates[$e->employee_id], 'dates'));

                            unset($dates[$e->employee_id][$key]);
                        }

                        $dates[$e->employee_id] = array_values($dates[$e->employee_id]);
                    }
                }
            }
            $value = array_sum(array_column($dates[$e->employee_id], 'amount'));
            $total_absent[$e->employee_id] = $value;
            if (empty($payrolls)) {
                $totaldeductions = 0;
                $net = 0;
                $totaldeductions = $e->total_deduction + $value;
                $net = $e->net_amount - $value;
                $data[] =
                    [
                        'payslip_no' => $payslipid,
                        'employee_id' => $e->employee_id,
                        'date' => $date,
                        'gross_salary' => number_format((float) $e->gross_salary, 2, '.', ''),
                        'approved_salary' => number_format((float) $e->approved_salary, 2, '.', ''),
                        'total_absent_deduction' => number_format((float) $e->absent_deduction, 2, '.', ''),
                        'total_leave_deduction' => number_format((float) $e->leave_deduction, 2, '.', ''),
                        'total_allowances' => number_format((float) $e->total_allowance, 2, '.', ''),
                        'total_deductions' => number_format((float) $totaldeductions, 2, '.', ''),
                        'net_amount' => number_format((float) $net, 2, '.', ''),
                    ];
            }
        }
        $type = 2;
        if ($data) {
            $type = 1;
        }
        $payslips = view('layouts.modals.employee-payslip-data', compact('data', 'breakup', 'allow', 'deduct', 'dates', 'total_absent'))->render();

        return response()->json([
            'html' => $payslips,
            'type' => $type,
        ]);
    }

    public function getManualPayslip(REQUEST $req)
    {
       
        $date = $req->year . '-' . $req->month;

        $employee_salary = DB::table('employee_salary')
            ->where('employee_id', $req->employee_id)
            ->where('is_deleted', 'N')
            ->get();
        $data = [];
        foreach ($employee_salary as $e) {
            $payslipid = auth()->user()->id . $e->employee_id . random_int(1000000, 9999999);
            $payrolls = DB::table('employee_payroll')

                ->where('employee_id', $e->employee_id)
                ->where('date', $date)
                ->where('is_deleted', 'N')

                ->first();

            $salaryType = DB::table('employes as e')
                ->select('s.*')
                ->join('salary_breakup as s', 'e.BreakUpTypeId', '=', 's.type_id')
                ->where('e.id', $e->employee_id)
                ->get();

            foreach ($salaryType as $se) {
                $breakup[$e->employee_id][] = [
                    'name' => $se->name,
                    'percentage' => $se->percentage,
                ];
            }
            $allowances = DB::table('allowance_queue')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();
            if (!empty($allowances)) {
                foreach ($allowances as $al) {
                    $allow[$e->employee_id][] = [
                        'allowance_name' => $al->allowance_name,
                        'allowance_amount' => $al->allowance_amount,
                    ];
                }
            } else {
                $allow[$e->employee_id] = [];
            }
            $deductions = DB::table('deduction_queue')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();
            if (!empty($deductions)) {
                foreach ($deductions as $al) {
                    $deduct[$e->employee_id][] = [
                        'deduction_name' => $al->deduction_name,
                        'deduction_amount' => $al->deduction_amount,
                    ];
                }
            } else {
                $deduct[$e->employee_id] = [];
            }
            //  $nextMonth = $a_date->copy()->endOfMonth();
            //  $beforeMonth = $a_date->copy()->startOfMonth();
            $employee_leaves = DB::table('leaves')
                ->where('employee_id', $e->employee_id)
                ->where('is_deleted', 'N')
                ->get()
                ->toArray();

            $employee_attendance = DB::table('attendance')
                ->where('employee_id', $e->employee_id)
                ->where('attendance_type', 'Clock In')

                ->pluck('attendance_date')
                ->toArray();

            $a_date = Carbon::parse($date);

            $from = $a_date->copy()->startOfMonth();

            $to = $a_date->copy()->endOfMonth();
            $perDaySalary = $e->approved_salary * 12;
            $perDaySalary = $perDaySalary / 365;
            for ($d = $from; $d->lte($to); $d->addDay()) {
                $ecc = $d->format('Y-m-d');
                if (!$d->isSunday()) {
                    $dates[$e->employee_id][] = [
                        'dates' => $d->format('Y-m-d'),
                        'amount' => number_format((float) $perDaySalary, 2, '.', ''),
                    ];
                    if (!empty($employee_attendance)) {
                        if (in_array($ecc, $employee_attendance)) {
                            // $key = array_search($ebc, $dates[$e->employee_id]);
                            $key = array_search($ecc, array_column($dates[$e->employee_id], 'dates'));

                            unset($dates[$e->employee_id][$key]);
                        }
                    }
                    $dates[$e->employee_id] = array_values($dates[$e->employee_id]);
                }
            }
            //   foreach($employee_attendance as $attendance){
            //     echo $attendance;
            //   }
            if (!empty($employee_leaves)) {
                foreach ($employee_leaves as $leave) {
                    $fro = Carbon::parse($leave->start_date);
                    $t = Carbon::parse($leave->end_date);
                    for ($d = $fro; $d->lte($t); $d->addDay()) {
                        $ebc = $d->format('Y-m-d');

                        if (in_array($ebc, array_column($dates[$e->employee_id], 'dates'))) {
                            // $key = array_search($ebc, $dates[$e->employee_id]);
                            $key = array_search($ebc, array_column($dates[$e->employee_id], 'dates'));

                            unset($dates[$e->employee_id][$key]);
                        }

                        $dates[$e->employee_id] = array_values($dates[$e->employee_id]);
                    }
                }
            }
            $value = array_sum(array_column($dates[$e->employee_id], 'amount'));
            $total_absent[$e->employee_id] = $value;
            if (empty($payrolls)) {
                $totaldeductions = 0;
                $net = 0;
                $totaldeductions = $e->total_deduction + $value;
                $net = $e->net_amount - $value;
                $data[] =
                    [
                        'payslip_no' => $payslipid,
                        'employee_id' => $e->employee_id,
                        'date' => $date,
                        'gross_salary' => number_format((float) $e->gross_salary, 2, '.', ''),
                        'approved_salary' => number_format((float) $e->approved_salary, 2, '.', ''),
                        'total_absent_deduction' => number_format((float) $e->absent_deduction, 2, '.', ''),
                        'total_leave_deduction' => number_format((float) $e->leave_deduction, 2, '.', ''),
                        'total_allowances' => number_format((float) $e->total_allowance, 2, '.', ''),
                        'total_deductions' => number_format((float) $totaldeductions, 2, '.', ''),
                        'net_amount' => number_format((float) $net, 2, '.', ''),
                    ];
            }
        }
        $type = 2;
        if ($data) {
            $type = 1;
        }
        $payslips = view('layouts.modals.employee-payslip-data', compact('data', 'breakup', 'allow', 'deduct', 'dates', 'total_absent'))->render();

        return response()->json([
            'html' => $payslips,
            'type' => $type,
        ]);
    }

    public function EmployeeSalary()
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();
        $allowances = DB::table('allowance')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();
        $deductions = DB::table('deduction')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/add-employee-salary')->with(compact('employees', 'allowances', 'deductions'));
    }

    public function insertAllowance(Request $req)
    {
        $emp = new AllowanceModel();
        $emp->name = $req->allowance_name;

        $emp->save();

        echo $emp->id;
    }

    public function updateAllowance(Request $req, $id)
    {
        $emp = AllowanceModel::find($id);
        $emp->name = $req->allowance_name;

        $emp->save();

        echo $emp->id;
    }

    public function updateDeduction(Request $req, $id)
    {
        $emp = DeductionModel::find($id);
        $emp->name = $req->deduction_name;

        $emp->save();

        echo $emp->id;
    }

    public function insertDeduction(Request $req)
    {
        $emp = new DeductionModel();
        $emp->name = $req->deduction_name;

        $emp->save();

        echo $emp->id;
    }

    public function getEmployeePay($id)
    {
        $a_date = Carbon::now();
        $a_date = $a_date->subMonth();

        $employee = DB::table('employes')
            ->where('id', $id)
            ->first();
        $salary_breakups = DB::table('salary_breakup')
            ->where('type_id', $employee->BreakUpTypeId)
            ->get();

        // $daysInMonth=Carbon::parse($a_date)->daysInMonth;

        // $absents=$daysInMonth-$sunday-$diffsu-$employee_att;

        $finalData = [];
        $finalData = [
            'salary' => $employee->basic_salary,
        ];
        foreach ($salary_breakups as $s) {
            $finalData['records'][] = [
                'name' => $s->name,
                'percentage' => $s->percentage,
            ];
        }

        $payslipcheck = DB::table('employee_salary')
            ->where('employee_id', $id)
            ->where('is_deleted', 'N')
            // ->whereBetween('dated', [$a_date->startOfMonth()->toDateTimeString(), $a_date->endOfMonth()->toDateTimeString()])
            ->first();
        if ($payslipcheck) {
            $data = '';

            return $data;
        } else {
            return $finalData;
        }
    }

    public function getEmployeePayEdit($id)
    {
        $a_date = Carbon::now();
        $a_date = $a_date->subMonth();

        $employee = DB::table('employes')
            ->where('id', $id)
            ->first();
        $salary_breakups = DB::table('salary_breakup')
            ->where('type_id', $employee->BreakUpTypeId)
            ->get();



        $finalData = [];
        $finalData = [
            'salary' => $employee->basic_salary,
        ];
        foreach ($salary_breakups as $s) {
            $finalData['records'][] = [
                'name' => $s->name,
                'percentage' => $s->percentage,
            ];
        }

        return $finalData;
    }

    public function addEmployeeSalary(REQUEST $req)
    {
        $a_date = Carbon::now();
        $a_date = $a_date->subMonth();
        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('add-employee-salary')
                ->withErrors($validator)
                ->withInput();
        } else {
            $payslipcheck = DB::table('employee_salary')
                ->select('*')
                ->where('employee_id', $req->employee_id)
                ->where('is_deleted', 'N')
                ->first();

            if (!empty($payslipcheck)) {
                $req->session()->flash('errorMsg', 'Employee payslip already generated for this month');

                return redirect('list-salary');
            } else {
                //  $payslipid=auth()->user()->id.$req->employee_id. random_int(1000000, 9999999);
                $employeemodel = employeeModel::find($req->employee_id);

                $employeemodel->basic_salary = $req->basic_salary;
                $employeemodel->save();
                $payslip = new PayslipModel();
                $payslip->employee_id = $req->employee_id;
                // $payslip->payslip_no = $payslipid;
                $payslip->gross_salary = $req->basic_salary;
                $payslip->approved_salary = $req->sub_total;

                $payslip->total_allowance = $req->allowance_charges;
                $payslip->total_deduction = $req->deduction_charges;
                $payslip->net_amount = $req->net_salary;
                $payslip->dated = $a_date;

                $payslip->created_on = date('Y-m-d H:i:s');
                $payslip->created_by = auth()->user()->id;
                $payslip->save();
                if (isset($req->allowance_id)) {
                    foreach ($req->allowance_id as $key => $value) {
                        $allowancequeue = new AllowanceQueueModel();
                        $allowance_name = DB::table('allowance')
                            ->select('name')
                            ->where('id', $req->allowance_id[$key])
                            ->pluck('name')
                            ->first();
                        $allowancequeue->allowance_name = $allowance_name;
                        $allowancequeue->allowance_id = $req->allowance_id[$key];
                        $allowancequeue->allowance_amount = $req->allowance_amount[$key];
                        $allowancequeue->employee_id = $req->employee_id;
                        $allowancequeue->save();
                    }
                }
                if (isset($req->deduction_id)) {
                    foreach ($req->deduction_id as $key => $value) {
                        $deductionqueue = new DeductionQueueModel();
                        $deduction_name = DB::table('deduction')
                            ->select('name')
                            ->where('id', $req->deduction_id[$key])
                            ->pluck('name')
                            ->first();
                        $deductionqueue->deduction_name = $deduction_name;
                        $deductionqueue->deduction_id = $req->deduction_id[$key];
                        $deductionqueue->deduction_amount = $req->deduct_amount[$key];
                        $deductionqueue->employee_id = $req->employee_id;
                        $deductionqueue->save();
                    }
                }

                return redirect('list-salary');
            }
        }
    }

    public function updateSalary($id, REQUEST $req)
    {
        $a_date = Carbon::now();
        $a_date = $a_date->subMonth();
        $validator = Validator::make($req->all(), [
            'employee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('edit-salary/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            //  $payslipid=auth()->user()->id.$req->employee_id. random_int(1000000, 9999999);
            $employeemodel = employeeModel::find($req->employee_id);

            $employeemodel->basic_salary = $req->basic_salary;
            $employeemodel->save();
            $payslip = PayslipModel::find($id);
            $payslip->employee_id = $req->employee_id;
            // $payslip->payslip_no = $payslipid;
            $payslip->gross_salary = $req->basic_salary;
            $payslip->approved_salary = $req->sub_total;

            $payslip->total_allowance = $req->allowance_charges;
            $payslip->total_deduction = $req->deduction_charges;
            $payslip->net_amount = $req->net_salary;
            $payslip->dated = $a_date;

            $payslip->updated_on = date('Y-m-d H:i:s');
            $payslip->updated_by = auth()->user()->id;
            $payslip->save();

            DB::table('allowance_queue')->where('employee_id', $payslip->employee_id)->delete();
            DB::table('deduction_queue')->where('employee_id', $payslip->employee_id)->delete();
            if (isset($req->allowance_id)) {
                foreach ($req->allowance_id as $key => $value) {
                    $allowancequeue = new AllowanceQueueModel();
                    $allowance_name = DB::table('allowance')
                        ->select('name')
                        ->where('id', $req->allowance_id[$key])
                        ->pluck('name')
                        ->first();
                    $allowancequeue->allowance_name = $allowance_name;
                    $allowancequeue->allowance_id = $req->allowance_id[$key];
                    $allowancequeue->allowance_amount = $req->allowance_amount[$key];
                    $allowancequeue->employee_id = $payslip->employee_id;
                    $allowancequeue->save();
                }
            }
            if (isset($req->deduction_id)) {
                foreach ($req->deduction_id as $key => $value) {
                    $deductionqueue = new DeductionQueueModel();
                    $deduction_name = DB::table('deduction')
                        ->select('name')
                        ->where('id', $req->deduction_id[$key])
                        ->pluck('name')
                        ->first();
                    $deductionqueue->deduction_name = $deduction_name;
                    $deductionqueue->deduction_id = $req->deduction_id[$key];
                    $deductionqueue->deduction_amount = $req->deduct_amount[$key];
                    $deductionqueue->employee_id = $payslip->employee_id;
                    $deductionqueue->save();
                }
            }
            $req->session()->flash('successMsg', 'Employee Salary has been updated Successfully');

            return redirect('list-salary');
            // }
        }
    }

    public function editSalary($id, REQUEST $req)
    {
        $employee_payslip = DB::table('employee_salary')
            ->select('*')
            ->where('id', $id)

            ->first();

        $employees = DB::table('employes')
            ->select('*')
            ->where('id', $employee_payslip->employee_id)
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();
        $allowances = DB::table('allowance')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();
        $deductions = DB::table('deduction')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();

        $allowances_queue = DB::table('allowance_queue')
            ->select('*')
            ->where('employee_id', $employee_payslip->employee_id)
            ->get();
        $deductions_queue = DB::table('deduction_queue')
            ->select('*')
            ->where('employee_id', $employee_payslip->employee_id)
            ->get();

        return view('layouts/employes/edit-payslip')->with(compact('employees', 'allowances', 'deductions', 'employee_payslip', 'allowances_queue', 'deductions_queue'));
    }

    public function viewPayroll($id)
    {

        $payrolls = DB::table('employee_payroll as p')
            ->select('p.*', 'e.full_name', 'e.designation', 'e.joining_date')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.payslip_no', $id)
            ->first();

        $payslip_details = DB::table('employee_payslip_details')
            ->select('*')
            ->where('payslip_id', $id)
            ->get();
        // dd($payslip_details);
        $data['allowance'] = [];
        $data['deduction'] = [];
        $data['absent'] = [];
        foreach ($payslip_details as $p) {
            if ($p->title == 'SalaryBreakup') {
                $data['salarybreakup'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            if ($p->title == 'allowance') {
                $data['allowance'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            if ($p->title == 'deduction') {
                $data['deduction'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            if ($p->title == 'Absent') {
                $data['absent'][] = [
                    'date' => $p->date,

                    'amount' => $p->amount,
                ];
            }
        }


        $rowspan['breakup_count'] = count($data['salarybreakup']) + 1;
        $rowspan['allow_count'] = count($data['allowance']) + 2;
        $rowspan['deduct_count'] = count($data['deduction']) + 2;
        $rowspan['absent_count'] = count($data['absent']) + 2;

        $a_date = Carbon::parse($payrolls->date);

        $monthName = $a_date->format('F');
        $rowspan['month'] = $monthName;

        return view('layouts/employes/view-payroll')->with(compact('payrolls', 'data', 'rowspan'));
    }

    public function printPayslip($id)
    {
        $payrolls = DB::table('employee_payroll as p')
            ->select('p.*', 'e.full_name', 'e.designation', 'e.joining_date')
            ->join('employes as e', 'p.employee_id', '=', 'e.id')
            ->where('e.status', '!=', 'fired')
            ->where('e.status', '!=', 'resign')
            ->where('p.payslip_no', $id)
            ->first();

        $payslip_details = DB::table('employee_payslip_details')
            ->select('*')
            ->where('payslip_id', $id)
            ->get();
        // dd($payslip_details);
        $data['allowance'] = [];
        $data['deduction'] = [];
        $data['absent'] = [];
        $absent_amount = 0;
        foreach ($payslip_details as $p) {
            if ($p->title == 'SalaryBreakup') {
                $data['salarybreakup'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            if ($p->title == 'allowance') {
                $data['allowance'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            if ($p->title == 'deduction') {
                $data['deduction'][] = [
                    'name' => $p->status,
                    'amount' => $p->amount,
                ];
            }
            // if($p->title=='Absent'){
            //     $absent_amount=$absent_amount+$p->amount;
            // }
        }



        $rowspan['breakup_count'] = count($data['salarybreakup']) + 1;
        $rowspan['allow_count'] = count($data['allowance']) + 2;
        $rowspan['deduct_count'] = count($data['deduction']) + 3;

        $a_date = Carbon::parse($payrolls->date);
        $monthName = $a_date->format('F');
        $rowspan['month'] = $monthName;

        return view('layouts/employes/print-payslip')->with(compact('payrolls', 'data', 'rowspan'));
    }

    public function deleteSalary($id, Request $req)
    {
        $payslip = DB::table('employee_salary')->where('id', $id)->first();
        $allowances = DB::table('allowance_queue')->where('employee_id', $payslip->employee_id)->get();
        $deductions = DB::table('deduction_queue')->where('employee_id', $payslip->employee_id)->get();

        if (!$payslip) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-salary');
        } else {
            $payslipmodel = PayslipModel::find($payslip->id);
            $payslipmodel->is_deleted = 'Y';
            $payslipmodel->updated_on = date('Y-m-d H:i:s');
            $payslipmodel->updated_by = auth()->user()->id;
            $payslipmodel->save();
            foreach ($allowances as $a) {
                $allowancemodel = AllowanceQueueModel::find($a->id);
                $allowancemodel->is_deleted = 'Y';

                $allowancemodel->save();
            }
            foreach ($deductions as $d) {
                $deductionmodel = DeductionQueueModel::find($d->id);
                $deductionmodel->is_deleted = 'Y';

                $deductionmodel->save();
            }
            // logs

            $req->session()->flash('successMsg', 'Record has been deleted successfully');

            return redirect('list-salary');
        }
    }

    public function deletePayroll($id, Request $req)
    {
        $payslip = DB::table('employee_payroll')->where('payslip_no', $id)->first();

        if (!$payslip) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-payroll');
        } else {
            $payslipmodel = PayrollModal::find($payslip->id);
            $payslipmodel->is_deleted = 'Y';
            $payslipmodel->updated_on = date('Y-m-d H:i:s');
            $payslipmodel->updated_by = auth()->user()->id;
            $payslipmodel->save();

            $req->session()->flash('successMsg', 'Record has been deleted successfully');

            return redirect('list-payroll');
        }
    }

    public function deleteAllowance($id, Request $req)
    {
        $payslip = DB::table('allowance')->where('id', $id)->first();

        if (!$payslip) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('setting-payslip');
        } else {
            $payslipmodel = AllowanceModel::find($id);
            $payslipmodel->is_deleted = 'Y';

            $payslipmodel->save();

            $req->session()->flash('successMsg', 'Record has been deleted successfully');

            return redirect('setting-payslip');
        }
    }

    public function deleteDeduction($id, Request $req)
    {
        $payslip = DB::table('deduction')->where('id', $id)->first();

        if (!$payslip) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('setting-payslip');
        } else {
            $payslipmodel = deductionModel::find($id);
            $payslipmodel->is_deleted = 'Y';

            $payslipmodel->save();

            $req->session()->flash('successMsg', 'Record has been deleted successfully');

            return redirect('setting-payslip');
        }
    }

    public function settingPayslip()
    {
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')

            ->get();
        $allowances = DB::table('allowance')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();
        $deductions = DB::table('deduction')
            ->select('*')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/setting-payslip')->with(compact('breakupTypes', 'allowances', 'deductions'));
    }

    public function getBreakUpTitles()
    {
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')

            ->get()
            ->toArray();

        return $breakupTypes;
    }

    public function insertBreakUpType(REQUEST $req)
    {
        $breakupTypes = DB::table('salary_breakup_type')
            ->select('*')
            ->where('name', $req->BreakUpTypeName)

            ->first();

        if (empty($breakupTypes)) {
            if (isset($req->BreakUpTypeTitleId) && !empty($req->BreakUpTypeTitleId)) {
                // $this->db->where('Id',$data['BreakUpTypeTitleId']);
                // $this->db->update('erp_salarybreakuptype',['Name'=>$data['BreakUpTypeName']]);
                $breakuptype = SalaryBreakupTypeModal::find($req->BreakUpTypeTitleId);
                $breakuptype->name = $req->BreakUpTypeName;

                $breakuptype->updated_on = date('Y-m-d H:i:s');
                $breakuptype->updated_by = auth()->user()->id;
                $breakuptype->save();
            } else {
                $breakuptype = new SalaryBreakupTypeModal();
                $breakuptype->name = $req->BreakUpTypeName;

                $breakuptype->created_on = date('Y-m-d H:i:s');
                $breakuptype->created_by = auth()->user()->id;
                $breakuptype->save();
            }

            return json_encode('true');
        } else {
            return json_encode('false');
        }
    }

    public function insertBreakUp(REQUEST $req)
    {
        $DuplicateData = DB::table('salary_breakup')
            ->select('*')
            ->where('name', $req->BreakUpName)
            ->where('type_id', $req->typeid)->first();
        if ($req->BreakUpId == '') {
            if (empty($DuplicateData)) {
                $breakuptype = new SalaryBreakupModal();
                $breakuptype->name = $req->BreakUpName;

                $breakuptype->type_id = $req->typeid;
                $breakuptype->percentage = $req->Percentage;

                $breakuptype->created_on = date('Y-m-d H:i:s');
                $breakuptype->created_by = auth()->user()->id;
                $breakuptype->save();

                // $req->session()->flash('successMsg','Record has been added successfully');
                return json_encode('true');
            } else {
                // $req->session()->flash('successMsg','Record already added');
                return json_encode('false');
            }
        } else {
            $breakuptype = SalaryBreakupModal::find($req->BreakUpId);
            $breakuptype->name = $req->BreakUpName;

            $breakuptype->percentage = $req->Percentage;

            $breakuptype->updated_on = date('Y-m-d H:i:s');
            $breakuptype->updated_by = auth()->user()->id;
            $breakuptype->save();

            return json_encode('Data Updated');
        }
    }

    public function fetchBreakup(REQUEST $req)
    {
        $DuplicateData = DB::table('salary_breakup')
            ->select('*')
            ->where('type_id', $req->type)->get()
            ->toArray();

        // $req->session()->flash('successMsg','Record has been added successfully');
        return json_encode($DuplicateData);
    }

    public function getBreakUpTypeTitles(REQUEST $req)
    {
        $SalaryBreakUpType = DB::table('salary_breakup_type')
            ->select('*')

            ->get()
            ->toArray();
        $output = '';
        if (!empty($SalaryBreakUpType)) {
            $sno = 0;
            foreach ($SalaryBreakUpType as $key => $v) {
                ++$sno;

                $output .= '<tr>' .
                    '<td>' . $sno . '</td>' .
                    '<td>' . $v->name . '</td>' .
                    '<td>' .
                    '<a href="javascript:void(0)" title="Edit Title" class="breakUpEdit" data-id="' . $v->id . '" data-title="' . $v->name . '">' .
                    '<span style="color:#0c6aad;" class="fa fa-edit"></span></a>' .
                    '</td></tr>';
            }
        }

        echo json_encode($output);
    }

    public function saveGeneratePayslip(REQUEST $req)
    {
        $employees = $req->employee;

        foreach ($employees as $e_id) {
            $employee_endleaves = DB::table('leaves')
                ->where('employee_id', $e_id)
                ->where('ispaid', 'unpaid')
                ->get();
            $ecc = [];
            $dcc = [];
            foreach ($employee_endleaves as $e) {
                //   $a_date =  Carbon::parse($req->date[$e_id]);

                $from = Carbon::parse($e->start_date);

                $to = Carbon::parse($e->end_date);

                for ($d = $from; $d->lte($to); $d->addDay()) {
                    $ecc[] = $d->format('Y-m-d');
                }
            }

            $a_date = Carbon::parse($req->date[$e_id]);

            $from = $a_date->copy()->startOfMonth();

            $to = $a_date->copy()->endOfMonth();
            for ($d = $from; $d->lte($to); $d->addDay()) {
                $dcc[] = $d->format('Y-m-d');
            }
            $result = [];
            $result = array_intersect($ecc, $dcc);
            $annualsalary = $req->approved_salary[$e_id] * 12;
            $per_day_salary = $annualsalary / 365;
            $leaves_amount = $per_day_salary * count($result);
            $totaldeductions = $req->total_deductions[$e_id] + $leaves_amount;
            $netsalary = $req->net_salary[$e_id] - $leaves_amount;
            $payslipid = auth()->user()->id . $e_id . random_int(1000000, 9999999);
            $payrollmodel = new PayrollModal();
            $payrollmodel->payslip_no = $payslipid;
            $payrollmodel->employee_id = $e_id;
            $payrollmodel->date = $req->date[$e_id];

            $payrollmodel->gross_salary = number_format((float) $req->approved_salary[$e_id], 2, '.', '');
            $payrollmodel->approved_salary = number_format((float) $req->approved_salary[$e_id], 2, '.', '');
            $payrollmodel->total_allowances = number_format((float) $req->total_allowances[$e_id], 2, '.', '');
            $payrollmodel->total_deductions = number_format((float) $totaldeductions, 2, '.', '');
            $payrollmodel->total_absent_deduction = number_format((float) $req->total_absent[$e_id], 2, '.', '');
            $payrollmodel->total_leave_deduction = number_format((float) $leaves_amount, 2, '.', '');
            $payrollmodel->net_amount = number_format((float) $netsalary, 2, '.', '');
            $payrollmodel->created_on = date('Y-m-d H:i:s');
            $payrollmodel->created_by = auth()->user()->id;
            $payrollmodel->save();
            if (isset($req->allowance_name[$e_id])) {
                $allowances = $req->allowance_name[$e_id];

                foreach ($allowances as $key => $allowance) {
                    $payslipDetails = new PayslipDetailsModel();
                    $payslipDetails->payslip_id = $payslipid;
                    $payslipDetails->amount = number_format((float) $req->allowance_amount[$e_id][$key], 2, '.', '');
                    $payslipDetails->status = $allowance;
                    $payslipDetails->title = 'allowance';
                    $payslipDetails->save();
                }
            }
            if (isset($req->deduction_name[$e_id])) {
                $deductions = $req->deduction_name[$e_id];

                foreach ($deductions as $key => $deduction) {
                    $payslipDetails = new PayslipDetailsModel();
                    $payslipDetails->payslip_id = $payslipid;
                    $payslipDetails->amount = number_format((float) $req->deduction_amount[$e_id][$key], 2, '.', '');
                    $payslipDetails->status = $deduction;
                    $payslipDetails->title = 'deduction';
                    $payslipDetails->save();
                }
            }
            if (isset($req->salary_breakup[$e_id])) {
                $salary_breakups = $req->salary_breakup[$e_id];

                foreach ($salary_breakups as $key => $salary_breakup) {
                    $payslipDetails = new PayslipDetailsModel();
                    $payslipDetails->payslip_id = $payslipid;
                    $payslipDetails->amount = number_format((float) $req->salary_breakupamount[$e_id][$key], 2, '.', '');
                    $payslipDetails->status = $salary_breakup;
                    $payslipDetails->title = 'SalaryBreakup';
                    $payslipDetails->save();
                }
            }
            if (isset($req->absent_dates[$e_id])) {
                $absent_dates = $req->absent_dates[$e_id];

                foreach ($absent_dates as $key => $absent_date) {
                    $payslipDetails = new PayslipDetailsModel();
                    $payslipDetails->payslip_id = $payslipid;
                    $payslipDetails->amount = number_format((float) $req->absent_amount[$e_id][$key], 2, '.', '');
                    $payslipDetails->date = $absent_date;
                    $payslipDetails->title = 'Absent';
                    $payslipDetails->status = 'Absent';
                    $payslipDetails->save();
                }
            }
        }

        return redirect('list-payroll');
    }

    public function employeeProfile(REQUEST $req, $id)
    {
        $employees = DB::table('employes')
            ->select('*')
            ->where('id', $id)
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->orderBy('id', 'DESC')
            ->first();

        return view('layouts/employes/employee-profile')->with(compact('employees'));
    }

    public function employeeProfilePhoto(REQUEST $req, $id)
    {
        $employees = employeeModel::find($id);
        $image = $req->file('image');
        if ($image) {
            $imageName = time() . '.' . $image->extension();

            $destinationPathThumbnail = public_path('/uploads/employeeprofile');
            $destinationPath = 'uploads/employeeprofile';
            $img = \Image::make($image->path());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $imageName);
            $filename = $destinationPath . '/' . $imageName;
            $employees->attachment = $filename;
            $employees->save();

            return json_encode($filename);
        } else {
            return json_encode('false');
        }
    }

    public function employeeStatus()
    {
        $employees = DB::table('employes')
            ->where('status', '!=', 'fired')
            ->where('status', '!=', 'resign')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/employee-status')->with(compact('employees'));
    }

    public function employeeGratuity()
    {
        $employees = DB::table('employes')
            ->where('status', 'fired')
            ->orWhere('status', 'resign')
            ->where('is_deleted', 'N')
            ->get();

        return view('layouts/employes/employee-gratuity')->with(compact('employees'));
    }

    public function getemployeeGratuity(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'employee' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('employee-gratuity')
                ->withErrors($validator)
                ->withInput();
        } else {
            $employees = DB::table('employes')
                ->where('status', 'fired')
                ->orWhere('status', 'resign')
                ->where('is_deleted', 'N')
                ->get();
            $employ = DB::table('employes')
                ->where('id', $req->employee)
                ->where('is_deleted', 'N')
                ->first();

            $startdate = Carbon::parse($employ->joining_date);
            $todate = Carbon::parse($employ->ending_date);
            $diff = $startdate->diffInYears($todate);
            $diffm = $startdate->diffInMonths($todate);

            $calc = 12 * $diff;

            $final = $diffm - $calc;
            $finalvalue = $diff . '.' . $final;

            if ($diff < 6) {
                $gratuity = DB::table('employee_gratuity')
                    ->where('years', $diff)
                    ->first();
            } else {
                $gratuity = DB::table('employee_gratuity')
                    ->where('years', '5+')
                    ->first();
            }
            if ($diff >= 1) {
                $amount = (float) $employ->basic_salary * (float) $finalvalue;
            } else {
                $amount = 0;
            }

            $gratuitys = [
                'name' => $employ->full_name,
                'designation' => $employ->designation,
                'phone' => $employ->mobile_phone,
                'joining_date' => $employ->joining_date,
                'ending_date' => $employ->ending_date,
                'years' => $finalvalue,
                'amount' => $amount,
            ];

            return view('layouts/employes/employee-gratuity')->with(compact('employ', 'employees', 'gratuitys'));
        }
    }

    public function addemployeeStatus(REQUEST $req)
    {
        $validator = Validator::make($req->all(), [
            'employee' => 'required|max:100',
            'status' => 'required|max:100',
            'enddate' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return redirect('employee-status')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $req->file('document');
            if ($file) {
                $fi = request()->file('document')->store('/');

                // Move Uploaded Fil
                $destinationPath = 'uploads/employeedocuments';

                $file->move($destinationPath, $fi);
                echo '<br>';
                $filename = $destinationPath . '/' . $fi;
            } else {
                $filename = '';
            }
            if ($req->status == 'fired' || $req->status == 'resign') {
                $validator = Validator::make($req->all(), [
                    'enddate' => 'required|max:100',
                ]);

                if ($validator->fails()) {
                    return redirect('employee-status')
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $employeemodel = employeeModel::find($req->employee);
                    $employeemodel->status = $req->status;
                    $employeemodel->ending_date = $req->enddate;
                    $employeemodel->reason = $req->reason;
                    $employeemodel->status_attachment = $filename;
                    $employeemodel->save();
                    $req->session()->flash('successMsg', 'Employee has been updated successfully');

                    return redirect('list-employees');
                }
            } else {
                $employeemodel = employeeModel::find($req->employee);
                $employeemodel->status = $req->status;
                $employeemodel->status_attachment = $filename;
                $employeemodel->reason = $req->reason;
                $employeemodel->save();
                $req->session()->flash('successMsg', 'Employee has been updated successfully');

                return redirect('list-employees');
            }
        }
    }
}
