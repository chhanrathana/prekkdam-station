<?php
namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpenseItem;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{    
    public function index(Request $request)
    {
        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $expenseTypeId = $request->expense_type_id;

        $query = ExpenseItem::query();
        
       $query->when($expenseTypeId, function($query) use($expenseTypeId){
           $query->where('expense_type_id', $expenseTypeId);
        });

    //    $query->when($fromDate, function($query) use($fromDate){
    //        $query->where('date','>=', $fromDate);
    //    });

    //    $query->when($toDate, function($query) use($toDate){
    //        $query->where('date','<=', $toDate);
    //     });
              
       $query->orderBy('date','desc');
       $records = $query->get();
       $types = ExpenseType::all();

        return view('operations.expenses.index',[
            'records'=> $records,
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'types' => $types,
        ]);
    }
  
    public function create()
    {            
        $types = ExpenseType::all();
        
        return view('operations.expenses.create',[
            'types' => $types,
            'record' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([            
            'date'              => 'required',
            'expense_type_id'   => 'required',            
            'amount'            => 'required|numeric',
            'description'       => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
            ExpenseItem::create([
                'expense_type_id' => $request->expense_type_id,
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
        $record = ExpenseItem::where('id', $id)->first();        
        $types = ExpenseType::all();

        return view('operations.expenses.edit', [
            'record' => $record, 
            'types' => $types           
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'date'              => 'required',
            'expense_type_id'   => 'required',            
            'amount' => 'required|numeric',
            'description' => 'required|string|max:250',
        ]);

        DB::beginTransaction();
        try {
            $expense = ExpenseItem::find($id);
            $expense->expense_type_id = $request->expense_type_id;
            $expense->amount = $request->amount;
            $expense->description = $request->description;
            $expense->date = $request->date;
            $expense->save();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        ExpenseItem::find($id)->delete();
        return redirect()->route('operation.expense.store');
    }   
}