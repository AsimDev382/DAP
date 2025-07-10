<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            // new Middleware('permission:user', only: ['userIndex']),
            // new Middleware('permission:user', only: ['userCreate']),
            // new Middleware('permission:user', only: ['userDestroy']),
            // new Middleware('permission:user', only: ['userEdit']),

            new Middleware('permission:view user', only: ['userIndex']),
            new Middleware('permission:create user', only: ['userCreate']),
            new Middleware('permission:edit user', only: ['userEdit']),
            new Middleware('permission:delete user', only: ['userDestroy']),
        ];
    }
    public function userIndex()
    {
        $users = User::with('company')
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->orderBy('id', 'desc')
        ->get();
        // dd($users);
        // $users = User::with('company')->where(!$role)->get();
        // $users = UserAccount::all();

        return view('admin.user.index', compact('users'));
    }


    public function userCreate()
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();

        return view('admin.user.create', compact('companies', 'departments', 'sub_departments'));
    }


    public function userStore(UserRequest $request)
    {
        // dd($request->all());
        $user = new User();
        $user->auto_id = $request->auto_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_phone = $request->user_phone;
        $user->designation = $request->designation;
        $user->sub_department = $request->sub_department;
        $user->department_id = $request->department_id;
        $user->company_id = $request->company_id;
        $user->user_location = $request->user_location;
        $user->user_address = $request->user_address;
        $user->password = Hash::make($request->password);
        $user->detail = $request->detail;
        $user->status = 'Active';

        if ($request->hasFile('user_img')) {
            $file = $request->file('user_img');
            $filename = date('dmy') . '_user_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('User', $filename, 'public');
            $user->user_img = $path;
        }

        $user->save();

        return to_route('user.index')->with('success', 'User Added Successfully');
    }


    public function userEdit($id)
    {
        $user = User::find($id);
        // dd($user);
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();

        return view('admin.user.edit', compact('user', 'companies', 'departments', 'sub_departments'));
    }


    public function userView($id)
    {
        $user = User::with('company', 'department', 'subDepartment')->where('id', $id)->first();
        // dd($user);
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();

        return view('admin.user.view', compact('user', 'companies', 'departments', 'sub_departments'));
    }


    public function userUpdate(UserRequest $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        // $user->auto_id = $request->auto_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_phone = $request->user_phone;
        $user->designation = $request->designation;
        $user->sub_department = $request->sub_department;
        $user->department_id = $request->department_id;
        $user->company_id = $request->company_id;
        $user->user_location = $request->user_location;
        $user->user_address = $request->user_address;
        $user->password = Hash::make($request->password);
        $user->detail = $request->detail;

        if ($request->hasFile('user_img')) {
            $file = $request->file('user_img');
            $filename = date('dmy') . '_user_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('User', $filename, 'public');
            $user->user_img = $path;
        }
        $user->update();
        return to_route('user.index')->with('success', 'User Updated successfully');
    }

    public function userDestroy($id){
        $user = User::find($id);
        $user->delete();
        return to_route('user.index')->with('success', 'User Deleted successfully');
    }

    public function updateUserStatus(Request $request, $id)
    {
        $company = User::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }

    public function sortUser(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $user = User::with('company')
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->orderBy('id', $sortFilter)
        ->get();
        // dd($user);

        return response()->json($user);
    }
}
