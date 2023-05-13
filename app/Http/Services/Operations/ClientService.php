<?php

namespace App\Http\Services\Operations;

use App\Enums\ClientStatusEnum;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientService
{

    private function generateClientCode()
    {
        
        $count = DB::table('clients')
        ->where('branch_id', auth()->user()->branch_id)
        ->count();
        $code = (168 + $count);
        return str_pad($code, 5, '0', STR_PAD_LEFT);
    }

    public function checkExistClient($request){
        $client = Client::where(DB::raw('trim(lower(name_en))'), '=', Str::lower(trim($request->name_en)))
        ->where('village_id', $request->village_id)
        ->first(); 
        if($client){
            if($request->client_id == $client->id){
                return false;
            }
        }               
        return $client;
    }

    public function createClient($request)
    {       
        $client = Client::find($request->client_id);
        if(!$client){
            $client = new Client();
            $client->code = $this->generateClientCode();
            // new client is client do new loan first time
            $client->is_new = 1;
        }else{
            $client->is_new = 0; 
        }

        $client->fill($request->only([
            'name_kh', 'name_en', 'sex', 'date_of_birth', 'phone_number', 'village_id','id_card_no','client_type_id'
        ]));
        $client->user_id = auth()->user()->id??null;
        $client->branch_id = $request->branch_id;
        $client->status = ClientStatusEnum::ACTIVE;        
        $client->save();
        return $client;
    }

    public function getClients(Request $request){
        $query = Client::query();
        
        if(!$request->code && !$request->name){
            $query->where('code', 'NA');
        }

        $query->when($request->code, function ($q) use ($request) {
            $code = mb_strtoupper(trim($request->code));
            $q->where('code', $code);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->where('name_kh', 'like', '%' . $name . '%');
            $q->orWhere('name_en', 'like', '%' . $name . '%');
        });

        $query->when($request->name_kh, function ($q) use ($request) {
            $nameKh = mb_strtoupper(trim($request->name_kh));
            $q->where('name_kh', 'like', '%' . $nameKh . '%');
        });

        $query->when($request->name_en, function ($q) use ($request) {
            $nameEn = mb_strtoupper(trim($request->name_en));
            $q->where('name_en', 'like', '%' . $nameEn . '%');
        });        

        $query->orderByDesc('updated_at');

        
        return $query->get();
    }

    public function getPaginateClients(Request $request){
        $query = Client::query();
             
        $query->when($request->code, function ($q) use ($request) {
            $code = mb_strtoupper(trim($request->code));
            $q->where('code', $code);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->where('name_kh', 'like', '%' . $name . '%');
            $q->orWhere('name_en', 'like', '%' . $name . '%');
        });

        $query->when($request->name_kh, function ($q) use ($request) {
            $nameKh = mb_strtoupper(trim($request->name_kh));
            $q->where('name_kh', 'like', '%' . $nameKh . '%');
        });

        $query->when($request->name_en, function ($q) use ($request) {
            $nameEn = mb_strtoupper(trim($request->name_en));
            $q->where('name_en', 'like', '%' . $nameEn . '%');
        });        

        $query->orderByDesc('updated_at');

        return $query->paginate(env('PAGINATION'));
    }

    public function getClientById($id)
    {
        return Client::find($id);
    }
}
