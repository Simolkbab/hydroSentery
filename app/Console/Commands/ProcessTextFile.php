<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\SensorData;
use App\Models\Alert;
use App\Models\Client;
use App\Mail\AlertMail;
use Illuminate\Support\Facades\Log;

class ProcessTextFile extends Command
{
    protected $signature = 'app:process-text-file';
    protected $description = 'Traiter les données du fichier texte et insérer dans la base de données';

    public function handle()
    {
        $file_path = 'D:\pfe_detection\data_water.txt';
        $position_file_path = 'public/last_processed_position.txt';

        try {
            if (!Storage::disk('public')->exists('last_processed_position.txt')) {
                Storage::disk('public')->put('last_processed_position.txt', '1');
            }

            $last_processed_position = (int)Storage::disk('public')->get('last_processed_position.txt');
            $data = file_get_contents($file_path);
            $lines = explode("\n", $data);
            $new_position = $last_processed_position;

            // Vérifier si l'insertion est autorisée
            $insertionControl = DB::table('insertion_control')->latest()->first();
            $insertionAllowed = $insertionControl ? $insertionControl->allow_insertion : true;

            for ($i = $last_processed_position - 1; $i < count($lines); $i += 2) {
                if (isset($lines[$i]) && isset($lines[$i + 1])) {
                    $debit = trim($lines[$i]);
                    $difference = trim($lines[$i + 1]);
                    
                    // Insérer dans les données de capteur indépendamment de la valeur de différence
                    SensorData::create([
                        'debit' => $debit,
                        'difference' => $difference,
                        'client_id' => 1,
                    ]);

                    // Si la différence est supérieure à 9 et les alertes sont autorisées
                    if ($difference > 9 && $insertionAllowed) {
                        $alert = Alert::create([
                            'client_id' => 1,
                            'message' => 'Différence au-dessus du seuil : ' . $difference,
                        ]);

                        // Fetch the client and send the email
                        $client = Client::find($alert->client_id);
                        if ($client) {
                            try {
                     
                                Mail::to($client->email)->send(new AlertMail(
                                    $alert->message,
                                    $alert->created_at->format('d/m/Y'),
                                    $alert->created_at->format('H:i')
                                ));
                            } catch (\Exception $e) {
                                Log::error('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
                            }
                        }

                        // Arrêter les insertions d'alertes ultérieures
                        DB::table('insertion_control')->updateOrInsert(
                            ['id' => $insertionControl ? $insertionControl->id : 1],
                            ['allow_insertion' => false]
                        );
                        $this->info('Différence supérieure à 9 détectée. Arrêt des alertes ultérieures.');
                        $insertionAllowed = false; // Mettre à jour le drapeau local pour arrêter les alertes ultérieures
                    }

                    $new_position = $i + 3;
                }
            }

            Storage::disk('public')->put('last_processed_position.txt', $new_position);
            $this->info('Données traitées avec succès.');

        } catch (\Exception $e) {
            $this->error('Erreur lors du traitement des données : ' . $e->getMessage());
        }
    }
}
