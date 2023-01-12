<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $check_user = User::where('email', $user->email)->first();
            if($check_user){
                Auth::login($check_user);
                return redirect()->intended('/');
            } else {
                $usr = User::latest()->first();
                if($usr){
                    $id = explode('-', $user->id_user);
                    $urutan = (int) $id[1];
                    $urutan++;
                } else {
                    $urutan = 1;
                }
                $id = 'USR-' . sprintf("%05s", $urutan);

                $new_user = new User();
                $new_user->id = $id;
                $new_user->firstname = $user->name;
                $new_user->email = $user->email;
                $new_user->password = Str::random(10);
                $new_user->save();

                Auth::login($new_user);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            // return redirect()->back();
        }
    }
}
