<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserNotifications;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('change-theme/{id}', [DashboardController::class, 'Themeupdate'])->middleware(['auth'])->name('change-theme');
Route::get('change-theme-rtl/{id}', [DashboardController::class, 'Themeupdate_rtl'])->middleware(['auth'])->name('change-theme');
Route::get('change-theme-gradient/{id}', [DashboardController::class, 'Themeupdate_gradient'])->middleware(['auth'])->name('change-theme');
Route::get('change-theme-sidebar/{id}', [DashboardController::class, 'Themeupdate_sidebar'])->middleware(['auth'])->name('change-theme');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(['auth']);

// Roles Routes
Route::get('list-roles', [rolesController::class, 'rolesList'])->middleware('auth', 'AuthResource:list-roles');
Route::get('add-roles', [rolesController::class, 'addRoles'])->middleware('auth', 'AuthResource:add-roles');
Route::post('add-roles', [rolesController::class, 'assignPermission'])->middleware('auth');
Route::get('view-roles/{id}', [rolesController::class, 'viewSelectedPermission'])->middleware('auth', 'AuthResource:view-roles');
Route::get('view-roles', [rolesController::class, 'viewPermission'])->middleware('auth', 'AuthResource:view-roles');
Route::post('view-roles', [rolesController::class, 'viewPermission'])->middleware('auth');
Route::get('edit-roles/{id}', [rolesController::class, 'editPermission'])->middleware('auth', 'AuthResource:edit-roles');
Route::post('edit-roles/{id}', [rolesController::class, 'updatePermission'])->middleware('auth');
Route::get('delete-roles/{id}', [rolesController::class, 'deleteRoles'])->middleware('auth', 'AuthResource:delete-roles');

Route::get('edit-roles-users/{id}', [rolesController::class, 'editPermissionUser'])->middleware('auth');
Route::post('edit-roles-users/{id}', [rolesController::class, 'updatePermissionUser'])->middleware('auth');

// Users Routes
Route::get('list-users', [UsersController::class, 'userList'])->middleware('auth', 'AuthResource:list-users');
Route::get('add-users', [UsersController::class, 'addUser'])->middleware('auth', 'AuthResource:add-users');
Route::post('add-users', [UsersController::class, 'addUserData'])->middleware('auth');
Route::get('/edit-users/{id}', [UsersController::class, 'editUser'])->middleware('auth', 'AuthResource:edit-users');
Route::post('/edit-users/{id}', [UsersController::class, 'updateUser'])->middleware('auth');
Route::get('/delete-users/{id}', [UsersController::class, 'deleteUser'])->middleware('auth', 'AuthResource:delete-users');

Route::get('logs-list', [LogsController::class, 'logsList'])->middleware('auth', 'AuthResource:logs-list');
Route::post('logs-range', [LogsController::class, 'logsrange'])->middleware('auth');

// Employes Routes
Route::get('list-employees', [EmployeesController::class, 'employeesList'])->middleware('auth', 'AuthResource:list-employees');
Route::get('add-employees', [EmployeesController::class, 'addEmployees'])->middleware('auth', 'AuthResource:add-employees');
Route::post('assign-employee-role/{id}', [EmployeesController::class, 'assignEmployeeRole']);
Route::get('get-user-data', [EmployeesController::class, 'getUserData']);

Route::post('add-employees', [EmployeesController::class, 'addEmployeeData'])->middleware('auth');
Route::get('/edit-employees/{id}', [EmployeesController::class, 'editEmployee'])->middleware('auth', 'AuthResource:edit-employees/');
Route::post('/edit-employees/{id}', [EmployeesController::class, 'updateEmployee'])->middleware('auth');
Route::get('/delete-employee/{id}', [EmployeesController::class, 'deleteEmployee'])->middleware('auth', 'AuthResource:delete-employee/');
Route::get('add-employees-document', [EmployeesController::class, 'addEmployeesDoc'])->middleware('auth', 'AuthResource:add-employees-document');
Route::post('add-employees-document', [EmployeesController::class, 'addEmployeesDocData'])->middleware('auth');
Route::get('view-employees-document/{id}', [EmployeesController::class, 'ViewEmployeesDoc'])->middleware('auth', 'AuthResource:view-employees-document/');
Route::get('/delete-employee-document/{id}', [EmployeesController::class, 'deleteEmployeeDoc'])->middleware('auth');
Route::get('/list-leaves-type', [EmployeesController::class, 'leavesType'])->middleware('auth', 'AuthResource:list-leaves-type');
Route::get('/list-leaves-record', [EmployeesController::class, 'leavesRecord'])->middleware('auth', 'AuthResource:list-leaves-record');
Route::get('add-leaves', [EmployeesController::class, 'addLeaves'])->middleware('auth', 'AuthResource:add-leaves');
Route::post('add-leaves', [EmployeesController::class, 'addLeavesData'])->middleware('auth');
Route::post('insert-leave-typemodel', [EmployeesController::class, 'addLeaveTypeModel'])->middleware('auth');
Route::get('/delete-leave/{id}', [EmployeesController::class, 'deleteLeave'])->middleware('auth', 'AuthResource:delete-leave/');
Route::get('/edit-leave/{id}', [EmployeesController::class, 'editLeave'])->middleware('auth', 'AuthResource:edit-leave/');
Route::post('/edit-leave/{id}', [EmployeesController::class, 'updateLeave'])->middleware('auth');
Route::get('add-leavestype', [EmployeesController::class, 'addLeavestype'])->middleware('auth', 'AuthResource:add-leavestype');
Route::post('add-leavestype', [EmployeesController::class, 'addLeavestypeData'])->middleware('auth');
Route::get('/delete-leavetype/{id}', [EmployeesController::class, 'deleteLeavetype'])->middleware('auth', 'AuthResource:delete-leavetype/');
Route::get('/edit-leavetype/{id}', [EmployeesController::class, 'editLeavetype'])->middleware('auth', 'AuthResource:edit-leavetype/');
Route::post('/edit-leavetype/{id}', [EmployeesController::class, 'updateLeavetype'])->middleware('auth');
Route::get('/employee-profile/{id}', [EmployeesController::class, 'employeeProfile'])->middleware('auth');
Route::get('employee-gratuity', [EmployeesController::class, 'employeeGratuity'])->middleware('auth');
Route::post('employee-gratuity', [EmployeesController::class, 'getemployeeGratuity'])->middleware('auth');
Route::post('/add-employee-status', [EmployeesController::class, 'addemployeeStatus'])->middleware('auth');
Route::post('/update-photo/{id}', [EmployeesController::class, 'employeeProfilePhoto'])->middleware('auth');

// attendance

Route::get('list-attendance', [EmployeesController::class, 'attendance'])->middleware('auth', 'AuthResource:list-attendance');
Route::get('add-attendance', [EmployeesController::class, 'addAttendance'])->middleware('auth', 'AuthResource:add-attendance');
Route::post('add-attendance', [EmployeesController::class, 'addAttendanceData'])->middleware('auth');
Route::get('/edit-attendance/{id}', [EmployeesController::class, 'editAttendance'])->middleware('auth', 'AuthResource:edit-attendance');
Route::post('/edit-attendance/{id}', [EmployeesController::class, 'updateAttendance'])->middleware('auth');
Route::get('/delete-attendance/{id}', [EmployeesController::class, 'deleteAttendance'])->middleware('auth', 'AuthResource:delete-attendance');

// payroll
Route::get('list-payroll', [EmployeesController::class, 'listPayroll'])->middleware('auth', 'AuthResource:list-payroll');
Route::get('list-salary', [EmployeesController::class, 'listSalary'])->middleware('auth', 'AuthResource:list-salary');
Route::get('generate-payslip', [EmployeesController::class, 'generatePayslip'])->middleware('auth', 'AuthResource:generate-payslip');
Route::post('generate-payslip', [EmployeesController::class, 'getGeneratePayslip'])->middleware('auth');
Route::get('manual-payslip', [EmployeesController::class, 'manualPayslip'])->middleware('auth', 'AuthResource:manual-payslip');
Route::post('manual-payslip', [EmployeesController::class, 'getManualPayslip'])->middleware('auth');
Route::post('generate-savedata', [EmployeesController::class, 'saveGeneratePayslip'])->middleware('auth');
Route::get('add-employee-salary', [EmployeesController::class, 'EmployeeSalary'])->middleware('auth', 'AuthResource:add-employee-salary');
Route::get('setting-payslip', [EmployeesController::class, 'settingPayslip'])->middleware('auth', 'AuthResource:setting-payslip');
Route::post('add-employee-salary', [EmployeesController::class, 'addEmployeeSalary'])->middleware('auth');
Route::post('insert-allowance-model', [EmployeesController::class, 'insertAllowance'])->middleware('auth');
Route::post('update-allowance-model/{id}', [EmployeesController::class, 'updateAllowance'])->middleware('auth');
Route::post('update-deduction-model/{id}', [EmployeesController::class, 'updateDeduction'])->middleware('auth');
Route::get('delete-allowance/{id}', [EmployeesController::class, 'deleteAllowance'])->middleware('auth');
Route::get('delete-deduction/{id}', [EmployeesController::class, 'deleteDeduction'])->middleware('auth');
Route::post('insert-deduction-model', [EmployeesController::class, 'insertDeduction'])->middleware('auth');
Route::get('get-employee-data/{id}', [EmployeesController::class, 'getEmployeePay'])->middleware('auth');
Route::get('get-employee-dataedit/{id}', [EmployeesController::class, 'getEmployeePayEdit'])->middleware('auth');
Route::get('view-payroll/{id}', [EmployeesController::class, 'viewPayroll'])->middleware('auth', 'AuthResource:view-payroll');
Route::get('edit-salary/{id}', [EmployeesController::class, 'editSalary'])->middleware('auth', 'AuthResource:edit-salary');
Route::get('delete-salary/{id}', [EmployeesController::class, 'deleteSalary'])->middleware('auth', 'AuthResource:delete-salary');
Route::get('delete-payroll/{id}', [EmployeesController::class, 'deletePayroll'])->middleware('auth', 'AuthResource:delete-payroll');
Route::post('edit-salary/{id}', [EmployeesController::class, 'updateSalary'])->middleware('auth');
Route::get('print-payslip/{id}', [EmployeesController::class, 'printPayslip'])->middleware('auth');
Route::get('get-breakup-titles', [EmployeesController::class, 'getBreakUpTitles'])->middleware('auth');
Route::get('get-salary-breakup-type', [EmployeesController::class, 'getBreakUpTypeTitles'])->middleware('auth');
Route::post('insert-breakup-type', [EmployeesController::class, 'insertBreakUpType'])->middleware('auth');
Route::post('insert-salary-breakup', [EmployeesController::class, 'insertBreakUp'])->middleware('auth');
Route::post('fetch-breakup', [EmployeesController::class, 'fetchBreakup'])->middleware('auth');
Route::post('add-breakup/{id}', [EmployeesController::class, 'add'])->middleware('auth');

// notfications

Route::get('notifications', [UserNotifications::class, 'viewNotifications'])->middleware('auth');
Route::get('mark-all-read', [UserNotifications::class, 'markRead'])->middleware('auth');
// Route::get('mark-all-unread', [UserNotifications::class,'markUnRead'])->middleware('auth');
Route::get('/mark-single-read/{id}', [UserNotifications::class, 'markReadSingle'])->middleware('auth');
Route::get('/mark-single-unread/{id}', [UserNotifications::class, 'markUnReadSingle'])->middleware('auth');
Route::get('/mark-action/{id}', [UserNotifications::class, 'tookaction'])->middleware('auth');


Route::post('updateProfileInformation', [UsersController::class, 'updateProfileInformation'])->middleware('auth');
Route::post('updateuserpassword', [UsersController::class, 'updateUserPassword'])->middleware('auth');
Route::get('/vat-report', [ProjectsController::class, 'vat_report'])->middleware('auth');


// Reporting

Route::get('report-employees', [ReportsController::class, 'showReport'])->middleware('auth', 'AuthResource:report-employees');
Route::get('report-attendance', [ReportsController::class, 'showAttendance'])->middleware('auth', 'AuthResource:report-attendance');
Route::get('report-monthly-attendance', [ReportsController::class, 'showMonthlyAttendance'])->middleware('auth', 'AuthResource:report-monthly-attendance');
Route::post('report-monthly-attendance', [ReportsController::class, 'showMonthlyAttendanceRange'])->middleware('auth');
Route::get('report-leave', [ReportsController::class, 'showLeaveReport'])->middleware('auth', 'AuthResource:report-leave');

Route::get('report-users', [ReportsController::class, 'showUsersReport'])->middleware('auth', 'AuthResource:report-users');

Route::get('report-salary', [ReportsController::class, 'showSalaryReport'])->middleware('auth', 'AuthResource:report-salary');
Route::get('report-payroll', [ReportsController::class, 'showPayrollReport'])->middleware('auth', 'AuthResource:report-payroll');
Route::post('report-payroll', [ReportsController::class, 'showPayrollRange'])->middleware('auth');
Route::get('report-timesheet', [ReportsController::class, 'showTimesheetReport'])->middleware('auth', 'AuthResource:report-timesheet');
Route::post('report-timesheet', [ReportsController::class, 'showTimesheetRange'])->middleware('auth');
Route::post('report-attendance', [ReportsController::class, 'showAttendanceRange'])->middleware('auth');
Route::post('report-users-range', [ReportsController::class, 'showUsersRange'])->middleware('auth');

Route::post('report-salary', [ReportsController::class, 'showSalaryRange'])->middleware('auth');
Route::post('report-leave-range', [ReportsController::class, 'showLeaveRange'])->middleware('auth');


Route::get('rate-employee', [ReportsController::class, 'rateEmployee'])->middleware('auth');
Route::post('rate-range', [ReportsController::class, 'raterange'])->middleware('auth');
