<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/cash_advance', function () {
    return view('cash_advance');
})->name('cash_advance');

Route::get('/user_approver', function () {
    return view('user_approver');
})->name('user_approver');

// Route::get('/view_cash_advance', function () {
//     return view('view_cash_advance');
// })->name('view_cash_advance');

// CASH ADVANCE CONTROLLER
Route::get('/view_cash_advance', 'CashAdvanceController@view_cash_advance');
Route::get('/view_cash_advance_test', 'CashAdvanceController@view_cash_advance_test');
Route::get('/view_cash_advance_approved', 'CashAdvanceController@view_cash_advance_approved');
Route::get('/view_cash_advance_disapproved', 'CashAdvanceController@view_cash_advance_disapproved');
Route::get('/view_cash_advance_liquidated', 'CashAdvanceController@view_cash_advance_liquidated');
Route::post('/add_cash_advance', 'CashAdvanceController@add_cash_advance')->name('add_cash_advance');
Route::get('/get_employee_info', 'CashAdvanceController@get_employee_info');
Route::get('/get_payroll_account_by_user', 'CashAdvanceController@get_payroll_account_by_user');
Route::post('/edit_cash_advance', 'CashAdvanceController@edit_cash_advance');
Route::get('/get_cash_advance_by_id', 'CashAdvanceController@get_cash_advance_by_id');
Route::post('/approved_cash_advance', 'CashAdvanceController@approved_cash_advance')->name('approved_cash_advance');
Route::post('/disapproved_cash_advance', 'CashAdvanceController@disapproved_cash_advance')->name('disapproved_cash_advance');
Route::get('/get_president_id', 'CashAdvanceController@get_president_id');
Route::post('/add_president', 'CashAdvanceController@add_president')->name('add_president');
Route::get('/get_ca_no_records', 'CashAdvanceController@get_ca_no_records');
Route::get('/get_local_no', 'CashAdvanceController@get_local_no');
Route::get('/get_noted_by', 'CashAdvanceController@get_noted_by');
Route::get('/get_president', 'CashAdvanceController@get_president');
Route::get('/auto_generate_ca_no', 'CashAdvanceController@auto_generate_ca_no');
Route::post('/cashier_previous_advance', 'CashAdvanceController@cashier_previous_advance')->name('cashier_previous_advance');
Route::get('/get_previous_advance', 'CashAdvanceController@get_previous_advance')->name('get_previous_advance');
Route::post('/date_cash_received', 'CashAdvanceController@date_cash_received')->name('date_cash_received');
Route::get('/download_file/{id}', 'CashAdvanceController@download_file');
Route::get('/get_rapidx_user', 'CashAdvanceController@get_rapidx_user');
Route::post('/date_liquidated', 'CashAdvanceController@date_liquidated')->name('date_liquidated');


Route::get('/view_cash_advance_canceled', 'CashAdvanceController@view_cash_advance_canceled');
Route::post('/cancel_cash_advance', 'CashAdvanceController@cancel_cash_advance');

//USER APPROVER CONTROLLER
Route::get('/view_users', 'UserApproverController@view_users');
Route::post('/add_user', 'UserApproverController@add_user')->name('add_user');
Route::post('/edit_user', 'UserApproverController@edit_user');
Route::get('/get_user_by_id', 'UserApproverController@get_user_by_id');
Route::post('/change_user_stat', 'UserApproverController@change_user_stat')->name('change_user_stat');
Route::get('/get_section_head_approver', 'UserApproverController@get_section_head_approver');
Route::get('/get_department_head_approver', 'UserApproverController@get_department_head_approver');
Route::get('/get_cashier_approver', 'UserApproverController@get_cashier_approver');
Route::get('/get_treasury_head_approver', 'UserApproverController@get_treasury_head_approver');
Route::get('/get_finance_general_manager_approver', 'UserApproverController@get_finance_general_manager_approver');
Route::get('/get_president_approver', 'UserApproverController@get_president_approver');
Route::get('/load_rapidx_user_list', 'UserApproverController@load_rapidx_user_list');
Route::get('/get_supervisor_approver', 'UserApproverController@get_supervisor_approver');

//PDF CONTROLLER
Route::get('/view_pdf/{id}', 'ViewPdfController@view_pdf');

