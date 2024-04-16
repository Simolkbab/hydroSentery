<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Importez la classe Str pour générer un nom de fichier aléatoire

class ProfileController extends Controller
{
    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'client_id' => 'required',
            'nomClient' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:clients', // changer 'profiles' à 'clients'
            'password' => 'required',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Traitement de l'image s'il est envoyé
        if ($request->hasFile('photo_path')) {
            $image = $request->file('photo_path');
            $extension = $image->getClientOriginalExtension();
            $i = 1;
            do {
                $imageName = 'logo_' . $i . '.' . $extension;
                $i++;
            } while (Storage::disk('public')->exists('profile_photos/' . $imageName));
    
            $imagePath = $image->storeAs('profile_photos', $imageName, 'public'); // Stocke l'image avec le nom généré
        } else {
            $imagePath = null;
        }
    

        // Création d'un nouvel objet Client avec les données validées
        $client = new Client;
        $client->client_id = $validatedData['client_id'];
        $client->nomClient = $validatedData['nomClient'];
        $client->telephone = $validatedData['telephone'];
        $client->email = $validatedData['email'];
        $client->password = bcrypt($validatedData['password']);
        $client->photo_path = $imagePath; // Chemin de l'image
        $client->password_length = strlen($validatedData['password']);

        // Sauvegarde du client dans la base de données
        $client->save();

        // Redirection avec un message de succès
        return redirect('/login');




    }
}
