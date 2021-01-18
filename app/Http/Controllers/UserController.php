<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['notifications', 'show', 'updateProfile', 'deleteAvatar','updatePassword' ]);
    }


    public function login()
    {
    	return view('auth.login');
    }

    public function register()
    {
    	return view('auth.register');
    }

    public function newUser(Request $request)
    {
    	$validated = $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required|confirmed|min:6',
        ]);

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
        ]);

        session()->flash("success", "Félicitations ! Votre compte à été crée avec succés, Vieullez s'identifier pour accéder à votre compte.");

        return view('auth.login');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();

            return redirect()->route('topics.index');
        }

        return back()->withErrors([
            'email' => 'Adresse E-mail ou Mot de Passe incorrect',
        ]);
    }

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }

    public function notifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        return view('topics.notifications', ['notifications' => auth()->user()->notifications()->paginate(4)]);
    }

    public function show()
    {
       $user = User::find(Auth::user()->id);
       return view('profile.show')->withUser($user);
    }

    public function updateProfile(Request $request)
    {
      $user = User::find(Auth::user()->id);
      $user->name = $request['name'];
      $user->email = $request['email'];
      if($request->hasFile('avatar')) {
          if($user->avatar && $user->avatar !== "default.jpg"){
            Storage::delete('/public/avatars/' . $user->avatar);
          }
          $filename = $request->avatar->getClientOriginalName();
          $request->avatar->storeAs('avatars', $filename, 'public');
          $user->avatar = $filename;
       }

      $user->save();
      return back()->with('success', 'Votre profile a été modifié avec succés');
    }

    public function deleteAvatar()
    {
        $user = User::find(Auth::user()->id);

        if($user->avatar !== "default.jpg")
        {
            Storage::delete('/public/avatars/' . $user->avatar);
            $user->avatar = "default.jpg";
        }
        else 
        {
            return back()->with('success', 'aucune photo de profile à supprimée');
        }

        $user->save();

        return back()->with('success', 'Votre photo de profile a été supprimée avec succés');        
    }

    public function updatePassword(Request $request)
    {
      $user = User::find(Auth::user()->id);

      if (Hash::check($request['old_password'], $user->password))
      {
        $user->password = Hash::make($request['new_password']);
        $user->save();
        return back()->with('success', 'Votre mot de passe a été modifié avec succés');
      }
      else
      {
        return back()->with('error', "l'ancien mot de passe est incorrect !");
      }
    }
}
