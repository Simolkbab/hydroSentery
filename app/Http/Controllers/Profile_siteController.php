<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
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
    $user = Auth::guard('client')->user();



    $validator = Validator::make($request->all(), [
        'email' => [
            'required',
            'email',
            Rule::unique('clients')->ignore($user->client_id, 'client_id'),
        ],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user->email = $request->email;
    $user->save();

    return redirect()->route('show')->with('success', 'E-mail mis à jour avec succès.');
}


public function editTelephone()
{
    return view('profile.ediTelephone');
}



public function updateTelephone(Request $request)
{
    $user = Auth::guard('client')->user();



    // Valider les données du formulaire
    $validator = Validator::make($request->all(), [
        'telephone' => 'required|numeric', // Exemple de règle de validation pour le numéro de téléphone
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mettre à jour le numéro de téléphone du client
    $user->telephone = $request->telephone;
    $user->save();


    return redirect()->route('show')->with('success', 'Numéro de téléphone mis à jour avec succès.');
}




public function editPassword()
{
    return view('profile.editPassword');
}
public function updatePassword(Request $request)
{
    $user = Auth::guard('client')->user();

  
    // Valider les données du formulaire
    $validator = Validator::make($request->all(), [
        'password' => 'required|min:6', // Exemple de règle de validation pour le mot de passe
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mettre à jour le mot de passe du client
    $user->password = bcrypt($request->password); // Assurez-vous de hasher le mot de passe
    $user->save();

    return redirect()->route('show')->with('success', 'Mot de passe mis à jour avec succès.');
}


}
