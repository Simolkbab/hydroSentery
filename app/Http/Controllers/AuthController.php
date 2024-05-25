<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; 
use App\Models\Admin; 
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authentification.login');
    }

   
    public function login(Request $request)
    {
        // Validation des données du formulaire
        $credentials = $request->validate([
            'user_id' => 'required', // Changed from 'client_id' or 'email' to 'username'
            'password' => 'required',
        ]);

        // Vérification de l'authentification pour les administrateurs
        if (Auth::guard('admin')->attempt(['admin_id' => $credentials['user_id'], 'password' => $credentials['password']], $request->has('remember'))) {
            
            
            // Authentification réussie pour l'administrateur
            return redirect()->intended('/home');// Rediriger vers le tableau de bord admin
        }
        // Vérification de l'authentification pour les clients
        if (Auth::guard('client')->attempt(['client_id' => $credentials['user_id'], 'password' => $credentials['password']], $request->has('remember'))) {
            // Authentification réussie pour le client
            return redirect()->intended('/home');// Rediriger vers le tableau de bord client
        }

        // Authentification échouée pour l'administrateur ou le client
        return redirect()->back()->withErrors(['error' => "Le nom d'utilisateur ou le mot de passe est incorrect."])->withInput($request->only('user_id'));
    }


    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif(Auth::guard('client')->check()) {
            Auth::guard('client')->logout();
        }
    
        return redirect('/login');
    }
    
  
}






