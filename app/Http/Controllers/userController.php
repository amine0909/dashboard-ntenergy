<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class userController extends Controller
{
    public function saveUpdate(Request $request){
        $this->validate($request,[
            "name"=> "required|string",
            "email" => "required|string|email|unique:users"
        ],
    
        [
            "name.required" => "Champs obligatoire",
            "name.string" => "Nom doit etre en texte brut",
            "email.required" => "Champs obligatoire",
            "email.email" => "Adresse email incorrect",
            "email.unique" => "Adresse email existe déja",
            "email.string" => "Adresse email doit etre en text brut"
        ]);

        $user = User::find(Auth::user()->id);
        $user->email = $request['email'];
        $user->name =  $request['name'];
        if($user->save()){
            $request->session()->flash('status', 'Modification avec success...!');
            return redirect()->back();
        }else{
            return redirect()->back();
        }

    }


    public function savePassword(Request $request){
        $this->validate($request, 
        [
            "pwd" => "required|string|min:8",
            "cpwd" => "required|string|min:8| same:pwd"
        ],
        [
            "pwd.required" => "Champs obligatoire",
            "pwd.string" => "Mot de passe doit etre en texte brut",
            "pwd.min" => "Mot de passe doit contenir au moins 8 caracters",

            "cpwd.required" => "Champs obligatoire",
            "cpwd.string" => "Mot de passe doit etre en texte brut",
            "cpwd.min" => "Mot de passe doit contenir au moins 8 caracters",
            "cpwd.same" => "Mot de passe doit etre identique"
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request['pwd']);
        if($user->save()){
            Auth::logout();
            return redirect('home');
        }
    }
}
