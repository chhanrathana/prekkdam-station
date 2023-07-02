<?php
namespace App\Http\Controllers\Settings\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OilType;
use Illuminate\Support\Facades\DB;

class OilTypeController extends Controller
{    
    public function index()
    {
        $records = OilType::paginate(env('PAGINATION'));
        return view('settings.master-data.oil-types.index',['records'=> $records]);
    }
  
    public function create()
    {            
        return view('settings.master-data.oil-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([            
            'name_kh' => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
            OilType::create([
                'name_kh' => $request->name_kh,
                'name_en' => $request->name_en,
                'liter_of_ton' => $request->liter_of_ton,
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
        $record = OilType::where('id', $id)->first();
        return view('settings.master-data.oil-types.edit', [
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
            $record = OilType::find($id);
            $record->name_kh = $request->name_kh;
            $record->name_en = $request->name_en;
            $record->liter_of_ton = $request->liter_of_ton;
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
        OilType::find($id)->delete();
        return redirect()->route('setting.master-data.oil-type.index');
    }   
}