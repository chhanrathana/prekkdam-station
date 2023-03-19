<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\CustomerRequest;
use App\Models\MasterData\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    
    public function index()
    {        
        $items = Customer::all();        
        return view('master-data.customers.index', [
            'items' => $items
        ]);
    }
   
    public function create()
    {
        return view('master-data.customers.
        create', [
            'code' => $this->generateCustomerCode(),
            'sexes' => $this->getSexes(),
        ]);
    }
  
    public function store(CustomerRequest $request)
    {       
        DB::beginTransaction();
        try {            
            $input = $request->all();            
            $model = new Customer();
            $model->fill($input);
            $model->save();
            
            DB::commit();
            return redirect()->back()->with('success', 'បានបញ្ចូល');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
      
    public function edit($id)
    {
        $item = Customer::find($id);
        return view('master-data.customers.edit', [
            'item' => $item,           
            'sexes' => $this->getSexes(),           
        ]);
    }
    
    public function update(CustomerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $model = Customer::findOrFail($id);
            $model->fill($request->all());
            $model->save();
            
            DB::commit();
            return redirect()->back()->with('success', 'បានកែប្រែ');
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {            
            Customer::findOrFail($id)->delete();
            DB::commit(); 
            return redirect()->back()->with('success', 'ជោគជ័យ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }  
    } 
}
