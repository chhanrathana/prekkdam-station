<?php
namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RevenueItem;
use App\Models\RevenueType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{    
    public function index(Request $request)
    {
        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $revenueTypeId = $request->revenue_type_id;

        $query = RevenueItem::query();
        
       $query->when($revenueTypeId, function($query) use($revenueTypeId){
           $query->where('revenue_type_id', $revenueTypeId);
        });

    //    $query->when($fromDate, function($query) use($fromDate){
    //        $query->where('date','>=', $fromDate);
    //    });

    //    $query->when($toDate, function($query) use($toDate){
    //        $query->where('date','<=', $toDate);
    //     });
              
       $query->orderBy('date','desc');
       $records = $query->get();
       
       $types = RevenueType::all();

        return view('operations.revenues.index',[
            'records'=> $records,
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'types' => $types
        ]);
    }
  
    public function create()
    {            
        $types = RevenueType::all();
        
        return view('operations.revenues.create',[
            'types' => $types,
            'record' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([            
            'date'              => 'required',
            'revenue_type_id'   => 'required',            
            'amount'            => 'required|numeric',
            'description'       => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
            RevenueItem::create([
                'revenue_type_id' => $request->revenue_type_id,
                'amount' => $request->amount,
                'description' => $request->description,
                'date' => $request->date
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
        $record = RevenueItem::where('id', $id)->first();        
        $types = RevenueType::all();

        return view('operations.revenues.edit', [
            'record' => $record, 
            'types' => $types           
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'date'              => 'required',
            'revenue_type_id'   => 'required',            
            'amount' => 'required|numeric',
            'description' => 'required|string|max:250',
        ]);

        DB::beginTransaction();
        try {
            $revenue = RevenueItem::find($id);
            $revenue->revenue_type_id = $request->revenue_type_id;
            $revenue->amount = $request->amount;
            $revenue->description = $request->description;
            $revenue->date = $request->date;
            $revenue->save();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        RevenueItem::find($id)->delete();
        return redirect()->route('operation.revenue.index');
    }   
}