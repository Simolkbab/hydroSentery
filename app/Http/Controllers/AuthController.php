<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; 
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    public function showLoginForm()
    {
        
        return view('authentification.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'client_id' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::guard('client')->attempt(['client_id' => $credentials['client_id'], 'password' => $credentials['password']], $request->has('remember'))) {
            // Authentification réussie
            $user = Auth::guard('client')->user();
            
            // Récupérer le chemin de la photo de profil
            $photoPath = Client::where('client_id', $user->client_id)->value('photo_path');
            
            
            return redirect()->intended('/home');
        } else {
            // Authentification échouée, rediriger avec un message d'erreur
            return redirect()->back()->withErrors(['error' => 'Identifiants incorrects'])->withInput($request->only('client_id'));
        }
        
        
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect('/login');
    }
    
  
}






