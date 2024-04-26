<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class Profile_siteController extends Controller
{
    public function show()
    {
        // Check if the user is logged in
 
            $user = Auth::guard('client')->user();
            $photoPath = Client::where('client_id', $user->client_id)->value('photo_path');
            
            return view('profile.profile', ['user' => $user, 'photoPath' => $photoPath]);
       
    }
    public function deleteProfileImage(Request $request)
    {
        $user = auth()->guard('client')->user();


        if ($user->photo_path && $user->photo_path !== 'profile_photos/default_profile.png') {
           storage::disk('public')->delete($user->photo_path);
        }
    
        // Update the user's photo_path in the database
        $user->photo_path = 'profile_photos/default_profile.png';
        $user->save();

        return redirect()->back()->with('success', 'Profile image deleted successfully.');
    }
    

    public function updateProfileImage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Max size set to 5MB (5120 KB)
        ]);
    
        // Get the authenticated user
        $user = auth()->guard('client')->user();
    
        // Check if a new profile image is uploaded
        if ($request->hasFile('profile_image')) {
            // Get the uploaded file
            $profileImage = $request->file('profile_image');
    
            // Check file size
            if ($profileImage->getSize() > 5120000) { // 5MB in bytes
                return redirect()->back()->with('error', 'The profile image exceeds the maximum allowed size of 5MB.')->withInput();
            }
    
            // Delete the old profile image if it exists and it's not the default image
            if ($user->photo_path && $user->photo_path !== 'profile_photos/default_profile.png') {
                Storage::delete($user->photo_path);
            }
    
            // Store the new profile image
            $profileImagePath = $profileImage->store('profile_photos', 'public');
    
            // Update the user's photo_path in the database
            $user->photo_path = $profileImagePath;
            $user->save();
    
            return redirect()->back()->with('success', 'Profile image updated successfully.');
        }
    
        return redirect()->back()->with('error', 'No profile image uploaded.');
    }
    
    public function editEmail()
{
    return view('profile.editEmail');
}

public function updateEmail(Request $request)
{
    $request->validate([
        'password' => 'required',
        'current_email' => 'required|email',
        'email' => 'required|email|unique:clients,email',
        'confirm_email' => 'required|same:email',
    ]);

    $user = Auth::user();

    // Vérifie si le mot de passe actuel est correct
    if (!\Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Mot de passe incorrect.');
    }

    // Vérifie si l'ancien e-mail correspond à celui dans la base de données
    if ($request->current_email !== $user->email) {
        return redirect()->back()->with('error', 'L\'ancien e-mail est incorrect.');
    }

    // Met à jour l'e-mail de l'utilisateur
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with('success', 'Adresse e-mail mise à jour avec succès.');

}

public function editNom()
{
    return view('profile.editNom');
}
public function updateNom(Request $request)
{
    $request->validate([
        'password' => 'required',
        'current_name' => 'required|string',
        'nomClient' => 'required|string|unique:clients,nomClient',
        'confirm_name' => 'required|same:nomClient',
    ]);

    $user = Auth::user();

    // Vérifie si le mot de passe actuel est correct
    if (!\Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Mot de passe incorrect.');
    }

    // Vérifie si l'ancien nom de téléphone correspond à celui dans la base de données
    if ($request->current_name !== $user->nomClient) {
        return redirect()->back()->with('error', 'L\'ancien nom  est incorrect.');
    }

    // Met à jour le nom  de l'utilisateur
    $user->nomClient = $request->nomClient;
    $user->save();

    return redirect()->back()->with('success', 'nom mis à jour avec succès.');
}

public function editTelephone()
{
    return view('profile.ediTelephone');
}

public function updateTelephone(Request $request)
{

    $request->validate([
        'password' => 'required',
        'current_phone' => 'required|numeric',
        'telephone' => 'required|numeric|unique:clients,telephone',
        'confirm_phone' => 'required|same:telephone',
    ]);

    $user = Auth::user();

    // Vérifie si le mot de passe actuel est correct
    if (!\Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Mot de passe incorrect.');
    }

    // Vérifie si l'ancien numéro de téléphone correspond à celui dans la base de données
    if ($request->current_phone !== $user->telephone) {
        return redirect()->back()->with('error', 'L\'ancien numéro de téléphone est incorrect.');
    }

    // Met à jour le numéro de téléphone de l'utilisateur
    $user->telephone = $request->telephone;
    $user->save();

    return redirect()->back()->with('success', 'Numéro de téléphone mis à jour avec succès.');
}

public function editPassword()
{
    return view('profile.editPassword');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed', 
    ]);
    
    $user = Auth::user();
    
    
    if (!\Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Mot de passe incorrect.');
    }
    
    
    $user->password = Hash::make($request->password);
    $user->save();
    
    return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
}
}