<?php

namespace App\Http\Controllers\Operations\Deposits;

use App\Enums\DepositStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Loan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use App\Models\DepositPayment;
use App\Models\DepositStatus;

class RequestController extends Controller
{    
    public function index(Request $request)
    {
        $records = $this->depositRequstService->getDeposits($request);
        $status = DepositStatus::all();

        return view('operations.deposits.requests.index',[
            'records' => $records,
            'status' => $status,
        ]);
    }

    public function create(Request $reqeust)
    {        
        $client = $this->clientService->getClientById($reqeust->selected);                      
        $clients = $this->clientService->getClients($reqeust);
               
        return view('operations.deposits.requests.create', [
            'client' => $client,
            'clients' => $clients,
        ]);
    }
 
    public function store(DepositRequest $request)
    {
        DB::beginTransaction();
        try {          
            $client = Client::find($request->client_id);            
            
            $record = $this->depositRequstService->createDeposit($request, $client);
            $this->depositPaymentService->createFristPayment($record);
            DB::commit();
            return redirect()->back()->with('success', __('message.success').' '.__('form.client_code').' '. $client->code);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $record = Deposit::find($id);

        return view('operations.deposits.requests.edit', [
            'record' => $record,
        ]);
    }

    public function update(DepositRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $client = Client::find($request->client_id);  
            $record = Deposit::find($request->deposit_id);
            if($record->status <> DepositStatusEnum::PENDING){
                return redirect()->back()->with('error', 'សន្សំកំពុងដំណើរការ! លេខកូដកម្ចី៖'  . $record->code);
            }  

            $record = $this->depositRequstService->createDeposit($request, $client);
            $this->depositPaymentService->createFristPayment($record);
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function show($id)
    {
        $record = Deposit::find($id);        
        
        return view('operations.deposits.requests.show',[
            'record' => $record,
        ]);
    } 

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $record = Deposit::find($id);
            DepositPayment::where('deposit_id', $id)->delete();
            $record->delete();        
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function export(Request $request)
    {
        $data = Loan::find($request->id);
        return Excel::download(new LoanExport($data), 'loan_payment.xlsx');
    }   
}