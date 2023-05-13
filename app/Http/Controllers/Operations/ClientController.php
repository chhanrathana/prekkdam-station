<?php

namespace App\Http\Controllers\Operations;

use App\Enums\ImageDir;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Loan;
use App\Http\Controllers\Controller;
use App\Models\LoanPayment;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Http\Requests\ClientRequest;
use App\Models\Commune;
use App\Models\District;
use App\Models\Village;

class ClientController extends Controller
{    
    public function index(Request $request)
    {    
        $clients = $this->clientService->getPaginateClients($request);    
        return view('operations.clients.index',[
            'clients' => $clients
        ]);
    }

    public function show($id)
    {
        $client = Client::find($id);
        return view('operations.clients.show',[
            'client' => $client
        ]);
    }

    public function create()
    {
        return view('operations.clients.create', [                  
            'client' => null,            
        ]);
    }

    public function store(ClientRequest $request)
    {
        DB::beginTransaction();
        try {
            $exist = $this->clientService->checkExistClient($request);
            if($exist){
                return redirect()->back()->with('error', 'អតិថិជនធ្លាប់មានម្តងរួចហើយដែលមានលេខកូដ '  . $exist->code);
            }
            $this->clientService->createClient($request);
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));  
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $districts = null;
        $communes = null;
        $villages = null;
        $client = Client::find($id);

        if($client){
            $districts = District::where('province_id', $client->village->commune->district->province->id)->get();
            $communes = Commune::where('district_id', $client->village->commune->district->id)->get();
            $villages = Village::where('commune_id', $client->village->commune->id)->get();            
        }   

        return view('operations.clients.edit', [
            'client' => $client,
            'districts' => $districts,
            'communes' => $communes,
            'villages' => $villages,
        ]);
    }

    public function update(ClientRequest $request, $id)
    {
        DB::beginTransaction();
        try {         
            $request->client_id = $id;
            $this->clientService->createClient($request);
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }
   
    public function updatePhoto(Request $request, $id)
    {
        DB::beginTransaction();
        try {         
            $client = Client::find($id);
            $client->photo = uploadImage($request->file, ImageDir::CLIENTS);     
            $client->save();
            DB::commit();
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        LoanPayment::where('loan_id', $id)->delete();
        $loan->delete();
        
        return redirect()->back();
    }

    public function printLoan($id){
        $province = Province::first();
        $loan = Loan::find($id);

        return view('operations.loans.print-loan',[
            'province' => $province,
            'loan' => $loan,
            'district' => $province->districts->find($loan->client->village->commune->district_id)
        ]);
    }
    
    public function export(Request $request)
    {
        $data = Loan::find($request->id);
        return Excel::download(new LoanExport($data), 'loan_payment.xlsx');
    }   
}