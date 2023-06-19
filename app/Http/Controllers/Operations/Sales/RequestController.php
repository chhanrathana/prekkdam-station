<?php

namespace App\Http\Controllers\Operations\Sales;

use App\Enums\LoanStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Loan;
use App\Models\LoanStatus;
use App\Http\Controllers\Controller;
use App\Models\LoanPayment;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Http\Requests\LoanRequest;
use App\Http\Requests\OilSaleRequest;
use App\Models\OilSale;

class RequestController extends Controller
{        
    public function index(Request $request)
    {
        $records = $this->saleRequstService->getSales($request);
        $status = LoanStatus::all();

        return view('operations.sales.requests.index',[            
            'records'   => $records,
            'status'    => $status,
        ]);
    }

    public function create()
    {                       
        return view('operations.sales.requests.create', [
            'code'          => generateOilSaleCode(),
            'currentDate'   => $this->currentDate,
            'types'         => $this->getOnsaleOils(),
            'shifts'        => $this->getWorkShifts(),
        ]);
    }
 
    public function store(OilSaleRequest $request)
    {        
        DB::beginTransaction();
        try {          
            $this->saleRequstService->createSale($request); 
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $record = OilSale::find($id);

        return view('operations.sales.requests.edit', [
            'record' => $record,
        ]);
    }

    public function update(LoanRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $client = Client::find($request->client_id);
            
            $record =Loan::find($request->loan_id);
            if($record->status <> LoanStatusEnum::PENDING){
                return redirect()->back()->with('error', 'កម្ចីកំពុងដំណើរការ! លេខកូដកម្ចី៖'  . $record->code);
            }  
            $record = $this->loanRequstService->createLoan($request, $client);                        
            $this->loanPaymentSevice->createFristPayment($record);
            DB::commit();            
            return redirect()->back()->with('success', __('message.success').' '.__('form.loan_code').' '. $client->code);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function show($id)
    {
        $record = Loan::find($id);

        return view('operations.loans.requests.show',[
            'record' => $record
        ]);
    } 

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $record = Loan::find($id);
            LoanPayment::where('loan_id', $id)->delete();
            $record->delete();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }
  
    public function download(Request $request){
        $record = Loan::find($request->id);
        $title = $record->client->name_kh .'_'.$record->principal_amount.'KHR';
        $html = view('operations.loans.requests.print',['record' => $record]);
        return $this->pdfService->reportPDF($html, $title = 'កាលវិភាគបង់ប្រាក់_'.$title, $orientation = 'P', $font = 12, $printCard = false, $mt = 10, $ml = 10, $mr = 10);
    }

    public function export(Request $request)
    {
        $data = Loan::find($request->id);
        return Excel::download(new LoanExport($data), 'loan_payment.xlsx');
    }   
}