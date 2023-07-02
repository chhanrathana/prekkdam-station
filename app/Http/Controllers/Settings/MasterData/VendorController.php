<?php

namespace App\Http\Controllers\Settings\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sex;
use App\Http\Requests\StoreStaffRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Vendor;
use App\Models\VendorStatus;

class VendorController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Vendor::query();
        
        $query->when($request->code, function ($q) use ($request) {
            $code = mb_strtoupper(trim($request->code));
            $q->where('code', $code);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->where('name_kh', 'like', '%' . $name . '%');
            $q->orWhere('name_en', 'like', '%' . $name . '%');
        });
        $records = $query->paginate(env('PAGINATION'));
        
        return view('settings.master-data.vendors.index', [            
            'records' => $records
        ]);
    }

    public function create()
    {        
        return view('settings.master-data.vendors.create', [
            'status' => VendorStatus::all(),
            'sexes' => Sex::all(),
            'code' => generateVendorCode()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kh' => 'required|max:255',
            'name_en' => 'required|max:255',
            'sex' => 'required',
            'phone_number' => 'required',
            'status' => 'required',
            'address' => 'nullable|max:500',
        ]);
    
        DB::beginTransaction();
        try {
            $record = new Vendor();
            $record->code = generateVendorCode();
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
            $record->sex = $request->sex;
            $record->phone_number = $request->phone_number;            
            $record->status = $request->status;
            $record->branch_id = $request->branch_id;
            $record->address = $request->address;
            $record->save(); 
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }       
    }

    public function edit($id)
    {        
        return view('settings.master-data.vendors.edit', [
            'record' => Vendor::find($id),
            'sexes' => Sex::all(),
            'status' => VendorStatus::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_kh' => 'required|max:255',
            'name_en' => 'required|max:255',
            'sex' => 'required',
            'phone_number' => 'required',
            'status' => 'required',
            'address' => 'nullable|max:500',
        ]);

        DB::beginTransaction();
        try {          
            $record = Vendor::find($id);
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
            $record->sex = $request->sex;
            $record->phone_number = $request->phone_number;
            $record->status = $request->status;
            $record->branch_id = $request->branch_id;
            $record->address = $request->address;
            $record->save();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        Vendor::find($id)->delete();
        return redirect()->route('setting.master-data.vendor.index');
    }
}