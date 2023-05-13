<?php
namespace App\Http\Controllers\Settings\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RevenueType;
use Illuminate\Support\Facades\DB;

class RevenueTypeController extends Controller
{    
    public function index()
    {
        $records = RevenueType::paginate(env('PAGINATION'));
        return view('settings.master-data.revenue-types.index',['records'=> $records]);
    }
  
    public function create()
    {            
        return view('settings.master-data.revenue-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([            
            'name_kh' => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
            RevenueType::create([
                'name_kh' => $request->name_kh,
                'name_en' => $request->name_en,
            ]);
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }
  
    public function edit($id)
    {
        $record = RevenueType::where('id', $id)->first();
        return view('settings.master-data.revenue-types.edit', [
            'record' => $record,
        ]);
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_kh' => 'required|string|max:250',
        ]);

        DB::beginTransaction();
        try {
            $record = RevenueType::find($id);
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
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
        RevenueType::find($id)->delete();
        return redirect()->route('setting.master-data.revenue-type.index');
    }   
}