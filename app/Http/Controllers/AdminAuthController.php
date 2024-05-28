<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {   
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'admin_id' => 'required',
            'password' => 'required',
        ]);
        /*$admin = Admin::where('admin_id', $request->admin_id)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('profile.index');
        }
        return back()->withErrors([
            'admin_id' => 'Identifiant ou mot de passe incorrect.',
        ]);
        */

        if (Auth::guard('admin')->attempt(['admin_id' => $credentials['admin_id'], 'password' => $credentials['password']], $request->has('remember'))) {
            
            
            // Authentification réussie pour l'administrateur
            return redirect()->intended(route('profile.index'));// Rediriger vers le tableau de bord admin
        }
        return back()->withErrors([
            'admin_id' => 'Identifiant ou mot de passe incorrect.',
        ]);
        
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
