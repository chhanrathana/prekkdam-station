<?php

namespace App\Http\Controllers\Settings\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sex;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use App\Models\StaffStatus;
use App\Models\Staff;

class StaffController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Staff::query();
        
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

        return view('settings.master-data.staffs.index', [
            'status' => StaffStatus::all(),
            'branches' => Branch::all(),
            'records' => $records
        ]);
    }

    public function create()
    {        
        return view('settings.master-data.staffs.create', [
            'status' => StaffStatus::all(),
            'code' => generateStaffCode()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kh' => 'required|max:255',
            'name_en' => 'required|max:255',
            'sex' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'date_format:d/m/Y',
            'start_work_date' => 'date_format:d/m/Y',
            'status' => 'required',
            'salary_amount' => 'numeric',
            'address' => 'nullable|max:500',
        ]);
    
        DB::beginTransaction();
        try {
            $record = new Staff();
            $record->code = generateStaffCode();
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
            $record->sex = $request->sex;
            $record->date_of_birth = $request->date_of_birth;
            $record->phone_number = $request->phone_number;
            $record->start_work_date = $request->start_work_date;
            $record->status = $request->status;
            $record->branch_id = $request->branch_id;
            $record->salary_amount = $request->salary_amount;
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
        return view('settings.master-data.staffs.edit', [
            'record' => Staff::find($id),
            'sexes' => Sex::all(),
            'status' => StaffStatus::all(),
            'branches' => Branch::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_kh' => 'required|max:255',
            'name_en' => 'required|max:255',
            'sex' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'date_format:d/m/Y',
            'start_work_date' => 'date_format:d/m/Y',
            'status' => 'required',
            'salary_amount' => 'numeric',
            'address' => 'nullable|max:500',
        ]);

        DB::beginTransaction();
        try {          
            $record = Staff::find($id);
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
            $record->sex = $request->sex;
            $record->date_of_birth = $request->date_of_birth;
            $record->phone_number = $request->phone_number;
            $record->start_work_date = $request->start_work_date;
            $record->status = $request->status;
            $record->branch_id = $request->branch_id;
            $record->salary_amount = $request->salary_amount;
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
        Staff::find($id)->delete();
        return redirect()->route('setting.master-data.staff.index');
    }
}