<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\WelcomeEmailNotification;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId()),
                    'role'=>4
                ]);
                $saveUser->notify(new WelcomeEmailNotification($saveUser));
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }


            Auth::loginUsingId($saveUser->id);

            //login after sign in
            switch (Auth::user()->role) {
                case 1:
                return redirect()->route('admin.home');
                    break;
                case 2:
                    return redirect()->route('teacher.home');
                    break;
                case 3:
                    return redirect()-> route('student.home');
                    break;
                case 4:
                    return redirect()-> route('user.home');
                    break;
                default:
                return redirect()->route('login'); //if user doesn't have any role
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}