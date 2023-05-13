<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
   
    public function index()
    {
        return view('auth.profiles.index', ['user' => auth()->user()]);
    }
   
    public function store(Request $request)
    {

        $image = $request->file;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $avatar ='avatar/'. Str::uuid().'.'.'png';
        Storage::disk('local')->put('public/'.$avatar, base64_decode($image));

        $user = User::find(auth()->user()->id);
        $user->avatar = $avatar;
        $user->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function edit($id)
    {
        return view('auth.profiles.edit', ['user' => auth()->user()]);
    }

    
    public function update(Request $request, $id)
    {

        try {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;

            if ($user->password != $request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->route('setting.profile.index');
        } catch (\Exception $exception) {
            DB::rollBack();

        }
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|min:4|max:100',
            'new_password' => 'required|min:4|max:100|confirmed',
        ]);

        try {
            DB::beginTransaction();
            auth()->user()->update([
                'password' => Hash::make($request->new_password),
            ]);

            DB::commit();
            exit;
            return redirect()->back()->with('success', __('message.success'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}