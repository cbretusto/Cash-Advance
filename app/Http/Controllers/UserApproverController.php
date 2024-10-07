<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

// MODEL
use App\RapidXUser;
use App\UserApprover;
use App\OnlineCashAdvance;
use App\SystemOneSupervisor;

class UserApproverController extends Controller
{
    //============================== VIEW USERS ==============================
    public function view_users(){
        $users = UserApprover::with(['rapidx_user_details'])->where('logdel',0)->get();
            // return $users[0]->rapidx_user_details->name;
        return DataTables::of($users)
        ->addColumn('fullname',function($user){
            $result = $user->rapidx_user_details->name;
            return $result;
        })

        ->addColumn('username',function($user){
            $result = $user->rapidx_user_details->username;
            return $result;
        })     

        ->addColumn('emp_email',function($user){
            $result = $user->rapidx_user_details->email;
            return $result;
        })

        ->addColumn('status', function($user){
            $result = "<center>";
            if($user->status == 1){
                $result .= '<span class="badge badge-pill badge-success">Active</span>';
            }
            else{
                $result .= '<span class="badge badge-pill badge-danger">Inactive</span>';
            }
                $result .= '</center>';
                return $result;
        })

        ->addColumn('action', function($user){
            $result = '<center><div class="btn-group">
                        <button type="button" class="btn btn-dark dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-lg fa-users-cog"></i> 
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">'; // dropdown-menu start
            if($user->status == 1){
                $result .= '<button class="dropdown-item text-center actionEditUser" type="button" user-id="' . $user->id . '" data-toggle="modal" data-target="#modalEditUser" data-keyboard="false">Edit</button>';
                $result .= '<button class="dropdown-item text-center actionChangeUserStat" type="button" user-id="' . $user->id . '" status="2" data-toggle="modal" data-target="#modalChangeUserStat" data-keyboard="false">Deactivate</button>';
            }else{
                $result .= '<button class="dropdown-item text-center actionChangeUserStat" type="button" user-id="' . $user->id . '" status="1" data-toggle="modal" data-target="#modalChangeUserStat" data-keyboard="false">Activate</button>';
            }
                $result .= '</div>'; // dropdown-menu end
                $result .= '</div></center>';
                return $result;
        })
            ->rawColumns(['status', 'action']) // to format the added columns(status & action) as html format
            ->make(true);
    }

    //============================== ADD USER ==============================
    public function add_user(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $rules = [
            'classification' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                $user_id = UserApprover::insert([
                    'employee_no' => $request->employee_no,
                    'rapidx_id' => $request->rapidx_user,
                    'classification' => $request->classification,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                DB::commit();
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                return response()->json(['result' => $e]);
            }
        }
    }

    //============================== GET SECTION HEAD ==============================
    public function get_section_head_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','Section Head')->where('status', 1)->get();
    // return $user_approvers;
        return response()->json(['user_approvers' => $user_approvers]);
    }

    //============================== GET DEPARTMENT HEAD ==============================
    public function get_department_head_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','Department Head')->where('status', 1)->get();
        // return $user_approvers;
        return response()->json(['user_approvers' => $user_approvers]);
    }

     //============================== GET CASHIER APPROVER ==============================
    public function get_cashier_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','Cashier')->where('status', 1)->get();
        // dd($user_approvers);
        return response()->json(['user_approvers' => $user_approvers]);
    }

    //============================== GET TREASURY HEAD  ==============================
    public function get_treasury_head_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','Treasury Head')->where('status', 1)->get();
        // dd($user_approvers);
        return response()->json(['user_approvers' => $user_approvers]);
    }

    //============================== GET FINANCE GENERAL MANAGER ==============================
    public function get_finance_general_manager_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','Finance General Manager')->where('status', 1)->get();
        // dd($user_approvers);
        //   return  $user_approvers;
        return response()->json(['user_approvers' => $user_approvers]);
    }

    //============================== GET PRESIDENT ==============================
    public function get_president_approver(Request $request){
        $user_approvers = UserApprover::with(['rapidx_user_details'])->where('classification','President')->where('status', 1)->get();
        // dd($user_approvers);
        // return  $user_approvers;
        return response()->json(['user_approvers' => $user_approvers]);
    }

    //============================== EDIT USER ==============================
    public function edit_user(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'classification' => 'required|string|max:255',
            'employee_no' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            /* DB::beginTransaction();*/
            try{
                UserApprover::where('id', $request->user_id)
                ->update([ // The update method expects an array of column and value pairs representing the columns that should be updated.
                    'rapidx_id' => $request->rapidx_user,
                    'employee_no' => $request->employee_no,
                    'classification' => $request->classification,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                
                /*DB::commit();*/
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0", 'tryCatchError' => $e]);
            }
        }
    }

    //============================== GET USER BY ID TO EDIT ==============================
    public function get_user_by_id(Request $request){
        $user = UserApprover::with('rapidx_user_details')->where('id', $request->user_id)->get(); // get all users where id is equal to the user-id attribute of the dropdown-item of actions dropdown(Edit)
        // return $user[0]->rapidx_user_details->name;
        return response()->json(['user' => $user]);  // pass the $user(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== CHANGE USER STAT ==============================
    public function change_user_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            UserApprover::where('id', $request->user_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    public function load_rapidx_user_list(Request $request)
    {
        if($request->selectedEmployee == ''){
            $users = RapidXUser::where('user_stat', 1)->orderBy('name','asc')->whereNotIn('name',['Admin','Test QAD Admin Approver'])->get();
            return response()->json(['users' => $users]);
        }else{
            $user = RapidXUser::where('user_stat', 1)->where('id', $request->selectedEmployee)->get('employee_number');
            return response()->json(['user' => $user]);
        }
    }

    //====================================== GET SUPERVISOR ======================================
    public function get_supervisor_approver(Request $request){
        $supervisor = SystemOneSupervisor::orderBy('emp_name', 'ASC')->get();
        // return $supervisor;
        return response()->json(["supervisor" => $supervisor]);
    }
}
