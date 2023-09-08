<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class PassportAuthController extends Controller
{
    Public Function register(Request $request)
    {

    $request->Validate(
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults(),]
        ]
        );


        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
            );

            $token = $user->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 200);
    }

    Public Function login(Request $request)
    {

        $credencials = [
           'email' => $request->email,
           'password' => $request->password
        ];


        if(auth()->attemp($credencials)){
            $token = Auth->user()->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 200);
        }else{
            return response()->json(['error' => 'Credenciales erroneas']);
        }
    }

    Public Function logout(){
        $token = auth()->user()->token();
        $token->revoke();
        return response()->json(['success' => 'Se cerro sesion de manera exitosa']);
    }


}
