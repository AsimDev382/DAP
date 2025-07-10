<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:permission', only: ['permissionIndex']),
    //         new Middleware('permission:permission', only: ['permissionCreate']),
    //         new Middleware('permission:permission', only: ['permissionDestroy']),
    //         new Middleware('permission:permission', only: ['permissionEdit']),
    //     ];
    // }

    public function permissionIndex()
    {
        // $users = User::with('roles', 'permissions')->get();
        // $users = User::with('roles', 'permissions')
        // ->whereHas('permissions') // only users who have at least one permission
        // ->get();

        $users = User::with('roles', 'permissions', 'company')
        ->whereHas('permissions') // users who have at least one permission
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->get();

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.permission.index', compact('users', 'roles', 'permissions'));
    }


    public function permissionCreate()
{
    // Group permissions by module name (everything after the first word)
    $permissions = Permission::all()->groupBy(function ($permission) {
        $parts = explode(' ', $permission->name);

        if (count($parts) <= 1) {
            return ucfirst($permission->name);
        }

        array_shift($parts); // remove 'view', 'create', etc.
        return ucfirst(implode(' ', $parts)); // e.g., 'Company'
    });

    $users = User::with('roles')
    ->whereDoesntHave('roles', function ($query) {
        $query->where('name', 'superadmin');
    })
    ->get();

    return view('admin.permission.create', compact('permissions', 'users'));
}

    // public function getUserPermissions($id)
    // {
    //     $user = User::with('permissions')->findOrFail($id);
    //     return response()->json($user->permissions->pluck('name'));
    // }

    public function getPermissions($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $permissions = $user->getPermissionNames(); // Returns a collection
        return response()->json([
            'permissions' => $permissions
        ]);
    }

    public function permissionAssign(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->syncPermissions($request->permissions ?? []);

        return to_route('permission.index')->with('success', 'Permissions updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Remove assigned roles first
        $user->roles()->detach(); // If you're using Spatie

        // Delete the user
        $user->delete();

        return redirect()->route('permission.index')->with('success', 'User deleted successfully.');
    }



    // public function permissionEdit($id)
    // {
    //     $users = User::with('roles', 'permissions')->where('id', $id)->get();
    //     $roles = Role::all();
    //     $permissions = Permission::all();

    //     return view('admin.permission.edit', compact('users', 'roles', 'permissions'));
    // }

    // public function permissionupdate(Request $request, User $user)
    // {
    //     // dd($request->all());
    //     $user->syncRoles($request->roles ?? []);
    //     $user->syncPermissions($request->permissions ?? []);

    //     return to_route('permission.index')->with('success', 'User roles and permissions updated.');
    // }




//     public function permissionIndex()
// {
//     $users = UserAccount::with('roles', 'permissions')->get();
//     $roles = Role::all();
//     $permissions = Permission::all();

//     return view('admin.permission.index', compact('users', 'roles', 'permissions'));
// }

// public function permissionEdit($id)
// {
//     $users = UserAccount::with('roles', 'permissions')->where('id', $id)->get();
//     $roles = Role::all();
//     $permissions = Permission::all();

//     return view('admin.permission.edit', compact('users', 'roles', 'permissions'));
// }

//     public function permissionupdate(Request $request, UserAccount $user)
//     {
//         $user->syncRoles($request->roles ?? []);
//         $user->syncPermissions($request->permissions ?? []);

//         return to_route('permission.index')->with('success', 'User roles and permissions updated.');
//     }
}
