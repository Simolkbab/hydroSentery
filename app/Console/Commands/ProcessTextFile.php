<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB; // Utilisation de DB pour la gestion des bases de données
use Illuminate\Support\Facades\Storage;


class ProcessTextFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-text-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process data from text file and insert into database';

    /**
     * Execute the console command.
     */

     public function handle()
{
    // Chemin du fichier texte
    $file_path = 'D:\pfe_detection\data_water.txt';

    try {
        if (!Storage::disk('public')->exists("last_processed_position.txt")) {
            Storage::disk('public')->put("last_processed_position.txt", "1");
        }
        
        // Get the content of the file
        $last_processed_position = Storage::disk('public')->get("last_processed_position.txt");

        // Lecture du contenu du fichier à partir de la dernière position
        $data = file_get_contents($file_path, false, null, (int)$last_processed_position);

        // Séparation des lignes du fichier
        $lines = explode("\n", $data);
        // Pour chaque ligne, insérer les données dans la base de données
        foreach (array_slice($lines,$last_processed_position+1) as $line) {
            $debit = (float)$line;

            if ($debit != 0) {
                // Utilisation de l'ORM de Laravel pour insérer les données
                DB::table('sensor_data')->insert([
                    'debit' => $debit,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    
        end($lines);
        Storage::disk('public')->put("last_processed_position.txt", key($lines));

        $this->info('Data processed successfully.');

    } catch (\Exception $e) {
        // Gestion des exceptions
        $this->error('Error processing data: ' . $e->getMessage());
    }
}

            
    
     
//     public function handle()
// {
//     // Chemin du fichier texte
//     $file_path = 'D:\pfe_detection\data_water.txt';

//     // Lecture du contenu du fichier
//     $data = file_get_contents($file_path);

//     // Séparation des lignes du fichier
//     $lines = explode("\n", $data);

//     try {
//         // Supprimer toutes les données existantes dans la table sensor_data
//         DB::table('sensor_data')->truncate();

//         // Pour chaque ligne, insérer les données dans la base de données
//         foreach ($lines as $line) {
//             $debit = (float)$line;

//             if ($debit != 0) {
//                 // Utilisation de l'ORM de Laravel pour insérer les données
//                 DB::table('sensor_data')->insert([
//                     'debit' => $debit,
//                     'created_at' => now(),
//                     'updated_at' => now()
//                 ]);
//             }
//         }

//         $this->info('Data processed successfully.');
//     } catch (\Exception $e) {
//         // Gestion des exceptions
//         $this->error('Error processing data: ' . $e->getMessage());
//     }
// }
}
