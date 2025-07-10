<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvidenceRequest;
use App\Models\CaseManagement;
use App\Models\Evidence;
use App\Models\EvidenceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EvidenceController extends Controller
{
    public static function middleware(): array
    {
        return [
                new Middleware('permission:view evidence', only: ['evidenceIndex']),
                new Middleware('permission:create evidence', only: ['evidenceCreate']),
                new Middleware('permission:edit evidence', only: ['evidenceEdit']),
                new Middleware('permission:delete evidence', only: ['evidenceDestroy']),
            ];
    }

    public function evidenceIndex()
    {
        $user = Auth::user();

        $evidences = Evidence::with('case.product', 'case.brand', 'case.company')->get();

        // $evidences = Evidence::with('product', 'company')
        //     ->when(!$isSuperAdmin, function ($query) use ($user) {
        //         $query->where('company_id', $user->company_id); // Filter by user_id
        //     })
        //     ->orderBy('id', 'desc')
        //     ->get();

        // dd($user->id, $user->company_id, $user->roles()->pluck('name'));

        return view('admin.evidence.index', compact('evidences'));
    }

    public function evidenceCreate()
    {
        $cases = CaseManagement::all();

        return view('admin.evidence.create', compact('cases'));
    }


    public function evidenceStore(EvidenceRequest $request)
    {
        $evidence = new Evidence();
        $evidence->auto_id = $request->auto_id;
        $evidence->client_id = $request->client_id;
        $evidence->case_id = $request->case_id;
        // $evidence->case_detail = $request->case_detail;
        $evidence->save();

        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $index => $file) {
                $filename = date('dmy_His') . "_{$index}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('Evidence', $filename, 'public');

                EvidenceImage::create([
                    'evidence_id' => $evidence->id,
                    'image_path' => $path,
                ]);
            }
        }


        return to_route('evidence.index')->with('success', 'Evidence Added Successfully');
    }


    public function evidenceEdit($id)
    {
        $evidence = Evidence::with('images')->where('id', $id)->first();
        // dd($evidence);
        $cases = CaseManagement::all();

        return view('admin.evidence.edit', compact('evidence', 'cases'));
    }


    public function evidenceView($id)
    {
        $evidence = Evidence::with('images')->where('id', $id)->first();
        $cases = CaseManagement::all();

        // $evidence = Evidence::find($id);
        $case = CaseManagement::where('id', $evidence->case_id)->first();
        // dd($evidence);
        return view('admin.evidence.view', compact('evidence','case'));
    }


    public function evidenceUpdate(EvidenceRequest $request, $id)
    {
        $evidence = Evidence::find($id);
        $evidence->auto_id = $request->auto_id;
        $evidence->client_id = $request->client_id;
        $evidence->case_id = $request->case_id;
        // $evidence->case_detail = $request->case_detail;
        $evidence->update();

        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $index => $file) {
                $filename = date('dmy_His') . "_{$index}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('Evidence', $filename, 'public');

                EvidenceImage::create([
                    'evidence_id' => $evidence->id,
                    'image_path' => $path,
                ]);
            }
        }

        return to_route('evidence.index')->with('success', 'Evidence Updated Successfully');
    }



    public function evidenceDestroy($id)
    {
        // dd($id);
        $evidence = Evidence::find($id);
        $evidence->delete();
        $image = EvidenceImage::where('evidence_id', $id)->delete();

        return to_route('evidence.index')->with('success', 'Evidence Deleted Successfully');
    }


    public function getevidenceData($id)
    {
        $evidence = Evidence::with('product', 'company', 'brand')->find($id);
        // dd($evidence);
        if ($evidence) {
            return response()->json([
                'evidence_type' => $evidence->evidence_type,
                'brand_id' => $evidence->brand,
                'product_id' => $evidence->product,
                'company_id' => $evidence->company,
            ]);
        } else {
            return response()->json([
                'evidence_type' => '',
                'brand_id' => '',
                'product_id' => '',
                'company_id' => '',
            ]);
        }
    }




    public function sortEvidence(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
            $evidence = Evidence::with('case.product', 'case.brand', 'case.company')->orderBy('id', $sortFilter)
            ->get();

        // Return JSON response to be handled by AJAX
        return response()->json($evidence);
    }
}
