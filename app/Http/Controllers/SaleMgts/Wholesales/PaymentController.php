<?php

namespace App\Http\Controllers\SaleMgts\Wholesales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\AddPaymentRequest;
use App\Http\Requests\SaleMgts\AddProductRequest;
use App\Models\Payments\Payment;
use App\Models\Payments\PaymentMethod;
use App\Models\SaleMgts\Wholesale;
use App\Models\SaleMgts\WholesaleProduct;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    
    public function index()
    {
        $items = Wholesale::all();
        return view('sale-mgts.wholesales.payments.index', [
            'items' => $items
        ]);
    }

    public function create($id)
    {        
        $item = Wholesale::find($id);
        return view('sale-mgts.wholesales.payments.create',[
            'item' => $item,
            'code' => $this->getWholesaleCode(),
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getProducts(),
            'paymentMethods' => PaymentMethod::all()
        ]);
    }
   
    public function edit($id)
    {        
        $item = Wholesale::find($id);
        return view('sale-mgts.wholesales.payments.edit',[
            'item' => $item,
            'code' => $this->getWholesaleCode(),
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getProducts(),
        ]);
    }

    public function editPayment($id, $paymentId)
    {
        $item = Wholesale::find($id);
        
        $_payment = Payment::find($paymentId);
        
        return view('sale-mgts.wholesales.payments.edit',[          
            'item' => $item,
            '_payment' => $_payment,            
            'clients' => $this->getClients(),
            'branches' => $this->getBranches(),
            'drivers' => $this->getDrivers(),
            'vehicles' => $this->getVehicles(),
            'products' => $this->getProducts(),
            'paymentMethods' => PaymentMethod::all()
        ]);
    }

    public function storePayment(AddPaymentRequest $request, $id = null)
    {   DB::beginTransaction();
        try {            
            $input = $request->all();                   
            $payment = Payment::find($id);
            if(!$payment){
                $payment = new Payment();
            }
            $payment->fill($input);
            $payment->save();
            
            $wholesale = Wholesale::where('code',$payment->reference_number)->first();
            $wholesale->paid_amount = $wholesale->payments->sum('paid_amount');
            $wholesale->save();
            DB::commit();

            DB::commit();
            return redirect()->route('sale-mgts.wholesale.payment.edit',[
                'id' => $payment->wholesale_id,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();           
            return redirect()->back()->with('error', $exception->getMessage());
        } 
    }            
}