<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RaidDocRequest;
use App\Models\CaseManagement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Department;
use App\Models\Group;
use App\Models\RaidDocumentation;
use App\Models\SubDepartment;

class RaidDocController extends Controller
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view raid documentation', only: ['raidDocIndex']),
            new Middleware('permission:create raid documentation', only: ['raidDocCreate']),
            new Middleware('permission:edit raid documentation', only: ['raidDocEdit']),
            new Middleware('permission:delete raid documentation', only: ['raidDocDestroy']),
        ];
    }

    public function raidDocIndex(){
        $raid_docs = RaidDocumentation::with('department', 'subDepartment', 'group')->orderBy('id', 'desc')->get();
        // dd($tasks);
        return view('admin.raid_doc.index', compact('raid_docs'));
    }


    public function raidDocCreate()
    {
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        return view('admin.raid_doc.create', compact('sub_departments', 'departments', 'groups', 'cases'));
    }


    public function raidDocStore(RaidDocRequest $request)
    {
        $raid = new RaidDocumentation();
        $raid->auto_id = $request->auto_id;
        $raid->raid_type = $request->raid_type;
        $raid->location = $request->location;
        $raid->department_id = $request->department_id;
        $raid->sub_department_id = $request->sub_department_id;
        $raid->group_id = $request->group_id;
        $raid->case_id = $request->case_id;
        $raid->status = $request->status;
        $raid->date = $request->date;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('raidDoc', $filename, 'public');
            $raid->document = $path;
        }

        $raid->save();

        return to_route('raid.doc.index')->with('success', 'Raid Documentation Added Successfully');
    }


    public function raidDocEdit($id)
    {
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        $raid = RaidDocumentation::with('department', 'subDepartment', 'group')->where('id', $id)->first();
        // dd($task);

        return view('admin.raid_doc.edit', compact('raid','sub_departments', 'departments', 'groups', 'cases'));
    }


    public function raidDocView($id)
    {
        $raid = RaidDocumentation::with('department', 'subDepartment', 'group')->where('id', $id)->first();
        // dd($raid);
        return view('admin.raid_doc.view', compact('raid'));
    }


    public function raidDocUpdate(RaidDocRequest $request, $id)
    {
        $raid = RaidDocumentation::find($id);
        $raid->auto_id = $request->auto_id;
        $raid->raid_type = $request->raid_type;
        $raid->location = $request->location;
        $raid->department_id = $request->department_id;
        $raid->sub_department_id = $request->sub_department_id;
        $raid->group_id = $request->group_id;
        $raid->case_id = $request->case_id;
        $raid->status = $request->status;
        $raid->date = $request->date;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('raidDoc', $filename, 'public');
            $raid->document = $path;
        }
        $raid->update();

        return to_route('raid.doc.index')->with('success', 'Raid Documentation Updated Successfully');
    }



    public function raidDocDestroy($id)
    {
        $raid = RaidDocumentation::find($id);
        $raid->delete();
        return to_route('raid.doc.index')->with('success', 'Raid Documentation Deleted Successfully');
    }



    public function sortraidDoc(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $raids = RaidDocumentation::with('department', 'subDepartment', 'group')->orderBy('id', $sortFilter)->get();


        return response()->json($raids);
    }


    public function updateStatus(Request $request, $id)
    {
        $raids = Group::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $raids->status = $newStatus;
        $raids->save();

        return response()->json(['status' => $newStatus]);
    }
}
