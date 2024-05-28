<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client; 
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('profile.index', compact('clients'));
    }

    public function create()
    {
        return view('profile.createClient');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomClient' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'telephone' => 'required|string|max:15',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès');
    }

    public function show($client)
    {
        return view('profile.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('profile.editClient', compact('client'));
    }

    public function update(Request $request, $id)  
    {

 
        $client = Client::findOrFail($id);
       
        $request->validate([
            "client_id"=>'nullable|string|max:255',
            'nomClient' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'telephone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

      
        if ($request->filled('password')) {
            $client->password = Hash::make($request->input('password'));
        }

        $client->nomClient = $request->input('nomClient', $client->nomClient);
        $client->email = $request->input('email', $client->email);
        $client->telephone = $request->input('telephone', $client->telephone);

        $client->save();

        return redirect()->route('profile.index')->with('success', 'Client mis à jour avec succès');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        
        return redirect()->route('profile.index')->with('success', 'Client supprimé avec succès');
    }
}
