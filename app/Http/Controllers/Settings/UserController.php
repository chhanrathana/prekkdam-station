<?php
namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $records = User::paginate(env('PAGINATION'));

        return view('settings.users.index',[
            'records'=> $records
        ]);
    }
   
    public function create()
    {       
        $types = UserType::all();  

        return view('settings.users.create', [
            'types' => $types,
        ]);
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name_kh' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8'
        ]);

        DB::beginTransaction();
        try {
            
            User::create([
                'name_kh' => $request->name_kh,
                'email' => $request->email,
                'user_type_id' => $request->user_type_id,
                'password' => Hash::make($request->password),
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
        $types = UserType::all();  
        $record = User::find($id);

        return view('settings.users.edit', [
            'types' => $types,
            'record'  => $record
        ]);
    }

    
    public function update(Request $request, $id)
    {    
        $request->validate([
            'name_kh' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users'. ',id,' . $id,
            'password' => 'nullable|string|min:8'
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->name_kh = $request->name_kh;
            $user->email = $request->email;
            $user->user_type_id = $request->user_type_id;
            $user->branch_id = $request->branch_id;
            if(trim($user->password) != null){
                $user->password = Hash::make($request->password);
            }            
            $user->save();           
            DB::commit();
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', __('message.failed') . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        if(!auth()->user()->user_type_id ){
            return view('errors.403');    
        }
        User::find($id)->delete();
        return redirect()->route('setting.user.index');
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name_kh = $request->name_kh;

        if ($user->password != $request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('profile');
    }
}