<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function authUser(Request $request) {
        $token = Str::random(80);

        $res = User::where('name',$request->name)
            ->where('password',$request->password)
            ->first();
      
        if ($res != null) {
            $res = User::where('name',$request->name)
                    ->where('password',$request->password)
                    ->update(['custom_token'=>$token]);
            return response()->json([
                'status'=>'success',
                'token'=>$token
            ]);
        } else {
            return response()->json([
                'status'=>'notfound'
            ]);           
        }
        
        // $res = User::query()->create([
        //     'name'=>$request->name,
        //     'password'=>bcrypt($request->pass),
        //     'email'=>$request->email,
        //     'custom_token'=>$token
        // ]);
        // return response()->json([
        //     'status'=>'success',
        //     'token'=>$token
        // ]);

    }

}
