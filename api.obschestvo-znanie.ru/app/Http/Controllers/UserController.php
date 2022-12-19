<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // http://127.0.0.1:8000/api/auth
    // {
    //     "name":"Коля",
    //     "password":"1111"
    // }
    public function authUser(Request $request) {

        $users = User::select('id','password')->where('name',$request->name)->get();

        $user_id = null;

        for ($i=0;$i<count($users);$i++) {
            if (Hash::check($request->password, $users[$i]->password)) {
                $user_id = $users[$i]->id;
                break;
            }
        }



        // $res = User::where('name',$request->name)
        //     ->where('password',$request->password)
        //     ->first();

        
      
        if ($user_id != null) {
            $token = Str::random(80);
            $res = User::where('id',$user_id)->update(['custom_token'=>$token]);
            if ($res) {
                return response()->json([
                    'status'=>'success',
                    'token'=>$token
                ]);
            } else {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Something went wrong (.'
                ]);
            }

        } else {
            return response()->json([
                'status'=>'notfound'
            ]);           
        }
    }
}
